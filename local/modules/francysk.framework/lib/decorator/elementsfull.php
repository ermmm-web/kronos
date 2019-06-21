<?php

namespace Francysk\Base\Decorator;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ElementsFull extends Elements {
    
    public function decorateItem($rowObj) {
        if( is_object($rowObj) ) {
            $row = $rowObj->getFields();
            $row["PROPERTIES"] = $rowObj->getProperties();
        } else {
            $row = $rowObj;
        }

        $this->objEntity->setItem($row);
        
        $row = $this->objEntity->createPhotoGallery($row);
        
        return parent::decorateItem($row);
    }
}