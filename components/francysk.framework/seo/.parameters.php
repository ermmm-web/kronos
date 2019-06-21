<?

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

if ( !CModule::IncludeModule("iblock") )
    return;

if ( !CModule::IncludeModule("francysk.framework") ) 
    return;

use Francysk\Framework\Core\Component\Parameters;

$oParams = new Parameters([Parameters::SAVE_GET, Parameters::IBLOCK]);
$oParams->setCurrentValues($arCurrentValues);

$arComponentParameters["GROUPS"] = $oParams->getGroups();
$arComponentParameters["PARAMETERS"] = $oParams->getParameters();

$arComponentParameters["PARAMETERS"]["GET_DATE"] = [
  "PARENT" => "BASE",
  "NAME" => "Получить данные из",
  "TYPE" => "LIST",
  "VALUES" => [
    "" => "Автоматически",
    "0" => "Из раздела элемента",
  ]
];