<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class UnitListObject extends BaseObject
{

    /**
     * @var UnitObject[]
     */
    protected $units = [];

    /**
     * @return UnitObject[]
     */
    public function getUnits(): array
    {
        return $this->units;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data->row as $unit) {
            $this->units[] = new UnitObject($unit);
        }
    }
}