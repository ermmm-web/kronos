<?php

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Objects\StructureCatalog;

class MenuStructure extends \CBitrixComponent
{
    public function initResult() {
        
        $menuIndex = 0;
        $previousDepthLevel = 1;

        foreach( StructureCatalog::getInstance($this->arParams["IBLOCK_ID"])->getSections() as $ar ) {
            if( $this->arParams["MAX_DEPTH"] && $ar["DEPTH_LEVEL"] > $this->arParams["MAX_DEPTH"] ) {
                continue;
            }
            
            if( $menuIndex > 0 ) {
                $this->arResult[$menuIndex - 1][3]["IS_PARENT"] = $ar["DEPTH_LEVEL"] > $previousDepthLevel;
            }
            
            $previousDepthLevel = $ar["DEPTH_LEVEL"];
            
            $this->arResult[$menuIndex++] = array(
              htmlspecialchars($ar["NAME"]) ?? $ar["UF_MENU_NAME"],
              $ar["SECTION_PAGE_URL"],
              false,
              array(
                "FROM_IBLOCK" => true,
                "IS_PARENT" => false,
                "DEPTH_LEVEL" => $ar["DEPTH_LEVEL"],
                "ICON" => $ar["UF_ICON"],
              )
            );
        }
    }
    
    public function executeComponent() {
        if( $this->startResultCache() ) {
            
            $this->initResult();
            
            $this->endResultCache();
        }

        return $this->arResult;
    }
}