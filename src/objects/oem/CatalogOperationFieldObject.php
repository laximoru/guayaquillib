<?php

namespace GuayaquilLib\objects\oem;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class CatalogOperationFieldObject extends BaseObject
{

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var string
     */
    protected $pattern;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
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
    public function getPattern(): string
    {
        return $this->pattern;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->description = (string)$data['description'];
        $this->name = (string)$data['name'];
        $this->pattern = (string)$data['pattern'];
    }
}