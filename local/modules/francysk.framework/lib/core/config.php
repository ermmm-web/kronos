<?php

namespace Francysk\Framework\Core;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Config
{

    static public $IBLOCK_CATALOG = IBLOCK_CATALOG;
    static public $IBLOCK_CURRENCY = 6;
    static public $IBLOCK_OTDELENIYA = 7;
    static public $IBLOCK_FILES = 16;
    static public $defaultPagenCatalog = 10;
    static public $aSoap = [
      "wsdl" => "https://portal.kupala.by:4443/KPL6/ws/InsuranceOnline.1cws?wsdl",
      "uri" => "https://portal.kupala.by:4443/KPL6/ws/InsuranceOnline.1cws",
      "location" => "https://portal.kupala.by:4443/KPL6/ws/InsuranceOnline.1cws",
//      "login" => "soap",
//      "password" => "soap237",
//      'encoding' => 'UTF-8',
//      "exceptions" => true,
//      "trace" => true,
//      'verifypeer' => false,
//      'verifyhost' => false,
//      'connection_timeout' => 180,
    ];

}
