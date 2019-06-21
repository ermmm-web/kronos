<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';			

echo '<pre>$arParams = '.__FILE__.' LINE: '.__LINE__;	
print_r($arParams);		
echo '</pre>';	*/		

//echo '<br>MAX_SORT = '.$arResult['MAX_SORT'];
//echo '<br>FILTER_NAME = '.$arParams['FILTER_NAME'];

$GLOBALS[$arParams['FILTER_NAME']]['>PROPERTY_MAIN_SORT'] = $arResult['MAX_SORT'];

