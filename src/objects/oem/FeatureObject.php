<?php

namespace GuayaquilLib\objects\oem;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class FeatureObject extends BaseObject
{
    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $example;

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
    public function getExample(): string
    {
        return $this->example;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->example = isset($data['example']) ? (string)$data['example'] : '';
        $this->name = (string)$data['name'];
    }
}