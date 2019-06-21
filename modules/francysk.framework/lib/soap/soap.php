<?php

namespace Francysk\Framework\Soap;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Soap
{
    protected $error;
    
    protected $client;

    public function __construct( $arParams ) {

        $arParams = $this->createParams($arParams);

        $this->client = new \SoapClient($arParams["WSDL"], $arParams["PARAMS"]);
    }

    protected function createParams( $arParams ) {
        $result = array();
        $arFields = array(
          "login",
          "password",
          "location",
          "uri",
          "style",
          "use",
          "trace",
          "exceptions",
          "connection_timeout",
          "proxy_port",
          "proxy_host",
          "soap_version"
        );

        $result["WSDL"] = NULL;

        if ( isset($arParams["wsdl"]) && \Francysk\Framework\Tools\Validate::isNotEmpty($arParams["wsdl"]) ) {
            $result["WSDL"] = $arParams["wsdl"];
        }

        $result["PARAMS"] = false;
        foreach ( $arFields as $field ) {
            if ( isset($arParams[$field]) && \Francysk\Framework\Tools\Validate::isNotEmpty($arParams[$field]) ) {
                $result["PARAMS"][$field] = $arParams[$field];
            }
        }

        return $result;
    }

    public function getClient() {
        return $this->client;
    }

}
