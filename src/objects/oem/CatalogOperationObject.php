<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class CatalogOperationObject extends BaseObject
{

    /**
     * @var string
     */
    protected $description;

    /**
     * @var string
     */
    protected $kind;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var CatalogOperationFieldObject[]
     */
    protected $fields;

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getKind(): string
    {
        return $this->kind;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return CatalogOperationFieldObject[]
     */
    public function getFields(): array
    {
        return $this->fields;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->description = (string)$data['description'];
        $this->kind = (string)$data['kind'];
        $this->name = (string)$data['name'];
        foreach ($data->field as $field) {
            $this->fields[] = new CatalogOperationFieldObject($field);
        }
    }
}