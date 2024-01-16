<?php

namespace GuayaquilLib;

use GuayaquilLib\objects\oem\CatalogListObject;
use GuayaquilLib\objects\oem\CatalogObject;
use GuayaquilLib\objects\oem\CategoryListObject;
use GuayaquilLib\objects\oem\FilterObject;
use GuayaquilLib\objects\oem\GroupObject;
use GuayaquilLib\objects\oem\ImageMapObject;
use GuayaquilLib\objects\oem\PartListObject;
use GuayaquilLib\objects\oem\PartReferencesListObject;
use GuayaquilLib\objects\oem\PartShortListObject;
use GuayaquilLib\objects\oem\QuickDetailListObject;
use GuayaquilLib\objects\oem\UnitListObject;
use GuayaquilLib\objects\oem\UnitObject;
use GuayaquilLib\objects\oem\VehicleListObject;
use GuayaquilLib\objects\oem\VehicleObject;
use GuayaquilLib\objects\oem\WizardObject;

class ServiceOem extends RequestBase
{
    function listCatalogs(string $locale = 'ru_RU'): CatalogListObject
    {
        return $this->executeCommand(Oem::listCatalogs($locale));
    }

    function getCatalogInfo(string $catalog, string $locale = 'ru_RU', bool $withPermissions = false): CatalogObject
    {
        return $this->executeCommand(Oem::getCatalogInfo($catalog, $locale, $withPermissions));
    }

    public function findVehicle(string $identString, string $locale = 'ru_RU'): VehicleListObject
    {
        return $this->executeCommand(Oem::findVehicle($identString, $locale));
    }

    public function findVehicleByVin(string $vin, string $locale = 'ru_RU'): VehicleListObject
    {
        return $this->executeCommand(Oem::findVehicleByVin($vin, $locale));
    }

    public function findVehicleByFrameNo(string $frameNo, string $locale = 'ru_RU'): VehicleListObject
    {
        return $this->executeCommand(Oem::findVehicleByFrameNo($frameNo, $locale));
    }

    public function findVehicleByPlateNumber(string $plate, string $locale = 'ru_RU'): VehicleListObject
    {
        return $this->executeCommand(Oem::findVehicleByPlateNumber($plate, $locale));
    }

    public function findVehicleByWizard2(string $catalog, string $ssd, string $locale = 'ru_RU'): VehicleListObject
    {
        return $this->executeCommand(Oem::findVehicleByWizard2($catalog, $ssd, $locale));
    }

    public function execCustomOperation(string $catalog, string $operation, array $data, string $locale = 'ru_RU'): VehicleListObject
    {
        return $this->executeCommand(Oem::execCustomOperation($catalog, $operation, $data, $locale));
    }

    public function getVehicleInfo(string $catalog, string $vehicleId, string $ssd, string $locale = 'ru_RU'): VehicleObject
    {
        return $this->executeCommand(Oem::getVehicleInfo($catalog, $vehicleId, $ssd, $locale));
    }

    public function getWizard2(string $catalog, $ssd = '', string $locale = 'ru_RU'): WizardObject
    {
        return $this->executeCommand(Oem::getWizard2($catalog, $ssd, $locale));
    }

    public function listCategories(string $catalog, string $vehicleId, string $ssd, string $categoryId = '-1', string $locale = 'ru_RU'): CategoryListObject
    {
        return $this->executeCommand(Oem::listCategories($catalog, $vehicleId, $ssd, $categoryId, $locale));
    }

    public function listUnits(string $catalog, string $vehicleId, string $ssd, string $categoryId, string $locale = 'ru_RU'): UnitListObject
    {
        return $this->executeCommand(Oem::listUnits($catalog, $vehicleId, $ssd, $categoryId, $locale));
    }

    public function getUnitInfo(string $catalog, string $ssd, string $unitId, string $locale = 'ru_RU'): UnitObject
    {
        return $this->executeCommand(Oem::getUnitInfo($catalog, $ssd, $unitId, $locale));
    }

    public function listImageMapByUnit(string $catalog, string $ssd, string $unitId): ImageMapObject
    {
        return $this->executeCommand(Oem::listImageMapByUnit($catalog, $ssd, $unitId));
    }

    public function listPartsByUnit(string $catalog, string $ssd, string $unitId, string $locale = 'ru_RU'): PartListObject
    {
        return $this->executeCommand(Oem::listPartsByUnit($catalog, $ssd, $unitId, $locale));
    }

    public function listQuickGroup(string $catalog, string $vehicleId, string $ssd, string $locale = 'ru_RU'): GroupObject
    {
        return $this->executeCommand(Oem::listQuickGroup($catalog, $vehicleId, $ssd, $locale));
    }

    public function listQuickDetail(string $catalog, string $vehicleId, string $ssd, string $groupId, string $locale = 'ru_RU'): QuickDetailListObject
    {
        return $this->executeCommand(Oem::listQuickDetail($catalog, $vehicleId, $ssd, $groupId, $locale));
    }

    public function findCatalogsByOem(string $oem, string $locale = 'ru_RU'): PartReferencesListObject
    {
        return $this->executeCommand(Oem::findCatalogsByOem($oem, $locale));
    }

    public function findVehicleByOem(string $catalog, string $oem, string $locale = 'ru_RU'): VehicleListObject
    {
        return $this->executeCommand(Oem::findVehicleByOem($catalog, $oem, $locale));
    }

    public function findPartInVehicle(string $catalog, string $ssd, string $oem, string $locale = 'ru_RU'): QuickDetailListObject
    {
        return $this->executeCommand(Oem::findPartInVehicle($catalog, $ssd, $oem, $locale));
    }

    public function findPartInVehicleByName(string $catalog, string $vehicleId, string $ssd, string $partName, string $locale = 'ru_RU'): PartShortListObject
    {
        return $this->executeCommand(Oem::findPartInVehicleByName($catalog, $vehicleId, $ssd, $partName, $locale));
    }

    public function getFilterByUnit(string $catalog, string $vehicleId, string $ssd, string $unitId, string $filter, string $locale = 'ru_RU'): FilterObject
    {
        return $this->executeCommand(Oem::getFilterByUnit($catalog, $vehicleId, $ssd, $unitId, $filter, $locale));
    }

    public function getFilterByPart(string $catalog, string $vehicleId, string $ssd, string $unitId, string $detailId, string $filter, string $locale = 'ru_RU'): FilterObject
    {
        return $this->executeCommand(Oem::getFilterByPart($catalog, $vehicleId, $ssd, $unitId, $detailId, $filter, $locale));
    }
}