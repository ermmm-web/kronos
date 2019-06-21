<?php

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

\CModule::includeModule('iblock');
\CBitrixComponent::includeComponentClass("francysk.framework:base.component");

use Francysk\Framework\Core\Config\FieldsClassParams;

class Seo extends \BaseComponent
{

    public function onPrepareComponentParams( $arParams ) {
        return $arParams;
    }

    public function executeComponent() {
        $this->arResult = $this->getResultDate($this->arParams[FieldsClassParams::SAVE_GET]);

        if ( $this->arParams["GET_DATE"] == 0 ) {
            $this->getSeoSectionDB();
            $this->getBreadCrumbsDB();
        } else {
            if ( count($this->arResult["ITEMS"]) == 1 || isset($this->arResult["ITEMS"]["ID"]) ) {
                if ( $this->arResult["ITEMS"]["ID"] ) {
                    $arResult = $this->arResult["ITEMS"];
                    $this->arResult = [];
                    $this->arResult["ITEMS"][0] = $arResult;
                    unset($arResult);
                }
                $this->initSeoItems();
                $this->getBreadCrumbsItem();
            } else {
                $this->initSeoSection();
            }
        }
        $GLOBALS["APPLICATION"]->SetPageProperty('title', $this->arResult["META_SEO"]["META_TITLE"]);
        $GLOBALS["APPLICATION"]->SetPageProperty('keywords', $this->arResult["META_SEO"]["META_KEYWORDS"]);
        $GLOBALS["APPLICATION"]->SetPageProperty("description", $this->arResult["META_SEO"]["META_DESCRIPTION"]);
        $GLOBALS["APPLICATION"]->SetTitle($this->arResult["META_SEO"]["PAGE_TITLE"]);

        if ( isset($this->arResult["BREADCRUMBS"]) ) {

            foreach ( $this->arResult["BREADCRUMBS"] as $arItem ) {
                if ( isset($arItem["LINK"]) ) {
                    $GLOBALS["APPLICATION"]->AddChainItem($arItem["NAME"], $arItem["LINK"]);
                    continue;
                }

                $GLOBALS["APPLICATION"]->AddChainItem($arItem["NAME"]);
            }
        }
    }
    
    public function getBreadCrumbsDB() {
        $aSection = \CIBlockSection::getByID($this->arResult["ITEMS"][0]["IBLOCK_SECTION_ID"])->getNext();
        
        if( $aSection["DEPTH_LEVEL"] == 2 ) {
            $parent = \CIBlockSection::getByID($aSection["IBLOCK_SECTION_ID"])->getNext();
            $this->arResult["BREADCRUMBS"][] = [
              "NAME" => $parent["NAME"],
              "LINK" => $parent["SECTION_PAGE_URL"]
            ];
        }
        
        $this->arResult["BREADCRUMBS"][] = [
          "NAME" => $aSection["NAME"],
          "LINK" => $aSection["SECTION_PAGE_URL"]
        ];
    }

    public function getSeoSectionDB() {
        $iSection = $this->arResult["ITEMS"][0]["IBLOCK_SECTION_ID"];
        $iIBlock = $this->arResult["ITEMS"][0]["IBLOCK_ID"];

        $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($iIBlock, $iSection);
        $result = $ipropValues->getValues();

        $this->arResult["META_SEO"] = [
          "META_TITLE" => $result["SECTION_META_TITLE"],
          "META_KEYWORDS" => $result["SECTION_META_KEYWORDS"],
          "META_DESCRIPTION" => $result["SECTION_META_DESCRIPTION"],
          "PAGE_TITLE" => $result["SECTION_PAGE_TITLE"]
        ];
    }

    protected function initSeoItems() {
        $ipropValues = new \Bitrix\Iblock\InheritedProperty\ElementValues($this->arResult["ITEMS"][0]["IBLOCK_ID"], $this->arResult["ITEMS"][0]["ID"]);
        $result = $ipropValues->getValues();

        $this->arResult["META_SEO"] = [
          "META_TITLE" => $result["ELEMENT_META_TITLE"],
          "META_KEYWORDS" => $result["ELEMENT_META_KEYWORDS"],
          "META_DESCRIPTION" => $result["ELEMENT_META_DESCRIPTION"],
          "PAGE_TITLE" => $result["ELEMENT_PAGE_TITLE"]
        ];
    }

