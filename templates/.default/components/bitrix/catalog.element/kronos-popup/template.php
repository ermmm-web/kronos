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

	CModule::IncludeModule('sale');
	CModule::IncludeModule('catalog');


$this->setFrameMode(true);?>
<?$templateLibrary = array('popup', 'fx');
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

/*echo '<pre>$price = '.__FILE__.' LINE: '.__LINE__;	
print_r($price);		
echo '</pre>';			


echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';*/
function show_calc($arResult, $num) {
	$code = 'CALC_'.$num;
	
	if (!$arResult['DISPLAY_PROPERTIES'][$code]['LINK_ELEMENT_VALUE']) {
		return;
	}
	?>
	<div role="tabpanel" class="tab-pane <?=($num === 1?'active':'')?>" id="tab<?=$num?>">
		<?
		/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
		print_r($arResult['DISPLAY_PROPERTIES'][$code]);		
		echo '</pre>';*/
		
		if (sizeof($arResult['DISPLAY_PROPERTIES'][$code]['LINK_ELEMENT_VALUE']) == 1) {
			$ar = current($arResult['DISPLAY_PROPERTIES'][$code]['LINK_ELEMENT_VALUE']);
			if ($ar['ID'] == 6192) { // navesnoe oborudovanie
				?>
				<div class="popup-calc-price__naves">
					<div class="popup-calc-price__naves-name d-tbx-none">Выберите дополнительное навесное оборудование:</div>
					<div class="popup-calc-price__naves-name d-tbx-block d-tb-none d-dt2x-none">Выберите дополнительное оборудование:</div>
					<div class="popup-calc-price__naves-name d-tb-block d-dt2x-none">Выберите оборудование:</div>
					<div class="popup-calc-price__naves-gallery">
						<div class="popup-calc-price-naves-swiper swiper-container">
							<div class="swiper-wrapper"><?
								foreach ($arResult['DISPLAY_PROPERTIES']['BIND_OBORUDOVANIE']['LINK_ELEMENT_VALUE'] as $arProp) {
									?><div class="swiper-slide">
										<div class="popup-calc-price-naves">
											<div class="popup-calc-price-naves__img"><img src="<?=$arProp['PREVIEW_PICTURE_SMALL']['src']?>" alt=""/></div>
											<div class="popup-calc-price-naves__name d-tb-none js-dotdotdot"><?=$arProp['NAME']?></div>
											<div class="popup-calc-price-naves__name d-tb-block d-dt2x-none js-dotdotdot"><span><?=$arProp['NAME']?></span></div>
											<div class="popup-calc-price-naves__checkbox-and-gift">
												<div class="popup-calc-price-naves__checkbox">
													<div class="checkbox checkbox_big checkbox_inline-no-text">
														<label>
															<input class="check-cust" type="checkbox" name="RASCHET_NAVES[]"  onClick="add_raschet_item('SEC_<?=$code?>', '<?=$arProp['ID']?>', '<?=$arProp['NAME']?>', true);" value="<?=$arProp['NAME']?>"/>
															<span class="check-cust_i"></span></label>
													</div>
												</div>
											</div>
										</div>
									</div><?
								}
							?></div>
						</div>
						<div class="swiper-pagination-kronos"></div>
						<div class="swiper-button-prev-2 point-animation"><svg>
							<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
							</svg></div>
						<div class="swiper-button-next-2 point-animation"><svg>
							<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
							</svg></div>
					</div>
				</div>			
				<?
			} elseif ($ar['ID'] == 6193) {
				?>
				
				<div class="">У вас уже есть наша дисконтная карта?</div>
				<div class="">Иконка</div>
				<div class="popup-calc-price-naves__checkbox-and-gift">
					<div class="popup-calc-price-naves__checkbox">
						<div class="checkbox checkbox_big checkbox_inline-no-text">
							<label>
								<input class="check-cust" type="radio" name="RASCHET_DISCOUNT_CARD[]" checked onClick="add_raschet_item('SEC_<?=$code?>', '<?=$arProp['ID']?>', '<?=$arProp['NAME']?>', false);" value="Нет"/>
								<span class="check-cust_i">Нет</span>
							</label>
						</div>
						<div class="checkbox checkbox_big checkbox_inline-no-text">
							<label>
								<input class="check-cust" type="radio" name="RASCHET_DISCOUNT_CARD[]" onClick="add_raschet_item('SEC_<?=$code?>', '<?=$arProp['ID']?>', '<?=$arProp['NAME']?>', false);" value="Да"/>
								<span class="check-cust_i">Да</span>
							</label>
						</div>
					</div>
				</div>
				
				<?
			} elseif ($ar['ID'] == 6211) {
				?>
				
				<div class="">Выберите способ и адрес доставки:</div>
				
				<div class="popup-calc-price-naves__checkbox-and-gift">
					<div class="popup-calc-price-naves__checkbox">
						<div class="checkbox checkbox_big checkbox_inline-no-text">
							<label>
								<div class="">Иконка</div>
								<input class="check-cust" type="radio" name="RASCHET_DELIVERY[]" checked onClick="add_raschet_item('SEC_<?=$code?>', '<?=$arProp['ID']?>', '<?=$arProp['NAME']?>', false);show_address('Самовывоз (скидка 3%)');" value="Самовывоз (скидка 3%)"/>
								<span class="check-cust_i">Самовывоз (скидка 3%)</span>
							</label>
						</div>
						<div class="checkbox checkbox_big checkbox_inline-no-text">
							<label>
								<div class="">Иконка</div>
								<input class="check-cust" type="radio" name="RASCHET_DELIVERY[]" onClick="add_raschet_item('SEC_<?=$code?>', '<?=$arProp['ID']?>', '<?=$arProp['NAME']?>', false);show_address('Доставка на дом');" value="Доставка на дом" id="RASCHET_DELIVERY"/>
								<span class="check-cust_i">Доставка на дом</span>
							</label>
						</div>
					</div>
					
					<div class="" id="delivery_address" style="display:none;">
						<div class="popup__col popup__col_50">
							<div class="jq-selectbox jqselect js-select js-select_block js-select-mini js-select_disabled-hide js-select_selected-hide js-tooltip js-tooltip-error dropdown opened" id="region-styler" style="display: inline-block; position: relative; z-index: 100;">
								<select id="region" style="-webkit-appearance: none; margin: 0px; padding: 0px; position: absolute; left: 0px; top: 0px; width: 100%; height: 100%; opacity: 0;" class="js-select js-select_block js-select-mini js-select_disabled-hide js-select_selected-hide js-tooltip js-tooltip-error" data-tooltip="Выберите область" name="RASCHET_DELIVERY_REGION" data-insert-el="#data-insert-address-1" data-insert="" data-insert-type="text" data-type-value="select">
									<option value="">Выберите область</option>
									<? foreach ($arResult['REGIONS'] as $v) {
										?><option value="<?=$v?>"><?=$v?></option><?
										
									} ?>
								</select>
								<div class="jq-selectbox__select" style="position: relative">
									<div class="jq-selectbox__select-text">Выберите область</div>
									<div class="jq-selectbox__trigger">
										<div class="jq-selectbox__trigger-arrow"></div>
									</div>
								</div>
								<div class="jq-selectbox__dropdown" style="position: absolute; height: auto; bottom: auto; top: 100%;">
									<div class="jq-selectbox__search">
										<input type="search" autocomplete="off" placeholder="Поиск...">
									</div>
									<div class="jq-selectbox__not-found" style="display: none;">Совпадений не найдено</div>
									<ul style="position: relative; list-style: none; overflow: hidden auto; max-height: 120px;">
										<li class="sel selected" style="">Выберите область</li>
										<? foreach ($arResult['REGIONS'] as $v) {
											?><li style=""><?=$v?></li><?
											
										} ?>
										<li data-jqfs-class="option_hidden" class="option_hidden" id="region_custom-styler" style=""></li>
									</ul>
								</div>
							</div>

						</div>
						
						<div class="popup__col popup__col_50">
							<div class="input">
								<div class="input__label">
									<label for="RASCHET_DELIVERY_CITY">Ваш населённый пункт:</label>
								</div>
								<div class="input__input">
									<input id="RASCHET_DELIVERY_CITY" type="text" name="RASCHET_DELIVERY_CITY"/>
								</div>
							</div>
						</div>
					
					</div>
				</div>
				
				<?
			}
		} else {
			/* GET SECTION FOR NAME */
			$temp = current($arResult['DISPLAY_PROPERTIES'][$code]['LINK_ELEMENT_VALUE']);
			$arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'UF_MULTY');
			$arFilter = array('IBLOCK_ID' => $temp['IBLOCK_ID'], 'ID' => $temp['IBLOCK_SECTION_ID']);
			$rSection = CIBlockSection::GetList(array('ID' => 'DESC'), $arFilter, false, $arSelect, array("nTopCount"=>1) );
			if ($arSection = $rSection->GetNext()) {
				// $arSection['NAME'] = strtolower($arSection['NAME']);
			}
			
			?>
			<div class="popup-calc-price__naves">
				<div class="popup-calc-price__naves-name d-tbx-none"><?=$arSection['NAME']?>:</div>
				<div class="popup-calc-price__naves-name d-tbx-block d-tb-none d-dt2x-none"><?=$arSection?>:</div>
				<div class="popup-calc-price__naves-name d-tb-block d-dt2x-none"><?=$arSection?>:</div>
				<div class="popup-calc-price__naves-gallery">
					<div class="popup-calc-price-naves-swiper swiper-container">
						<div class="swiper-wrapper"><?
							foreach ($arResult['DISPLAY_PROPERTIES'][$code]['LINK_ELEMENT_VALUE'] as $arProp) {
								?><div class="swiper-slide">
									<div class="popup-calc-price-naves">
										<div class="popup-calc-price-naves__img"><img src="<?=$arProp['PREVIEW_PICTURE_SMALL']['src']?>" alt=""/></div>
										<div class="popup-calc-price-naves__name d-tb-none js-dotdotdot"><?=$arProp['NAME']?></div>
										<div class="popup-calc-price-naves__name d-tb-block d-dt2x-none js-dotdotdot"><span><?=$arProp['NAME']?></span></div>
										<div class="popup-calc-price-naves__checkbox-and-gift">
											<div class="popup-calc-price-naves__checkbox">
												<div class="checkbox checkbox_big checkbox_inline-no-text">
													<label>
														<input class="check-cust" type="<?=($arSection['UF_MULTY']?'checkbox':'radio')?>" name="RASCHET_MORE[]" onClick="add_raschet_item('SEC_<?=$code?>', '<?=$arProp['ID']?>', '<?=$arProp['NAME']?>', <?=($arSection['UF_MULTY']?'true':'false')?>, $(this).prop('checked'));"  value="<?=$arProp['NAME']?>"/>
														<span class="check-cust_i"></span>
													</label>
												</div>
											</div>
										</div>
									</div>
								</div><?
							}
						?></div>
					</div>
					<div class="swiper-pagination-kronos"></div>
					<div class="swiper-button-prev-2 point-animation"><svg>
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
						</svg></div>
					<div class="swiper-button-next-2 point-animation"><svg>
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
						</svg></div>
				</div>
			</div>			
			<?			
		}		
		?>
		<div class="popup-calc-price__bottom">
			<div class="popup-calc-price__bottom-left">
				<div class="popup-calc-price__garant"><img src="img/svg/garant.svg" alt=""/><span class="d-tb-none">Гарантия лучшей цены</span><span class="d-tb-inline d-dt2x-none">Гарантия<br>
					лучшей цены</span></div>
			</div>
			<div class="popup-calc-price__bottom-right">
				<a class="btn" aria-controls="home" role="tab" data-toggle="tab" href="#tab<?=($num + 1)?>" title="">Далее</a>
			</div>
		</div>
	</div>
	<?
}
			
			
function show_popup_header($arResult, $title, $mode) {
	?>
	<div class="popup__head"> 
		<div class="steps"><span class="steps__text"><?=$title?>:</span><span class="steps__title">Шаг</span>
			<ul class="steps-list" role="tablist">
				<li role="presentation" class="step active"><a href="#tab1" aria-controls="tab1" role="tab" data-toggle="tab"><span class="step__num">1</span></a></li>
				<li role="presentation" class="step"><a href="#tab2" aria-controls="tab2" role="tab" data-toggle="tab"><span class="step__num">2</span></a></li>
				<? if (in_array($mode, array('price', 4))) {
					?><li role="presentation" class="step"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><span class="step__num">3</span></a></li>
					<li role="presentation" class="step"><a href="#tab4" aria-controls="tab4" role="tab" data-toggle="tab"><span class="step__num">4</span></a></li><?
					
				} elseif ($mode == 3) {
					?><li role="presentation" class="step"><a href="#tab3" aria-controls="tab3" role="tab" data-toggle="tab"><span class="step__num">3</span></a></li><?
					
				}
				?>
			</ul>
		</div>
		<div class="popup-product">
			<div class="popup-product__descr red ">3<?=$arResult["NAME"]?></div>
			<div class="popup-product__pic"><img class="img-responsive" src="<?=$arResult["PREVIEW_PICTURE"]['src']?>" alt=""/></div>
			<div class="popup-product__bought"><span class="dot-link-one-line__name"><?=$arResult['DISPLAY_PROPERTIES']['COUNT_BUY']['VALUE']?> человек уже купили этот товар!</span></div>
		</div>
	</div><?
}

