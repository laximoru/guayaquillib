<?php

namespace GuayaquilLib\objects\am;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartDimensions extends BaseObject
{
    /**
     * @var float
     */
    protected $d1;

    /**
     * @var float
     */
    protected $d2;

    /**
     * @var float
     */
    protected $d3;

    /**
     * @return float
     */
    public function getD1(): float
    {
        return $this->d1;
    }

    /**
     * @return float
     */
    public function getD2(): float
    {
        return $this->d2;
    }

    /**
     * @return float
     */
    public function getD3(): float
    {
        return $this->d3;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        list($this->d1, $this->d2, $this->d3) = explode('X', $data);
    }
}