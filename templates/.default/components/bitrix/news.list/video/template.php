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
	<div class="video-gallery video-gallery_head <?=$arParams['SHOW_SLIDER'] == 'Y'?'swiper-container js-swiper-video':''?>">
		<div class="swiper-wrapper">

			<?foreach($arResult["ITEMS"] as $k => $arItem):?>
				<?
				$this->AddEditAction($arItem['ID'], $arItem['EDIT_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_EDIT"));
				$this->AddDeleteAction($arItem['ID'], $arItem['DELETE_LINK'], CIBlock::GetArrayByID($arItem["IBLOCK_ID"], "ELEMENT_DELETE"), array("CONFIRM" => GetMessage('CT_BNL_ELEMENT_DELETE_CONFIRM')));
				
				/*echo '<pre>$arItem = '.__FILE__.' LINE: '.__LINE__;	
				print_r($arItem);		
				echo '</pre>';			
				
				echo '<!--';	
				echo '<pre>$arItem = '.__FILE__.' LINE: '.__LINE__;	
				print_r($arItem);		
				echo '</pre>';			
				echo '-->';		
				echo '<br>$k = '.$k;
				echo '<br>VIDEOS_PER_COLOMN = '.$arParams['VIDEOS_PER_COLOMN'];
				echo '<br>per = '.($k % $arParams['VIDEOS_PER_COLOMN']);*/	
				
				if (!$k % $arParams['VIDEOS_PER_COLOMN']) {
					?><div class="swiper-slide"><?
				}
				?>
			
					<div class="video-gallery__item" id="<?=$this->GetEditAreaId($arItem['ID']);?>">
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
				
				<?
				if (!($k+1) % $arParams['VIDEOS_PER_COLOMN'] || !$arResult["ITEMS"][$k+1]) {
					?></div><?
				}
				
				?>
			
			<?endforeach;?>

<?

			if ($arParams['SHOW_ALL'] == 'Y') {
				?><div class="swiper-slide detail-video__item_all">
						<a class="video video-all" href="#" title="Смотреть все видео" style="padding: 70px; text-align:center;">
							<div class="video-all__block">
								<svg>
								<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-video-next"></use>
								</svg>
								<div class="dot-link-one-line__name video-all__name">Смотреть все видео</div>
							</div>
						</a>               
				</div><?
			}
		?></div><?

		if ($arParams['SHOW_SLIDER'] == 'Y') {
					?><div class="swiper-button-prev-kronos swiper-button-prev-kronos_gray point-animation">
		
						<svg>
		
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
		
						</svg>
		
					</div>
		
					<div class="swiper-button-next-kronos swiper-button-next-kronos_gray point-animation">
		
						<svg>
		
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
		
						</svg>
		
					</div>
		
				<div class="swiper-pagination swiper-pagination-kronos"></div><?
			
		}

	?></div>
</div>





<?if($arParams["DISPLAY_BOTTOM_PAGER"]):?>
	<br /><?=$arResult["NAV_STRING"]?>
<?endif;?>
