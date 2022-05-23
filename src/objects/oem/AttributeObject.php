<?php

namespace GuayaquilLib\objects\oem;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class AttributeObject extends BaseObject
{
    /**
     * @var string
     */
    protected $key;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $value;

    /**
     * @return string
     */
    public function getKey(): string
    {
        return $this->key;
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
    public function getValue(): string
    {
        return $this->value;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->key = (string)$data['key'];
        $this->name = (string)$data['name'];
        $this->value = (string)$data['value'];
    }
}