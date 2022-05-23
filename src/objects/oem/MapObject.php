<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class MapObject extends BaseObject
{
    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $type;

    /**
     * @var int
     */
    protected $x1;

    /**
     * @var int
     */
    protected $x2;

    /**
     * @var int
     */
    protected $y1;

    /**
     * @var int
     */
    protected $y2;

    /** @var  PartLink */
    protected $link;

    /**
     * @return string
     */
    public function getCode(): string
    {
        return $this->code;
    }

    /**
     * @return string
     */
    public function getType(): string
    {
        return $this->type;
    }

    /**
     * @return int
     */
    public function getX1(): int
    {
        return $this->x1;
    }

    /**
     * @return int
     */
    public function getX2(): int
    {
        return $this->x2;
    }

    /**
     * @return int
     */
    public function getY1(): int
    {
        return $this->y1;
    }

    /**
     * @return int
     */
    public function getY2(): int
    {
        return $this->y2;
    }

    /**
     * @return PartLink
     */
    public function getLink(): ?PartLink
    {
        return $this->link;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->code = (string)$data['code'];
        $this->type = (string)$data['type'];
        $this->x1 = (int)$data['x1'];
        $this->x2 = (int)$data['x2'];
        $this->y1 = (int)$data['y1'];
        $this->y2 = (int)$data['y2'];

        if ($data->Link) {
            $this->link = new PartLink($data->Link);
        }
    }
}