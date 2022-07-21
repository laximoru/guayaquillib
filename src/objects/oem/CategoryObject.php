<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class CategoryObject extends BaseObject
{
    /**
     * @var int
     */
    protected $categoryId;

    /**
     * @var CategoryObject[]|null
     */
    protected $childrens = [];

    /**
     * @var string
     */
    protected $code;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var int
     */
    protected $parentCategoryId;

    /**
     * @var string
     */
    protected $ssd;

    /**
     * @var UnitObject[]
     */
    protected $units = [];

    /**
     * @return int
     */
    public function getCategoryId(): int
    {
        return $this->categoryId;
    }

    /**
     * @return CategoryObject[]|null
     */
    public function getChildrens(): ?array
    {
        return $this->childrens;
    }

    /**
     * @param CategoryObject $child
     * @return void
     */
    public function appendChildren(CategoryObject $child): void
    {
        $this->childrens[] = $child;
    }

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
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return int
     */
    public function getParentCategoryId(): ?int
    {
        return $this->parentCategoryId;
    }

    /**
     * @return string
     */
    public function getSsd(): string
    {
        return $this->ssd;
    }

    /**
     * @return UnitObject[]
     */
    public function getUnits(): array
    {
        return $this->units;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->categoryId = (int)$data['categoryid'];
        $this->code = (string)$data['code'];
        $this->name = (string)$data['name'];
        $this->parentCategoryId = (int)$data['parentcategoryid'];
        $this->ssd = (string)$data['ssd'];

        if ($data->Unit instanceof SimpleXMLElement) {
            foreach ($data->Unit as $unit) {
                $this->units[] = new UnitObject($unit);
            }
        }
    }
}