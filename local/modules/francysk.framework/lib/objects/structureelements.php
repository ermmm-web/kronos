<?php

namespace Francysk\Framework\Objects;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Object;
use Francysk\Framework\Core\Config;

class StructureElements extends StructureCatalog
{
    private $aElements;
    private $aFiles;
    
    private $oModelElement;
    private $oModelFiles;
    private $oModelSections;
    
    public function __construct($iBlock) {
        Config::$IBLOCK_CATALOG = $iBlock;
        parent::__construct();
    }
    
    static public function getInstance($iBlock) {

        if (self::$instance[$iBlock] == null) {
            self::$instance[$iBlock] = new StructureElements($iBlock);
        }
        
        return self::$instance[$iBlock];
    }
    
    protected function getCacheID() {
        return md5("OBJECTS_ELEMENTS_".  Config::$IBLOCK_CATALOG);
    }
    
    protected function initModel() {
        parent::initModel();
      
        $this->oModelElement = new \Francysk\Framework\Model\FCIBlockElement;
        $this->oModelElement->setOrder(["SORT" => "ASC"])
                ->addFilter(["IBLOCK_ID" => Config::$IBLOCK_CATALOG]);
        
        $this->oModelFiles = new \Francysk\Framework\Model\Files;
        
        $this->oModelSections = new \Bitrix\Iblock\SectionElementTable();
    }
    
    protected function initParams( $result ) {
        parent::initParams($result["SECTIONS"]);
        
        $this->aElements = $result["ELEMENTS"];
        $this->aFiles = $result["FILES"];
    }
    
    protected function getDate() {
        $result["SECTIONS"] = parent::getDate();
        
        $aFilterFiles = [];
        
        $this->oModelElement->execute();
        
        $ids = $elements = [];
        while( $row = $this->oModelElement->fetch() ) {
            $ids[$row["ID"]] = $row["ID"];
            $elements[$row["ID"]] = $row;
            $aFilterFiles[$row["PREVIEW_PICTURE"]] = $row["PREVIEW_PICTURE"];
            $result["ELEMENTS"][$row["IBLOCK_SECTION_ID"]][$row["ID"]] = $row;
        }
        
        $dbl = $this->oModelSections->getList(["filter" => ["IBLOCK_ELEMENT_ID" => $ids]]);
        unset($ids);
        
        while( $row = $dbl->fetch() ) {
            $result["ELEMENTS"][$row["IBLOCK_SECTION_ID"]][$row["IBLOCK_ELEMENT_ID"]] = $elements[$row["IBLOCK_ELEMENT_ID"]];
        }
        unset($elements);
        
        $this->oModelFiles->addFilter($aFilterFiles)
                ->execute();
        
        $oDecorator = new \Francysk\Framework\Decorator\Files();
        
        while( $row = $this->oModelFiles->fetch() ) {
            $result["FILES"][$row["ID"]] = $oDecorator->decorateElement($row);
        }
        
        return $result;
    }
    
    public function getElements() {
        return $this->aElements;
    }
    
    public function getElementsBySection($iID) {
        return $this->aElements[$iID];
    }
    
    public function getFiles() {
        return $this->aFiles;
    }
}
