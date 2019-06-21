<?php

namespace Francysk\Framework\Objects\Property;


if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Object;
use Francysk\Framework\Core\Config;

class Brend extends Object {
    
    private $aData;
    
    static protected $instance = null;
    
    protected function initModel() {
        $this->oModel = \Bitrix\Iblock\ElementTable::getList([
            "order" => ["SORT" => "ASC"],
            "filter" => ["IBLOCK_ID" => IBLOCK_ID_PROIZVODSTVO]
        ]);
    }
    
    protected function initParams( $result ) {
        foreach ( $result as $row ) {
            $this->aData[$row["ID"]] = $row;
        }
    }
    
    protected function getDate(): array {
        $result = [];
        
        while ( $row = $this->oModel->fetch() ) {
            if( $row["PREVIEW_PICTURE"] > 0 ) {
                $src = \CFile::getPath($row["PREVIEW_PICTURE"]);
                $row["PREVIEW_PICTURE_SRC"] = $src;
            }
            
            $result[$row["ID"]] = $row;
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
        return md5("OBJECTS_BREND");
    }
}
