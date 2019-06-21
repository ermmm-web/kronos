<?php

namespace Francysk\Framework\Objects;


if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Object;
use Francysk\Framework\Core\Config;

class Bonus extends Object {
    
    private $aData;
    private $aPersent;
    
    static protected $instance = null;
    
    protected function initModel() {
        $this->oModel = \CIBlockElement::getList(["SORT" => "ASC"], ["ACTIVE" => "Y", "IBLOCK_ID" => IBLOCK_ID_BONUS], false, false, ["ID", "NAME", "CODE", "IBLOCK_ID", "PREVIEW_TEXT", "PROPERTY_ICON", "PROPERTY_PERCENT"]);       
    }
    
    protected function initParams( $result ) {
        foreach ( $result as $row ) {
            $this->aData[$row["ID"]] = $row;
            
            if( $row["PERSENT"] > 0 ) {
                $this->aPersent[$row["ID"]] = $row;
            }
        }
    }
    
    protected function getDate(): array {
        $result = [];
        
        while ( $row = $this->oModel->fetch() ) {
            if( $row["PROPERTY_ICON_VALUE"] > 0 ) {
                $src = \CFile::getPath($row["PROPERTY_ICON_VALUE"]);
                $row["ICON_SRC"] = $src;
            }
            
            if( $row["PROPERTY_PERCENT_VALUE"] > 0 ) {
                $row["PERSENT"] = $row["PROPERTY_PERCENT_VALUE"];
            }
            
            $result[$row["ID"]] = $row;
        }
        
        return $result;
    }
    
    public function isPersent($iID): bool {
        return (bool)$this->aPersent[$iID];
    }
    
    public function getPersent($iID) {
        return $this->aPersent[$iID];
    }
    
    public function get($iID) {
        return $this->aData[$iID];
    }
    
    protected function getTimeCache(): int {
        return 30 * 600;
    }
    
    protected function getCacheID(): String {
        return md5("OBJECTS_BONUS");
    }
}
