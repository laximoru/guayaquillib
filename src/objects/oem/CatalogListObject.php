<?php

namespace GuayaquilLib\objects\oem;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class CatalogListObject extends BaseObject
{
    /**
     * @var CatalogObject[]
     */
    protected $catalogs;

    /**
     * @var string[]
     */
    protected $examples;

    /**
     * @return CatalogObject[]
     */
    public function getCatalogs(): array
    {
        return $this->catalogs;
    }

    /**
     * @return mixed
     */
    public function getExamples(): array
    {
        return $this->examples;
    }


    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data as $catalog) {
            $catObj = new CatalogObject($catalog);
            $this->catalogs[] = $catObj;
        }

        $this->examples = $this->getRandomExample();
    }

    private function getRandomExample(): array
    {
        if (!$this->catalogs) {
            $this->catalogs = [];
        }

        $rand = rand(1, count($this->catalogs));

        $count = 0;

        $vinExample = 'WAUZZZ4M6JD010702';
        $frameExample = 'XZU423-0001026';

        foreach ($this->catalogs as $catalog) {
            $count++;

            if ($count === $rand && isset($catalog->vinexample) && !empty($catalog->vinexample)) {
                $vinExample = $catalog->vinexample;

                break;
            }
        }

        $count = 0;
        $rand = rand(1, count($this->catalogs));

        foreach ($this->catalogs as $catalog) {
            $count++;

            if ($count === $rand && isset($catalog->frameexample) && !empty($catalog->frameexample)) {
                $frameExample = $catalog->frameexample;

                break;
            }
        }

        return [$vinExample, $frameExample];
    }
}