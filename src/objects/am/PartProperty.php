<?php

namespace GuayaquilLib\objects\am;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartProperty extends BaseObject
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $propertyName;

    /**
     * @var float
     */
    protected $rate;

    /**
     * @var string
     */
    protected $value;

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
    public function getPropertyName(): string
    {
        return $this->propertyName;
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
    public function getValue(): string
    {
        return $this->value;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->code = (string)$data['code'];
        $this->propertyName = (string)$data['property'];
        $this->rate = (float)$data['rate'];
        $this->value = (string)$data['value'];
    }
}