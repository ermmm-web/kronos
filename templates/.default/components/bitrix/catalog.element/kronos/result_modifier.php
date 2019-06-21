<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';*/			


KRONOS_CATALOG::prepare_element($arResult, false);

foreach ($arResult['DISPLAY_PROPERTIES'] as $k => $v) {
	
	if ($v['VALUE']) {
		/* PREPARE LINK FOR BRAND */
		if (strpos($k, 'TORGOVAYA_MARKA') !== false) {
			include($_SERVER['DOCUMENT_ROOT'].'/bitrix/components/bitrix/catalog.smart.filter/class.php');
			
			$a = new CBitrixCatalogSmartFilter();
			$a->FILTER_NAME = 'arrFilter';
			$a->SAFE_FILTER_NAME = htmlspecialcharsbx($a->FILTER_NAME);
			$a->fillItemValues($v, $v['VALUE_ENUM_ID']);


			/*echo '<pre>$v = '.__FILE__.' LINE: '.__LINE__;	
			print_r($v);		
			echo '</pre>';	*/		

			if ($v['VALUES']) {
				$arResult['MANUFACTURE_SECTION_PAGE_URL']	= $arResult['SECTION']['SECTION_PAGE_URL'];
				$arResult['MANUFACTURE_SECTION_PAGE_URL'] .= '?set_filter=%D4%E8%EB%FC%F2%F0%EE%E2%E0%F2%FC';
				foreach ($v['VALUES'] as $vv) {
					$arResult['MANUFACTURE_SECTION_PAGE_URL'] .= '&'.$vv['CONTROL_NAME'].'='.$vv['HTML_VALUE'];
				}
				
				// echo '<br>MANUFACTURE_SECTION_PAGE_URL = '.$arResult['MANUFACTURE_SECTION_PAGE_URL'];
				
				//?arrFilter_171_289485416=Y&set_filter=%D4%E8%EB%FC%F2%F0%EE%E2%E0%F2%FC
			}
			
			$arResult['MANUFACTURE'] = $v;

			
			/*$res = CIBlockProperty::GetByID($v['CODE'], $v['IBLOCK_ID']);
			if ($ar_res = $res->GetNext()) {
			
				echo '<pre>$ar_res = '.__FILE__.' LINE: '.__LINE__;	
				print_r($ar_res);		
				echo '</pre>';	
				
				
			}*/
			
			break 1;	
		}
		
		/* FIND VIDEOS FOR MORE_PHOTO */
		$first = array_shift($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]);
		
		CModule::IncludeModule('iblock');
		$arFilter 	= array(   
			"IBLOCK_ID"					=> IBLOCK_ID_VIDEO,    
			"PROPERTY_PRODUCT_SLIDER"	=> $arResult['ID'],    
		);
		$arSelect 	= array('ID', 'NAME', 'PREVIEW_PICTURE', 'PROPERTY_LINK_YOUTUBE', 'PROPERTY_TIME');
		$res 		= CIBlockElement::GetList(array("ID"=>"DESC"), $arFilter, false, array("nTopCount"=>20), $arSelect);
		while($arFields = $res->GetNext()){
			array_unshift($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"], KRONOS_CATALOG::prepare_more_photo_item($arFields['PREVIEW_PICTURE'], $arFields['PROPERTY_LINK_YOUTUBE_VALUE']));
		}
		array_unshift($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"], $first);
		
		/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
		print_r($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]);		
		echo '</pre>';	*/		
		
	}
}




