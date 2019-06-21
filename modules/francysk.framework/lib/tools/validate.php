<?php

namespace Francysk\Framework\Tools;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Validate {
        
    static function isNotEmpty($value) {
        if( $value == "" ) {
            return false;
        }
        
        return true;
    }
    
}