<?php

namespace Francysk\Framework\Collection;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass;

class ResultByKey extends AbstractClass\Result
{
    public function add($aItem) {
        $this->result[$aItem["KEY"]] = $aItem;
    }    
}