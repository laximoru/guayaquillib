<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartListObject extends BaseObject
{

    /**
     * @var PartObject[]
     */
    protected $parts = [];

    /**
     * @return PartObject[]
     */
    public function getParts(): array
    {
        return $this->parts;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data->row as $part) {
            $this->parts[] = new PartObject($part);
        }
    }
}