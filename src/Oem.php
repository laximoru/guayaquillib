<?php

namespace GuayaquilLib;

class Oem
{
    public static function listCatalogs(string $locale = 'ru_RU'): Command
    {
        return new Command('ListCatalogs', [
            'Locale' => $locale
        ], 'oem');
    }

    public static function getCatalogInfo(string $catalog, string $locale = 'ru_RU', bool $withPermissions = false): Command
    {
        $params = [
            'Locale' => $locale,
            'Catalog' => $catalog
        ];
        if ($withPermissions) {
            $params['withPermissions'] = 'true';
        }

        return new Command('GetCatalogInfo', $params, 'oem');
    }

    public static function findVehicle(string $identString, string $locale = 'ru_RU'): Command
    {
        return new Command('FindVehicle', [
            'Locale' => $locale,
            'IdentString' => $identString
        ], 'oem');
    }

    public static function findVehicleByVin(string $vin, string $locale = 'ru_RU'): Command
    {
        return new Command('FindVehicleByVIN', [
            'Locale' => $locale,
            'VIN' => $vin,
            'Localized' => 'true'
        ], 'oem');
    }

    public static function findVehicleByFrameNo(string $frameNo, string $locale = 'ru_RU'): Command
    {
        return new Command('FindVehicleByFrameNo', [
            'Locale' => $locale,
            'FrameNo' => $frameNo,
            'Localized' => 'true'
        ], 'oem');
    }

    public static function findVehicleByPlateNumber(string $plate, string $locale = 'ru_RU'): Command
    {
        return new Command('FindVehicleByPlateNumber', [
            'Locale' => $locale,
            'PlateNumber' => $plate,
            'CountryCode' => 'ru',
            'Localized' => 'true'
        ], 'oem');
    }

    public static function findVehicleByWizard2(string $catalog, string $ssd, string $locale = 'ru_RU'): Command
    {
        return new Command('FindVehicleByWizard2', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'ssd' => $ssd,
            'Localized' => 'true'
        ], 'oem');
    }

    public static function execCustomOperation(string $catalog, string $operation, array $data, string $locale = 'ru_RU'): Command
    {
        return new Command('ExecCustomOperation', array_merge([
            'Locale' => $locale,
            'Catalog' => $catalog,
            'operation' => $operation
        ], $data), 'oem');
    }

    public static function getVehicleInfo(string $catalog, string $vehicleId, string $ssd, string $locale = 'ru_RU'): Command
    {
        return new Command('GetVehicleInfo', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'VehicleId' => $vehicleId,
            'ssd' => $ssd,
            'Localized' => 'true'
        ], 'oem');
    }

    public static function getWizard2(string $catalog, $ssd = '', string $locale = 'ru_RU'): Command
    {
        return new Command('GetWizard2', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'ssd' => $ssd
        ], 'oem');
    }

    public static function listCategories(string $catalog, string $vehicleId, string $ssd, string $categoryId = '-1', string $locale = 'ru_RU'): Command
    {
        return new Command('ListCategories', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'VehicleId' => $vehicleId,
            'CategoryId' => $categoryId,
            'ssd' => $ssd,
        ], 'oem');
    }

    public static function listUnits(string $catalog, string $vehicleId, string $ssd, string $categoryId = '-1', string $locale = 'ru_RU'): Command
    {
        return new Command('ListUnits', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'VehicleId' => $vehicleId,
            'CategoryId' => $categoryId,
            'ssd' => $ssd,
            'Localized' => 'true'
        ], 'oem');
    }

    public static function getUnitInfo(string $catalog, string $ssd, string $unitId, string $locale = 'ru_RU'): Command
    {
        return new Command('GetUnitInfo', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'UnitId' => $unitId,
            'ssd' => $ssd,
            'Localized' => 'true'
        ], 'oem');
    }


    public static function listImageMapByUnit(string $catalog, string $ssd, string $unitId): Command
    {
        return new Command('ListImageMapByUnit', [
            'Catalog' => $catalog,
            'UnitId' => $unitId,
            'ssd' => $ssd,
            'WithLinks' => 'true'
        ], 'oem');
    }

    public static function listPartsByUnit(string $catalog, string $ssd, string $unitId, string $locale = 'ru_RU'): Command
    {
        return new Command('ListDetailByUnit', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'UnitId' => $unitId,
            'ssd' => $ssd,
            'Localized' => 'true',
            'WithLinks' => 'true'
        ], 'oem');
    }

    public static function getFilterByUnit(string $catalog, string $vehicleId, string $ssd, string $unitId, string $filter, string $locale = 'ru_RU'): Command
    {
        return new Command('GetFilterByUnit', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'Filter' => $filter,
            'VehicleId' => $vehicleId,
            'UnitId' => $unitId,
            'ssd' => $ssd
        ], 'oem');
    }

    public static function getFilterByPart(string $catalog, string $vehicleId, string $ssd, string $unitId, string $partId, string $filter, string $locale = 'ru_RU'): Command
    {
        return new Command('GetFilterByDetail', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'Filter' => $filter,
            'VehicleId' => $vehicleId,
            'UnitId' => $unitId,
            'DetailId' => $partId,
            'ssd' => $ssd
        ], 'oem');
    }

    public static function listQuickGroup(string $catalog, string $vehicleId, string $ssd, string $locale = 'ru_RU'): Command
    {
        return new Command('ListQuickGroup', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'VehicleId' => $vehicleId,
            'ssd' => $ssd
        ], 'oem');
    }

    public static function listQuickDetail(string $catalog, string $vehicleId, string $ssd, string $groupId, string $locale = 'ru_RU'): Command
    {
        return new Command('ListQuickDetail', [
            'Locale' => $locale,
            'Catalog' => $catalog,
            'VehicleId' => $vehicleId,
            'QuickGroupId' => $groupId,
            'ssd' => $ssd,
            'Localized' => 'true',
            'All' => '1'
        ], 'oem');
    }

    public static function findCatalogsByOem(string $oem, string $locale = 'ru_RU'): Command
    {
        return new Command('FINDPARTREFERENCES', [
            'Locale' => $locale,
            'OEM' => $oem
        ], 'oem');
    }

    public static function findVehicleByOem(string $catalog, string $oem, string $locale = 'ru_RU'): Command
    {
        return new Command('FindApplicableVehicles', [
            'OEM' => $oem,
            'Catalog' => $catalog,
            'Locale' => $locale
        ], 'oem');
    }

    public static function findPartInVehicle(string $catalog, string $ssd, string $oem, string $locale = 'ru_RU'): Command
    {
        return new Command('GetOEMPartApplicability', [
            'Catalog' => $catalog,
            'OEM' => $oem,
            'ssd' => $ssd,
            'Locale' => $locale
        ], 'oem');
    }

    public static function findPartInVehicleByName(string $catalog, string $vehicleId, string $ssd, string $partName, string $locale = 'ru_RU'): Command
    {
        return new Command('SearchVehicleDetails', [
            'Catalog' => $catalog,
            'VehicleId' => $vehicleId,
            'ssd' => $ssd,
            'Query' => $partName,
            'Locale' => $locale
        ], 'oem');
    }
}