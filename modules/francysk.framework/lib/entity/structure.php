<?php

namespace Francysk\Base\Entity;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Structure extends BaseItem {
    
    protected $arResult;
    
    public function __construct($_objModel = null, $_objDecorator = null) {
        parent::__construct($_objModel, $_objDecorator);
        $this->arResult = array();
    }
    
    public function transfarmation() {
       
        if( $this->arItem["DEPTH_LEVEL"] ==  1 ) {
            $this->arResult[0][$this->arItem["ID"]] = $this->arItem;
        } else {
            $this->arResult[$this->arItem["IBLOCK_SECTION_ID"]][$this->arItem["ID"]] = $this->arItem;
        }
    }
    
    public function getResult() {
        
        return array(
          "RESULT" => $this->objModel->getElements(),
          "ITEMS" => $this->arResult,
          "FILES" => $this->getFiles()
        );
    }
}