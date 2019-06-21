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
?>
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<div class="video-gallery video-gallery_wide swiper-container js-swiper-video <?=$arParams['CLASS']?> <?=$arParams['IS_SWIPER'] == 'Y'?'swiper-container js-swiper-video':''?>">
	<div class="video-gallery-info">
		<div class="video-gallery__title">Видеоотзывы</div>
	</div>
	<div class="swiper-wrapper"><?
	
		foreach($arResult["ITEMS"] as $arItem) {
		
			?><div class="swiper-slide" >
				<a class="video video_review popup-youtube-gallery" href="<?=$arItem['DISPLAY_PROPERTIES']['YOUTUBE']['VALUE']?>">
					<div class="video__bg" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["src"]?>)"></div>
					<div class="video__play"></div>
					<div class="video__content">
						<div class="video__content-top">
							<div class="video__title"><?=$arItem['DISPLAY_PROPERTIES']['NAME']['VALUE']?> <?=$arItem['DISPLAY_PROPERTIES']['SECOND_NAME']['VALUE']?></div>
							<? KRONOS_CATALOG::show_address ($arItem); ?>
						</div>
					</div>
				</a>
				<?
				if ($arParams['HIDE_ELEMENT_LINK'] != 'Y') {
					?><div class="video__content-bottom">
						<div class="video__text">Отзыв на:</div>
						<div class="video__name video__name_link">
							<a href="<?= $arItem['PRODUCT']["DETAIL_PAGE_URL"]; ?>" target="" title="<?= $arItem['PRODUCT']["NAME"]; ?>" class="dot-link-multi-line__name video__name video__name_link">
								<span><?=$arItem['NAME']?></span>
							</a>
						</div>
					</div><?
				}
				?>
			</div><?
		}
		
	?></div><?
	
	if ($arParams['IS_SWIPER'] == 'Y') {
		?><div class="swiper-button-prev-kronos swiper-button-prev-kronos_video point-animation">
			<svg>
			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
			</svg>
		</div>
		<div class="swiper-button-next-kronos swiper-button-next-kronos_video point-animation">
			<svg>
			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
			</svg>
		</div>
		<div class="swiper-pagination swiper-pagination-kronos"></div><?
		
	}
	?>
	
</div>





<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
