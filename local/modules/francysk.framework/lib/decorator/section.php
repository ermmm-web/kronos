<?php
namespace Francysk\Base\Decorator;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Section extends AbstractDecorator {
    
    public function __construct($_objComponent) {
        parent::__construct($_objComponent);
        
        $this->collectFilesCodes = array(
          "PICTURE",
          "UF_IMAGE_WHITE",
          "UF_IMAGE_COLOR"
        );
    }
    
    public function decorateItemSection($row) {
        
        $this->objEntity->setItem($row);
        
        $this->objEntity->transfarmation();

        $this->collectFiles($row);

        // c версии 5.3.0 можно method_exists()
        if( method_exists(get_class($this->objComponent), "decorateItemSection") ) {
            $row = $this->objComponent->decorateItemSection($row);
        }

        return $row;
    }
    
}