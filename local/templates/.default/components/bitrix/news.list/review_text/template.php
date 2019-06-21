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
<?if($arParams["DISPLAY_TOP_PAGER"]):?>
	<?=$arResult["NAV_STRING"]?><br />
<?endif;?>

<? foreach ($arResult["ITEMS"] as $arItem): ?>
	<div class="review <?= $arResult["SECTIONS"][$arItem["IBLOCK_SECTION_ID"]]["CODE"]; ?>">
		<div class="review__inner">
			<div class="review__pic review__pic_doc">
				<div class="review-doc">
					<svg class="lupa">
					<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-lupa"></use>
					</svg>
					<img src="<?= $arItem["PREVIEW_PICTURE"]["src"]; ?>" title="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>" />
				</div>
			</div>
			<div class="review__body">
				<div class="review__head">
					<div class="review__head-item">
						<p><?= $arItem["NAME"]; ?></p>
						<? KRONOS_CATALOG::show_address ($arItem); ?>
					</div><?
					if ($arParams['HIDE_ELEMENT_LINK'] != 'Y') {
						?><div class="review-product">
							<p class="review-product__subname">Отзыв на:</p>
							<div class="review-product__row">
								<div class="review-product__descr">
									<a href="<?= $arItem['PRODUCT']["DETAIL_PAGE_URL"]; ?>" target="" title="<?= $arItem['PRODUCT']["NAME"]; ?>" class="review-product__name">
										<span><?= $arItem['PRODUCT']["NAME"]; ?></span>
									</a>
								</div>
								<div class="review-product__pic">
									<img src="<?= $arItem['PRODUCT']["PREVIEW_PICTURE"]['src']; ?>" />
								</div>
							</div>
						</div><?                                                
					}
					
				?></div>
				<div class="review__text">
					<p><?= $arItem["PREVIEW_TEXT"]; ?></p>
				</div>
				<?
				if ($arItem["DETAIL_TEXT"]) {
					?><div class="answer__text">
						<p class="answer__text-title">Ответ компании:</p>
						<p class="answer__text-value"><?= $arItem["DETAIL_TEXT"]; ?></p>
					</div><?
				}
				
				
				?>
				
				
				<div class="review__foot">
					<div class="review__foot-item"><a class="dot-link-one-line" href="#"><span class="dot-link-one-line__name">Комментировать</span></a></div>
					<div class="review__foot-item"><a class="reviews-el__foot-item dot-link-one-line" href="<?= $arResult["PRODUCT"][$arItem["PROPERTIES"]["PRODUCT_ID"]["VALUE"]]["DETAIL_PAGE_URL"]; ?>"><span class="dot-link-one-line__name">Посмотреть все отзывы на этот товар (1234)</span></a></div>
				</div>
			</div>
		</div>
	</div>
<? endforeach; ?>





<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
