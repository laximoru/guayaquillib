<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartShortObject extends BaseObject
{
    /**
     * @var string
     */
    protected $oem;

    /**
     * @var string
     */
    protected $name;

    /**
     * @return string
     */
    public function getOem(): string
    {
        return $this->oem;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->oem = (string)$data['oem'];
        $this->name = (string)$data;
    }
}