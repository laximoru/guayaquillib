<?php

namespace GuayaquilLib\objects\am;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class SecondLevelReplacementList extends BaseObject
{
    /**
     * @var SecondLevelReplacement[]
     */
    protected $replacements = [];

    /**
     * @return SecondLevelReplacement[]
     */
    public function getReplacements(): array
    {
        return $this->replacements;
    }

    /**
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        foreach ($data as $row) {
            $this->replacements[] = new SecondLevelReplacement($row);
        }
    }
}