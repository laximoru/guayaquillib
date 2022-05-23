<?php

namespace GuayaquilLib;

class Am
{
    public const optionsCrosses = 'crosses';
    public const optionsWeights = 'weights';
    public const optionsNames = 'names';
    public const optionsProperties = 'properties';
    public const optionsImages = 'images';

    public const replacementTypePartOfTheWhole = 'PartOfTheWhole';
    public const replacementTypeReplacement = 'Replacement';
    public const replacementTypeDuplicate = 'Duplicate';
    public const replacementTypeTuning = 'Tuning';
    public const replacementTypeCode = 'Code';

    /**
     * @param string $oem
     * @param string $brand
     * @param string[] $options Array of options
     * @param string[] $replacementTypes Array of replacement types
     * @param string $locale
     * @return Command
     */
    public static function findOem(string $oem, string $brand = '', array $options = [], array $replacementTypes = [], string $locale = 'ru_RU'): Command
    {
        return new Command('FindOEM', [
            'Locale' => $locale,
            'Brand' => $brand,
            'OEM' => $oem,
            'ReplacementTypes' => count($replacementTypes) ? implode(',', $replacementTypes) : 'default',
            'Options' => implode(',', $options),
        ], 'am');
    }

    /**
     * @param int $partId
     * @param string[] $options
     * @param string[] $replacementTypes
     * @param string $locale
     * @return Command
     */
    public static function findPart(int $partId, array $options = [], array $replacementTypes = [], string $locale = 'ru_RU'): Command
    {
        return new Command('FindDetail', [
            'Locale' => $locale,
            'DetailId' => $partId,
            'ReplacementTypes' => count($replacementTypes) ? implode(',', $replacementTypes) : 'default',
            'Options' => implode(',', $options),
        ], 'am');
    }

    public static function listManufacturer(string $locale = 'ru_RU'): Command
    {
        return new Command('ListManufacturer', [
            'Locale' => $locale,
        ], 'am');
    }

    public static function getManufacturerInfo(int $manufacturerId, string $locale = 'ru_RU'): Command
    {
        return new Command('ManufacturerInfo', [
            'Locale' => $locale,
            'ManufacturerId' => $manufacturerId,
        ], 'am');
    }

    public static function findReplacements(int $partId, string $locale = 'ru_RU'): Command
    {
        return new Command('FindReplacements', [
            'Locale' => $locale,
            'DetailId' => $partId,
        ], 'am');
    }

    public static function findOemCorrection(string $oem, string $locale = 'ru_RU'): Command
    {
        return new Command('FindOEMCorrection', [
            'Locale' => $locale,
            'OEM' => $oem,
        ], 'am');
    }
}