<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class VehicleListObject extends BaseObject
{
    /**
     * @var VehicleObject[]
     */
    protected $vehicles = [];

    /**
     * @return VehicleObject[]
     */
    public function getVehicles(): array
    {
        return $this->vehicles;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data->row as $vehicle) {
            $this->vehicles[] = new VehicleObject($vehicle);
        }
    }
}