function show_phone ($arResult, $button_text = 'Заказать', $show_name = true) {
	?><div class="popup__body popup__form buy-with-presents__form" >
		<?
		//if (!$arResult['USER']['PHONE']) {
			?><div class="buy-with-presents__flex"><?
				if ($show_name) {
					?><div><div class="input"><div class="input__label"><label for="POPUP_FOUNDED_CHEAPER_NAME"><span class="hidden-phx">Введите Ваше имя:</span><span class="visible-phx">Ваше имя:</span></label></div><div class="input__input"><input id="POPUP_FOUNDED_CHEAPER_NAME" type="text" name="NAME"/></div></div></div><?
				}
				?>
		<div>
			<div class="input">
				<div class="input__label">
					<label for="POPUP_FOUNDED_CHEAPER_PHONE"><span class="hidden-phx">Введите номер Вашего телефона:</span><span class="visible-phx">Ваш телефон:</span></label>
					</div>
				<div class="input__input"><? KRONOS_CATALOG::show_phone_sub (); ?><?
					?></div>
			</div>
			</div>				
			
			<div><button class="btn save_order_button"><?=$button_text?></button></div>
			</div>
		</div>

		<?
		//if (!$arResult['USER']['PHONE']) {
			?><div class="buy-with-presents__description buy-with-presents__hide-small"><div>Мы не передаём Ваш номер третьим лицам и не используем его</div><div>для рассылки рекламы.</div></div>
			<div class="buy-with-presents__description buy-with-presents__show-small"><div>Мы не передаём Ваш номер</div><div>третьим лицам и не используем</div><div>его для рассылки рекламы.</div></div>
			<?
		//}
		?>
	</div><?	
}

