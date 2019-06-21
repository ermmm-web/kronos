<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

use \Bitrix\Main\Localization\Loc;

/**
 * @global CMain $APPLICATION
 * @var array $arParams
 * @var array $arResult
 * @var CatalogSectionComponent $component
 * @var CBitrixComponentTemplate $this
 * @var string $templateName
 * @var string $componentPath
 * @var string $templateFolder
 */

$this->setFrameMode(true);
/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';*/			


$templateLibrary = array('popup', 'fx');
$currencyList = '';

if (!empty($arResult['CURRENCIES']))
{
	$templateLibrary[] = 'currency';
	$currencyList = CUtil::PhpToJSObject($arResult['CURRENCIES'], false, true, true);
}

$templateData = array(
	'TEMPLATE_THEME' => $arParams['TEMPLATE_THEME'],
	'TEMPLATE_LIBRARY' => $templateLibrary,
	'CURRENCIES' => $currencyList,
	'ITEM' => array(
		'ID' => $arResult['ID'],
		'IBLOCK_ID' => $arResult['IBLOCK_ID'],
		'OFFERS_SELECTED' => $arResult['OFFERS_SELECTED'],
		'JS_OFFERS' => $arResult['JS_OFFERS']
	)
);
unset($currencyList, $templateLibrary);

$mainId = $this->GetEditAreaId($arResult['ID']);
$itemIds = array(
	'ID' => $mainId,
	'DISCOUNT_PERCENT_ID' => $mainId.'_dsc_pict',
	'STICKER_ID' => $mainId.'_sticker',
	'BIG_SLIDER_ID' => $mainId.'_big_slider',
	'BIG_IMG_CONT_ID' => $mainId.'_bigimg_cont',
	'SLIDER_CONT_ID' => $mainId.'_slider_cont',
	'OLD_PRICE_ID' => $mainId.'_old_price',
	'PRICE_ID' => $mainId.'_price',
	'DISCOUNT_PRICE_ID' => $mainId.'_price_discount',
	'PRICE_TOTAL' => $mainId.'_price_total',
	'SLIDER_CONT_OF_ID' => $mainId.'_slider_cont_',
	'QUANTITY_ID' => $mainId.'_quantity',
	'QUANTITY_DOWN_ID' => $mainId.'_quant_down',
	'QUANTITY_UP_ID' => $mainId.'_quant_up',
	'QUANTITY_MEASURE' => $mainId.'_quant_measure',
	'QUANTITY_LIMIT' => $mainId.'_quant_limit',
	'BUY_LINK' => $mainId.'_buy_link',
	'ADD_BASKET_LINK' => $mainId.'_add_basket_link',
	'BASKET_ACTIONS_ID' => $mainId.'_basket_actions',
	'NOT_AVAILABLE_MESS' => $mainId.'_not_avail',
	'COMPARE_LINK' => $mainId.'_compare_link',
	'TREE_ID' => $mainId.'_skudiv',
	'DISPLAY_PROP_DIV' => $mainId.'_sku_prop',
	'DISPLAY_MAIN_PROP_DIV' => $mainId.'_main_sku_prop',
	'OFFER_GROUP' => $mainId.'_set_group_',
	'BASKET_PROP_DIV' => $mainId.'_basket_prop',
	'SUBSCRIBE_LINK' => $mainId.'_subscribe',
	'TABS_ID' => $mainId.'_tabs',
	'TAB_CONTAINERS_ID' => $mainId.'_tab_containers',
	'SMALL_CARD_PANEL_ID' => $mainId.'_small_card_panel',
	'TABS_PANEL_ID' => $mainId.'_tabs_panel'
);
$obName = $templateData['JS_OBJ'] = 'ob'.preg_replace('/[^a-zA-Z0-9_]/', 'x', $mainId);
$name = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_PAGE_TITLE']
	: $arResult['NAME'];
$title = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_TITLE']
	: $arResult['NAME'];
