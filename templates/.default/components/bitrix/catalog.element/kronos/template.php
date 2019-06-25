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

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';*/			

$oView = new \Francysk\Framework\View\Card($arResult);

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult['SECTION']);		
echo '</pre>';	*/		

?>

<!-- kidys css block start / 18.06-25.06 -->
<style type="text/css">
    .detail__top-kidys {display: none}
    .detail__top {display: block}

    .tooltipster-sidetip.tooltipster-kronos .tooltipster-content {
        font-size: 14px;
    }

    @media all and (min-width: 960px) {
        .detail__top {display: none}
        .detail__top-kidys {display: block}
        .container {width: 1280px;max-width: 1280px;padding: 0 32px;margin-left: auto;margin-right: auto}
        .detail__title-kidys h1 {font-size: 20px;line-height: 24px;letter-spacing: .36px;margin-bottom: 26px}
        .detail__row-kidys {margin-bottom: 21px;display: flex;justify-content: space-between;align-items: flex-start} .detail__row-kidys * {font-size: 12px!important;line-height: 14px!important;letter-spacing: .48px!important}
        .col-kidys:nth-child(1) {width: 448px;margin-right: 32px}
        .col-kidys:nth-child(2) {display: flex;justify-content: space-between;align-items: flex-start;width: calc(768px - 32px)}
        .detail__row-kidys_info-top {align-items: center}
        .detail__row-kidys_info-bottom {}
        .col__child-kidys:nth-child(1) {width: 479px;margin-right: 28px}
        .col__child-kidys:nth-child(2) {width: 256px}
        .detail__row-kidys_info-top .col__child-kidys:nth-child(1) {width: auto}
        .col-kidys_info1 ul {margin: 0;list-style: none;padding: 0;display: flex;align-items: center;justify-content: flex-start}
        .col-kidys_info1 .status {display: flex;align-items: center;padding: 0}
        .col-kidys_info1 .status:before {width: 10px;height: 10px;position: static;margin-right: 8px}
        .col-kidys_info1 li.kidys-text {display: flex;align-items: center}
        .col-kidys_info1 li.kidys-text:before {content: '';display: inline-block;line-height: inherit;margin: 0 12px;border-right: 1px dotted #999;width: 1px;height: 15px}
        .detail__row-kidys_info-top .col__child-kidys_info3 {display: flex;justify-content: flex-end;align-items: center}
        .detail__row-kidys_info-top .col-kidys:nth-child(2) {align-items: center}
        .detail__row-kidys_info-top .col__child-kidys_info2 ul {margin: 0;padding: 0;list-style: none;display: flex;justify-content: flex-start;align-items: center}
        .detail__row-kidys_info-top .col__child-kidys_info2 ul li {display: flex;align-items: center;margin-right: 16px}
        .detail__row-kidys_info-top .col__child-kidys_info2 ul li a {display: flex;align-items: center}
        .detail__row-kidys_info-top .col__child-kidys_info2 ul li:last-child {margin-right: 0}
        .detail__row-kidys_info-top .col__child-kidys_info2 img {width: auto;height: 18px;margin-right: 6px}
        .detail-banner__item_kidys {background-color: #eee;height: 335px}
        .detail__row-kidys_info-bottom .col-kidys:nth-child(2) .swiper-wrapper {overflow: hidden}
        .detail-banner__item_kidys span {font-size: 48px!important;line-height: 58px!important;letter-spacing: .32px!important;color: #dcdcdc}
        .detail__row-kidys_info-bottom .gallery {overflow: hidden;position: relative}
        .detail-gallery__item_kidys {height: 252px}

        .detail__row-kidys_info-bottom .gallery .swiper-button-prev-kronos, .detail__row-kidys_info-bottom .gallery .swiper-button-next-kronos {width: 22px;height: 24px;display: flex;justify-content: center;align-items: center;text-align: center} 
        .detail__row-kidys_info-bottom .gallery .swiper-button-prev-kronos {right: 22px }
        .detail__row-kidys_info-bottom .gallery .swiper-button-prev-kronos svg, .detail__row-kidys_info-bottom .gallery .swiper-button-next-kronos svg {position: static;margin: 0;width: 5px;height: 8px}
        .detail-gallery-thumbs {margin-top: 20px}
        .detail-gallery-thumbs .swiper-wrapper {margin-left: -168px}
        .detail-gallery-thumbs .swiper-wrapper .swiper-slide {width: 112px!important;height: 63px!important}
        .detail-gallery-thumbs__item a {height: 63px!important}
        .detail-gallery__item_kidys img {width: 100%}
        .detail__row-kidys_info-bottom .col-kidys:nth-child(2) .col__child-kidys:nth-child(1) {display: flex;justify-content: space-between}
        .sert-kidys, .detail__sert {max-height: 335px;overflow: hidden;width: 145px}
        .detail-sert {height: 335px;overflow: hidden}
        .sert-kidys .detail__sert {width: 72px;margin-left: 34px}
        .sert-kidys .detail__sert .swiper-slide, .sert-kidys .detail__sert .swiper-slide img {height: 104px!important}

        .detail__row-kidys_info-bottom .sert-kidys .swiper-button-prev-kronos, .detail__row-kidys_info-bottom .sert-kidys .swiper-button-next-kronos {width: 20px;height: 20px;display: flex;justify-content: center;align-items: center;text-align: center} 
        .detail__row-kidys_info-bottom .sert-kidys .swiper-button-prev-kronos {right: 20px }
        .detail__row-kidys_info-bottom .sert-kidys .swiper-button-prev-kronos svg, .detail__row-kidys_info-bottom .sert-kidys .swiper-button-next-kronos svg {position: static;margin: 0;width: 5px;height: 8px}

        .description-kidys .detail__triggers {margin: 0}
        .detail__block-top {margin-bottom: 8px}
        .detail__block-top .swiper-wrapper {overflow: visible!important}
        .detail-triggers__item-name {font-size: 14px!important;line-height: 17px!important;letter-spacing: .4px!important}
        .detail__block-bottom .detail__action {margin-bottom: 7px}
        .detail__block-bottom .detail-action {display: flex;align-items: center;justify-content: space-between}
        .detail-action .detail-action__text {padding: 0}
        .detail-action .detail-action__date {margin: 0;flex-grow: 2;display: flex;justify-content: center}
        .detail-action .detail-action__date ul {display: flex;align-items: flex-start;justify-content: space-around;margin: 0 10px;width: 75%}
        .detail-action .detail-action__date ul .js-countUpDeadline {font-size: 21px!important;line-height: 25px!important;letter-spacing: .4px!important}
        .detail__block-bottom .detail-action .detail-action__dot {margin-top: 11px!important}
        .detail-action__date ul li span + span {font-size: 10px!important;line-height: 12px!important}
        .detail__price {margin: 45px 0 20px 0}
        .banner-product-open__price .price {color: #FF6600}
        .banner-product-open__price .price.price_normal {font-family: Lato;font-style: normal;font-weight: normal;font-size: 21px!important;line-height: 25px!important;display: flex;align-items: center;letter-spacing: 0.36px!important;color: #000000}        
        .banner-product-open__price .price.price_old {font-family: Lato;font-style: normal;font-weight: normal;font-size: 14px!important;line-height: 17px!important;display: flex;align-items: center;letter-spacing: 0.4px!important;text-decoration-line: line-through;color: #999999}
        .banner-product-open__price.banner-product-open__price_old {display: flex;align-items: flex-end}.banner-product-open__price.banner-product-open__price_old > * {margin-bottom: 0;margin-top: 0}
        .detail__price .product-item-detail-price-current {font-size: 21px!important;line-height: 25px!important;letter-spacing: .36px!important}
        .detail__buttons {margin-top: 7px;display: flex;align-items: center;justify-content: space-between}
        .detail__buttons a:not(:last-of-type) {margin-right: 12px}
        .detail__buttons a[title="Рассрочка/кредит"] {background-color: #FF6600;color: white;text-align: center}
        .detail__buttons a[title="Рассрочка/кредит"] .dot-link-one-line__name:after {display: none}
        .detail__links .border-dot-list li {padding-right: 12px}
        .detail__links .border-dot-list li:last-child {padding-right: 0;padding-left: 12px}

    }
</style>

<script type="text/javascript">
    $(function() {$('.detail__buttons a[title="Рассрочка/кредит"]').toggleClass('btn btn_min');$('.detail-sert .swiper-wrapper .swiper-slide').css('height', '104px', true)})
</script>
<!-- kidys css block end / 18.06-25.06 -->

<div class="detail">

	<!-- kidys html block start / 18.06-25.06 -->
  <div class="detail__top-kidys">
        <div class="detail__title-kidys">
            <h1><?=$arResult['NAME']?></h1>
        </div>
        <div class="detail__row-kidys detail__row-kidys_info-top">
            <div class="col-kidys col-kidys_info1">
                <ul>
                    <li><?= $oView->getStatus(); ?></li>
                    <li class="kidys-text"><? KRONOS_CATALOG::show_allready_buy ($arResult); ?></li>
                </ul>
            </div>
            <div class="col-kidys">
                <div class="col__child-kidys col__child-kidys_info2">
                    <ul>
                    <? if( $arResult["PODAROK_COUNT"] > 0 ): ?>
                        <li class="percent">
                            <a href="/popup/presents/?id=<?= $arResult["ID"];?>" class="popup-modal-ajax" title="Подарки">
                                <img src="/local/frontend/build/img/svg/percent.svg" alt="Подарки" title="Подарки" />
                                <span><?= $arResult["PODAROK_COUNT"]; ?> <?= Francysk\Framework\Tools\TextDecline::getWordNum($iCountPodarki, ['подарок', 'подарка', 'подарков'])?></span>
                            </a>
                        </li>
                    <? endif; ?>
                    <? foreach ($arResult["DISPLAY_PROPERTIES"]["BONUS"]["LINK_ELEMENT_VALUE"] as $aBonus): ?>
                        <li class="<?= $aBonus["CODE"]; ?>">
                            <img src="<?= $aBonus["ICON"]["SRC"]; ?>" alt="<?= $aBonus["NAME"]; ?>" titile="<?= $aBonus["NAME"]; ?>" />
                            <span><?= $aBonus["NAME"]; ?></span>                                    
                        </li>
                    <? endforeach; ?>
                    </ul>
                </div>
                <div class="col__child-kidys col__child-kidys_info3">
                    <?=KRONOS_CATALOG::show_brand($arResult); ?>
                </div>
            </div>
        </div>
        <div class="detail__row-kidys detail__row-kidys_info-bottom">
            <div class="col-kidys">
                <div class="gallery">
                    <div class="detail__gallery">
                        <div class="detail-gallery swiper-container">
                            <div class="swiper-wrapper">                             
                            <? foreach ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"] as $key => $arPhoto): ?>
                                <div class="swiper-slide">
                                    <div class="swiper-lazy-preloader"></div>
                                    <? if ($arPhoto["YOUTUBE"]): ?>
                                        <div class="detail-gallery__item detail-gallery__item_kidys">
                                            <a class="detail-gallery__item popup-youtube" href="<?= $arPhoto["YOUTUBE"] ?>" style="background-image: url(<? /*= $arPhoto['FULL']["SRC"];*/ ?>);">
                                                <img class="swiper-lazy"  data-src="<?=$arPhoto["PREVIEW"]["src"]; ?>" alt="<?= $arResult["NAME"]; ?>" title="<?= $arResult["NAME"]; ?>">
                                                <svg class="detail-gallery-thumbs__play">
                                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-youtube-fill"></use>
                                                </svg>
                                            </a>
                                        </div>
                                    <? else: ?>
                                        <div class="detail-gallery__item detail-gallery__item_kidys">
                                            <img class="swiper-lazy cloudzoom-image" data-cloudzoom="zoomImage:'<?= $arPhoto["FULL"]["SRC"]; ?>'" data-src="<?= $arPhoto["PREVIEW"]["src"]; ?>" alt="<?= $arResult["NAME"]; ?>" >
                                        </div>
                                    <? endif; ?>
                                </div>
                            <? endforeach; ?>
                                <div class="swiper-slide">
                                    <a class="detail-gallery__item detail-gallery__item_kidys detail-gallery__item-link popup-modal-ajax" href="popup/popup-free-call.html" title="Закажите бесплатный звонок">
                                        <div>
                                            <img src="/local/frontend/build/img/image3.png" alt="">
                                            <div class="detail-gallery__item-link-text"><span>Закажите бесплатный звонок</span></div>
                                        </div>
                                        <svg class="lupa">
                                            <use xlink:href="img/sprite-custom.svg#svg-icon-lupa"></use>
                                        </svg>
                                    </a>
                                </div>
                                <div class="swiper-slide">
                                    <a class="detail-gallery__item detail-gallery__item_kidys detail-gallery__item-link" href="#" title="Задайте вопрос">
                                        <div>
                                            <img src="/local/frontend/build/img/image2.png" alt="">
                                            <div class="detail-gallery__item-link-text"><span>Задайте вопрос</span></div>
                                        </div>
                                        <svg class="lupa">
                                            <use xlink:href="img/sprite-custom.svg#svg-icon-lupa"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="swiper-button-prev-kronos point-animation">
                                <svg>
                                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
                                </svg>
                            </div>
                            <div class="swiper-button-next-kronos point-animation">
                                <svg> 
                                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="detail-gallery-thumbs swiper-container">
                    <div class="swiper-wrapper">
                    <? foreach ($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"] as $key => $arPhoto): ?>
                        <div class="swiper-slide">
                            <? if ($arPhoto["YOUTUBE"]): ?>
                                <div class="detail-gallery-thumbs__item">
                                    <a style="background-image: url(<?= $arPhoto['THUMBNAIL']["src"];?>);">
                                        <svg class="detail-gallery-thumbs__play">
                                        <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-youtube-fill"></use>
                                        </svg>
                                    </a>
                                </div>
                            <? else: ?>
                                <div class="swiper-lazy-preloader"></div>
                                <div class="detail-gallery-thumbs__item">
                                    <a><img class="swiper-lazy" data-src="<?= $arPhoto['THUMBNAIL']["src"]; ?>" alt="<?= $arResult["NAME"]; ?>" title="<?= $arResult["NAME"]; ?>"></a>
                                </div>
                            <? endif; ?>                                        
                        </div>
                    <? endforeach; ?>
                        <div class="swiper-slide">
                            <div class="detail-gallery-thumbs__item"><a style="background-image: url(/local/frontend/build/img/image4.jpg);"></a></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="detail-gallery-thumbs__item"><a style="background-image: url(/local/frontend/build/img/image5.jpg);"></a></div>
                        </div>
                    </div>
                </div>
                <div class="detail-gallery-pagination">
                    Фото <span class="detail-gallery-pagination__active">2 </span> из <span class="detail-gallery-pagination__count">34</span>
                </div>
            </div>
            <div class="col-kidys">
                <div class="col__child-kidys">
                    <div class="description-kidys">
                        <div class="detail__block detail__block flex-column-reverse_tb">
                        <div class="detail__block-top">
                            <div class="detail__triggers detail__triggers-desktop">
                                <div class="detail-triggers detail-triggers_scroll detail-triggers_scroll_05 swiper-container detail-triggers_v swiper-container-vertical swiper-container-autoheight js-swiper">
                                
                                    <div class="swiper-wrapper">
                                        <? foreach ($arResult["PROPERTIES"]["TRIGGERS"]["VALUE"] as $pid): ?>
                                            <? $aTrigger = \Francysk\Framework\Objects\Triggers::getInstance()->get($pid);
                                             ?>
                                            <div class="swiper-slide">
                                                <div class="detail-triggers__item js-tooltip" data-position-x="left;+12" title="<?= $aTrigger["PREVIEW_TEXT"]; ?>">
                                                    <div class="detail-triggers__item-img"><img class="detail-triggers__item-img-normal" src="<?= $aTrigger["PREVIEW_PICTURE_SRC"]; ?>" alt="<?= $aTrigger["NAME"]; ?>"><img class="detail-triggers__item-img-hover" src="<?= $aTrigger["PREVIEW_PICTURE_SRC"]; ?>" alt="<?= $aTrigger["NAME"]; ?>"></div>
                                                    <div class="detail-triggers__item-name js-tooltip-target js-tooltip-item" ><?= $aTrigger["NAME"]; ?></div>
                                                </div>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                    <div class="swiper-scrollbar swiper-scrollbar_style-1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="detail__block-bottom">
                            <div class="detail__action">
                                <? if (!empty($arResult["PROPERTIES"]["DEADLINE"]["VALUE"]) && time() < strtotime($arResult["PROPERTIES"]["DEADLINE"]["VALUE"]) ): ?>
                                    <div class="detail-action">
                                        <div class="detail-action__text">
                                            До окончания акции<br>&#171;+<?=$iCountPodarki;?> <?= Francysk\Framework\Tools\TextDecline::getWordNum($iCountPodarki, ['подарок', 'подарка', 'подарков'])?>&#187; осталось
                                        </div>
                                        <div class="detail-action__date">
                                            <ul>
                                                <?
                                                    $dTime = strtotime($arResult["PROPERTIES"]["DEADLINE"]["VALUE"]);
                                                    $dDay = date("d", $dTime);
                                                    $dHour = date("H", $dTime);
                                                    $dMin = date("m", $dTime);
                                                    $dSec = date("s", $dTime);
                                                ?>
                                                <li><span class="js-countUpDeadline" data-start="0" data-end="<?= $dDay; ?>"><?= $dDay; ?></span><span>Д</span></li>
                                                <li class="detail-action__dot"></li>
                                                <li><span class="js-countUpDeadline" data-start="0" data-end="<?= $dHour; ?>"><?= $dHour?></span><span>Ч</span></li>
                                                <li class="detail-action__dot"></li>
                                                <li><span class="js-countUpDeadline" data-start="0" data-end="<?= $dMin; ?>"><?= $dMin?></span><span>М</span></li>
                                                <li class="detail-action__dot"></li>
                                                <li><span class="js-countUpDeadline" data-start="0" data-end="<?= $dSec; ?>"><?= $dSec?></span><span>С</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                <? endif; ?>
                            </div>
                            <div class="detail__price">
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
                            <div class="detail__buttons">
                                <?=KRONOS_CATALOG::show_buttons_sub ($arResult); ?>
                                <!--a.btn.btn_green.btn_size21(href="#", title="") Рассчитать цену-->
                                <!--a.btn.btn_size21(href="#", title="") Рассрочка/кредит-->
                                <!--a.btn.btn_green.btn_size21(href="#", title="") Расчёт цены-->
                                <!--a.btn.btn_size21(href="#", title="") Рассрочка/креди
                                <a class="btn btn_green btn_size21 popup-modal-ajax" href="/popup/popup-buy/?ELEMENT_ID=<?= $arResult["ID"];?>&MODE=BUY" title="">Купить</a>
                                <a class="btn btn_size21 popup-modal-ajax" href="/popup/popup-buy/?ELEMENT_ID=<?= $arResult["ID"];?>&MODE=CREDIT" title="" >Рассрочка/кредит</a>т-->
                                <!--<a class="btn btn_size21 popup-modal-ajax" href="/popup/popup-thanks/" title="" >Подписка</a>-->
                                
                            </div>
                            <div class="detail__links">
                                <ul class="border-dot-list">
                                    <li><a class="dot-link-one-line dot-link-one-line_wrap-mobile popup-modal-ajax" href="/popup/look-discount/"><span class="dot-link-one-line__name">Сообщить о снижении цены</span><span class="dot-link-one-line__mob"> (Следят <?= $arResult["PROPERITES"]["COUNT_LOOK"]["VALUE"];?> человек)</span></a></li>
                                    <li><a class="dot-link-one-line dot-link-one-line_wrap-mobile  popup-modal-ajax" href="/popup/founded-cheaper/"><span class="dot-link-one-line__name">Нашли дешевле?</span></a></li>

                                </ul>
                            </div>
                            <div class="detail__views">
                                <?if( $arResult["PROPERTIES"]["COUNT_LOOK"]["VALUE"] >  0 ):?>
                                    Следят <?= $arResult["PROPERTIES"]["COUNT_LOOK"]["VALUE"];?> человек
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                    </div>
                    <div class="sert-kidys">
                        <div class="detail__sert">
                            <div class="detail-sert swiper-container">
                                <div class="swiper-wrapper">
                                    <? 
                                    /*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__; 
                                    print_r($arResult['DISPLAY_PROPERTIES']["SERTIFICAT"]);     
                                    echo '</pre>';  */      
                                    foreach ($arResult['DISPLAY_PROPERTIES']["SERTIFICAT"]["LINK_ELEMENT_VALUE"] as $arItem): ?>
                                        <div class="swiper-slide">
                                            <div class="detail-sert__item">
                                                <a href="<?= $arItem['PREVIEW_PICTURE']['SRC']; ?>" title="<?= $arItem["NAME"]; ?>">
                                                    <svg class="lupa">
                                                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-lupa"></use>
                                                    </svg>
                                                    <span class="detail-sert__text"><?= $arItem["NAME"]; ?></span>
                                                    <img src="<?= $arItem['PREVIEW_PICTURE_SMALL']['src']?>" title="<?= $arItem["NAME"]; ?>" alt="<?= $arItem["NAME"]; ?>" />
                                                </a>
                                            </div>
                                        </div>
                                    <? endforeach; ?>                                
                                </div>
                                <div class="swiper-button-prev-kronos point-animation">
                                    <svg>
                                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-down"></use>
                                    </svg>
                                </div>
                                <div class="swiper-button-next-kronos point-animation">
                                    <svg>
                                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-up"></use>
                                    </svg>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="col__child-kidys">
                    <div class="swiper-wrapper">
                        <div class="swiper-slide">
                            <div class="detail-banner__item detail-banner__item_kidys empty"> <span>Баннер</span></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="detail-banner__item detail-banner__item_kidys empty"> <span>Баннер</span></div>
                        </div>
                        <div class="swiper-slide">
                            <div class="detail-banner__item detail-banner__item_kidys empty"> <span>Баннер</span></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
	<!-- kidys html block end / 18.06-25.06 -->

    <div class="detail__bottom">
        <div class="container-fluid">
            <div class="detail__row detail__row-opt">
                <div class="detail-products-brend-and-share">
					<?=KRONOS_CATALOG::show_brand($arResult); ?>
                    <!--<a class="detail-products-brend-and-share__brend dot-link-one-line" href="#" title="Все товары бренда &amp;#171;Кентавр&amp;#187;">
                        <span class="dot-link-one-line__name">Все товары бренда &#171;Кентавр&#187;</span>
                    </a>-->
                    <a class="detail-products-brend-and-share__share dot-link-one-line" href="#" title="Поделиться">
                        <img src="/local/frontend/build/img/svg/share.svg" alt="">
                        <span class="dot-link-one-line__name">Поделиться</span>
                    </a>
                </div>
                <div class="detail__tabs">
                    <div class="tabs"><?
						$class = 'active';
						if ($arResult['DISPLAY_PROPERTIES']['DESCRIPTIONS']['LINK_ELEMENT_VALUE']) {
							?><a class="<?=$class?> js-tab" href="#description" title="Описание">Описание</a><?
							$class = '';
						} ?>
                        <a class="<?=$class?> js-tab" href="#ch" title="">Характеристики</a><?
						$class = '';
						
						if ($arResult['DISPLAY_PROPERTIES']['COMPLECT2']['LINK_ELEMENT_VALUE']) {
							?><a class="<?=$class?> js-tab" href="#comp" title="">Комплектация</a><?
						}
						if ($arResult["REVIEWS_COUNT"]) {
							?><a class="js-tab" href="#review" title="">Отзывы<span class="anim-destination"><span data-hover="<?=$arResult["REVIEWS_COUNT"]?>"><?=$arResult["REVIEWS_COUNT"]?></span></span></a><?
						}
						if ($arResult["NAVES_COUNT"]) {
							?><a class="js-tab" href="#naves" title="">Навесное оборудование<span class="anim-destination"><span data-hover="<?=$arResult["NAVES_COUNT"]?>"><?=$arResult["NAVES_COUNT"]?></span></span></a><?
						}
						if ($arResult["VIDEOS_COUNT"]) {
							?><a class="js-tab" href="#video" title="">Видео<span class="anim-destination"><span data-hover="<?=$arResult["VIDEOS_COUNT"]?>"><?=$arResult["VIDEOS_COUNT"]?></span></span></a><?
						}
						if ($arResult["NAVES_COUNT"]) {
							?><a class="d-dt2x-none d-tbx-block js-tab" href="#certificates" title="">Сертификаты<span class="anim-destination"><span data-hover="12"> 12</span></span></a><?
						}
                    ?></div>
                </div>
                <div class="detail__opt">
                    <a class="dot-link-one-line" href="#" title="">
                        <img src="/local/frontend/build/img/svg/opt.svg" alt=""><span class="dot-link-one-line__name">Купить оптом</span>
                    </a>
                </div>
            </div>
            <div class="detail__tabs-container">
                <div class="tabs-container">
                    <div class="tabs-container__inner">
                        <div class="tabs-container-head">
                            <div class="tabs-container-head__text js-close-tab">Назад</div>
                            <div class="tabs-container-head__close js-close-tab"></div>
                        </div>
						
						
						<!-- DESCRIPTION --><?
						if ($arResult['DISPLAY_PROPERTIES']['DESCRIPTIONS']['LINK_ELEMENT_VALUE']) {
							?>
							<div class="tab-container active js-tab-container" id="description">
								<div class="detail-bg detail-bg_2" style="background-image: url(/local/frontend/build/img/image6.png)"></div>
								<div class="detail-content">
									<div class="detail-desc">
										<div class="detail-tab-name">Описание</div>
										<div class="desc">
											<div class="desc__inner"><?
												$count = 0;
												foreach ($arResult['DISPLAY_PROPERTIES']['DESCRIPTIONS']['LINK_ELEMENT_VALUE'] as $k => $v) {
	/*echo '<pre>$v = '.__FILE__.' LINE: '.__LINE__;	
	print_r($v);		
	echo '</pre>';	*/		
													
													?>
													<div class="desc__item desc__item_25 <?=$k?>">
														<div class="desc-item"><?
															if ($v['NAME'] != 'NO TITLE') {
																?><div class="desc-item__name">
																	 <?=$v['NAME']?>
																</div><?
															}
															
															if ($v['PREVIEW_TEXT']) {
																?><div class="desc-item__text"><?=$v['PREVIEW_TEXT']?></div><?
															}
															if ($v['PREVIEW_PICTURE_SMALL']) {
																?><div class="desc-item__img" style="background-image: url('<?=$v['PREVIEW_PICTURE_SMALL']['src']?>');padding-top:56.97115384615385%;"></div><?
																
															}
															if ($v['YOUTUBE']) {
																?><div class="desc-item__img">
																	 <iframe width="411" height="256" src="<?=$v['YOUTUBE']?>" frameborder="0" allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>
																</div><?															
															}
															if ($v['MORE_PHOTO']) {
																?><div class="desc__item">
																	<div class="desc-item__slider js-swiper-root">
																		<div class="swiper-container desc-item-slider js-swiper swiper-container-horizontal slider_init">
																			<div class="swiper-wrapper"><?
																				foreach ($v['MORE_PHOTO'] as $arMorePhoto) {
																					?><div class="swiper-slide" >
																						<!--<div class="desc-item__img" style="background-image: url(<?=$arMorePhoto['src']?>);"></div>-->
																						<div class="desc-item__img"><img src="<?=$arMorePhoto['src']?>"></div>
																					</div><?
																					
																				}
																			
																			?>
																			</div>
																			<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span></div>
																		<div class="swiper-button-prev-kronos swiper-button-prev-kronos_desc point-animation swiper-button-disabled" tabindex="0" role="button" aria-label="Previous slide" aria-disabled="true"><svg>
																			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
																			</svg></div>
																		<div class="swiper-button-next-kronos swiper-button-next-kronos_desc point-animation" tabindex="0" role="button" aria-label="Next slide" aria-disabled="false"><svg>
																			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
																			</svg></div>
																		<div class="swiper-pagination swiper-pagination-kronos swiper-pagination-custom">Фото <span>1</span> из <?=sizeof($v['MORE_PHOTO'])?></div>
																	</div>
																</div><?															
															}
															?>
														</div>
													</div>												
													<?
												}
												?><div style="clear:both;"></div><?
												?><?= $arResult["DETAIL_TEXT"]; ?>
											</div>
										</div>
										<div class="detail-btn">
											<?=KRONOS_CATALOG::show_buttons_sub ($arResult); ?>
										</div>
									</div>
									<? KRONOS_CATALOG::show_have_qu (); ?>
	
								</div>
							</div>
							<?
						}
						?>
						
						
						<!-- CHARACTER -->
                        <div class="tab-container js-tab-container" id="ch">
                            <div class="detail-bg detail-bg_1" style="background-image: url(/local/frontend/build/img/image.png)"></div>
                            <div class="detail-content">
                                <div class="detail-ch">
                                    <div class="detail-tab-name detail-tab-name_padding">Характеристики</div>
                                    <?= $oView->getHtmlProps();?>                                                                                                                                             
                                </div>
								<? KRONOS_CATALOG::call_client (); ?>
								
                            </div>
                        </div>
						
						
						<!-- COMPLECT -->
                        <div class="tab-container js-tab-container" id="comp">
                            <div class="detail-bg detail-bg_2" style="background-image: url(/local/frontend/build/img/image6.png)"></div>
                            <div class="detail-content">
                                <div class="detail-comp">
									<div class="container-fluid">
										<div class="detail-tab-name">Комплектация</div>
										<div class="">
											<div class="row">
											<?
											foreach ($arResult['DISPLAY_PROPERTIES']['COMPLECT2']['LINK_ELEMENT_VALUE'] as $v) {
												if ($v['NAME']) {
													?><div class="col-xs-12 col-sm-4 col-lg-3">
														<div class="detail-comp__item"><ul><li><?=$v['NAME']?></li></ul></div>
													</div><?
												}
											}
											?>                                        
											</div>
										</div>
									</div>
                                </div>
								<? KRONOS_CATALOG::show_have_qu (); ?>

                            </div>
                        </div>

						
						<!-- REVIEWS -->
                        <div class="tab-container js-tab-container" id="review">
                            <div class="detail-bg detail-bg_2" style="background-image: url(/local/frontend/build/img/image6.png)"></div>
                            <div class="detail-content">
                                <?
                                $APPLICATION->IncludeComponent(
                                    "francysk.custom:reviews", "", Array(
										"ELEMENT_COUNT" => "",
										"FRANCYSKFRAEMWORK_ENTITY" => "2",
										"FRANCYSKFRAEMWORK_FUNCTION_DECORATOR" => "collectSection",
										"FRANCYSKFRAEMWORK_SYSTEM" => "1",
										"GET_SECTION_BOOL" => "N",
										"IBLOCK_ID" => "1",
										"IBLOCK_TYPE" => "media",
										"SORT_FIELD_1" => "SORT",
										"SORT_FIELD_2" => "NAME",
										"SORT_VALUE_1" => "asc",
										"SORT_VALUE_2" => "",
										"CLASS" => "reviews_product",
										"PRODUCT" => $arResult['ID'],
									)
                                );
                                ?>
								
								<? KRONOS_CATALOG::show_have_qu (); ?>

                            </div>
                        </div>

						
						<!-- NAVESNOE -->
                        <div class="tab-container js-tab-container" id="naves">
                            <div class="detail-bg detail-bg_2" style="background-image: url(/local/frontend/build/img/image6.png)"></div>
                            <div class="detail-content">
                                <div class="detail-naves">
                                    <div class="detail-tab-name detail-tab-name_padding">Навесное оборудование</div>

                                    <div class="banner-block">
                                        <div class="banner-block__col banner-block__col_100">
                                            <div class="banner-products banner-products_100">
                                                <?
												$GLOBALS['arrFilter_nav'] = array(
													'ID' => $arResult["PROPERTIES"]["BIND_OBORUDOVANIE"]['VALUE']
												);

												$APPLICATION->IncludeComponent(
													"bitrix:catalog.top",
													"kronos",
													array(
														'FILTER_NAME' 	=> 'arrFilter_nav',
														'TEMPLATE' 		=> 'kronos-bonus',
														
														"IBLOCK_TYPE" => $arParams["IBLOCK_TYPE"],
														"IBLOCK_ID" => $arParams["IBLOCK_ID"],
														"ELEMENT_SORT_FIELD" => $arParams["TOP_ELEMENT_SORT_FIELD"],
														"ELEMENT_SORT_ORDER" => $arParams["TOP_ELEMENT_SORT_ORDER"],
														"ELEMENT_SORT_FIELD2" => $arParams["TOP_ELEMENT_SORT_FIELD2"],
														"ELEMENT_SORT_ORDER2" => $arParams["TOP_ELEMENT_SORT_ORDER2"],
														"SECTION_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["section"],
														"DETAIL_URL" => $arResult["FOLDER"].$arResult["URL_TEMPLATES"]["element"],
														"BASKET_URL" => $arParams["BASKET_URL"],
														"ACTION_VARIABLE" => $arParams["ACTION_VARIABLE"],
														"PRODUCT_ID_VARIABLE" => $arParams["PRODUCT_ID_VARIABLE"],
														"PRODUCT_QUANTITY_VARIABLE" => $arParams["PRODUCT_QUANTITY_VARIABLE"],
														"PRODUCT_PROPS_VARIABLE" => $arParams["PRODUCT_PROPS_VARIABLE"],
														"DISPLAY_COMPARE" => $arParams["USE_COMPARE"],
														"ELEMENT_COUNT" => $arParams["TOP_ELEMENT_COUNT"],
														"LINE_ELEMENT_COUNT" => $arParams["TOP_LINE_ELEMENT_COUNT"],
														"PROPERTY_CODE" => (isset($arParams["TOP_PROPERTY_CODE"]) ? $arParams["TOP_PROPERTY_CODE"] : []),
														"PROPERTY_CODE_MOBILE" => $arParams["TOP_PROPERTY_CODE_MOBILE"],
														"PRICE_CODE" => $arParams["~PRICE_CODE"],
														"USE_PRICE_COUNT" => $arParams["USE_PRICE_COUNT"],
														"SHOW_PRICE_COUNT" => $arParams["SHOW_PRICE_COUNT"],
														"PRICE_VAT_INCLUDE" => $arParams["PRICE_VAT_INCLUDE"],
														"PRICE_VAT_SHOW_VALUE" => $arParams["PRICE_VAT_SHOW_VALUE"],
														"USE_PRODUCT_QUANTITY" => $arParams['USE_PRODUCT_QUANTITY'],
														"ADD_PROPERTIES_TO_BASKET" => (isset($arParams["ADD_PROPERTIES_TO_BASKET"]) ? $arParams["ADD_PROPERTIES_TO_BASKET"] : ''),
														"PARTIAL_PRODUCT_PROPERTIES" => (isset($arParams["PARTIAL_PRODUCT_PROPERTIES"]) ? $arParams["PARTIAL_PRODUCT_PROPERTIES"] : ''),
														"PRODUCT_PROPERTIES" => (isset($arParams["PRODUCT_PROPERTIES"]) ? $arParams["PRODUCT_PROPERTIES"] : []),
														"CACHE_TYPE" => $arParams["CACHE_TYPE"],
														"CACHE_TIME" => $arParams["CACHE_TIME"],
														"CACHE_GROUPS" => $arParams["CACHE_GROUPS"],
														"OFFERS_CART_PROPERTIES" => (isset($arParams["OFFERS_CART_PROPERTIES"]) ? $arParams["OFFERS_CART_PROPERTIES"] : []),
														"OFFERS_FIELD_CODE" => $arParams["TOP_OFFERS_FIELD_CODE"],
														"OFFERS_PROPERTY_CODE" => (isset($arParams["TOP_OFFERS_PROPERTY_CODE"]) ? $arParams["TOP_OFFERS_PROPERTY_CODE"] : []),
														"OFFERS_SORT_FIELD" => $arParams["OFFERS_SORT_FIELD"],
														"OFFERS_SORT_ORDER" => $arParams["OFFERS_SORT_ORDER"],
														"OFFERS_SORT_FIELD2" => $arParams["OFFERS_SORT_FIELD2"],
														"OFFERS_SORT_ORDER2" => $arParams["OFFERS_SORT_ORDER2"],
														"OFFERS_LIMIT" => (isset($arParams["TOP_OFFERS_LIMIT"]) ? $arParams["TOP_OFFERS_LIMIT"] : 0),
														'CONVERT_CURRENCY' => $arParams['CONVERT_CURRENCY'],
														'CURRENCY_ID' => $arParams['CURRENCY_ID'],
														'HIDE_NOT_AVAILABLE' => $arParams['HIDE_NOT_AVAILABLE'],
														'VIEW_MODE' => (isset($arParams['TOP_VIEW_MODE']) ? $arParams['TOP_VIEW_MODE'] : ''),
														'ROTATE_TIMER' => (isset($arParams['TOP_ROTATE_TIMER']) ? $arParams['TOP_ROTATE_TIMER'] : ''),
														'TEMPLATE_THEME' => (isset($arParams['TEMPLATE_THEME']) ? $arParams['TEMPLATE_THEME'] : ''),
											
														'LABEL_PROP' => $arParams['LABEL_PROP'],
														'LABEL_PROP_MOBILE' => $arParams['LABEL_PROP_MOBILE'],
														'LABEL_PROP_POSITION' => $arParams['LABEL_PROP_POSITION'],
														'ADD_PICT_PROP' => $arParams['ADD_PICT_PROP'],
														'PRODUCT_DISPLAY_MODE' => $arParams['PRODUCT_DISPLAY_MODE'],
														'PRODUCT_BLOCKS_ORDER' => $arParams['TOP_PRODUCT_BLOCKS_ORDER'],
														'PRODUCT_ROW_VARIANTS' => $arParams['TOP_PRODUCT_ROW_VARIANTS'],
														'ENLARGE_PRODUCT' => $arParams['TOP_ENLARGE_PRODUCT'],
														'ENLARGE_PROP' => isset($arParams['TOP_ENLARGE_PROP']) ? $arParams['TOP_ENLARGE_PROP'] : '',
														'SHOW_SLIDER' => $arParams['TOP_SHOW_SLIDER'],
														'SLIDER_INTERVAL' => isset($arParams['TOP_SLIDER_INTERVAL']) ? $arParams['TOP_SLIDER_INTERVAL'] : '',
														'SLIDER_PROGRESS' => isset($arParams['TOP_SLIDER_PROGRESS']) ? $arParams['TOP_SLIDER_PROGRESS'] : '',
											
														'OFFER_ADD_PICT_PROP' => $arParams['OFFER_ADD_PICT_PROP'],
														'OFFER_TREE_PROPS' => (isset($arParams['OFFER_TREE_PROPS']) ? $arParams['OFFER_TREE_PROPS'] : []),
														'PRODUCT_SUBSCRIPTION' => $arParams['PRODUCT_SUBSCRIPTION'],
														'SHOW_DISCOUNT_PERCENT' => $arParams['SHOW_DISCOUNT_PERCENT'],
														'DISCOUNT_PERCENT_POSITION' => $arParams['DISCOUNT_PERCENT_POSITION'],
														'SHOW_OLD_PRICE' => $arParams['SHOW_OLD_PRICE'],
														'MESS_BTN_BUY' => $arParams['~MESS_BTN_BUY'],
														'MESS_BTN_ADD_TO_BASKET' => $arParams['~MESS_BTN_ADD_TO_BASKET'],
														'MESS_BTN_SUBSCRIBE' => $arParams['~MESS_BTN_SUBSCRIBE'],
														'MESS_BTN_DETAIL' => $arParams['~MESS_BTN_DETAIL'],
														'MESS_NOT_AVAILABLE' => $arParams['~MESS_NOT_AVAILABLE'],
														'ADD_TO_BASKET_ACTION' => $basketAction,
														'SHOW_CLOSE_POPUP' => isset($arParams['COMMON_SHOW_CLOSE_POPUP']) ? $arParams['COMMON_SHOW_CLOSE_POPUP'] : '',
														'COMPARE_PATH' => $arResult['FOLDER'].$arResult['URL_TEMPLATES']['compare'],
														'USE_COMPARE_LIST' => 'Y',
											
														'COMPATIBLE_MODE' => (isset($arParams['COMPATIBLE_MODE']) ? $arParams['COMPATIBLE_MODE'] : '')
													),
													$component
												);												 
												?>                                                                    
                                            </div>
                                        </div>
                                    </div>
                                </div>
								<? KRONOS_CATALOG::show_have_qu (); ?>
                            </div>
                        </div>

						
						<!-- VIDEO -->
                        <div class="tab-container js-tab-container" id="video">
                            <div class="detail-bg detail-bg_1" style="background-image: url(/local/frontend/build/img/image.png)"></div>
                            <div class="detail-content">
								<?
								$GLOBALS['arrFilter'] = array (
									'PROPERTY_PRODUCT' => $arResult['ID']
								);
								$APPLICATION->IncludeComponent("bitrix:news.list", "video", Array(
									"ACTIVE_DATE_FORMAT" => "d.m.Y",	// Формат показа даты
										"ADD_SECTIONS_CHAIN" => "N",	// Включать раздел в цепочку навигации
										"AJAX_MODE" => "N",	// Включить режим AJAX
										"AJAX_OPTION_ADDITIONAL" => "",	// Дополнительный идентификатор
										"AJAX_OPTION_HISTORY" => "N",	// Включить эмуляцию навигации браузера
										"AJAX_OPTION_JUMP" => "N",	// Включить прокрутку к началу компонента
										"AJAX_OPTION_STYLE" => "N",	// Включить подгрузку стилей
										"CACHE_FILTER" => "N",	// Кешировать при установленном фильтре
										"CACHE_GROUPS" => "N",	// Учитывать права доступа
										"CACHE_TIME" => "36000000",	// Время кеширования (сек.)
										"CACHE_TYPE" => "A",	// Тип кеширования
										"CHECK_DATES" => "Y",	// Показывать только активные на данный момент элементы
										"DETAIL_URL" => "",	// URL страницы детального просмотра (по умолчанию - из настроек инфоблока)
										"DISPLAY_BOTTOM_PAGER" => "N",	// Выводить под списком
										"DISPLAY_DATE" => "N",	// Выводить дату элемента
										"DISPLAY_NAME" => "Y",	// Выводить название элемента
										"DISPLAY_PICTURE" => "Y",	// Выводить изображение для анонса
										"DISPLAY_PREVIEW_TEXT" => "N",	// Выводить текст анонса
										"DISPLAY_TOP_PAGER" => "N",	// Выводить над списком
										"FIELD_CODE" => array(	// Поля
											0 => "NAME",
											1 => "PREVIEW_PICTURE",
											2 => "",
										),
										"FILTER_NAME" => "arrFilter",	// Фильтр
										"HIDE_LINK_WHEN_NO_DETAIL" => "N",	// Скрывать ссылку, если нет детального описания
										"IBLOCK_ID" => "7",	// Код информационного блока
										"IBLOCK_TYPE" => "spravochniki",	// Тип информационного блока (используется только для проверки)
										"INCLUDE_IBLOCK_INTO_CHAIN" => "N",	// Включать инфоблок в цепочку навигации
										"INCLUDE_SUBSECTIONS" => "N",	// Показывать элементы подразделов раздела
										"MESSAGE_404" => "",	// Сообщение для показа (по умолчанию из компонента)
										"NEWS_COUNT" => "5",	// Количество новостей на странице
										"PAGER_BASE_LINK_ENABLE" => "N",	// Включить обработку ссылок
										"PAGER_DESC_NUMBERING" => "N",	// Использовать обратную навигацию
										"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",	// Время кеширования страниц для обратной навигации
										"PAGER_SHOW_ALL" => "N",	// Показывать ссылку "Все"
										"PAGER_SHOW_ALWAYS" => "N",	// Выводить всегда
										"PAGER_TEMPLATE" => ".default",	// Шаблон постраничной навигации
										"PAGER_TITLE" => "Новости",	// Название категорий
										"PARENT_SECTION" => "",	// ID раздела
										"PARENT_SECTION_CODE" => "",	// Код раздела
										"PREVIEW_TRUNCATE_LEN" => "",	// Максимальная длина анонса для вывода (только для типа текст)
										"PROPERTY_CODE" => array(	// Свойства
											0 => "SHORT_NAME",
											1 => "NUMBER",
											2 => "TIME",
										),
										"SET_BROWSER_TITLE" => "N",	// Устанавливать заголовок окна браузера
										"SET_LAST_MODIFIED" => "N",	// Устанавливать в заголовках ответа время модификации страницы
										"SET_META_DESCRIPTION" => "N",	// Устанавливать описание страницы
										"SET_META_KEYWORDS" => "N",	// Устанавливать ключевые слова страницы
										"SET_STATUS_404" => "N",	// Устанавливать статус 404
										"SET_TITLE" => "N",	// Устанавливать заголовок страницы
										"SHOW_404" => "N",	// Показ специальной страницы
										"SORT_BY1" => "SORT",	// Поле для первой сортировки новостей
										"SORT_BY2" => "SORT",	// Поле для второй сортировки новостей
										"SORT_ORDER1" => "DESC",	// Направление для первой сортировки новостей
										"SORT_ORDER2" => "ASC",	// Направление для второй сортировки новостей
										"STRICT_SECTION_CHECK" => "N",	// Строгая проверка раздела для показа списка
										
										'SHOW_ALL' => 'Y'
									),
									false
								);?>
								
								<? KRONOS_CATALOG::call_client (); ?>
                           </div>
                        </div>
                    </div>
                </div>
            </div>


