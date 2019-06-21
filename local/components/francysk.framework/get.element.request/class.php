<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

\CModule::includeModule("symfony.component");
\CBitrixComponent::includeComponentClass("francysk.framework:base.component");

use Francysk\Framework\Core\Config\FieldsClassParams;
use Symfony\Component\HttpFoundation\Request;

class GetElementByRequest extends BaseComponent {

    public function onPrepareComponentParams($arParams) {

        $arParams = $this->initFilterByParams($arParams);
        
        $arParams["PRODUCTS"] = [];

        return parent::onPrepareComponentParams($arParams);
    }

    public function dateByActive($row, $logic) {
        if ($logic != "ITEMS") {
            return $row;
        }

        $row["DATE"] = Francysk\Fraemwork\Core\Tools::rusdate(strtotime($row["ACTIVE_FROM"]), 'j %MONTH% Y');

        return $row;
    }

    public function explodeDateActive($row, $logic) {
        if ($logic == "ITEMS") {
            $aExplode = explode(" ", $row["DATE_ACTIVE_FROM"]);
            $row["DATE_FROM"] = explode('.', $aExplode[0]);
            
            $aExplode = explode(" ", $row["DATE_ACTIVE_TO"]);
            $row["DATE_TO"] = explode(".", $aExplode[0]);
            
            if( $row["PROPERTIES"]["PRODUCTS"]["VALUE"] != '' ) {
                $this->arParams["PRODUCTS"] = array_merge($this->arParams["PRODUCTS"], $row["PROPERTIES"]["PRODUCTS"]["VALUE"]);
            }
        }

        return $row;
    }

    public function executeComponent() {
        if ($this->startResultCache()) {

            $this->arResult = $this->getResult();

            $this->includeComponentTemplate();
        }

        $this->saveResultDate();
    }

    private function initFilterByParams($arParams) {
        $oRequest = Request::createFromGlobals();

        if (strlen($arParams[FieldsClassParams::REQUEST_FITLER_SECTION]) > 0) {
            $arParams["SECTION_CODE"] = $oRequest->query->filter($arParams[FieldsClassParams::REQUEST_FITLER_SECTION]);
        }

        if (strlen($arParams[FieldsClassParams::REQUEST_FILTER_ELEMENT]) > 0) {
            $arParams["CODE"] = $oRequest->query->filter($arParams[FieldsClassParams::REQUEST_FILTER_ELEMENT]);
        }

        return $arParams;
    }

}
