<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartObject extends BaseObject
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
     * @var string
     */
    protected $codeOnImage;

    /**
     * @var string
     */
    protected $ssd;

    /**
     * var bool
     */
    protected $match;

    /**
     * var bool
     */
    protected $filter;

    /**
     * @var AttributeObject[]
     */
    protected $attributes = [];

    /**
     * @var PartLink[]
     */
    protected $links = [];

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
     * @return string
     */
    public function getCodeOnImage(): string
    {
        return $this->codeOnImage;
    }

    /**
     * @return string
     */
    public function getSsd(): string
    {
        return $this->ssd;
    }

    /**
     * @return mixed
     */
    public function getMatch()
    {
        return $this->match;
    }

    /**
     * @return mixed
     */
    public function getFilter()
    {
        return $this->filter;
    }

    /**
     * @return AttributeObject[]
     */
    public function getAttributes(): array
    {
        return $this->attributes;
    }

    /**
     * @return array
     */
    public function getLinks(): array
    {
        return $this->links;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->oem = (string)$data['oem'];
        $this->name = (string)$data['name'];
        $this->codeOnImage = (string)$data['codeonimage'];
        $this->match = ((string)$data['match']) == 't';
        $this->filter = (string)$data['filter'];
        $this->ssd = (string)$data['ssd'];

        if (!empty($data->Links)) {
            foreach ($data->Links->Link as $link) {
                $linkObject = new PartLink($link);
                $this->links[] = $linkObject;
            }
        }

        if ($data->attribute instanceof SimpleXMLElement) {
            foreach ($data->attribute as $attribute) {
                $this->attributes[] = new AttributeObject($attribute);
            }
        }
    }
}