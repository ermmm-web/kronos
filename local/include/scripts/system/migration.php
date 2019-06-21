<?php

require_once $_SERVER["DOCUMENT_ROOT"] . "/bitrix/modules/main/include/prolog_before.php";


$aMap = [
  "RATING" => [
    "NAME" => "Рейтинг",
    "ACTIVE" => "Y",
    "SORT" => 500,
    "CODE" => "RATING",
    "PROPERTY_TYPE" => "N",
    "ROW_COUNT" => 1,
    "COL_COUNT" => 30,
    "LIST_TYPE" => "L",
    "MULTIPLE_CNT" => 5,
  ],
  "ADDRESS" => [
    "NAME" => "Адрес (текст)",
    "ACTIVE" => "Y",
    "SORT" => 500,
    "CODE" => "ADDRESS",
    "PROPERTY_TYPE" => "S",
    "ROW_COUNT" => 1,
    "COL_COUNT" => 30,
    "LIST_TYPE" => "L",
    "MULTIPLE_CNT" => 5,
  ],
  "COORDINATE" => [
    "NAME" => "Адрес (координаты)",
    "ACTIVE" => "Y",
    "SORT" => 500,
    "CODE" => "COORDINATE",
    "PROPERTY_TYPE" => "S",
    "ROW_COUNT" => 1,
    "COL_COUNT" => 30,
    "LIST_TYPE" => "L",
    "MULTIPLE_CNT" => 5,
    "USER_TYPE" => "map_yandex",
  ],
  "SITE" => [
    "NAME" => "Сайт",
    "ACTIVE" => "Y",
    "SORT" => 500,
    "CODE" => "SITE",
    "PROPERTY_TYPE" => "S",
    "ROW_COUNT" => 1,
    "COL_COUNT" => 30,
    "LIST_TYPE" => "L",
    "MULTIPLE_CNT" => 5,
  ],
  "PHONES" => [
    "NAME" => "Контактные телефоны",
    "ACTIVE" => "Y",
    "SORT" => 500,
    "CODE" => "SITE",
    "PROPERTY_TYPE" => "S",
    "ROW_COUNT" => 1,
    "COL_COUNT" => 30,
    "LIST_TYPE" => "L",
    "MULTIPLE" => "Y",
    "MULTIPLE_CNT" => 5,
  ]
];

$oRequest = Bitrix\Main\Context::getCurrent()->getRequest();

$iIBlock = $oRequest->get("iblock");

$oResult = \Bitrix\Iblock\PropertyTable::getList(["filter" => ["IBLOCK_ID" => $iIBlock]]);

foreach ( $aMap as $code => $prop ) {
    $aMap[$code]["IBLOCK_ID"] = $iIBlock;
}

while ( $row = $oResult->fetch() ) {
    if ( isset($aMap[$row["CODE"]]) ) {
        unset($aMap[$row["CODE"]]);
    }
}

foreach ( $aMap as $prop ) {
    echo "Добавил свойство : " . $prop["NAME"] . "</br>";
    \Bitrix\Iblock\PropertyTable::add($prop);
}