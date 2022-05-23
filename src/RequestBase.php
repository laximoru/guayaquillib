<?php

namespace GuayaquilLib;

use Exception;
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

            'FindOEM' => 'am\PartListObject/array',
            'FindDetails' => 'am\PartListObject/array',

            'ListManufacturer' => 'am\ManufacturerListObject/single',
            'ManufacturerInfo' => 'am\ManufacturerObject/single',
            'FindReplacements' => 'am\SecondLevelReplacement/single',
            'FindOEMCorrection' => 'am\PartListObject/array',
        ];
    /** @var GuayaquilSoapWrapper */
    protected $soap;

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
     * @return BaseObject
     * @throws Exception
     */
    public function executeCommand(Command $command): BaseObject
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
        $xmlString = $this->soap->queryData($query, $service);
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