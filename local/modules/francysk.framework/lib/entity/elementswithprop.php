<?php

namespace Francysk\Framework\Entity;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class ElementsWithProp extends Elements
{
    protected $aFilesProp;
    
    public function __construct($oComponent = null) {
        parent::__construct($oComponent);
        
        $this->oModel = new \Francysk\Framework\Model\FCIBlockElementAllProp();
    }
    
    public function pushFiles($row) {
        parent::pushFiles($row);
        foreach( $this->aFilesProp as $fileCode ) {
            if( isset($row["PROPERTIES"][$fileCode]) ) {
                if( is_array($row["PROPERTIES"][$fileCode]["VALUE"]) ) {
                    if( !is_array($this->aFilesIDs) ) {
                        $this->aFilesIDs = [];
                    }
                    $this->aFilesIDs = array_merge($this->aFilesIDs, $row["PROPERTIES"][$fileCode]["VALUE"]);
                } else {
                    $this->aFilesIDs[] = $row["PROPERTIES"][$fileCode]["VALUE"];
                }
            }
        }
    }
    
    protected function initFilesID() {
        parent::initFilesID();
        $this->aFilesProp = array(
            "SLIDER",
            "MEDIA",
            "MORE_PICTURE",
            "MORE_PHOTO",
        );
    }
}