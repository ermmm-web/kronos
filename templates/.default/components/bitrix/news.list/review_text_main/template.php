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
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<div class="section-nav">
	<h2 class="clients-section__title">Текстовые отзывы</h2>
	<a class="dot-link-one-line dot-link-one-line_arrow point-animation" href="/otzyvy/" title="">
		<span class="dot-link-one-line__name">Все отзывы</span>
		<svg class="dot-link-one-line__arrow">
			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
		</svg>
	</a>
</div>

<div class="text-reviews">
	<div class="text-reviews__bg" style="background-image: url(/local/frontend/build/img/text-reviews.png)"></div>
	<div class="docs-gallery swiper-container js-popup-docs js-swiper-docs swiper-container-horizontal">
		<div class="swiper-wrapper">
			<? foreach ($arResult["ITEMS"] as $arItem): ?>
				<div class="swiper-slide" >
					<div class="docs-gallery__el js-popup-docs-el" data-doc="<?= $arItem["PREVIEW_PICTURE"]['SRC']; ?>" >
						<div class="popup-doc-bar__info">
							<div class="popup-doc-bar__row">
								<div class="popup-doc-bar__item">
									<div class="popup-doc-bar__name"><?= $arItem["NAME"]; ?></div>
									<? KRONOS_CATALOG::show_address ($arItem); ?>
								</div>
								<div class="popup-doc-bar__item">Отзыв на <a class="popup-doc-bar__link dot-link-one-line" href="<?= $arItem['PRODUCT']["DETAIL_PAGE_URL"]; ?>"><span class="dot-link-one-line__name"><?= $arItem['PRODUCT']["NAME"]; ?></span></a>
								</div>
							</div>
						</div>
						<div class="docs-gallery__pic"><img src="<?= $arItem["PREVIEW_PICTURE"]['SRC']; ?>"></div>
						<div class="docs-gallery__more"><svg class="lupa">
							<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-lupa"></use>
							</svg><span>Увеличить</span>
						</div>
					</div>
				</div>
			<? endforeach; ?>
		</div>
		<span class="swiper-notification" aria-live="assertive" aria-atomic="true"></span>
	</div>
	<div class="swiper-button-prev-kronos swiper-button-prev-kronos_docs" tabindex="0" role="button" aria-label="Previous slide"><svg>
		<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
		</svg>
	</div>
	<div class="swiper-button-next-kronos swiper-button-next-kronos_docs" tabindex="0" role="button" aria-label="Next slide"><svg>
		<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
		</svg>
	</div>
</div>





<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
