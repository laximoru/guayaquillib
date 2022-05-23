<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class ImageMapObject extends BaseObject
{
    /**
     * @var MapObject[]
     */
    protected $mapObjects = [];

    /**
     * @return MapObject[]
     */
    public function getMapObjects(): array
    {
        return $this->mapObjects;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data->row as $mapObject) {
            $this->mapObjects[] = new MapObject($mapObject);
        }
    }
}