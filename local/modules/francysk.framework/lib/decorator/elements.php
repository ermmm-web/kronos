<?php

namespace Francysk\Base\Decorator;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Elements extends AbstractDecorator {
    
    public function __construct($_objComponent) {
        parent::__construct($_objComponent);
        
        $this->collectFilesCodes = array(
          "PREVIEW_PICTURE",
          "DETAIL_PICTURE",
        );
    }
    
    /**
     * Функция преобразует данные из Entity
     * @param array $row   - строчка из базы
     * @return array $row
     */
    public function decorateItem($row) {
        
        $this->objEntity->setItem($row);

        $this->objEntity->transfarmation();
        
        $this->collectFiles($row);

        // c версии 5.3.0 можно method_exists()
        if( is_callable(get_class($this->objComponent), $this->callbackFunction) && $this->objComponent != null) {
            //$row = $this->objComponent->{$this->callbackFunction}($row);
            $row = call_user_func_array(array($this->objComponent, $this->callbackFunction), array($row));
        }
        
        return $row;
    }
}