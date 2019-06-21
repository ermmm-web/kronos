<?php

namespace Francysk\Base\Soap;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Yurkas extends Soap
{

    private $error = false;
    
    public function __construct( $arParams ) {
        ini_set("soap.wsdl_cache_enabled", "0");
        ini_set('soap.wsdl_cache_ttl', "0");
        parent::__construct($arParams);
    }
    
    public function getFactoryList() {
        
        $obReturn = $this->client->FactoryList();
        
        return json_decode($obReturn->return);
    }
    
    public function checkError($code) {
        if( $code == 0 || ($code > 1 && $code <= 99) ) {
            $this->error = "Код ошибки " . $code;
        }
    }
    
    public function newRecl($arParams) {
        
        $obReturn = $this->client->newRecl($arParams);
        
        $this->checkError($obReturn->return);
    }
    
    public function editRecl($arParams) {
        
        $obReturn = $this->client->editRecl($arParams);
        
        $this->checkError($obReturn->return);
    }
    
    public function getTTN($date) {
        $obReturn = $this->client->CheckTTN(array("TTN" => "", "Date" => $date));
        
        return json_decode($obReturn->return);
    }
    
    public function isError() {
        return (bool) $this->error;
    }
    
    public function getError() {
        return $this->error;
    }

}
