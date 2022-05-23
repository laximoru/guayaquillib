<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class CategoryListObject extends BaseObject
{
    /**
     * @var CategoryObject[]
     */
    protected $root = [];

    /**
     * @return CategoryObject[]
     */
    public function getRoot(): array
    {
        return $this->root;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $categories = [];
        foreach ($data->row as $categoryData) {
            $category = new CategoryObject($categoryData);
            $categories[$category->getCategoryId()] = $category;
        }

        foreach ($categories as $category) {
            $parentId = $category->getParentCategoryId();

            if ($parentId) {
                $categories[$parentId]->appendChildren($category);
            } else {
                $this->root[] = $category;
            }
        }
    }
}