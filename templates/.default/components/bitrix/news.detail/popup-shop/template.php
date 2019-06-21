<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
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

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';	*/		

?>


<div class="popup popup-shop"><!--попап (наши магазины)-->
    <div class="popup__body">
        <div class="popup-shop__head">
            <div class="popup-shop__nav">
                <ul class="popup-animate-left" data-delay="0.5s">
                    <li><a class="active popup-shop__icon" href="#" title="Пески-1">
                            <svg>
                                <use xlink:href="img/sprite-custom.svg#svg-icon-location"></use>
                            </svg>
                            <span><?=$arResult["DISPLAY_PROPERTIES"]['UF_SHOP_CITY']['VALUE']?></span></a></li>
                </ul>
            </div>
            <div class="popup-shop__name popup-animate-right" data-delay="0.5s">Вид торгового зала</div>
        </div>
        <div class="popup-shop__gallery js-swiper-root">
            <div class="popup-shop__gallery-slides">
                <div class="popup-shop-gallery swiper-container js-swiper">
                    <div class="swiper-wrapper">

                        <?foreach($arResult["DISPLAY_PROPERTIES"]["UF_SHOP_PHOTO"]["FILE_VALUE"] as $arPhoto):?>
                            <div class="swiper-slide" data-name="Вид торгового зала">
                                <div class="popup-shop__item" style="background-image: url(<?=$arPhoto["SRC"]?>);"></div>
                            </div>
                        <?endforeach;?>

                    </div>
                </div>
                <div class="swiper-button-prev-kronos swiper-button-prev-kronos_popup point-animation">
                    <svg>
                        <use xlink:href="/local/templates/kronos/img/sprite-custom.svg#svg-icon-left"></use>
                    </svg>
                </div>
                <div class="swiper-button-next-kronos swiper-button-next-kronos_popup point-animation">
                    <svg>
                        <use xlink:href="local/templates/kronos/img/sprite-custom.svg#svg-icon-right"></use>
                    </svg>
                </div>
            </div>
            <div class="popup-shop__pagination popup-animate-scale" data-delay="0s">
                <div class="popup-shop__name">Вид торгового зала</div>
                <div class="swiper-pagination-kronos"></div>
            </div>
        </div>
        <div class="popup-shop__foot">
            <div class="popup-shop__address">
                <ul class="popup-animate-left" data-delay="0.5s">
                    <li><?=$arResult["DISPLAY_PROPERTIES"]['UF_SHOP_ADDRESS']['~VALUE']['TEXT']?></li>
                    <li><?=$arResult["DISPLAY_PROPERTIES"]['UF_SHOP_WORKING']['~VALUE']['TEXT']?></li>
                </ul>
            </div>
            <div class="popup-shop__map popup-animate-right" data-delay="0.5s">
                <a class="dot-link-one-line" href="#" title="Карта проезда"> <span class="dot-link-one-line__name">Карта проезда</span></a></div>
        </div>
    </div>
    <script>$(function () {
            App.popupAnimate(".popup-shop");
            App.swiper('.swiper-container.js-swiper', '.popup-shop', 10);
        });</script>
</div>


