<?php


namespace GuayaquilLib\objects;

use Exception;
use SimpleXMLElement;

abstract class BaseObject
{
    /**
     * @param SimpleXMLElement|null $data
     * @throws Exception
     */
    public function __construct(SimpleXMLElement $data = null)
    {
        if (is_null($data)) {
            throw new Exception('Empty data');
        }

        $this->fromXml($data);
    }

    /**
     * @param SimpleXMLElement $data
     */
    abstract protected function fromXml(SimpleXMLElement $data);
}