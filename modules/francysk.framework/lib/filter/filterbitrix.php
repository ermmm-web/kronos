<?php

namespace Francysk\Base\Filter;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class FilterBitrix {
    
    protected  $arFilter;

    protected  $arBaseFilter;
    
    public function __construct($arParams) {
        $this->initBaseFilter();
        $this->initFilter();
        $this->makeFilter($arParams);
    }
    
    protected function initFilter() {
        $this->arFilter = array(
          "IBLOCK_LID" => SITE_ID,
          "IBLOCK_ACTIVE" => "Y",
          "ACTIVE_DATE" => "Y",
          "ACTIVE" => "Y",
          //"CHECK_PERMISSIONS" => "Y",
          //"MIN_PERMISSION" => "Y",
          "INCLUDE_SUBSECTIONS" => "Y"
        );
    }
    
    protected function initBaseFilter() {
        $this->arBaseFilter = array(
          "SECTION_ID",
          "SECTION_CODE",
          "IBLOCK_ID",
          "ELEMENT_CODE",
        );
    }
    
    protected function makeFilter($arParams) {
        if( !is_array($arParams) ) {
            return false;
        }

        foreach( $this->arBaseFilter as $code ) {
            if( $arParams[$code] != '' && isset($arParams[$code]) ) {
                $this->arFilter[$code] = $arParams[$code];
            }
        }
    }
}