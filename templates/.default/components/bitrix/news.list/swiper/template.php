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
<div class="popup-calc-price-naves-swiper swiper-container">
	<div class="swiper-wrapper">
		<? foreach($arResult["ITEMS"] as $arItem) {
			?><div class="swiper-slide">
				<div class="popup-calc-price-naves">
					<div class="popup-calc-price-naves__img"><img src="<?=$arItem['PREVIEW_PICTURE_SMALL']['src']?>" alt=""/></div>
					<div class="popup-calc-price-naves__name d-tb-none js-dotdotdot"><?=$arItem['NAME']?></div>
					<div class="popup-calc-price-naves__name d-tb-block d-dt2x-none js-dotdotdot"><span><?=$arItem['NAME']?></span></div>
					<div class="popup-calc-price-naves__checkbox-and-gift">
						<div class="popup-calc-price-naves__checkbox">
							<div class="checkbox checkbox_big checkbox_inline-no-text">
								<label>
									<input class="check-cust" type="checkbox" name="p[]"/>
									<span class="check-cust_i"></span></label>
							</div>
						</div>
					</div>
				</div>
			</div><?
		}
		?>
	</div>
</div>

<div class="swiper-pagination-kronos"></div>
<div class="swiper-button-prev-2 point-animation"><svg>
	<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
	</svg>
</div>
<div class="swiper-button-next-2 point-animation"><svg>
	<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
	</svg>
</div>

