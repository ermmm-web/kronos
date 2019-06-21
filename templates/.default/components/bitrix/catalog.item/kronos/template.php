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

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';

die();		*/	




?><div class="catalog__product">

	<div class="product product_320">
		<div class="product__top">
			<div class="product__name"><a href="<?= $arResult["DETAIL_PAGE_URL"]; ?>" target="" class="js-dotdotdot" style="overflow-wrap: break-word;"><span><?= $arResult["NAME"]; ?></span></a></div>
			<div class="product__status">
				<?= $oView->getStatus(); ?>
			</div>
			<div class="product__image-mob">
				<img src="<?= $arResult["PREVIEW_PICTURE"]['src']; ?>" alt="<?= $arResult["NAME"]; ?>">
			</div>
		</div>
		<div class="product__row product__bonuses">
				<?=KRONOS_CATALOG::show_bonuses($arResult); ?>
		</div>
		<div class="product__bottom">
			<div class="product__info-bottom"></div>
			<? KRONOS_CATALOG::show_price($arResult); ?>
			<? KRONOS_CATALOG::show_buttons ($arResult, false); ?>
		</div>
		<div class="product__bottom_gifts">
			<? KRONOS_CATALOG::show_gifts_images ($arResult); ?>	
		</div>
	</div>	

	<div class="product product_1920">
		<div class="product__top">
			<div class="product__row">
				<div class="product__top-left">
					<div class="product__name">
						<a target="" href="<?= $arResult["DETAIL_PAGE_URL"]; ?>" title="<?= $arResult["NAME"]; ?>"><?= $arResult["NAME"]; ?></a>
					</div>
				</div>
				<div class="product__top-right">
					<div class="product__top-top-right">
						<div class="product__left-side">
							<? KRONOS_CATALOG::show_reviews($arResult); ?>
						</div>
						<div class="product__right-side">
							<div class="product__status product__info-top">
								<?= $oView->getStatus(); ?>
							</div>
						</div>
					</div>
					
				</div>
			</div>
			<div class="product__row product__bonuses">
				<?=KRONOS_CATALOG::show_bonuses($arResult); ?>
			</div>
			<div class="product__row">
				<div class="product__top-left">
					<? KRONOS_CATALOG::show_props ($arResult)  ?>
				</div>
				<div class="product__top-right">
					<? KRONOS_CATALOG::show_more_photo ($arResult) ?>
				</div>						
			</div>
		</div>
		<div class="product__bottom">
			<div class="product__spec"></div>
			<div class="product__action">
				<? KRONOS_CATALOG::show_buttons ($arResult); ?>
				<? KRONOS_CATALOG::show_price($arResult); ?>
			</div>
		</div>
		<div class="product__bottom_gifts">
			
			<? KRONOS_CATALOG::show_gifts_images ($arResult); ?>	
		</div>
	</div>
</div>