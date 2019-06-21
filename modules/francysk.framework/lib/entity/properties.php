<?php
namespace Francysk\Base\Entity;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Properties extends BaseItem
{
    private $arProp;
    
    private $arPropClass;
    
    private $arPropSelect;
    
    public function __construct($_objModel = null, $_objDecorator = null) {
        $this->arProp = array();
        $this->arPropClass = array();
        $this->arPropSelect = array();
        
        parent::__construct($_objModel, $_objDecorator);
    }
    
    public function initProp($arSelect) {
        $this->arPropSelect = $arSelect;
    }
    
    public function initComponent($objComponent) {
        $this->objComponent = $objComponent;
    }
    
    public function transfarmation() { 

        if( in_array($this->arItem["ID"], $this->arPropSelect) ) {
            $this->arProp[$this->arItem["ID"]] = $this->arItem;
            $this->arPropClassModel[$this->arItem["ID"]] = \Francysk\Base\Fabrica\Property::getClass($this->arItem["PROPERTY_TYPE"], $this->arItem);
        }
    }
    
    public function getResult($key = false) {
        $this->objModel->getElements();
        foreach( $this->arPropClassModel as $code => $classProp ) {
            $this->objModel = $classProp;
            $this->objModel->setOrder(array("SORT" => "ASC"));
            $result[$code] = $this->objModel->getElements();
        }
        
        return array("PROPERTY" => $this->arProp, "PROPERTY_VALUE" => $result);
        
    }
    
}