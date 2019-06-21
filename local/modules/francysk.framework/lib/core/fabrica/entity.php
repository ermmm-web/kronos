<?php

namespace Francysk\Framework\Core\Fabrica;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\Interfaces\Fabrica;

class Entity implements Fabrica
{
    private $oComponent;
    
    const ELEMENT = 1;
    const ELEMENTWITHPROP = 2;
    const SECTION = 3;
    const ELEMENTSECTION = 4;
    const ITEMS = 0;
    
    public function __construct($oComponent = null) {
        $this->oComponent = $oComponent;
    }
    
    static public function initEntity($oComponent = null) {
        return new static($oComponent);
    }
    
    static public function getEntityByName() {
        return array(
          self::ITEMS => "Просто элемент",
          self::ELEMENT => "Обычный элемент",
          self::ELEMENTWITHPROP => "Элемент со всеми свойствами",
          self::SECTION => "Раздел",
          self::ELEMENTSECTION => "Элементы с разделами",
        );
    }
    
    public function getClass($iType) {
        switch ($iType) {
            case self::ITEMS :
                return new \Francysk\Framework\Entity\Items($this->oComponent);
            case self::ELEMENT :
                return new \Francysk\Framework\Entity\Elements($this->oComponent);
            case self::ELEMENTWITHPROP :
                return new \Francysk\Framework\Entity\ElementsWithProp($this->oComponent);
            case self::SECTION :
                return new \Francysk\Framework\Entity\Sections($this->oComponent);
            case self::ELEMENTSECTION :
                return new \Francysk\Framework\Entity\ElementsSections($this->oComponent);
            default: 
                return new \Francysk\Framework\Entity\Elements($this->oComponent);
        }
    }
}