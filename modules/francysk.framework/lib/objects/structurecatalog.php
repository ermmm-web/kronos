<?php

namespace Francysk\Framework\Objects;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Object;
use Francysk\Framework\Core\Config;

class StructureCatalog extends Object
{
    private $aTree;
    private $aHashID;
    private $aHashCode;
    
    static protected $instance = null;

    public function __construct($iIblock) {
        $this->iIblockID = $iIblock;
        parent::__construct($iIblock);        
    }

    protected function initModel() {
        $this->oModel = new \Francysk\Framework\Model\FCIBlockSection;
        $this->oModel->setOrder(["LEFT_MARGIN" => "ASC"])
                ->addFilter(["IBLOCK_ID" => $this->iIblockID, "ACTIVE" => "Y"]);       
    }

    protected function initParams( $result ) {
        foreach ( $result as $row ) {
            if ( $row["DEPTH_LEVEL"] == 1 ) {
                $this->aTree[0][$row["ID"]] = $row;
            } elseif($row["IBLOCK_SECTION_ID"] > 0) {
                $this->aTree[$row["IBLOCK_SECTION_ID"]][$row["ID"]] = $row;
            }
            
            $this->aHashID[$row["ID"]] = $row;
            $this->aHashCode[$row["CODE"]] = $row["ID"];
        }
    }

    protected function getDate(): array {
        $result = [];
        $this->oModel->execute();
        $aFiles = [];
        while ( $row = $this->oModel->fetch() ) {
            if( $row["UF_ICON"] > 0 ) {
                $src = \CFile::getPath($row["UF_ICON"]);
                $row["UF_ICON"] = $src;
            }
            
            $result[] = $row;
        }
        
        return $result;
    }
    
    protected function getTimeCache(): int {
        return 30 * 60;
    }
    
    protected function getCacheID(): String {
        return md5("OBJECTS_PRODUCT");
    }
    
    public function getSections() {
        return $this->aHashID;
    }
    
    public function getSectionByID($id): array {
        return $this->aHashID[$id];
    }

    public function getSectionByCode($sCode): array {
        $iID = $this->aHashCode[$sCode];
        return $this->aHashID[$iID];
    }
    
    public function getTreeSectionByIDParent($id): array {
        return $this->aTree[$id];
    }
    
    public function getTreeSectionByCodeParent($sCode): array {
        $iID = $this->aHashCode[$sCode];
        return $this->aTree[$iID];
    }
    
}
