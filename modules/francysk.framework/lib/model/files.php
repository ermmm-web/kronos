<?php

namespace Francysk\Framework\Model;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Model;

class Files extends Model
{
    public function execute() {
        $this->oBDResult = \CFile::getList(array(), $this->aFilter);
        
        return $this;
    }
}