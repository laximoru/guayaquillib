<?php

namespace GuayaquilLib\objects\am;


use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartListObject extends BaseObject
{
    /**
     * @var PartObject[] $oems
     */
    protected $oems = [];

    /**
     * @return PartObject[]
     */
    public function getOems(): array
    {
        return $this->oems;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data as $detail) {
            $detail = new PartObject($detail);
            $this->oems[] = $detail;
        }
    }
}