<?php

namespace GuayaquilLib\objects\am;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class ManufacturerListObject extends BaseObject
{
    /**
     * @var ManufacturerObject[]
     */
    protected $manufacturers = [];

    /**
     * @return ManufacturerObject[]
     */
    public function getManufacturers(): array
    {
        return $this->manufacturers;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data as $row) {
            $this->manufacturers[] = new ManufacturerObject($row);
        }
    }
}