<?php

namespace GuayaquilLib\objects\am;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class SecondLevelReplacement extends BaseObject
{
    /**
     * @var int
     */
    protected $detailId;

    /**
     * @var string
     */
    protected $formattedOem;

    /**
     * @var string
     */
    protected $oem;

    /**
     * @var string
     */
    protected $manufacturer;

    /**
     * @var int
     */
    protected $manufacturerId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var string Duplicate/PartOfTheWhole/etc
     */
    protected $replacementtype1;

    /**
     * @var string Duplicate/PartOfTheWhole/etc
     */
    protected $replacementtype2;

    /**
     * @var string Forward/Backward
     */
    protected $type1;

    /**
     * @var string Forward/Backward
     */
    protected $type2;

    /**
     * @var float
     */
    protected $weight;

    /**
     * @return int
     */
    public function getDetailId(): int
    {
        return $this->detailId;
    }

    /**
     * @return string
     */
    public function getFormattedOem(): string
    {
        return $this->formattedOem;
    }

    /**
     * @return string
     */
    public function getOem(): string
    {
        return $this->oem;
    }

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @return int
     */
    public function getManufacturerId(): int
    {
        return $this->manufacturerId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return string
     */
    public function getReplacementtype1(): string
    {
        return $this->replacementtype1;
    }

    /**
     * @return string
     */
    public function getReplacementtype2(): string
    {
        return $this->replacementtype2;
    }

    /**
     * @return string
     */
    public function getType1(): string
    {
        return $this->type1;
    }

    /**
     * @return string
     */
    public function getType2(): string
    {
        return $this->type2;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->detailId = (int)$data['detailid'];
        $this->formattedOem = (string)$data['formattedoem'];
        $this->manufacturer = (string)$data['manufacturer'];
        $this->manufacturerId = (int)$data['manufacturerid'];
        $this->name = (string)$data['name'];
        $this->oem = (string)$data['oem'];
        $this->rate = (float)$data['rate'];
        $this->replacementtype1 = (string)$data['replacementtype1'];
        $this->replacementtype2 = (string)$data['replacementtype2'];
        $this->type1 = (string)$data['type1'];
        $this->type2 = (string)$data['type2'];
        $this->weight = (float)$data['weight'];
    }
}