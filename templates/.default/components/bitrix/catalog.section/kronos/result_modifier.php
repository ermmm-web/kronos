<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogSectionComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

foreach ($arResult['ITEMS'] as $arItem) {
	if ($arItem['MIN_PRICE']['DISCOUNT_DIFF']) {
echo '<!--';	
echo '<pre>$arItem = '.__FILE__.' LINE: '.__LINE__;	
print_r($arItem);		
echo '</pre>';			
echo '-->';			
$arDiscounts = CCatalogDiscount::GetDiscountByProduct(
        150,
        $USER->GetUserGroupArray(),
        "N",
        $arParams['PRICE_CODE'],
        SITE_ID
    );		
echo '<!--';	
echo '<pre>$arDiscounts = '.__FILE__.' LINE: '.__LINE__;	
print_r($arDiscounts);		
echo '</pre>';			
echo '-->';			
	}
}

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';		

echo '<!--';	
echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult['ITEMS']);		
echo '</pre>';			
echo '-->';			
*/	

