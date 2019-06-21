<? foreach($arResult["ITEMS"] as $k => $arItem) {
	$arResult["ITEMS"][$k]['PREVIEW_PICTURE_SMALL'] = CFile::ResizeImageGet($arItem['PREVIEW_PICTURE']['ID'], array('width' => 200, 'height' => 200), BX_RESIZE_IMAGE_PROPORTIONAL, true);
}

