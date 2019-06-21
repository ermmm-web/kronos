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

<div class="content-head__triggers-content content-head__triggers-content_normal">

	<div class="triggers-wrap">

		<div class="triggers triggers_head swiper-container js-swiper">

			<div class="swiper-wrapper">
			








<?foreach($arResult["ITEMS"] as $arItem):?>
	<?
	$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
	$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
	
/*echo '<pre>$arItem = '.__FILE__.' LINE: '.__LINE__;	
print_r($arItem);		
echo '</pre>';	*/		

	?>
				<div class="swiper-slide" id="<?=$this->GetEditAreaId($arItem['ID']);?>">

					<div class="trigger-item">

						<div class="trigger-item__normal">

							<div class="trigger-item__icon">

								<div class="trigger-item__icon-container"><img src="/local/frontend/build/img/trigger4.png" alt="<?=$arItem["NAME"]?>"/></div>

							</div>

							<div class="trigger-item__content">

								<div class="trigger-item__text"><?=$arItem["NAME"]?></div>

								<div class="trigger-item__info-text"></div>

							</div>

						</div>

						<div class="trigger-item__blobs">

							<div></div>

							<div></div>

							<div></div>

						</div>

						<div class="trigger-item__hover">

							<div class="trigger-item__full">

								<div class="trigger-item__desc"><?=$arItem["PREVIEW_TEXT"]?></div>

								<div class="trigger-item__link"><a class="dot-link-one-line" href="#" title="<?=$arItem["NAME"]?>"><span class="dot-link-one-line__name">Подробнее</span></a></div>

							</div>

						</div>

					</div>

				</div>



<?endforeach;?>


			</div>

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

	</div>

</div>




<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
