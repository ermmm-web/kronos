<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

$arResult["PREVIEW_PICTURE"] = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]['ID'], array('width'=>208, 'height'=>162), BX_RESIZE_IMAGE_PROPORTIONAL, true);

/*foreach ($arResult["DISPLAY_PROPERTIES"] as $code => $values) {
	if ($values['PROPERTY_TYPE'] == 'E') {
		if ($values['LINK_ELEMENT_VALUE']) {
			foreach ($values['LINK_ELEMENT_VALUE'] as $k => $v) {
				$arResult["DISPLAY_PROPERTIES"][$code]['LINK_ELEMENT_VALUE']['PREVIEW_PICTURE'] = CFile::ResizeImageGet($v['PREVIEW_PICTURE'], array('width'=>208, 'height'=>162), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			}
		} else {
			CModule::IncludeModule('iblock');
			$arFilter 	= array(   
				"IBLOCK_ID"	=> $values['LINK_IBLOCK_ID'],    
				"ID"		=> $values['VALUE'],    
			);
			$arSelect 	= array('ID', 'NAME', 'PREVIEW_PICTURE');
			$res 		= CIBlockElement::GetList(array("ID"=>"DESC"), $arFilter, false, array("nTopCount"=>1), $arSelect);
			if ($arFields = $res->GetNext()){
				$arFields['PREVIEW_PICTURE'] = Cfile::GetFileArray($arFields['PREVIEW_PICTURE']);
				if (sizeof()) {
					
				}
				$arResult["DISPLAY_PROPERTIES"][$code]['ITEM'] = $arFields;
			}
			
		}
	}
	$arResult["DISPLAY_PROPERTIES"][$code]['NAME'] = preg_replace('@\([^)]+\)@', '', $values["NAME"]);
}
echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult["DISPLAY_PROPERTIES"]);		
echo '</pre>';		

if ($arResult["PROPERTIES"]["MORE_PHOTO"]['VALUE']) {
	$values = $arResult["PROPERTIES"]["MORE_PHOTO"]['VALUE'];
	
	foreach ($values as $file_id) {
		$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"][] = CFile::GetFileArray($file_id);
		$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO_PREVIEW"][] = CFile::ResizeImageGet($file_id, array('width'=>208, 'height'=>162), BX_RESIZE_IMAGE_PROPORTIONAL, true);
	}
}
*/	
