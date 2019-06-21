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
$oView = new \Francysk\Framework\View\Card($arResult);

// echo '<br>ID = '.$arResult['ID'];

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;
print_r($arResult['DISPLAY_PROPERTIES']["MORE_PHOTO"]);
echo '</pre>';

die();		*/



?>

<div class="banner-products__item banner-products__item_<?=$arResult['SIZE']?$arResult['SIZE']:'normal'?>">
	<div class="banner-product banner-product_left">

		<!-- NORMAL -->
		<div class="banner-product__normal">
			<div class="banner-product__top">
				<div class="banner-product__category"><?=$arResult["SECTION"]['UF_SHORT_NAME']; ?></div>
				<div class="banner-product__name"><a href="<?=$arResult["DETAIL_PAGE_URL"]; ?>" target="" title="<?= $arResult["NAME"]; ?>"><?= $arResult['PROPERTIES']['NAME']["VALUE"]; ?></a></div>
				<div class="banner-product__status">
					<?= $oView->getStatus(); ?>
				</div>
			</div>
			<?
			if ($arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']) {
				?><div class="banner-product__bottom">
					<div class="banner-product__price">
						<? KRONOS_CATALOG::show_price($arResult, 'old_up'); ?>
					</div>
				</div><?
			}
			?>

			<div class="banner-product__img"><img src="<?=$arResult["PREVIEW_PICTURE"]['src']; ?>" alt="<?= $arResult["NAME"]; ?>" draggable="false"></div>
			<div class="banner-product__zoom">
				<svg><use xlink:href="/local/frontend/src/img/sprite-custom.svg#svg-icon-lupa"></use></svg>
			</div>
		</div>

		<!-- OPEN -->
		<div class="banner-product__open banner-product-open">
			<div class="banner-product-open__top">
				<div class="banner-product-open__top-left">
					<div class="banner-product-open__category"><?=$arResult['SECTION']['UF_SHORT_NAME']?></div>
				</div>
				<div class="banner-product-open__top-right">
					<div class="banner-product-open__triggers">
						<ul>
							<li><img src="/local/frontend/src/img/svg/garant-product.svg" alt=""><span>Гарантия лучшей цены</span></li>
						</ul>
					</div>
				</div>
			</div>
			<div class="banner-product-open__name"><a href="<?= $arResult["DETAIL_PAGE_URL"]; ?>" target="" title="<?= $arResult["NAME"]; ?>"><?= $arResult['PROPERTIES']['NAME']["VALUE"]; ?></a></div>
			<div class="banner-product-open__status">
				<?= $oView->getStatus(); ?>
			</div>

			<div class="banner-product-open__main">

				<div class="banner-product-open__main-left"><?
				
					?>
					<div class="banner-product-open__spec">Специальная<br> цена до 30.12</div>
					<?
					if ($arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']) {
						?><? KRONOS_CATALOG::show_price($arResult, 'old_down'); ?><?
					} else {
						?>
						<div class="banner-product-open__triggers-left">
							<ul>
								<?
								if ($arResult["PODAROK_COUNT"]) {
									$bonus_count = 1;
									?><li class="item-gift">
										<? KRONOS_CATALOG::show_gifts_2 ($arResult); ?>
									</li><?
								} else {
									$bonus_count = 2;
								}
								$arResult["DISPLAY_PROPERTIES"]["BONUS"]["LINK_ELEMENT_VALUE"] = array_slice($arResult["DISPLAY_PROPERTIES"]["BONUS"]["LINK_ELEMENT_VALUE"], 0, $bonus_count);
								foreach ($arResult["DISPLAY_PROPERTIES"]["BONUS"]["LINK_ELEMENT_VALUE"] as $aBonus): ?>
									<li class="<?= $aBonus["CODE"]; ?>">
										<img src="<?= $aBonus["ICON"]["SRC"]; ?>" alt="<?= $aBonus["NAME"]; ?>" titile="<?= $aBonus["NAME"]; ?>" />
										<span><?= $aBonus["NAME"]; ?></span>                                    
									</li>
								<? endforeach; ?>

							</ul>
						</div>
						<?
					}
					?>
					<div class="banner-product-open__count">
						<? KRONOS_CATALOG::show_allready_buy ($arResult); ?>
					</div>
				</div>

				<div class="banner-product-open__main-right">
					<div class="banner-product-open__image" data-count="8"><a class="banner-product-open__image-more" href="" title="">
						<div class="banner-product-open__image-more-info"><img src="<?=$arResult["PREVIEW_PICTURE"]['src']; ?>" alt=""><span class="dot-link-one-line__name">Ещё <?=$arResult["MORE_MORE_PHOTO"]?> фотографий</span></div>
						</a>
						<div class="banner-product-open__image-preload">
							<div class="swiper-lazy-preloader"></div>
						</div>
						<div class="banner-product-open__image-target"><img src="<?=$arResult["PREVIEW_PICTURE"]['src']; ?>" alt="<?=$arResult['NAME']; ?>" draggable="false"></div>
					</div>
				</div>
			</div>

			<div class="banner-product-open__pagination">
				<div class="pagination-line">
					<a class="active" href="<?=$arResult["PREVIEW_PICTURE"]['src']; ?>" title=""></a>
					<?
					foreach ($arResult['DISPLAY_PROPERTIES']["MORE_PHOTO"] as $ar) {
						?><a href="<?=$ar['PREVIEW']['src']?>" title=""></a><?
					}
					?>
					</div>
			</div>

			<? KRONOS_CATALOG::show_gifts_images ($arResult)  ?>

			<div class="banner-product-open__props">
				<div class="props props_product-banner">
					<? KRONOS_CATALOG::show_props ($arResult)  ?>
				</div>
			</div>
			<div class="banner-product-open__action">
				<? KRONOS_CATALOG::show_buttons ($arResult); ?>
			</div>
		</div>
	</div>
</div>


