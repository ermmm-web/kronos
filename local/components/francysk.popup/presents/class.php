<?php

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

\CBitrixComponent::includeComponentClass("francysk.framework:base.component");

class PresentsPopup extends \BaseComponent
{
    public function onPrepareComponentParams($arParams) {
        if( $_GET["id"] ) {
            $arParams["ELEMENT_ID"] = (int) $_GET["id"];
        }
        
        return parent::onPrepareComponentParams($arParams);
    }
    
    public function executeComponent() {
        
        if( empty($this->arParams["ELEMENT_ID"]) ) {
            return false;
        }
        
        if( $this->startResultCache() ) {
            
            $this->getIDsPresents();
            
            $this->model->addFilter([
                "IBLOCK_ID" => IBLOCK_ID_PRODUCT,
                "=ID" => $this->arParams["IDS"],
            ]);

            $this->arResult = $this->getResult();
            
            $this->includeComponentTemplate();
        }
    }
    
    public function correctName($row, $logic) {
        if( $logic == "ITEMS" && !empty($row["PROPERTIES"]["SHORT_NAME"]["VALUE"]) ) {
            $row["NAME"] = $row["PROPERTIES"]["SHORT_NAME"]["VALUE"];
        }
        
        return $row;
    }
    
    private function getIDsPresents() {
        $entity = new \Francysk\Framework\Entity\ElementsWithProp();
        $entity->getModel()
                ->addFilter([
                    "IBLOCK_ID" => IBLOCK_ID_PRODUCT,
                    "=ID" => $this->arParams["ELEMENT_ID"],
                ]);
        
        $arResult = $entity->getResult();

        $this->arParams["IDS"] = $arResult["ITEMS"][0]["PROPERTIES"]["BIND_PODAROK"]["VALUE"];
    }
}