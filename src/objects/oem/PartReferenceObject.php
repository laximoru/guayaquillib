<?php

namespace GuayaquilLib\objects\oem;


use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartReferenceObject extends BaseObject
{
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
     * @param SimpleXMLElement $data
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->brand = (string)$data['brand'];
        $this->code = (string)$data['code'];
        $this->name = (string)$data->name;
    }
}