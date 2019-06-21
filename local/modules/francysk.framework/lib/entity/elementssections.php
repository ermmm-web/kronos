<?php

namespace Francysk\Framework\Entity;

use Francysk\Framework\Decorator;
use Francysk\Framework\Core\AbstractClass\Entity;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class ElementsSections extends ElementsWithProp
{
    private $aSections;
    private $aIBlocks;
    
    public function __construct( $oComponent = null ) {
        parent::__construct($oComponent);
        $this->oModel = new \Francysk\Framework\Model\FCIBlockElementAllProp();
    }
    
    public function process($logic, $row) {
        if( $logic == "ITEMS" ) {
            $this->aSections[$row["IBLOCK_SECTION_ID"]] = $row["IBLOCK_SECTION_ID"];
            $this->aIBlocks = $row["IBLOCK_ID"];
        }
        
        parent::process($logic, $row);
    }
    
    public function getResult() {
        $this->executeEntity();
        return array(
          "ITEMS" => $this->aCollectionResult["ITEMS"]->getResult(),
          "SECTIONS" => $this->aCollectionResult["SECTIONS"]->getResult(),
          "FILES" => $this->aCollectionResult["FILES"]->getResult(),
        );
    }
    
    public function getLogicModelSECTIONS() {
        $model = new \Francysk\Framework\Model\FCIBlockSection;
        $model->setOrder(["SORT" => "ASC"])
                ->addFilter(["ID" => $this->aSections, "IBLOCK_ID" => $this->aIBlocks]);
        $model->execute();
        return $model;
    }
    
    protected function initLogic() {
        $this->aLogic = array(
        "ITEMS",
        "SECTIONS",
        "FILES"
        );

        return $this;
    }
    
    protected function initDecorator() {
        $this->aDecorator["ITEMS"] = array();
        $this->aDecorator["SECTIONS"] = array();
        $this->aDecorator["FILES"] = array(
          new Decorator\Files()
        );
    }
    
    protected function initCollectionResult() {
        $this->aCollectionResult["ITEMS"] = new \Francysk\Framework\Collection\ResultBySection();
        $this->aCollectionResult["SECTIONS"] = new \Francysk\Framework\Collection\ResultByID();
        $this->aCollectionResult["FILES"] = new \Francysk\Framework\Collection\ResultByID();
    }

}
