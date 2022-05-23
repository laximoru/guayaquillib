<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class VehicleObject extends BaseObject
{
    /**
     * @var string
     */
    protected $catalog;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $ssd;

    /**
     * @var string
     */
    protected $vehicleId;

    /**
     * @var AttributeObject[]
     */
    protected $attributes = [];

    /**
     * @var string[]
     */
    protected $systemProperties = [];
    /**
     * @var string
     */
    protected $brand;

    /**
     * @return string
     */
    public function getCatalog(): string
    {
        return $this->catalog;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getSsd(): string
    {
        return $this->ssd;
    }

    /**
     * @return string
     */
    public function getVehicleId(): string
    {
        return $this->vehicleId;
    }

    /**
     * @return AttributeObject[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return string[]
     */
    public function getSystemProperties(): array
    {
        return $this->systemProperties;
    }

    /**
     * @return string
     */
    public function getBrand(): string
    {
        return $this->brand;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->catalog = (string)$data['catalog'];
        $this->name = (string)$data['name'];
        $this->ssd = (string)$data['ssd'];
        $this->vehicleId = (string)$data['vehicleid'];
        $this->brand = (string)$data['brand'];

        if ($data->attribute instanceof SimpleXMLElement) {
            foreach ($data->attribute as $attribute) {
                $attributeObject = new AttributeObject($attribute);
                $this->attributes[$attributeObject->getKey()] = $attributeObject;
            }
        }

        if ($data->sysproperty instanceof SimpleXMLElement) {
            foreach ($data->sysproperty as $attribute) {
                $key = (string)$attribute['key'];
                $this->systemProperties[$key] = (string)$attribute;
            }
        }
    }
}