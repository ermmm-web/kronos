<?php

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

\CBitrixComponent::includeComponentClass("francysk.framework:base.component");

class Video extends BaseComponent
{
    public function onPrepareComponentParams($arParams) {
        return parent::onPrepareComponentParams($arParams);
    }
    
    public function executeComponent() {
        if( $this->startResultCache() ) {
            
            if( $this->arParams["PRODUCT_ID"] ) {
                $this->model->addFilter(["PROPERTY_PRODUCT" => $this->arParams["PRODUCT_ID"]]);
            }
            
            $this->arResult = $this->getResult();
            
            $this->includeComponentTemplate();
        }
    }
}