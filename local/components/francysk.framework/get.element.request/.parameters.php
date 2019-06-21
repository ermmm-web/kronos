<?

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

if ( !CModule::IncludeModule("iblock") )
    return;

if ( !CModule::IncludeModule("francysk.framework") ) 
    return;

use Francysk\Framework\Core\Component\Parameters;

$oParams = new Parameters([Parameters::IBLOCK, Parameters::SAVE_SET ,Parameters::F_SYSTEM, Parameters::FILTER_REQUEST]);
$oParams->setCurrentValues($arCurrentValues);

$arComponentParameters["GROUPS"] = $oParams->getGroups();
$arComponentParameters["PARAMETERS"] = $oParams->getParameters();