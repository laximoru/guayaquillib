<?php

namespace GuayaquilLib\objects\am;

use Exception;
use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartObject extends BaseObject
{
    /**
     * @var string
     */
    protected $manufacturer;

    /**
     * @var int
     */
    protected $manufacturerId;

    /**
     * @var int
     */
    protected $partId;

    /**
     * @var string
     */
    protected $formattedOem;

    /**
     * @var string
     */
    protected $oem;

    /**
     * @var string
     */
    protected $name;

    /**
     * @var PartCrossObject[]
     */
    protected $replacements = [];

    /**
     * @var PartImage[]
     */
    protected $images = [];

    /**
     * @var float
     */
    protected $weight;
    /**
     * @var float
     */
    protected $volume;

    /**
     * @var PartDimensions|null
     */
    protected $dimensions;

    /**
     * @var PartProperty[]
     */
    protected $properties = [];

    /**
     * @return string
     */
    public function getManufacturer(): string
    {
        return $this->manufacturer;
    }

    /**
     * @return int
     */
    public function getManufacturerId(): int
    {
        return $this->manufacturerId;
    }

    /**
     * @return int
     */
    public function getPartId(): int
    {
        return $this->partId;
    }

    /**
     * @return string
     */
    public function getFormattedOem(): string
    {
        return $this->formattedOem;
    }

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
     * @return PartCrossObject[]
     */
    public function getReplacements(): array
    {
        return $this->replacements;
    }

    /**
     * @return PartImage[]
     */
    public function getImages(): array
    {
        return $this->images;
    }

    /**
     * @return float
     */
    public function getWeight(): float
    {
        return $this->weight;
    }

    /**
     * @return float
     */
    public function getVolume(): float
    {
        return $this->volume;
    }

    /**
     * @return PartDimensions|null
     */
    public function getDimensions(): ?PartDimensions
    {
        return $this->dimensions;
    }

    /**
     * @return PartProperty[]
     */
    public function getProperties(): array
    {
        return $this->properties;
    }

    /**
     * @param SimpleXMLElement $data
     * @throws Exception
     */
    protected function fromXml(SimpleXMLElement $data)
    {
        $this->partId = (int)$data['detailid'];
        $this->formattedOem = (string)$data['formattedoem'];
        $this->manufacturer = (string)$data['manufacturer'];
        $this->manufacturerId = (int)$data['manufacturerid'];
        $this->name = (string)$data['name'];
        $this->oem = (string)$data['oem'];
        $this->weight = (float)$data['weight'];
        $this->volume = (float)$data['volume'];
        $this->dimensions = (string)$data['dimensions'] ? new PartDimensions($data['dimensions']) : null;

        if ($data->images) {
            foreach ($data->images->image as $image) {
                $this->images[] = new PartImage($image);
            }
        }

        if ($data->replacements) {
            foreach ($data->replacements->replacement as $replacement) {
                $this->replacements[] = new PartCrossObject($replacement);
            }
        }

        if ($data->properties) {
            foreach ($data->properties->property as $property) {
                $this->properties[] = new PartProperty($property);
            }
        }
    }
}