<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*foreach($arResult["ITEMS"] as $k => $arItem) {
	if ($arItem["PREVIEW_PICTURE"]["SRC"]) {
		$arResult["ITEMS"][$k]["PREVIEW_PICTURE"] = CFile::ResizeImageGet($arItem["PREVIEW_PICTURE"]['ID'], array('width'=>220, 'height'=>350), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	} else {
		$arItem["PREVIEW_PICTURE"]["src"] = 'img/video5.jpg';
	}
	
	foreach ($arItem['DISPLAY_PROPERTIES']['PRODUCT_ID']['LINK_ELEMENT_VALUE'] as $kk => $vv) {
		
		$vv["PREVIEW_PICTURE"] = CFile::ResizeImageGet($vv["PREVIEW_PICTURE"], array('width'=>372, 'height'=>500), BX_RESIZE_IMAGE_PROPORTIONAL, true);
		$arResult["ITEMS"][$k]['PRODUCT'] = $vv;
			
	}
	
}*/

foreach($arResult["ITEMS"] as $k => $arItem) {
	KRONOS_CATALOG::prepare_element($arItem);
	
	$arItem['PRODUCT'] = current($arItem['DISPLAY_PROPERTIES']['PRODUCT_ID']['LINK_ELEMENT_VALUE']);
	
	$arResult["ITEMS"][$k] = $arItem;
	
}

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';	*/		


/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';	*/		

