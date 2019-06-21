<?php

$eventManager = \Bitrix\Main\EventManager::getInstance();

$eventManager->addEventHandler("iblock", "OnIBlockPropertyBuildList", [
    "FPBindProps", "GetIBlockPropertyDescription"
        ], $_SERVER["DOCUMENT_ROOT"] . "/local/props/bindprops/bindprops.php"
);

$eventManager->addEventHandler("iblock", "OnBeforeIBlockElementAdd", ["FrancyskEvent", "addBeforeElement"], $_SERVER["DOCUMENT_ROOT"] . "/local/modules/francysk.framework/classes/general/francyskevent.php");
$eventManager->addEventHandler("iblock", "OnBeforeIBlockElementUpdate", ["FrancyskEvent", "updateBeforeElement"], $_SERVER["DOCUMENT_ROOT"] . "/local/modules/francysk.framework/classes/general/francyskevent.php");

//// Добавления элемента
//AddEventHandler("iblock", "OnBeforeIBlockElementAdd", array("FrancyskEvent", "addBeforeElement"), 100, $_SERVER["DOCUMENT_ROOT"] . "/local/modules/francysk.framework/classes/general/francyskevent.php");
//// Изменения элемента
//AddEventHandler("iblock", "OnBeforeIBlockElementUpdate", array("FrancyskEvent", "updateBeforeElement"), 100, $_SERVER["DOCUMENT_ROOT"] . "/local/modules/francysk.base/classes/general/francyskevent.php");
