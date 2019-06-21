<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogTopComponent $component
 */

$component 	= $this->getComponent();
$arParams 	= $component->applyTemplateModifications();

if (!$arParams['TEMPLATE']) {
	$arParams['TEMPLATE'] == 'kronos';	
}

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';	*/		


/* LIMIT ITEMS VIA SIZE */
if ($arParams['MAX_COUNT']) {
	$arParams['MAX_COUNT'] *= 100;
	$cur_size 	= 0;
	$cur_sum 	= 0;
	$total_sum 	= 0;
	$name_size	= '';
	foreach ($arResult['ITEMS'] as $k => $arItem) {
		$name_size 		= $arItem['PROPERTIES']['MAIN_SIZE']['VALUE_XML_ID'];
		$arItem['SORT'] = $arItem['PROPERTIES']['MAIN_SORT']['VALUE'];
		
		if ($name_size == 'normal') {
			$cur_size = 100;
		} else { // mini
			$cur_size = 50;
		}
		$cur_sum += $cur_size;
		
		/* CORRECT SIZE, e.g. mini then normal */
		if ($cur_sum > 100) {
			$cur_size 	= 50;
			$name_size 	= 'mini';
			$cur_sum 	= 0;
		} elseif ($cur_sum == 100) {
			$cur_sum = 0;
		}
		
		$total_sum += $cur_size;
		
		
		if ($total_sum > $arParams['MAX_COUNT']) {
			unset($arResult['ITEMS'][$k]);
		} else {
			$arResult['MAX_SORT'] 			= $arItem['SORT'];
			$arResult['ITEMS'][$k]['SORT'] 	= $arItem['SORT'];
			$arResult['ITEMS'][$k]['SIZE'] 	= $name_size;
		}
		
		/*echo '<br>$PRODUCT_ID = '.$PRODUCT_ID;
		echo '<br>$name_size = '.$name_size;
		echo '<br>$cur_sum = '.$cur_sum;
		echo '<br>$cur_size = '.$cur_size;
		echo '<br>$total_sum = '.$total_sum;*/
	}
	
	/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
	print_r($arResult);		
	echo '</pre>';			
	
	die();*/
	
	
	
	
	
	
	
	usort($arResult['ITEMS'], function ($a, $b) {
		if ($a['SORT'] > $b['SORT']) {
			return 1;
		} else {
			return 0;
		}
	});	
}


/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult['ITEMS']);		
echo '</pre>';	
die();	*/	

$this->__component->arResultCacheKeys = array_merge($this->__component->arResultCacheKeys, array('MAX_SORT'));
