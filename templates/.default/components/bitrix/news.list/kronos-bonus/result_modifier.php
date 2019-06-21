<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';*/			

/* LIMIT ITEMS VIA SIZE */
$arParams['MAX_COUNT'] *= 100;
$cur_size 	= 0;
$cur_sum 	= 0;
$total_sum 	= 0;
$name_size	= '';
foreach ($arResult['ITEMS'] as $k => $arItem) {
	$name_size = $arItem['DISPLAY_PROPERTIES']['SIZE']['VALUE_XML_ID'];
	
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
		$arResult['MAX_SORT'] = $arItem['SORT'];
		// echo '<br>USE = '.$arItem['ID'];
		
		/* PREPARE DATA FOR catalog.top */
		$PRODUCT_ID = $arItem['DISPLAY_PROPERTIES']['PRODUCT_ID']['VALUE'];
		$arResult['AR_ITEMS'][$PRODUCT_ID] = array (
			'ID' 	=> $PRODUCT_ID,
			'SORT' 	=> $arItem['SORT'],
			'SIZE'	=> $name_size
		);
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

$this->__component->arResultCacheKeys = array_merge($this->__component->arResultCacheKeys, array('MAX_SORT'));