$alt = !empty($arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT'])
	? $arResult['IPROPERTY_VALUES']['ELEMENT_DETAIL_PICTURE_FILE_ALT']
	: $arResult['NAME'];

$haveOffers = !empty($arResult['OFFERS']);
if ($haveOffers)
{
	$actualItem = isset($arResult['OFFERS'][$arResult['OFFERS_SELECTED']])
		? $arResult['OFFERS'][$arResult['OFFERS_SELECTED']]
		: reset($arResult['OFFERS']);
	$showSliderControls = false;

	foreach ($arResult['OFFERS'] as $offer)
	{
		if ($offer['MORE_PHOTO_COUNT'] > 1)
		{
			$showSliderControls = true;
			break;
		}
	}
}
else
{
	$actualItem = $arResult;
	$showSliderControls = $arResult['MORE_PHOTO_COUNT'] > 1;
}

$skuProps = array();
$price = $actualItem['ITEM_PRICES'][$actualItem['ITEM_PRICE_SELECTED']];
$measureRatio = $actualItem['ITEM_MEASURE_RATIOS'][$actualItem['ITEM_MEASURE_RATIO_SELECTED']]['RATIO'];
$showDiscount = $price['PERCENT'] > 0;

$showDescription = !empty($arResult['PREVIEW_TEXT']) || !empty($arResult['DETAIL_TEXT']);
$showBuyBtn = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION']);
$buyButtonClassName = in_array('BUY', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showAddBtn = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION']);
$showButtonClassName = in_array('ADD', $arParams['ADD_TO_BASKET_ACTION_PRIMARY']) ? 'btn-primary' : 'btn-link';
$showSubscribe = $arParams['PRODUCT_SUBSCRIPTION'] === 'Y' && ($arResult['CATALOG_SUBSCRIBE'] === 'Y' || $haveOffers);

$arParams['MESS_BTN_BUY'] = $arParams['MESS_BTN_BUY'] ?: Loc::getMessage('CT_BCE_CATALOG_BUY');
$arParams['MESS_BTN_ADD_TO_BASKET'] = $arParams['MESS_BTN_ADD_TO_BASKET'] ?: Loc::getMessage('CT_BCE_CATALOG_ADD');
$arParams['MESS_NOT_AVAILABLE'] = $arParams['MESS_NOT_AVAILABLE'] ?: Loc::getMessage('CT_BCE_CATALOG_NOT_AVAILABLE');
$arParams['MESS_BTN_COMPARE'] = $arParams['MESS_BTN_COMPARE'] ?: Loc::getMessage('CT_BCE_CATALOG_COMPARE');
$arParams['MESS_PRICE_RANGES_TITLE'] = $arParams['MESS_PRICE_RANGES_TITLE'] ?: Loc::getMessage('CT_BCE_CATALOG_PRICE_RANGES_TITLE');
$arParams['MESS_DESCRIPTION_TAB'] = $arParams['MESS_DESCRIPTION_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_DESCRIPTION_TAB');
$arParams['MESS_PROPERTIES_TAB'] = $arParams['MESS_PROPERTIES_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_PROPERTIES_TAB');
$arParams['MESS_COMMENTS_TAB'] = $arParams['MESS_COMMENTS_TAB'] ?: Loc::getMessage('CT_BCE_CATALOG_COMMENTS_TAB');
$arParams['MESS_SHOW_MAX_QUANTITY'] = $arParams['MESS_SHOW_MAX_QUANTITY'] ?: Loc::getMessage('CT_BCE_CATALOG_SHOW_MAX_QUANTITY');
$arParams['MESS_RELATIVE_QUANTITY_MANY'] = $arParams['MESS_RELATIVE_QUANTITY_MANY'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_MANY');
$arParams['MESS_RELATIVE_QUANTITY_FEW'] = $arParams['MESS_RELATIVE_QUANTITY_FEW'] ?: Loc::getMessage('CT_BCE_CATALOG_RELATIVE_QUANTITY_FEW');

$positionClassMap = array(
	'left' => 'product-item-label-left',
	'center' => 'product-item-label-center',
	'right' => 'product-item-label-right',
	'bottom' => 'product-item-label-bottom',
	'middle' => 'product-item-label-middle',
	'top' => 'product-item-label-top'
);

$discountPositionClass = 'product-item-label-big';
if ($arParams['SHOW_DISCOUNT_PERCENT'] === 'Y' && !empty($arParams['DISCOUNT_PERCENT_POSITION']))
{
	foreach (explode('-', $arParams['DISCOUNT_PERCENT_POSITION']) as $pos)
	{
		$discountPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$labelPositionClass = 'product-item-label-big';
if (!empty($arParams['LABEL_PROP_POSITION']))
{
	foreach (explode('-', $arParams['LABEL_PROP_POSITION']) as $pos)
	{
		$labelPositionClass .= isset($positionClassMap[$pos]) ? ' '.$positionClassMap[$pos] : '';
	}
}

$themeClass = isset($arParams['TEMPLATE_THEME']) ? ' bx-'.$arParams['TEMPLATE_THEME'] : '';

$oViewNaves = new \Francysk\Framework\View\Card($arResult);
?>
<div class="banner-products__item banner-products__item_normal">
	<div class="banner-product banner-product_left">
		<div class="banner-product__normal">
			<div class="banner-product__top">
				<div class="banner-product__category"><?//=  $oViewNaves->getCategory(); ?></div>
				<div class="banner-product__name">
					<a href="<?= $arResult["DETAIL_PAGE_URL"]; ?>" target="" title="<? ?>"><?= $oViewNaves->getShortName(); ?></a></div>
				<div class="banner-product__status">
					<?= $oViewNaves->getStatus(); ?>
				</div>
			</div>
			<div class="banner-product__bottom">
				<div class="banner-product__price">
					<div class="mb-3">
						<?
						if ($arParams['SHOW_OLD_PRICE'] === 'Y')
						{
							?>
							<div class="product-item-detail-price-old mb-1"
								id="<?=$itemIds['OLD_PRICE_ID']?>"
								<?=($showDiscount ? '' : 'style="display: none;"')?>;><?=($showDiscount ? $price['PRINT_RATIO_BASE_PRICE'] : '')?></div>
							<?
						}
						?>

						<div class="product-item-detail-price-current mb-1" id="<?=$itemIds['PRICE_ID']?>"><?=$price['PRINT_RATIO_PRICE']?></div>

						<?
						if ($arParams['SHOW_OLD_PRICE'] === 'Y')
						{
							?>
							<div class="product-item-detail-economy-price mb-1"
								id="<?=$itemIds['DISCOUNT_PRICE_ID']?>"
								<?=($showDiscount ? '' : 'style="display: none;"')?>><?
									if ($showDiscount)
									{
										echo Loc::getMessage('CT_BCE_CATALOG_ECONOMY_INFO2', array('#ECONOMY#' => $price['PRINT_RATIO_DISCOUNT']));
									}
								?></div>
							<?
						}
						?>
					</div>
				</div>
			</div>
			<div class="banner-product__img">
				<img src="<?= $arResult["PREVIEW_PICTURE"]["src"]; ?>" alt="<?= $arResult["NAME"]; ?>" draggable="false"/></div>
			<div class="banner-product__zoom">
				<svg>
				<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-lupa"></use>
				</svg>
			</div>
		</div>
		
		<div class="banner-product__open banner-product-open">
			<div class="banner-product-open__top">
				<div class="banner-product-open__top-left">
					<div class="banner-product-open__category"><?//= $oViewNaves->getCategory(); ?></div>
				</div>
				<div class="banner-product-open__top-right">
					<div class="banner-product-open__triggers">
						<ul>
							<? foreach ($arResult["PROPERTIES"]["BONUS"]["VALUE"] as $pid): ?>
								<? // $aBonus = \Francysk\Framework\Objects\Bonus::getInstance()->get($pid); ?>
								<li class="<?= $aBonus["CODE"]; ?>">
									<img src="<?= $aBonus["ICON_SRC"]; ?>" alt="<?= $aBonus["NAME"]; ?>" titile="<?= $aBonus["NAME"]; ?>" />
									<span><?= $aBonus["NAME"]; ?></span>                                    
								</li>
							<? endforeach; ?>   
						</ul>
					</div>
				</div>
			</div>
			
			<div class="banner-product-open__name">
				<a href="<?= $arResult["DETAIL_URL_PAGE"]; ?>" target="" title="<?= $arResult["NAME"]; ?>"><?= $oViewNaves->getShortName(); ?></a></div>
			<div class="banner-product-open__status">
				<?= $oViewNaves->getStatus(); ?>
			</div>
			<div class="banner-product-open__main">
				<div class="banner-product-open__main-left">
					<div class="banner-product-open__price">
						<div class="js-banner-product-countUp price price_normal" data-end="128 999 р." data-start="0">0</div>
					</div>
					<div class="banner-product-open__count">
						<a class="dot-link-lines" href="#" title="7 654 человек уже купили этот товар!"><span class="dot-link-lines__name">7 654 человек уже купили этот товар!</span></a>
					</div>
				</div>
				<div class="banner-product-open__main-right">
					<div class="banner-product-open__image" data-count="8"><a class="banner-product-open__image-more" href="" title="">
							<div class="banner-product-open__image-more-info"><img src="/local/frontend/build/img/svg/photo.svg" alt=""/><span class="dot-link-one-line__name">Ещё 12 фотографий</span></div></a>
						<div class="banner-product-open__image-preload">
							<div class="swiper-lazy-preloader"></div>
						</div>
						<div class="banner-product-open__image-target"><img src="<?= $arResult["NAVES"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>" alt="Flagman RX MTZ Edition" draggable="false"/></div>
					</div>
				</div>
			</div>
			<div class="banner-product-open__pagination">
				<div class="pagination-line">
					<a class="active" href="<?= $arResult["NAVES"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>" title=""></a>
					<? foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUES"] as $pid): ?>
						<a href="<?= $arResult["NAVES"]["FILES"][$pid]["SRC"]; ?>" title=""></a>
					<? endforeach; ?>
				</div>
			</div>
			<?
			$APPLICATION->IncludeComponent("francysk.custom:present", "", array("FRANCYSKFRAEMWORK_ENTITY" => "2",
				"FRANCYSKFRAEMWORK_FUNCTION_DECORATOR" => "",
				"FRANCYSKFRAEMWORK_SYSTEM" => "1",
				"GET_SECTION_BOOL" => "N",
				"IBLOCK_ID" => "2",
				"IBLOCK_TYPE" => "1c_catalog",));
			?>
			<div class="banner-product-open__props">
				<div class="props props_product-banner">
					<div class="props__table">
						<? foreach ($arItem["PROPERTIES"] as $code => $values): ?>
							<? if (strripos($code, "MINI_") === false) continue; ?>
							<div class="props__tr">
								<div class="props__td"><?= $values["HINT"] ? $values["HINT"] : $values["NAME"]; ?>:</div>
								<div class="props__td">
									<? if ($values["PROPERTY_TYPE"] == "E"): ?>
										<? $p = $arResult["DOP"]["ITEMS"][$values["VALUE"]]; ?>
										<? $values["VALUE"] = $p["NAME"]; ?>
										<? if ($p["PREVIEW_PICTURE"] > 0): ?>
											<img src="<?= $arResult["DOP"]["FILES"][$p["PREVIEW_PICTURE"]]["SRC"]; ?>" alt="<?= $p["NAME"]; ?>" title="<?= $p["NAME"]; ?>" />
										<? endif; ?>
									<? endif; ?>
									<?= $values["VALUE"]; ?> <?= $values["DESCRIPTION"]; ?>
								</div>
							</div>
						<? endforeach; ?>  
					</div>
				</div>
			</div>
			<div class="banner-product-open__action"><a class="btn" href="#" title="">Подробнее</a><a class="btn btn_green" href="#" title="">Купить</a><a class="dot-link-lines" href="#" title=""><span class="dot-link-lines__name">Рассрочка/кредит</span></a>
			</div>
		</div>
	</div>
</div>
<?