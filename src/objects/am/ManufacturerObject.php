<?php

namespace GuayaquilLib\objects\am;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class ManufacturerObject extends BaseObject
{
    /**
     * @var int
     */
    protected $manufacturerId;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var bool
     */
    protected $isOriginal;

    /**
     * @var string[]
     */
    protected $aliases = [];

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
     * @return bool
     */
    public function isOriginal(): bool
    {
        return $this->isOriginal;
    }

    /**
     * @return string[]
     */
    public function getAliases(): array
    {
        return $this->aliases;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->manufacturerId = (int)$data['manufacturerid'];
        $this->aliases = (string)$data['alias'] ? explode(',', (string)$data['alias']) : [];
        $this->name = (string)$data['name'];
        $this->isOriginal = (string)$data['isoriginal'] == 'true';
    }
}