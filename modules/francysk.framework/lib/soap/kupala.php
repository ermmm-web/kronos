<?php

namespace Francysk\Framework\Soap;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Kupala extends Soap
{

    protected $response;
    
    public function __construct( $arParams ) {
        ini_set('soap.wsdl_cache_enabled', 0);
        ini_set('soap.wsdl_cache_ttl', 0);
        
        parent::__construct($arParams);

        //$this->initHeader();
    }

    private function initHeader() {
        $header = new \SoapHeader("http://InsuranceOnline.Kupala.org", "AuthentificationInfo", ['login' => 'soap', 'password' => 'soap237']);

        $this->client->__setSoapHeaders($header);
    }

    public function checkPolice($sDoc) {
        $obReturn = $this->client->CheckPolice(["PoliceNumber" => $sDoc]);

        if( !$obReturn->return->Item ) {
            $this->error = true;
        }

        $this->response = json_decode(json_encode($obReturn->return->Item), true);
    }
    
    public function errors() {
        return $this->error;
    }
    
    public function getResponse() {
        return $this->response;
    }
    
    public function editUser() {

        $obReturn = $this->client->EditUser(["SessionID" => "", "User" => ["ID" => 1, "IIN" => "192686669", "FirstName" => "Тестовый", "MiddleName" => "Тестовый", "LastName" => "Тестовый", "BornDate" => "", "DocumentSeries" => "", "DocumentNumber" => "", "DocumentDate" => "", "Address" => "", "Resident" => "", "MobileNumber" => "", "PIN" => ""]]);
        echo "====== REQUEST HEADERS =====" . PHP_EOL;
        var_dump($this->client->__getLastRequestHeaders());
        echo "========= REQUEST ==========" . PHP_EOL;
        var_dump($this->client->__getLastRequest());
        echo "========= RESPONSE =========" . PHP_EOL;
        var_dump($response);
        prent($obReturn);
    }
    
    public function newUser($aFields) {
        $fields["User"] = $aFields;
        $fields["SessionID"] = false;
        $fields["User"]["UserGUID"] = $fields["User"]["ID"] = false;
        prent($fields);
        $obReturn = $this->client->EditUser($fields);
        
        if( $obReturn->return->Code != 0 && $obReturn->return->Description != "OK" ) {
            $this->error = true;
        }
    }

}
