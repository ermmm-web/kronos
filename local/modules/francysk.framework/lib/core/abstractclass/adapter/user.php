<?php

namespace Francysk\Framework\Core\AbstractClass\Adapter;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

abstract class User
{   
    protected $aMap;
    protected $aFields;
    protected $aResult;

    public function __construct($aFields) {
        $this->aFields = $aFields;
        $this->execute();
    }
    
    abstract protected function execute();
    abstract protected function initMap();
}