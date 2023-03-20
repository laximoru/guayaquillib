<?php

namespace GuayaquilLib\objects\am;

use GuayaquilLib\objects\BaseObject;
use SimpleXMLElement;

class PartImage extends BaseObject
{
    /**
     * @var string
     */
    protected $filename;

    /**
     * @var string
     */
    protected $thumbnailFilename;

    /**
     * @var int
     */
    protected $height;

    /**
     * @var int
     */
    protected $width;

    /**
     * @return string
     */
    public function getFilename(): string
    {
        return $this->filename;
    }

    /**
     * @return string
     */
    public function getThumbnailFilename(): string
    {
        return $this->thumbnailFilename;
    }

    /**
     * @return int
     */
    public function getHeight(): int
    {
        return $this->height;
    }

    /**
     * @return int
     */
    public function getWidth(): int
    {
        return $this->width;
    }

    protected function fromXml(SimpleXMLElement $data)
    {
        $this->filename = (string)$data['filename'];
        $this->height = (int)$data['height'];
        $this->width = (int)$data['width'];
        $this->thumbnailFilename = (string)$data['thumbnailfilename'];
    }
}