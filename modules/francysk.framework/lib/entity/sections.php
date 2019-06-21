<?php

namespace Francysk\Framework\Entity;

use Francysk\Framework\Decorator;
use Francysk\Framework\Core\AbstractClass\Entity;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Sections extends Elements
{
    protected function initVars() {
        parent::initVars();
        $this->oModel = new \Francysk\Framework\Model\FCIBlockSection();
    }
    
    protected function initFilesID() {
        $this->aFiles = array(
            "PICTURE",
            "UF_ICON",
            
        );
    }
}