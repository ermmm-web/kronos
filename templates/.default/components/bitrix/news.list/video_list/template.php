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

<div class="content-head__video-content">
	<div class="video-gallery video-gallery_head row">
		<?foreach($arResult["ITEMS"] as $k => $arItem):?>
			<?
			$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
			$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
			?>
		
			<div class="col-12 col-sm-6 col-md-4 col-lg-3" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
				<div class="video-gallery__item" >
					<a class="video popup-youtube-gallery" href="<?=$arItem["PROPERTIES"]['LINK_YOUTUBE']['VALUE']?>">
			
						<div class="video__bg" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["PREVIEW_LIST"]["src"] ?>)"></div>
			
						<div class="video__play"></div>
						<div class="video__content">
			
							<div class="video__content-top">
								<div class="video__group">Видеообзор</div>
							</div>
			
							<div class="video__content-bottom">
								<div class="video__name"><?=$arItem["NAME"]?></div>
								<div class="video__time"><?=$arItem["PROPERTIES"]['TIME']['VALUE']?></div>
							</div>
						</div>
					</a>		
				</div>
			</div>
			
		
		<?endforeach;?><?
	?></div>
</div>





<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
