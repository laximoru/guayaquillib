<?php

namespace GuayaquilLib\objects\oem;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class WizardStepOptionObject extends BaseObject
{
    /**
     * @var string
     */
    protected $key;

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
    public function getValue(): string
    {
        return $this->value;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->key = (string)$data['key'];
        $this->value = html_entity_decode($data['value']);
    }
}