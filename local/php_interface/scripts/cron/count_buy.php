<?php

/* 
 * Скрипт пересчитывает количество купивших по заданным настройках
 */

require $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";

use Francysk\Framework\Collection\ResultByID;

\CBitrixComponent::includeComponentClass("francysk.lib:hl.countbuy");
$aCountBuy = \HLCountBuy::get(new ResultByID(), []);

$oModel = new \Francysk\Framework\Model\FCIBlockElement();
$oModel->setSelect(["ID", "NAME", "IBLOCK_ID", "PROPERTY_COUNT_BUY", "PROPERTY_CONTROL_COUNT_BUY"]);
$oModel->setFilter(["ACTIVE" => "Y", "IBLOCK_ID" => IBLOCK_ID_PRODUCT, "!PROPERTY_COUNT_BUY" => false]);
$db = $oModel->execute();

while( $row = $db->fetch() ) {
    $aResult[$row["ID"]] = [$row["PROPERTY_COUNT_BUY"], $row["PROPERTY_CONTROL_COUNT_BUY"]];
}

prent($aResult);