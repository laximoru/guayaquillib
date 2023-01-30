<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class CatalogObject extends BaseObject
{
    public const FEATURE_VIN_SEARCH = 'vinsearch';
    public const FEATURE_FRAME_SEARCH = 'framesearch';
    public const FEATURE_WIZARD2 = 'wizardsearch2';
    public const FEATURE_QUICK_GROUPS = 'quickgroups';
    public const FEATURE_APPLICABILITY = 'detailapplicability';
    public const FEATURE_PART_BY_NAME_SEARCH = 'fulltextsearch';

    /**
     * @var string
     */
    protected $brand;

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var FeatureObject[]
     */
    protected $features = [];

    /**
     * @var CatalogOperationObject[]
     */
    protected $operations = [];

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return FeatureObject[]
     */
    public function getFeatures(): array
    {
        return $this->features;
    }

    /**
     * @return CatalogOperationObject[]
     */
    public function getOperations(): array
    {
        return $this->operations;
    }

    public function getVinSearchFeature(): ?FeatureObject
    {
        return $this->getFeature(self::FEATURE_VIN_SEARCH);
    }

    public function getFeature(string $name): ?FeatureObject
    {
        foreach ($this->features as $feature) {
            if ($feature->getName() == $name) {
                return $feature;
            }
        }

        return null;
    }

    public function getFrameSearchFeature(): ?FeatureObject
    {
        return $this->getFeature(self::FEATURE_FRAME_SEARCH);
    }

    public function getWizard2Feature(): ?FeatureObject
    {
        return $this->getFeature(self::FEATURE_WIZARD2);
    }

    public function getQuickGroupsFeature(): ?FeatureObject
    {
        return $this->getFeature(self::FEATURE_QUICK_GROUPS);
    }

    public function getDetailApplicabilityFeature(): ?FeatureObject
    {
        return $this->getFeature(self::FEATURE_APPLICABILITY);
    }

    public function getPartByNameSearchFeature(): ?FeatureObject
    {
        return $this->getFeature(self::FEATURE_PART_BY_NAME_SEARCH);
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->brand = (string)$data['brand'];
        $this->name = (string)$data['name'];
        $this->code = (string)$data['code'];

        if (isset($data->features) && $data->features instanceof SimpleXMLElement) {
            foreach ($data->features->feature as $feature) {
                $this->features[] = new FeatureObject($feature);
            }
        }

        if (isset($data->extensions) && $data->extensions instanceof SimpleXMLElement && $data->extensions->operations instanceof SimpleXMLElement) {
            foreach ($data->extensions->operations->operation as $operation) {
                $this->operations[] = new CatalogOperationObject($operation);
            }
        }
    }
}