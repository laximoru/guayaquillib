<?php

namespace GuayaquilLib;

use Exception;
use GuayaquilLib\exceptions\AccessDeniedException;
use GuayaquilLib\exceptions\AccessLimitReachedException;
use GuayaquilLib\exceptions\CatalogFeatureNotSupportedExeption;
use GuayaquilLib\exceptions\CatalogNotExistsException;
use GuayaquilLib\exceptions\GroupIsNotSearchableException;
use GuayaquilLib\exceptions\InvalidParameterException;
use GuayaquilLib\exceptions\InvalidRequestException;
use GuayaquilLib\exceptions\NotSupportedException;
use GuayaquilLib\exceptions\OperationNotFoundException;
use GuayaquilLib\exceptions\StandardPartException;
use GuayaquilLib\exceptions\TemporaryUnavailableExeption;
use GuayaquilLib\exceptions\TimeoutException;
use GuayaquilLib\exceptions\TooManyRequestsException;
use GuayaquilLib\exceptions\UnexpectedProblemException;
use GuayaquilLib\exceptions\UnknownCommandException;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;
use SoapFault;

abstract class RequestBase
{
    protected static $typeMap =
        [
            'GetCatalogInfo' => 'oem\CatalogObject/single',
            'ListCatalogs' => 'oem\CatalogListObject/array',

            'FindVehicleByVIN' => 'oem\VehicleListObject/array',
            'FindVehicleByFrameNo' => 'oem\VehicleListObject/array',
            'ExecCustomOperation' => 'oem\VehicleListObject/array',
            'FindVehicle' => 'oem\VehicleListObject/array',
            'GetVehicleInfo' => 'oem\VehicleObject/single',

            'GetWizard2' => 'oem\WizardObject/array',
            'FindVehicleByWizard2' => 'oem\VehicleListObject/array',

            'ListQuickGroups' => 'oem\GroupObject/single',
            'ListQuickDetail' => 'oem\QuickDetailListObject/array',

            'ListCategories' => 'oem\CategoryListObject/array',
            'ListUnits' => 'oem\UnitListObject/array',
            'GetUnitInfo' => 'oem\UnitObject/single',
            'ListImageMapByUnit' => 'oem\ImageMapObject/array',
            'ListDetailsByUnit' => 'oem\PartListObject/array',

            'GetFilterByUnit' => 'oem\FilterObject/array',
            'GetFilterByDetail' => 'oem\FilterObject/array',

            'OEMPartReferences' => 'oem\PartReferencesListObject/array',
            'FindApplicableVehicles' => 'oem\VehicleListObject/array',
            'GetOEMPartApplicability' => 'oem\QuickDetailListObject/array',

            'SearchVehicleDetails' => 'oem\PartShortListObject/array',

            'FindOEM' => 'am\PartListObject/array',
            'FindDetails' => 'am\PartListObject/array',

            'ListManufacturer' => 'am\ManufacturerListObject/single',
            'ManufacturerInfo' => 'am\ManufacturerObject/single',
            'FindReplacements' => 'am\SecondLevelReplacementList/array',
            'FindOEMCorrection' => 'am\PartListObject/array',
        ];
    /** @var GuayaquilSoapWrapper */
    public $soap;

    /**
     * @param string $login
     * @param string $password
     */
    public function __construct(string $login, string $password)
    {
        $this->soap = new GuayaquilSoapWrapper();
        $this->soap->setUser($login, $password);
    }

    /**
     * @param Command $command
     * @return mixed
     * @throws Exception
     */
    public function executeCommand(Command $command)
    {
        $simpleXMLElements = $this->_query($command->getCommand(), $command->getService());

        foreach ($simpleXMLElements as $xml) {
            return $this->getObject($xml);
        }

        throw new Exception('Data not found');
    }

