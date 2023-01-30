<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartShortListObject extends BaseObject
{
    /**
     * @var PartShortObject[]
     */
    protected $parts = [];

    /**
     * @return PartShortObject[]
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
            $this->parts[] = new PartShortObject($part);
        }
    }
}