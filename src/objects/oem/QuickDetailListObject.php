<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class QuickDetailListObject extends BaseObject
{
    /**
     * @var CategoryObject[]
     */
    protected $categories = [];

    /**
     * @return CategoryObject[]
     */
    public function getCategories(): array
    {
        return $this->categories;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data->Category as $category) {
            $this->categories[] = new CategoryObject($category);
        }
    }
}