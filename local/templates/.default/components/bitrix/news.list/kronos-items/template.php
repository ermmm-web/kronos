<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);

$componentElementParams = array(
	"ACTION_VARIABLE" => "action",
	"ADD_DETAIL_TO_SLIDER" => "N",
	"ADD_ELEMENT_CHAIN" => "N",
	"ADD_PICT_PROP" => "-",
	"ADD_PROPERTIES_TO_BASKET" => "Y",
	"ADD_SECTIONS_CHAIN" => "N",
	"ADD_TO_BASKET_ACTION" => array("BUY"),
	"ADD_TO_BASKET_ACTION_PRIMARY" => array("BUY"),
	"BACKGROUND_IMAGE" => "-",
	"BASKET_URL" => "/personal/basket.php",
	"BRAND_USE" => "N",
	"BROWSER_TITLE" => "-",
	"CACHE_GROUPS" => "N",
	"CACHE_TIME" => "36000000",
	"CACHE_TYPE" => "A",
	"CHECK_SECTION_ID_VARIABLE" => "N",
	"COMPATIBLE_MODE" => "Y",
	"CONVERT_CURRENCY" => "N",
	"DETAIL_PICTURE_MODE" => array("POPUP","MAGNIFIER"),
	"DETAIL_URL" => "",
	"DISABLE_INIT_JS_IN_COMPONENT" => "N",
	"DISPLAY_COMPARE" => "N",
	"DISPLAY_NAME" => "Y",
	"DISPLAY_PREVIEW_TEXT_MODE" => "E",
	"ELEMENT_CODE" => "",
	"GIFTS_DETAIL_BLOCK_TITLE" => "Выберите один из подарков",
	"GIFTS_DETAIL_HIDE_BLOCK_TITLE" => "N",
	"GIFTS_DETAIL_PAGE_ELEMENT_COUNT" => "4",
	"GIFTS_DETAIL_TEXT_LABEL_GIFT" => "Подарок",
	"GIFTS_MAIN_PRODUCT_DETAIL_BLOCK_TITLE" => "Выберите один из товаров, чтобы получить подарок",
	"GIFTS_MAIN_PRODUCT_DETAIL_HIDE_BLOCK_TITLE" => "N",
	"GIFTS_MAIN_PRODUCT_DETAIL_PAGE_ELEMENT_COUNT" => "4",
	"GIFTS_MESS_BTN_BUY" => "Выбрать",
	"GIFTS_SHOW_DISCOUNT_PERCENT" => "Y",
	"GIFTS_SHOW_IMAGE" => "Y",
	"GIFTS_SHOW_NAME" => "Y",
	"GIFTS_SHOW_OLD_PRICE" => "Y",
	"HIDE_NOT_AVAILABLE_OFFERS" => "Y",
	"IBLOCK_ID" => "2",
	"IBLOCK_TYPE" => "1c_catalog",
	"IMAGE_RESOLUTION" => "16by9",
	"LABEL_PROP" => array(),
	"LINK_ELEMENTS_URL" => "link.php?PARENT_ELEMENT_ID=#ELEMENT_ID#",
	"LINK_IBLOCK_ID" => "",
	"LINK_IBLOCK_TYPE" => "",
	"LINK_PROPERTY_SID" => "",
	"MAIN_BLOCK_PROPERTY_CODE" => array(),
	"MESSAGE_404" => "",
	"MESS_BTN_ADD_TO_BASKET" => "В корзину",
	"MESS_BTN_BUY" => "Купить",
	"MESS_BTN_SUBSCRIBE" => "Подписаться",
	"MESS_COMMENTS_TAB" => "Комментарии",
	"MESS_DESCRIPTION_TAB" => "Описание",
	"MESS_NOT_AVAILABLE" => "Нет в наличии",
	"MESS_PRICE_RANGES_TITLE" => "Цены",
	"MESS_PROPERTIES_TAB" => "Характеристики",
	"META_DESCRIPTION" => "-",
	"META_KEYWORDS" => "-",
	"OFFERS_LIMIT" => "0",
	"PARTIAL_PRODUCT_PROPERTIES" => "N",
	"PRICE_CODE" => array("Цена розница"),
	"PRICE_VAT_INCLUDE" => "Y",
	"PRICE_VAT_SHOW_VALUE" => "N",
	"PRODUCT_ID_VARIABLE" => "id",
	"PRODUCT_INFO_BLOCK_ORDER" => "sku,props",
	"PRODUCT_PAY_BLOCK_ORDER" => "rating,price,priceRanges,quantityLimit,quantity,buttons",
	"PRODUCT_PROPS_VARIABLE" => "prop",
	"PRODUCT_QUANTITY_VARIABLE" => "quantity",
	"PRODUCT_SUBSCRIPTION" => "N",
	"SECTION_CODE" => "",
	"SECTION_CODE_PATH" => "#SECTION_CODE_PATH#/",
	"SECTION_ID" => '',
	"SECTION_ID_VARIABLE" => "SECTION_ID",
	"SECTION_URL" => "",
	"SEF_MODE" => "Y",
	"SEF_RULE" => "#SECTION_CODE_PATH#/#ELEMENT_CODE#/",
	"SET_BROWSER_TITLE" => "N",
	"SET_CANONICAL_URL" => "N",
	"SET_LAST_MODIFIED" => "N",
	"SET_META_DESCRIPTION" => "N",
	"SET_META_KEYWORDS" => "N",
	"SET_STATUS_404" => "N",
	"SET_TITLE" => "N",
	"SET_VIEWED_IN_COMPONENT" => "N",
	"SHOW_404" => "N",
	"SHOW_CLOSE_POPUP" => "N",
	"SHOW_DEACTIVATED" => "N",
	"SHOW_DISCOUNT_PERCENT" => "N",
	"SHOW_MAX_QUANTITY" => "N",
	"SHOW_OLD_PRICE" => "N",
	"SHOW_PRICE_COUNT" => "1",
	"SHOW_SLIDER" => "N",
	"STRICT_SECTION_CHECK" => "N",
	"TEMPLATE_THEME" => "blue",
	"USE_COMMENTS" => "N",
	"USE_ELEMENT_COUNTER" => "N",
	"USE_ENHANCED_ECOMMERCE" => "N",
	"USE_GIFTS_DETAIL" => "N",
	"USE_GIFTS_MAIN_PR_SECTION_LIST" => "N",
	"USE_MAIN_ELEMENT_SECTION" => "N",
	"USE_PRICE_COUNT" => "N",
	"USE_PRODUCT_QUANTITY" => "N",
	"USE_RATIO_IN_RANGES" => "N",
	"USE_VOTE_RATING" => "N"
);

?>
<div class="">
<? foreach($arResult["ITEMS"] as $arItem) {
	if ($arItem['DISPLAY_PROPERTIES']['PRODUCT_ID']['VALUE']) {
		$componentElementParams["ELEMENT_ID"] = $arItem['DISPLAY_PROPERTIES']['PRODUCT_ID']['VALUE'];
	} else {
		$componentElementParams["ELEMENT_ID"] = $arItem['ID'];
	}
		
	$APPLICATION->IncludeComponent(
		"bitrix:catalog.element",
		"kronos-item",
		$componentElementParams
	);/**/
	
}
?>
</div>
