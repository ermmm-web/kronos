<?php

namespace Francysk\Framework\Core\Interfaces\Adapter;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

interface User
{
    /**
     * 
     * @return array
     */
    public function getDate();
}