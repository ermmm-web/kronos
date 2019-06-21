<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

if (!$arParams['VIDEOS_PER_COLOMN']) {
	$arParams['VIDEOS_PER_COLOMN'] = 1;
}

foreach($arResult["ITEMS"] as $k => $arItem) {
	if (!$arItem["PREVIEW_PICTURE"]["SRC"]) {
		$arResult["ITEMS"][$k]["PREVIEW_PICTURE"]["PREVIEW_LIST"]["src"] = 'img/video5.jpg';
	} else {
		$arResult["ITEMS"][$k]["PREVIEW_PICTURE"]["PREVIEW_LIST"] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width'=>448, 'height'=>252), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		
	}
}

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';	*/		
