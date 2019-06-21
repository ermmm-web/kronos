<?php
namespace Francysk\Base\Entity;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class SectionElements extends BaseItem
{
    
    private $aIDSections = array();
    
    public function __construct($_objModel, $_objDecorator) {
        parent::__construct($_objModel, $_objDecorator);
    }
    
    public function transfarmation() {
        $this->aIDSections[] = $this->arItem["IBLOCK_SECTION_ID"];
    }
    
    public function getSections() {
        $objModel = new \Francysk\Base\Model\Section($this->objDecorator);
        $objModel->initParams($this->arParams);
        
        $objModel->addFilter(array("=ID" => $this->aIDSections));

        prent($objModel->getElements());
        
    }
    
    public function getResult() {
        $result = array(
          "SECTIONS" => $this->getSections(),
          "ITEMS" => $this->getItems($key),
          "FILES" => $this->getFiles(),
          "NAV_PARAMS" => $this->getCDBResult(),
        );
        
        return $result;
    }
}