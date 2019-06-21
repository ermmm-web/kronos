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

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';	*/		

?>

<div class="<?=$arParams['ADD_CLASS']?> swiper-container js-swiper">
	<div class="swiper-wrapper">
		<? foreach($arResult["DISPLAY_PROPERTIES"]["UF_SHOP_PHOTO"]["FILE_VALUE"] as $k => $arPhoto):?>
			
			<div class="swiper-slide">
				<a class="popup-modal-ajax" href="/popup/shop/" title="" style="background-image: url(<?=$arPhoto["SRC"]?>)" data-mfp-mainClass="popup_gallery">
					<svg class="lupa">
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-lupa"></use>
					</svg>
					<div class="footer__bottom-slider-info">
						<div class="footer__bottom-slider-shop"><?=$arResult["DISPLAY_PROPERTIES"]['UF_SHOP_CITY']['VALUE']?></div>
						<div class="footer__bottom-slider-name">Вид торгового зала</div>
						<div class="footer__bottom-slider-pagination">Фотография <?=($k+1)?> из <?=sizeof($arResult["DISPLAY_PROPERTIES"]["UF_SHOP_PHOTO"]["FILE_VALUE"])?></div>
					</div>
				</a>
			</div>
		<?endforeach;?>
	</div>
	<div class="swiper-pagination-kronos"></div>
	<div class="swiper-button-prev-kronos swiper-button-prev-kronos_gray point-animation">
		<svg>
			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
		</svg>
	</div>
	<div class="swiper-button-next-kronos swiper-button-next-kronos_gray point-animation">
		<svg>
			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
		</svg>
	</div>
</div>





