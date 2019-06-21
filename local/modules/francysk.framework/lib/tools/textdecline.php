<?php

namespace Francysk\Framework\Tools;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class TextDecline
{
    static public function present($count) {
        if( $count == 1 ) {
            return "ПОДАРОК";
        } elseif( $count > 1 && $count < 5 ) {
            return "ПОДАРКА";
        } elseif( $count > 5 ) {
            return "ПОДАРКОВ";
        }
    }
    
    static public function getWordNum($num, $words){
        $cases = array(2, 0, 1, 1, 1, 2);
        return $words[($num % 100 > 4 && $num % 100 < 20) ? 2 : $cases[min($num % 10, 5)]];
    }
}