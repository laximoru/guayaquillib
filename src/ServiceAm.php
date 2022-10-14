<?php

namespace GuayaquilLib;

use Exception;
use GuayaquilLib\objects\am\ManufacturerListObject;
use GuayaquilLib\objects\am\ManufacturerObject;
use GuayaquilLib\objects\am\PartListObject;
use GuayaquilLib\objects\am\SecondLevelReplacementList;

class ServiceAm extends RequestBase
{
    /**
     * @param string $oem
     * @param string $brand
     * @param string[] $options
     * @param string[] $replacementtypes
     * @param string $locale
     * @return PartListObject
     * @throws Exception
     */
    public function findOem(string $oem, string $brand = '', array $options = [], array $replacementtypes = [], string $locale = 'ru_RU'): PartListObject
    {
        return $this->executeCommand(Am::findOem($oem, $brand, $options, $replacementtypes, $locale));
    }

    /**
     * @param int $partId
     * @param string[] $options
     * @param string[] $replacementtypes
     * @param string $locale
     * @return PartListObject
     * @throws Exception
     */
    public function findPart(int $partId, array $options = [], array $replacementtypes = [], string $locale = 'ru_RU'): PartListObject
    {
        return $this->executeCommand(Am::findPart($partId, $options, $replacementtypes, $locale));
    }

    public function listManufacturer(string $locale = 'ru_RU'): ManufacturerListObject
    {
        return $this->executeCommand(Am::listManufacturer($locale));
    }

    public function getManufacturerInfo(int $manufacturerId, string $locale = 'ru_RU'): ManufacturerObject
    {
        return $this->executeCommand(Am::getManufacturerInfo($manufacturerId, $locale));
    }

    public function findReplacements(int $partId, string $locale = 'ru_RU', bool $crossOriginals = false): SecondLevelReplacementList
    {
        return $this->executeCommand(Am::findReplacements($partId, $locale, $crossOriginals));
    }

    public function findOemCorrection(string $oem, string $locale = 'ru_RU'): PartListObject
    {
        return $this->executeCommand(Am::findOemCorrection($oem, $locale));
    }
}
