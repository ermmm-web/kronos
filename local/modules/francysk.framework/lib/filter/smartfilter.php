<?php

namespace Francysk\Base\Filter;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

\CModule::IncludeModule("iblock");

class SmartFilter extends FilterBitrix {

    public function __construct( $arParams ) {
        parent::__construct($arParams);
        $this->makeFilter($arParams);
    }

    public function makeFilter( $arParams ) {
        parent::makeFilter($arParams);

        global $arrFilter;
        $arPriceFilter = array();
        $bOffersFilterExist = (isset($arrFilter["OFFERS"]) && !empty($arrFilter["OFFERS"]) && is_array($arrFilter["OFFERS"]));

        foreach ( $arrFilter as $key => $value ) {
            if ( preg_match('/^(>=|<=|><)CATALOG_PRICE_/', $key) ) {
                if( count($value) == 2 ) {
                    $arPriceFilter[">=CATALOG_PRICE_1"] = \CCurrencyRates::ConvertCurrency($value[0], "BYR", "USD");
                    $arPriceFilter["<=CATALOG_PRICE_1"] = \CCurrencyRates::ConvertCurrency($value[1], "BYR", "USD");
                } else {
                    $arPriceFilter[$key] = \CCurrencyRates::ConvertCurrency($value, "BYR", "USD");
                }
                unset($arrFilter[$key]);
            }
        }
        if ( $bOffersFilterExist ) {
            if ( empty($arPriceFilter) )
                $arSubFilter = $arrFilter["OFFERS"];
            else
                $arSubFilter = array_merge($arrFilter["OFFERS"], $arPriceFilter);

            $arSubFilter["IBLOCK_ID"] = 11;
            $arSubFilter["ACTIVE_DATE"] = "Y";
            $arSubFilter["ACTIVE"] = "Y";
            if ( 'Y' == $arParams['HIDE_NOT_AVAILABLE'] )
                $arSubFilter['CATALOG_AVAILABLE'] = 'Y';
            $this->arFilter["=ID"] = \CIBlockElement::SubQuery("PROPERTY_81", $arSubFilter);
        }
        elseif ( !empty($arPriceFilter) ) {
            $arSubFilter = $arPriceFilter;

            $arSubFilter["IBLOCK_ID"] = 10;
            $arSubFilter["ACTIVE_DATE"] = "Y";
            $arSubFilter["ACTIVE"] = "Y";
            $this->arFilter[] = array(
              "LOGIC" => "OR",
              $arPriceFilter,
              "=ID" => \CIBlockElement::SubQuery("PROPERTY_81", $arSubFilter),
            );
        }
        if( is_array($arrFilter) && count($arrFilter) > 0 ) {
            $this->arFilter += $arrFilter;
        }
        $this->catalogQuantity();

        $this->arFilter["CATALOG_SHOP_QUANTITY_1"] = 1;
    }
    
    private function catalogQuantity() {
        $arSection = \Francysk\Base\Core\Structure::getInstance()->getSection($this->arFilter["SECTION_ID"]);

        $arVanny = \Francysk\Base\Core\Structure::getInstance()->getSection(64);
        $arSanteh = \Francysk\Base\Core\Structure::getInstance()->getSection(73);

        if( $arSection["LEFT_MARGIN"] >= $arSanteh["LEFT_MARGIN"] && $arSection["RIGHT_MARGIN"] <= $arVanny["RIGHT_MARGIN"] ) {
            $this->arFilter[">CATALOG_QUANTITY"] = 0;
        }
        unset($arSection);
        if( isset($_REQUEST["STORE"]) && $_REQUEST["STORE"] == "N" ) {
            unset($this->arFilter[">CATALOG_QUANTITY"]);
        }
    }

    public function getFilter() {
        return $this->arFilter;
    }
}