    /**
     * @param string $query
     * @param string $service
     * @return SimpleXMLElement[]
     * @throws SoapFault
     */
    protected function _query(string $query, string $service): array
    {
        try {
            $xmlString = $this->soap->queryData($query, $service);
        } catch (SoapFault $ex) {
            if (substr($ex->getMessage(), 0, 2) == 'E_') {
                list($reason, $message) = explode(':', $ex->getMessage(), 2);
                switch (trim($reason)) {
                    case 'E_CATALOGNOTEXISTS':
                        throw new CatalogNotExistsException($ex->getMessage());
                    case 'E_INVALIDREQUEST':
                        throw new InvalidRequestException($ex->getMessage());
                    case 'E_INVALIDPARAMETER':
                        throw new InvalidParameterException($ex->getMessage());
                    case 'E_UNKNOWNCOMMAND':
                        throw new UnknownCommandException($ex->getMessage());
                    case 'E_ACCESSDENIED':
                        throw new AccessDeniedException($ex->getMessage());
                    case 'E_NOTSUPPORTED':
                        throw new NotSupportedException($ex->getMessage());
                    case 'E_GROUP_IS_NOT_SEARCHABLE':
                        throw new GroupIsNotSearchableException($ex->getMessage());
                    case 'E_TOO_MANY_REQUESTS':
                        throw new TooManyRequestsException($ex->getMessage());
                    case 'E_STANDARD_PART_SEARCH':
                        throw new StandardPartException($ex->getMessage());
                    case 'E_ACCESSLIMITREACHED':
                        throw new AccessLimitReachedException($ex->getMessage());
                    case 'E_CATALOG_FEATURE_NOT_SUPPORTED':
                        throw new CatalogFeatureNotSupportedExeption($ex->getMessage());
                    case 'E_OPERATION_NOT_FOUND':
                        throw new OperationNotFoundException($ex->getMessage());
                    case 'E_TEMPORARY_UNAVAILABLE':
                        throw new TemporaryUnavailableExeption($ex->getMessage());
                    case 'E_TIMEOUT':
                        throw new TimeoutException($ex->getMessage());
                    case 'E_UNEXPECTED_PROBLEM':
                        throw new UnexpectedProblemException($ex->getMessage());
                }
            }
            throw $ex;
        }
        $data = $this->parseXml($xmlString);

        if ($data && method_exists(get_class($data), 'children')) {
            $result = [];
            foreach ($data->children() as $row) {
                $result[] = $row;
            }
        } else {
            throw new Exception('Unable to parse data ' . $xmlString);
        }

        return $result;
    }

    /**
     * @param $xmlString
     * @return \$1|false|SimpleXMLElement
     */
    protected function parseXml(string $xmlString)
    {
        $data = simplexml_load_string($xmlString);

        return $data;
    }

    /**
     * @param SimpleXMLElement $data
     * @return BaseObject
     * @throws Exception
     */
    protected function getObject(SimpleXMLElement $data): BaseObject
    {
        $elementName = $data->getName();
        if (array_key_exists($elementName, self::$typeMap)) {
            $mapType = self::$typeMap[$elementName];
            list($classSuffix, $multiplicity) = explode('/', $mapType);
            $className = 'GuayaquilLib\objects\\' . $classSuffix;
            return new $className($multiplicity == 'single' ? $data->row : $data);
        } else {
            throw new Exception('Unable to map result, unknown command type ' . $elementName);
        }
    }

    /**
     * @param Command[] $commands
     * @return BaseObject[]
     * @throws Exception
     */
    public function queryButch(array $commands): array
    {
        $result = [];
        $queries = [];
        $resultObjects = [];
        $service = false;

        /** @var $query Command */
        foreach ($commands as $command) {
            if ($service === false) {
                $service = $command->getService();
            } elseif ($service != $command->getService()) {
                throw new \Exception('Different types of service is not allowed');
            }

            $queries[] = $command->getCommand();

            if (count($queries) == 5) {
                $partialResult = $this->_query(implode("\n", $queries), $service);
                $result = array_merge($result, $partialResult);
                $queries = [];
            }
        }

        if (count($queries) > 0) {
            $partialResult = $this->_query(implode("\n", $queries), $service);
            $result = array_merge($result, $partialResult);
        }

        /** @var SimpleXMLElement $element */
        foreach ($result as $index => $element) {
            $resultObjects[$index] = $this->getObject($element);
        }

        return $resultObjects;
    }
}