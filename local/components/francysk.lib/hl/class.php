<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

class HL {

    static public function adapt($aFields = []) {
        return $aFields;
    }

    static public function add($aFields) {
        $aFields = static::adapt($aFields);
        $oClass = static::initModel();

        $oClass::add($aFields);
    }

    static public function update($iID, $aFields) {
        $oClass = static::initModel();
        return $oClass::update($iID, $aFields);
    }
    
    static public function delete($iID) {
        $oClass = static::initModel();
        return $oClass::delete($iID);
    }

    static public function getList($aArgs = []) {
        $oClass = static::initModel();
        return $oClass::getList($aArgs);
    }

    static public function prepareParams($aMap, $aFields) {
        $result = [];

        foreach ($aMap as $value => $code) {
            $result[$code] = $aFields[$value];
        }

        return $result;
    }

    static public function get($oCollection = false, $aFilter = [], $aSelect = false, $aGroup = false) {
        $arResult = [];
        $oCache = new CPHPCache();

        if ($oCache->initCache(86400, static::getCacheID([$aFilter, $aSelect, $aGroup]), static::getPathCache())) {

            $arResult = $oCache->GetVars();
        } else {
            
            if( !$oCollection ) {
                $oCollection = new \Francysk\Framework\Collection\Result;
            }

            $oModel = static::initModel();

            $aFields["filter"] = $aFilter;

            if ($aSelect) {
                $aFields["select"] = $aSelect;
            }
            
            if ($aGroup) {
                $aFields["group"] = $aGroup;
            }

            $dbl = $oModel::getList($aFields);

            while ($row = $dbl->fetch()) {
                $oCollection->add($row);                
            }
            
            $arResult = $oCollection->getResult();

            $oCache->endDataCache($arResult);
        }


        return $arResult;
    }
    
    static public function getEntity() {
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(static::ID)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        return $entity;
    }

    static public function initModel() {
        \CModule::includeModule("highloadblock");
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById(static::ID)->fetch();
        $entity = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        return $entity->getDataClass();
    }

}
