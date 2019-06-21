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

?>

<div class="menu-mob-popup-shop__name">Наш склад-магазин:</div>
<div class="menu-mob-popup-shop__city"><?=$arResult["DISPLAY_PROPERTIES"]['UF_SHOP_CITY']['VALUE']?></div>
<div class="menu-mob-popup-shop__desc">
	<p><?=$arResult["DISPLAY_PROPERTIES"]['UF_SHOP_ADDRESS']['~VALUE']['TEXT']?></p>
	<p><?=$arResult["DISPLAY_PROPERTIES"]['UF_SHOP_WORKING']['~VALUE']['TEXT']?></p>
</div>
<div class="menu-mob-popup-shop__map"><a class="dot-link-lines" href="#"><span class="dot-link-lines__name">Карта проезда</span></a></div>
<div class="menu-mob-popup-shop__gallery js-swiper-root">
	<div class="menu-mob-popup-shop__swiper swiper-container js-swiper">
		<div class="swiper-wrapper">
			<?foreach($arResult["DISPLAY_PROPERTIES"]["UF_SHOP_PHOTO"]["FILE_VALUE"] as $arPhoto):?>
				<div class="swiper-slide">
					<a class="menu-mob-popup-shop__gallery-item" href="#" title="" style="background-image: url(<?=$arPhoto["SRC"]?>);">
						<svg class="lupa">
							<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-lupa"></use>
						</svg>
						<div class="menu-mob-popup-shop__gallery-item-desc">
							<div class="menu-mob-popup-shop__gallery-item-name">Магазин «<?=$arResult["NAME"]?>»</div>
							<div class="menu-mob-popup-shop__gallery-item-type">Вид торгового зала</div>
						</div>
					</a>
				</div>
			<?endforeach;?>
		</div>
	</div>
	<div class="swiper-button-prev-kronos swiper-button-prev-kronos_mob">
		<svg>
			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
		</svg>
	</div>
	<div class="swiper-button-next-kronos swiper-button-next-kronos_mob">
		<svg>
			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
		</svg>
	</div>
	<div class="swiper-pagination swiper-pagination-kronos"></div>
</div>



