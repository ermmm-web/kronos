<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
// $arParams = $component->applyTemplateModifications();

KRONOS_CATALOG::prepare_element($arResult, 8);

/*echo '<pre>$arParams = '.__FILE__.' LINE: '.__LINE__;	
print_r($arParams);		
echo '</pre>';	

echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';
die();			*/


/* CHECK DATA OF MAIN PAGE FOR SIZE 
foreach ($arParams['AR_ITEMS'] as $arItem) {
	if ($arItem['ID'] == $arResult['ID']) {
		if ($arItem['DISPLAY_PROPERTIES']['SIZE']['VALUE_XML_ID']) {
			$arResult['SIZE'] = $arItem['DISPLAY_PROPERTIES']['SIZE']['VALUE_XML_ID'];
		} else {
			$arResult['SIZE'] = 'normal';
		}
		break;
	}
}*/
