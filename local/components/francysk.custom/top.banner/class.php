<?php

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

\CBitrixComponent::includeComponentClass("francysk.framework:base.component");

class TopBanner extends BaseComponent
{
    public function onPrepareComponentParams($arParams) {
        
        $arParams["URL"] = $GLOBALS["APPLICATION"]->GetCurPage();
        
        return parent::onPrepareComponentParams($arParams);
    }
    
    public function executeComponent() {
        if( $this->startResultCache() ) {
            
            if( !$this->getSectionId() ) {
                return '';
            }

            $this->arResult = $this->getResult();

            $this->includeComponentTemplate();
        }
    }
    
    public function getResult() {
        $this->model->setFilter(["IBLOCK_SECTION_ID" => $this->arParams["SECTION_ID"]]);

        return parent::getResult();
    }
    
    private function getSectionId(): bool {
        $db = \Bitrix\Iblock\SectionTable::getList([
            "filter" => [
                "=CODE" => $this->arParams["URL"],
            ]
        ]);
        
        if( $row = $db->fetch() ) {
            $this->arParams["SECTION_ID"] = $row["ID"];
            return true;
        }
        
        return false;
    }
}