<?php



namespace Francysk\Framework\Core\Component;



\CModule::includeModule("symfony.component");



if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )

    die();



use Francysk\Framework\Core\Config\FieldsClassParams;

use Symfony\Component\HttpFoundation\Request;



class ParamsValue

{

    private $arParams;

    

    private $aModel = null;

    

    public function __construct($arParams) {

        $this->arParams = $arParams;

        $this->aModel = [];

    }

    

    public function makeEntity() {

        return $this->arParams[FieldsClassParams::SYSTEM_FRAEMWORK] == 1;

    }

    

    public function getDecorator() {

        return $this->arParams[FieldsClassParams::DECORATOR];

    }

    

    public function getModel() {

        return $this->arParams[FieldsClassParams::MODEL];

    }

    

    public function getEntity() {

        return $this->arParams[FieldsClassParams::ENTITY];

    }

    

    public function getCollectionResult() {

        return $this->arParams[FieldsClassParams::COLLECTION_RESULT];

    }

    

    public function getCallabackDecoratorFunction() {

        return $this->arParams[FieldsClassParams::FUNCTION_DECORATOR];

    }



    public function getNavParams() {

        $iPage = \Francysk\Framework\Core\Config::$defaultPagenCatalog;



        $iNumPage = isset($_REQUEST["PAGEN_1"]) ? (int)$_REQUEST["PAGEN_1"] : 1;



        if( $this->arParams[FieldsClassParams::NAV_COUNT] != '' ) {

            $iPage = $this->arParams[FieldsClassParams::NAV_COUNT];

        }

        return [

            "nPageSize" => $iPage,

            "iNumPage" => $iNumPage,

        ];

    }

    

    public function getModelOrder() {

        $result = ["SORT" => "ASC"];

        

        if( $this->arParams["SORT_VALUE_1"] != '' ) {

            $result = [];

            $result[$this->arParams["SORT_FIELD_1"]] = $this->arParams["SORT_VALUE_1"];

        }

        

        if( $this->arParams["SORT_VALUE_2"] != '' ) { 

            $result[$this->arParams["SORT_FIELD_2"]] = $this->arParams["SORT_VALUE_2"];

        }



        return $result;

    }

    

    public function initModelFilter() {

        $this->aModel["ACTIVE"] = "Y";

        

        $this->getUrlModelFilter();

        $this->getSmartModelFilter();

        $this->getParametersFilter();

               

        $params = array("IBLOCK_ID", "SECTION_ID", "SECTION_CODE", "CODE");

        

        foreach( $params as $code ) {

            if( isset($this->arParams[$code]) ) {

                $this->aModel[$code] = $this->arParams[$code];

            }

        }

                

        return $this->aModel;

    }

    

    public function getModelFilter() {

        if( !$this->aModel ) {

            $this->initModelFilter();

        }

        

        return $this->aModel;

    }

    

    private function getParametersFilter() {

        if( $this->arParams["PROPERTIES"] ) {

            foreach( $this->arParams["PROPERTIES"] as $code ) {

                $this->aModel["PROPERTY_".$code] = $this->arParams["PROPERTY_".$code."_VALUE"];

            }

        }

    }

    

    private function getUrlModelFilter() {

        if( (isset($_REQUEST["SECTION_CODE"]) && !isset($_REQUEST["ELEMENT_CODE"]))) {

            $oRequest = Request::createFromGlobals();
            $sSection = $oRequest->query->filter("SECTION_CODE");
            $aSection = \Bitrix\Iblock\SectionTable::getList(["filter" => ["CODE" => $sSection]])->fetch();
            $this->aModel["SECTION_ID"] = $aSection["ID"];
            $this->aModel["INCLUDE_SUBSECTIONS"] = "Y";

        } elseif ($this->arParams['SECTION_CODE']) {
            $sSection = $this->arParams['SECTION_CODE'];
            $aSection = \Bitrix\Iblock\SectionTable::getList(["filter" => ["CODE" => $this->arParams['SECTION_CODE']]])->fetch();
            $this->aModel["SECTION_ID"] = $aSection["ID"];
            $this->aModel["INCLUDE_SUBSECTIONS"] = "Y";
			
        } elseif ( isset($_REQUEST["ELEMENCT_CODE"]) ) {

            $this->aModel["CODE"] = $sSection = $oRequest->query->filter("ELEMENCT_CODE");

        } elseif( isset($_REQUEST["filter"]) ) {

            $this->aModel = array_merge($this->aModel, $_REQUEST["filter"]);

        }

    }

    

    public function getSmartModelFilter() {

        if( isset($GLOBALS["arrFilter"]) ) {

            $this->aModel = array_merge($this->aModel, $GLOBALS["arrFilter"]);

        }

    }

}