function show_credit_start ($price) {
	CModule::IncludeModule('sale');
	CModule::IncludeModule('catalog');
	for ($i = 0; $i < 6; $i++) {
		$s = SaleFormatCurrency($price['RATIO_PRICE']/10*$i, $price['CURRENCY']).' ('.($i*10).'%)';
		?><option value="<?=$s?>"><?=$s?></option><?
	}
}
function show_facts_header () {
	?><div class="facts-label__wrap"><a href="javascript:void(0);" onClick="$('.facts').toggle();"<span><span class="facts-label__num">5</span> <span class="facts-label__text">фактов о наших кредитах</span></span></a></div><?
}

function show_facts () {
?>
	<div class="facts" style="display:none;">
		<ul class="facts__list">
			<li class="fact">
				<div class="fact__pic" style="background-image: url('/local/frontend/build/img/fact_1.png')"></div>
				<p class="fact__descr">Кредит можно оформить за 15–20 минут в магазине или по телефону. Для оформления нужен только паспорт. Поручители и справка о доходах не требуются.</p>
			</li>
			<li class="fact">
				<div class="fact__pic" style="background-image: url('/local/frontend/build/img/fact_2.png')"></div>
				<p class="fact__descr">Мы сотрудничаем с самыми крупными банками, России поэтому подберём Вам лучшие условия кредитования из доступных на рынке.</p>
			</li>
			<li class="fact">
				<div class="fact__pic" style="background-image: url('/local/frontend/build/img/fact_3.png')"></div>
				<p class="fact__descr">8 из 10 наших запросов на кредитование одобряются.</p>
			</li>
			<li class="fact">
				<div class="fact__pic" style="background-image: url('/local/frontend/build/img/fact_4.png')"></div>
				<p class="fact__descr">В нашем договоре нет скрытых комиссий и платежей. Штраф за досрочное погашение кредита не взимается.</p>
			</li>
			<li class="fact">
				<div class="fact__pic" style="background-image: url('/local/frontend/build/img/fact_5.png')"></div>
				<p class="fact__descr">Вы подписываете кредитный договор только после получения товара.</p>
			</li>
		</ul>
		<div class="facts__turn js-facts-btn"><span>Свернуть</span></div>
	</div>
<?
}






