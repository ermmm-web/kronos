<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as $k => $arItem) {
	KRONOS_CATALOG::prepare_element($arItem);
	
	$arItem['PRODUCT'] = current($arItem['DISPLAY_PROPERTIES']['PRODUCT_ID']['LINK_ELEMENT_VALUE']);
	
	$arResult["ITEMS"][$k] = $arItem;
}