    protected function initSeoSection() {
		if ($this->arParams["SECTION_CODE"]) {
			$SECTION_CODE = $this->arParams["SECTION_CODE"];
		} else {
			$SECTION_CODE = $_REQUEST["SECTION_CODE"];
		}
        $arSection = \Francysk\Framework\Objects\StructureCatalog::getInstance($this->arParams["IBLOCK_ID"])->getSectionByCode($SECTION_CODE);

        $ipropValues = new \Bitrix\Iblock\InheritedProperty\SectionValues($arSection["IBLOCK_ID"], $arSection["ID"]);
        $result = $ipropValues->getValues();

        $this->arResult["META_SEO"] = [
          "META_TITLE" => $result["SECTION_META_TITLE"],
          "META_KEYWORDS" => $result["SECTION_META_KEYWORDS"],
          "META_DESCRIPTION" => $result["SECTION_META_DESCRIPTION"],
          "PAGE_TITLE" => $result["SECTION_PAGE_TITLE"]
        ];
        
        
        if ( $arSection["DEPTH_LEVEL"] == 3 ) {
            $parentSection = \Francysk\Framework\Objects\StructureCatalog::getInstance($this->arParams["IBLOCK_ID"])->getSectionByID($arSection["IBLOCK_SECTION_ID"]);
            $this->arResult["BREADCRUMBS"][] = [
              "NAME" => $parentSection["NAME"],
              "LINK" => $parentSection["SECTION_PAGE_URL"]
            ];
            unset($parentSection);
        }

        if ( $arSection["DEPTH_LEVEL"] == 2 ) {
            $parentSection = \Francysk\Framework\Objects\StructureCatalog::getInstance($this->arParams["IBLOCK_ID"])->getSectionByID($arSection["IBLOCK_SECTION_ID"]);
            $this->arResult["BREADCRUMBS"][] = [
              "NAME" => $parentSection["NAME"],
              "LINK" => $parentSection["SECTION_PAGE_URL"]
            ];
        }

        $this->arResult["BREADCRUMBS"][] = [
          "NAME" => $arSection["NAME"]
        ];
    }

    protected function getBreadCrumbsItem() {
        $iSection = $this->arResult["ITEMS"][0]["IBLOCK_SECTION_ID"];
        $arSection = \Francysk\Framework\Objects\StructureCatalog::getInstance($this->arParams["IBLOCK_ID"])->getSectionByID($iSection);
        $this->arResult["BREADCRUMBS"] = [];

        if ( $arSection["DEPTH_LEVEL"] == 3 ) {
            $parentSection = \Francysk\Framework\Objects\StructureCatalog::getInstance($this->arParams["IBLOCK_ID"])->getSectionByID($arSection["IBLOCK_SECTION_ID"]);
            $this->arResult["BREADCRUMBS"][] = [
              "NAME" => $parentSection["NAME"],
              "LINK" => $parentSection["SECTION_PAGE_URL"]
            ];
            unset($parentSection);
        }
        
        if ( $arSection["DEPTH_LEVEL"] == 2 ) {
            $parentSection = \Francysk\Framework\Objects\StructureCatalog::getInstance($this->arParams["IBLOCK_ID"])->getSectionByID($arSection["IBLOCK_SECTION_ID"]);
            $this->arResult["BREADCRUMBS"][] = [
              "NAME" => $parentSection["NAME"],
              "LINK" => $parentSection["SECTION_PAGE_URL"]
            ];
            unset($parentSection);
        }

        $this->arResult["BREADCRUMBS"][] = ["NAME" => $arSection["NAME"], "LINK" => $arSection["SECTION_PAGE_URL"]];
        $this->arResult["BREADCRUMBS"][] = ["NAME" => $this->arResult["ITEMS"][0]["NAME"]];
    }

}
