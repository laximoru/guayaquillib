<?php

namespace GuayaquilLib\objects\oem;


use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartReferencesListObject extends BaseObject
{
    /**
     * @var string $oem
     */
    protected $oem;

    /**
     * @var string $name
     */
    protected $name;

    /**
     * @var PartReferenceObject[] $referencesList
     */
    protected $references = [];

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
     * @return PartReferenceObject[]
     */
    public function getReferences(): array
    {
        return $this->references;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        if (!empty($data)) {
            $this->oem = (string)$data->OEMPartReference->attributes()->oem;
            $this->name = (string)$data->OEMPartReference->name;

            if (!empty($data->OEMPartReference)) {
                foreach ($data->OEMPartReference as $OEMPartReferenceItem) {
                    foreach ($OEMPartReferenceItem->CatalogReferences as $catalogReference) {
                        foreach ($catalogReference->CatalogReference as $reference) {
                            $this->references[] = new PartReferenceObject($reference);
                        }
                    }
                }
            }
        }
    }
}