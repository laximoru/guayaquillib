<?php

namespace GuayaquilLib\objects\am;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartCrossObject extends BaseObject
{
    /**
     * @var float
     */
    protected $rate;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var string
     */
    protected $way;

    /**
     * @var PartObject
     */
    protected $part;

    /**
     * @return float
     */
    public function getRate(): float
    {
        return $this->rate;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return string
     */
    public function getWay(): string
    {
        return $this->way;
    }

    /**
     * @return PartObject
     */
    public function getPart(): PartObject
    {
        return $this->part;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->rate = (float)$data['rate'];
        $this->type = (string)$data['type'];
        $this->way = (string)$data['way'];
        $this->part = new PartObject($data->detail);
    }
}