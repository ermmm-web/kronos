<?php
namespace Francysk\Base\Fabrica;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Decorator extends BaseFabrica implements \Francysk\Base\Interfaces\Fabrica {
    
    /*  Декоратор обычного элемента  */
    const ELEMENT = 1;
    /* */
    const ELEMENT_FULL = 2;
    /* */
    const TOVAR = 3;
    
    const SECTION = 4;
    
    public function getClass($type) {
        switch ($type) {
            case self::ELEMENT :
                return new \Francysk\Base\Decorator\Elements($this->objComponent);
            case self::ELEMENT_FULL :
                return new \Francysk\Base\Decorator\ElementsFull($this->objComponent);
            case self::TOVAR :
                return new \Francysk\Base\Decorator\Tovar($this->objComponent);
            case self::SECTION :
                return new \Francysk\Base\Decorator\Section($this->objComponent);
        }
    }
}