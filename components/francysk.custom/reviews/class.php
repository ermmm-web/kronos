<?php

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

\CBitrixComponent::includeComponentClass("francysk.framework:elements.list");

class Reviews extends ElementsList
{
    public function onPrepareComponentParams($arParams) {
        
        $arParams["COUNTRY_PIC"] = [
          18 => "/local/frontend/build/img/Belarus.png",
        ];
        
        return parent::onPrepareComponentParams($arParams);
    }
    
    public function executeComponent() {
        if( $this->startResultCache() ) {
            
            if( $this->arParams["PRODUCT"] ) {
                $this->model->addFilter(["PROPERTY_PRODUCT" => $this->arParams["PRODUCT"]]);
            }
            
            $this->arResult = $this->getResult();
            
            $this->getSection()
                    ->getProduct();
            
            $this->includeComponentTemplate();
        }
    }
    
    public function getProduct() {
        $entity = new Francysk\Framework\Entity\Elements();
        $entity->setCollectionResult(new Francysk\Framework\Collection\ResultByID());
        $entity->getModel()
                ->addFilter(["IBLOCK_ID" => IBLOCK_ID_PRODUCT, "=ID" => $this->arParams["PRODUCT"]]);
        
        $this->arResult["PRODUCT"] = $entity->getResult();
    }
    
    public function getSection() {
        $entity = new Francysk\Framework\Entity\Sections();
        $entity->setCollectionResult(new Francysk\Framework\Collection\ResultByID());
        $entity->getModel()
                ->addFilter(["IBLOCK_ID" => $this->arParams["ID"], "ID" => $this->arParams["SECTIONS"]]);
        
        $this->arResult["SECTIONS"] = $entity->getResult();
        
        return $this;
    }
    
    public function collectSection($row, $logic) {
        if($logic == "ITEMS" ) {
            if( $row["IBLOCK_SECTION_ID"] > 0 ) {
                $this->arParams["SECTIONS"][$row["IBLOCK_SECTION_ID"]] = $row["IBLOCK_SECTION_ID"];
            }
            
            if( $row["PROPERTIES"]["PRODUCT"]["VALUE"] > 0 ) {
                $this->arParams["PRODUCT"][$row["PROPERTIES"]["PRODUCT"]["VALUE"]] = $row["PROPERTIES"]["PRODUCT"]["VALUE"];
            }
        }
        
        return $row;
    }
}