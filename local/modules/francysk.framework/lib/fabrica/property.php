<?php

namespace Francysk\Base\Fabrica;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Property extends BaseFabrica
{
    const PROPERTY_E = "E";
    
    const PROPERTY_S = "S";
    
    const PROPERTY_N = "N";
    
    const PROPERTY_L = "L";
    
    public function getClass($type, $param = null) {
        switch ($type) {
            case self::PROPERTY_E :
                return new \Francysk\Base\Model\PropertyE($this->objComponent, $param);
            case self::PROPERTY_S: case self::PROPERTY_N :
                return new \Francysk\Base\Model\PropertyS($this->objComponent, $param);
            case self::PROPERTY_L : 
                return new \Francysk\Base\Model\PropertyL($this->objComponent, $param);
        }
    }
}