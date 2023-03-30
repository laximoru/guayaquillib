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
     * @var string[]
     */
    protected $permissions = null;

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

    public function permissionsLoaded(): bool
    {
        return is_array($this->permissions);
    }

    private function hideFeature(string $featureName)
    {
        foreach ($this->features as $index => $feature) {
            if ($feature->getName() == $featureName) {
                unset($this->features[$index]);
                return;
            }
        }
    }

    protected function hideDeniedFeatures()
    {
        if ($this->permissionsLoaded()) {
            if (!$this->permissionGranted('SEARCHVEHICLEDETAILS')) {
                $this->hideFeature('fulltextsearch');
            }
            if (!$this->permissionGranted('GETOEMPARTAPPLICABILITY')) {
                $this->hideFeature('detailapplicability');
            }
            if (!$this->permissionGranted('LISTQUICKGROUP')) {
                $this->hideFeature('quickgroups');
            }
            if (!$this->permissionGranted('GETWIZARD2')) {
                $this->hideFeature('wizardsearch2');
            }
            if (!$this->permissionGranted('FINDVEHICLE')) {
                $this->hideFeature('vinsearch');
            }
            if (!$this->permissionGranted('EXECCUSTOMOPERATION')) {
                $this->operations = [];
            }
        }
    }

    public function permissionGranted($permission): bool
    {
        return array_key_exists($permission, $this->permissions);
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
        if (isset($data->permissions) && $data->permissions instanceof SimpleXMLElement && $data->permissions->permission instanceof SimpleXMLElement) {
            $this->permissions = [];
            foreach ($data->permissions->permission as $permission) {
                $permName = (string)$permission;
                $this->permissions[$permName] = true;
            }

            $this->hideDeniedFeatures();
        }
    }

}