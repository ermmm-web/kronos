<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

foreach($arResult["ITEMS"] as $k => $arItem) {
	if (!$arItem["PREVIEW_PICTURE"]["SRC"]) {
		$arItem["PREVIEW_PICTURE"]["SRC"] = 'img/video5.jpg';
	}
}
