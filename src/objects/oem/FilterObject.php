<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class FilterObject extends BaseObject
{
    /**
     * @var FilterFieldObject[]
     */
    protected $fields = [];

    /**
     * @return FilterFieldObject[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data->row as $filterField) {
            $this->fields[] = new FilterFieldObject($filterField);
        }
    }
}