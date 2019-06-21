<?php

namespace Francysk\Framework\Objects;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

\CModule::includeModule("iblock");

use Francysk\Framework\Core\AbstractClass\Object;

class ContentIblocks extends Object
{
    const TYPE = "stati";
    
    protected $aIBlocks;
    protected $aIDs;
    
    protected function initModel() {
        
    }
    
    protected function initParams( $result ) {
        foreach( $result as $aIBlock ) {
            $this->aIBlocks[$aIBlock["ID"]] = $aIBlock;
            $this->aIDs[] = $aIBlock["ID"];
        }
    }
    
    public function getIDs() {
        return $this->aIDs;
    }
    
    public function getIBlock(int $iID) {
        return $this->aIBlocks[$iID];
    }
    
    public function getIBlocks() {
        return $this->aIBlocks;
    }
    
    protected function getDate() {
        $dbl = \Bitrix\Iblock\IblockTable::getList(["filter" => ["IBLOCK_TYPE_ID" => self::TYPE]]);
        
        $result = [];
        while( $row = $dbl->fetch() ) {
            $result[] = $row;
        }
        
        return $result;
    }
    
    protected function getCacheID() {
        return 'content_iblock';
    }
}