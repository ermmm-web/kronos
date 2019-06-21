<?php
namespace Francysk\Base\Fabrica;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Model extends BaseFabrica implements \Francysk\Base\Interfaces\Fabrica {

    /*  Модель элемента  */
    const ELEMENT = 1;
    /*  Модель элемента со всеми свойства (getNextElement) */
    const ELEMENT_FULL = 2;
    
    const TOVAR = 3;
    
    const HIGHLOAD = 4;
    
    const SECTION = 5;
    
    const PROPERTY = 6;
    
    public function getClass($type, $param = null) {
        switch ($type) {
            case self::ELEMENT : 
                return new \Francysk\Base\Model\Elements($this->objComponent);
            case self::ELEMENT_FULL :
                return new \Francysk\Base\Model\ElementsFull($this->objComponent);
            case self::TOVAR :
                return new \Francysk\Base\Model\Tovar($this->objComponent);
            case self::HIGHLOAD :
                return new \Francysk\Base\Model\Highloadblock($this->objComponent, $param);
            case self::SECTION :
                return new \Francysk\Base\Model\Section($this->objComponent);
            case self::PROPERTY :
                return new \Francysk\Base\Model\Property($this->objComponent, $param);
        }
    }
}