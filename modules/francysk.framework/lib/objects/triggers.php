<?php

namespace Francysk\Framework\Objects;


if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Object;
use Francysk\Framework\Core\Config;

class Triggers extends Object {
    
    private $aData;
    
    static protected $instance = null;
    
    protected function initModel() {
       $this->oModel = \CIBlockElement::getList(
	  	 ["SORT" => "ASC"],
		 ["ACTIVE" => "Y", "IBLOCK_ID" => IBLOCK_ID_TRIGGER],
			false,
			false,
			["ID", "NAME", "CODE", "IBLOCK_ID", "PREVIEW_PICTURE", "PREVIEW_TEXT", "PROPERTY_SVG"] // , "PROPERTY_SVG_HOVER"
	   );       
    }
    
    protected function initParams( $result ) {
        foreach ( $result as $row ) {
            $this->aData[$row["ID"]] = $row;
        }
    }
    
    protected function getDate(): array {
        $result = [];
        
        while ( $row = $this->oModel->fetch() ) {
            if( $row["PROPERTY_SVG_VALUE"] > 0 ) {
				$src = \CFile::getPath($row["PROPERTY_SVG_VALUE"]);
				$row["SVG_SRC"] = $src;
                $row["PREVIEW_PICTURE_SRC"] = $src;
            } elseif( $row["PREVIEW_PICTURE"] > 0 ) { 
                $src = \CFile::getPath($row["PREVIEW_PICTURE"]);
                $row["PREVIEW_PICTURE_SRC"] = $src;
            }

            $result[] = $row;
        }
        
        return $result;
    }
    
    public function get($iID) {
        return $this->aData[$iID];
    }
    
    protected function getTimeCache(): int {
        return 30 * 600;
    }
    
    protected function getCacheID(): String {
        return md5("OBJECTS_TRIGGERS");
    }
}
