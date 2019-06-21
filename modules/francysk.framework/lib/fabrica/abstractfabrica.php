<?php

namespace Francysk\Base\Fabrica;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class BaseFabrica {

    /*  Объект компонента    */
    protected $objComponent;
    
    public function __construct($_objComponent) {
        $this->objComponent = $_objComponent;
    }
    
    static public function getObject($_objComponent) {
        return new static($_objComponent);
    }
}