?>

<div class="popup buy-with-presents">
	<div class="popup__body ">
		<form id="save_order_form">
			<input type="hidden" name="ELEMENT_ID" value="<?=$arResult['ID']?>" >
	
			<?
			$phone_display = '';
			if ($arParams['MODE'] == 'BUY') {
				?><div class="popup__name buy-with-presents__name">
					<div>Оформить заказ <br class="visible-phx">на <?=$arResult['NAME']?></div><?
		
					$iCountPodarki = count($arResult["DISPLAY_PROPERTIES"]["BIND_PODAROK"]["LINK_ELEMENT_VALUE"]);
					?>
					<? if( $iCountPodarki > 0 ): ?>
						<div class="buy-with-presents__hide-small">и получить <?=$iCountPodarki?> подарка</div>
					<? endif; ?>
				</div>

				<?if( $iCountPodarki == 0 ): ?>
					<div class="buy-with-presents__presents-container_by_present">
						<div class="buy-with-presents__tractor">
							
							<img class="img-responsive" src="<?=$arResult["PREVIEW_PICTURE"]['src']?>" alt=""/>
						</div>
					
						<div class="buy-with-presents__presents-items-container">
							<? foreach ($arResult["DISPLAY_PROPERTIES"]["BIND_PODAROK"]["LINK_ELEMENT_VALUE"] as $k => $arItems) {
								/*echo '<pre>$arItem = '.__FILE__.' LINE: '.__LINE__;	
								print_r($arItem);		
								echo '</pre>';	*/		
					
								?><div class="buy-with-presents__present">
									<div class="buy-with-presents__present-img">
										<img class="img-responsive" src="<?=$arItems['PREVIEW_PICTURE_SMALL']['src']?>" alt="<?=$arItems['NAME']?>"/>
									</div>
									<div class="buy-with-presents__present-name js-dotdotdot"><?=$arItems['NAME']?></div>
								</div><?
							}
							
							?>
							</div>	
					</div>
				<? endif; ?>

				<?if( $iCountPodarki > 0 ): ?>
					<div class="buy-with-presents__presents-container_by_present">
						<div class="buy-with-presents__tractor">							
							<img class="img-responsive" src="<?=$arResult["PREVIEW_PICTURE"]['src']?>" alt=""/>
						</div>
						<div class="buy-with-presents__plus">
								<img src="/local/frontend/build/img/svg/plus.svg" alt="plus"/>
							</div>
							<div class="buy-with-presents__presents-items-container">
							<? foreach ($arResult["DISPLAY_PROPERTIES"]["BIND_PODAROK"]["LINK_ELEMENT_VALUE"] as $k => $arItem) {
								/*echo '<pre>$arItem = '.__FILE__.' LINE: '.__LINE__;	
								print_r($arItem);		
								echo '</pre>';	*/		
					
								?><div class="buy-with-presents__present">
									<div class="buy-with-presents__present-img">
										<img class="img-responsive" src="<?=$arItem['PREVIEW_PICTURE_SMALL']['src']?>" alt="<?=$arItem['NAME']?>"/>
									</div>
									<div class="buy-with-presents__present-name js-dotdotdot"><?=$arItem['NAME']?></div>
								</div><?
							}
							
							?>
							</div>	
					</div>
				<? endif; ?>
				<?	
				show_phone ($arResult, 'Заказать');		
				
			} elseif ($arParams['MODE'] == 'CALC') {
				if ($arResult['DISPLAY_PROPERTIES']['CALC_4']['LINK_ELEMENT_VALUE']) {
					$tabs_count = 4;
				} elseif ($arResult['DISPLAY_PROPERTIES']['CALC_3']['LINK_ELEMENT_VALUE']) {
					$tabs_count = 3;
				} elseif ($arResult['DISPLAY_PROPERTIES']['CALC_2']['LINK_ELEMENT_VALUE']) {
					$tabs_count = 2;
				} elseif ($arResult['DISPLAY_PROPERTIES']['CALC_1']['LINK_ELEMENT_VALUE']) {
					$tabs_count = 1;
				}
				?>
				<div class="popup popup-calc-price"><!--попап (рассчитать цену) навесное оборудование-->
					<div class="popup__body">
						<? show_popup_header($arResult, 'Расчет цены', $tabs_count + 1); // 6192?>
						

						<div class="popup-calc-price__middle">
							<div class="tab-content">
								<? show_calc($arResult, 1); ?>
								<? show_calc($arResult, 2); ?>
								<? show_calc($arResult, 3); ?>
								<? show_calc($arResult, 4); ?>
								
								<div role="tabpanel" class="tab-pane" id="tab<?=($tabs_count + 1)?>">
									<div class="popup__name">Ваш расчет готов!</div>
									<p>Введите номер Вашего телефона и получите расчет в течении
30 секунд. Засекайте!</p>
									<? show_phone ($arResult, 'Получить расчёт платежей', false); ?>
									<hr>
									<div class="popup__name">Ваш товар:</div>
									<p class="text-center"><?=$arResult['NAME']?></p>
									<div id="final-list" class="row">
										<? foreach ($arResult["DISPLAY_PROPERTIES"]["BIND_PODAROK"]["LINK_ELEMENT_VALUE"] as $k => $arItem) {
											?><div class="popup__col popup__col_50">
												<img> <?=$arItem['NAME']?>
											</div><?
										}
										?>
									</div>

									<hr>
									<div class="popup__name">Способ доставки:</div>
									<p class="text-center" id="delivery_result">Самовывоз (Скидка 3%)</p>
								</div>
							</div>
						</div>
						
					</div>
					<script>App.dotdotdot(".popup-calc-price");
				App.popupCalcPrice.naves(".popup-calc-price");</script></div>
				<?
			} elseif ($arParams['MODE'] == 'CREDIT') {
				$phone_display = 'display:none;';
	
				?>
				<div class="popup-credit">
					<!--попап -->
					<? show_popup_header($arResult, 'Рассрочка/кредит', $price?'price':''); ?>
	
					<!-- Tab panes -->
						
						
					<? /* TAB 1 */ ?>
					<div class="tab-content">
						<div role="tabpanel" class="tab-pane active" id="tab1">
							<div class="popup__name">Как Вы хотите купить этот товар?</div>
							<div class="radio">
							  <label>
								<input type="radio" name="CREDIT_TYPE" id="optionsRadios1" value="Кредит" checked onClick="$('#next_credit').show();$('#next_rassrochka').hide();">
								Кредит
							  </label>
							</div>
							<div class="radio">
							  <label>
								<input type="radio" name="CREDIT_TYPE" id="optionsRadios2" value="Рассрочка" onClick="$('#next_credit').hide();$('#next_rassrochka').show();">
								Рассрочка
							  </label>
							</div>						
							
							<div class="popup__tab-footer">
								<div class="buy-with-presents__flex">
									<div class="">
										Гарантия лучшей цены
									</div>
									<div class="">
										<a id="next_credit" href="#tab2" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-default">Далее</a>
										<a id="next_rassrochka" href="#tab6" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-default" style="display:none;">Далее2</a>
									</div>
								</div>
							</div>
						</div>
						
						<? if ($price) { ?>
							<? /* TAB 2 */ ?>
							<div role="tabpanel" class="tab-pane" id="tab2">
								<div class="popup__name">У нас самая низкая процентная ставка!</div>
								<p>Мы договорились с самыми крупными банками России и каждый день анализируем лучшие условия кредитов, предлагая их своим клиентам.</p>
								<p>Оставьте номер своего телефона, и наш кредитный брокер бесплатно проконсультирует Вас по лучшим кредитным продуктам и подберёт оптимальный вариант.</p>
		
								<div class="row">
									<div class="col-sm-6"><div class="input">
										<div class="input__label">
											<label for="CREDIT_TIME"><span class="hidden-phx">Выберите срок кредита:</span><span class="visible-phx">Срок кредита:</span></label>
										</div>
										<div class="input__input">
											<select name="CREDIT_TIME">
												<option value="12 месяцев" selected >12 месяцев</option>
												<option value="6 месяцев">6 месяцев</option>
												<option value="3 месяца">3 месяца</option>
											</select>
										</div>
									</div></div>
									<div class="col-sm-6"><div class="input">
										<div class="input__label">
											<label for="CREDIT_START"><span class="hidden-phx">Выберите сумму первоначального взноса:</span><span class="visible-phx">Суммуа первоначального взноса:</span></label>
										</div>
										<div class="input__input">
											<select name="CREDIT_START">
												<? show_credit_start ($price) ?>
											</select>
										</div>
									</div></div>
								
								</div>
						
		
								<div class="popup__tab-footer">
									<div class="facts__header buy-with-presents__flex">
										<div class="">
											<a id="next_credit" href="#tab1" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-btn_white">Назад</a>
										</div>
										<div class="facts-label">
											<?=show_facts_header();?>
										</div>
										<div class="">
											<a id="next_credit" href="#tab3" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-default">Далее</a>
										</div>
										
									</div>
									<?=show_facts ()?>
								
								</div>
								
							</div>
							
							
							<? /* TAB 3 */ ?>
							<div role="tabpanel" class="tab-pane" id="tab3">
								<div class="popup__name">Выберите условия кредита</div>
								<p>Мы договорились с самыми крупными банками России и каждый день анализируем лучшие условия кредитов, предлагая их своим клиентам.</p>
								<p>Оставьте номер своего телефона, и наш кредитный брокер бесплатно проконсультирует Вас по лучшим кредитным продуктам и подберёт оптимальный вариант.</p>
		
								<div class="row">
									<div class="col-sm-12">
									  <div class="checkbox">
										<label>
										  <input type="checkbox" name="CREDIT_CONDITION[]" value="Без поручителей" checked>Без поручителей
										</label>
									  </div>
									  <div class="checkbox">
										<label>
										  <input type="checkbox" name="CREDIT_CONDITION[]" value="Без справок">Без справок
										</label>
									  </div>
									  <div class="checkbox">
										<label>
										  <input type="checkbox" name="CREDIT_CONDITION[]" value="Досрочное погашение без штрафов">Досрочное погашение без штрафов
										</label>
									  </div>
									</div>
								</div>
								
								<div class="popup__tab-footer">
									<div class="facts__header buy-with-presents__flex">
										<div class="">
											<a id="next_credit" href="#tab2" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-btn_white">Назад</a>
										</div>
										<div class="facts-label">
											<?=show_facts_header();?>
										</div>
										<div class="">
											<a id="next_credit" href="#tab4" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-default">Далее</a>
										</div>
										
									</div>
									<?=show_facts ();?>
								
								</div>
							</div>
							
							<? /* TAB 4 */ ?>
							<div role="tabpanel" class="tab-pane" id="tab4">
								<div class="popup__name">Введите номер телефона и бесплатно получите<br> рассчёты платежей от самых крупных банков России.</div>
								<? show_phone ($arResult, 'Получить расчёт платежей', false); ?>
								<div class="popup__tab-footer">
									<div class="facts__header buy-with-presents__flex">
										<div class="">
											<a id="next_credit" href="#tab3" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-btn_white">Назад</a>
										</div>
										<div class="facts-label">
											<?=show_facts_header();?>
										</div>
									</div>
									<?=show_facts ()?>
								
								</div>
							
							</div>	<?						
						} else { ?>
							<? /* TAB 2 (NO PRICE) */ ?>
							<div role="tabpanel" class="tab-pane" id="tab2">
								<div class="popup__name">У нас самая низкая процентная ставка!</div>
								<p>Мы договорились с самыми крупными банками России и каждый день анализируем лучшие условия кредитов, предлагая их своим клиентам.</p>
								<p>Оставьте номер своего телефона, и наш кредитный брокер бесплатно проконсультирует Вас по лучшим кредитным продуктам и подберёт оптимальный вариант.</p>
	
								<? show_phone ($arResult, 'Заказать бесплатную консультацию', false); ?>
								
								<div class="popup__tab-footer">
									<div class="facts__header buy-with-presents__flex">
										<div class="">
											<a href="#tab1" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-btn_white">Назад</a>
										</div>
										<div class="facts-label">
											<?=show_facts_header();?>
										</div>
									</div>
									<?=show_facts ()?>
								
								</div>
							
							</div>
						<? } ?>
						
						<? /* TAB 6 */ ?>
						<div role="tabpanel" class="tab-pane" id="tab6">
							<div class="popup__name">Оформите честную рассрочку!</div>
							<p>Мы договорились с самыми крупными банками России и каждый день анализируем лучшие условия кредитов, предлагая их своим клиентам.</p>
							<div class="row">
								<div class="col-md-4">
									<div class="rass_big"><?=SaleFormatCurrency(0, 'RUB')?></div>
									<div class="rass_small">Первый взнос</div>
								</div>
								<div class="col-md-4">
									<div class="rass_big">0%</div>
									<div class="rass_small">Переплата</div>
								</div>
								<div class="col-md-4">
									<div class="rass_big">12</div>
									<div class="rass_small">12 месяцев рассрочки</div>
								</div>
							
							</div>
							<p>Оставьте номер своего телефона, и наш специалист бесплатно расскажет Вам<br> всё о товаре и оформлении его в рассрочку.</p>

							<? show_phone ($arResult, 'Заказать бесплатную консультацию'); ?>
							
							<!--<div class="popup__tab-footer">
								<div class="facts__header buy-with-presents__flex">
									<div class="">
										<a href="#tab1" aria-controls="home" role="tab" data-toggle="tab" class="btn btn-btn_white">Назад</a>
									</div>
								</div>
							
							</div>-->
						
						</div>
					</div>
				</div>
				<?			
			}
			?>

		</form>
	</div>
<script>App.dotdotdot(".buy-with-presents");
App.mask.phone.init(".buy-with-presents");
function add_raschet_item (code, id, name, multy, is_checked) {
	if (!multy) {
		$('#final-list .'+code).remove();
	} else if (!is_checked) {
		$('#final-list .el-'+id).remove();
	}
	if (is_checked) {
		$('#final-list').append('<div class="popup__col popup__col_50 '+code+' el-'+id+'">'+name+'</div>');
		// <div class="popup__col popup__col_50">
	}
	
	// 'SEC_<?=$code?>', '<?=$arProp['ID']?>', '<?=$arProp['NAME']?>', false
}
function show_address(text) {
	if ($('#RASCHET_DELIVERY').prop('checked')) {
		$('#delivery_address').show();
	} else {
		$('#delivery_address').hide();
	}
	$('#delivery_result').html(text);
}
</script>
</div>

