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

$arViewModeList = $arResult['VIEW_MODE_LIST'];

$strSectionEdit = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_EDIT");
$strSectionDelete = CIBlock::GetArrayByID($arParams["IBLOCK_ID"], "SECTION_DELETE");
$arSectionDeleteParams = array("CONFIRM" => GetMessage('CT_BCSL_ELEMENT_DELETE_CONFIRM'));

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';	*/		

if (0 < $arResult["SECTIONS_COUNT"]) {
	?><div class="category-select-section"><?
		?><div class="root-catalog root-catalog-container2"><?
			foreach ($arResult['SORTED_SECTIONS']['ROOT'] as $k) {
				$arSection = $arResult['SECTIONS'][$k];
				
				?>
				<div class="root-catalog__product">
					<div class="root-catalog__product-img"><img src="<?=$arSection["PICTURE"]['SRC']?>" alt="<?=$arSection["UF_SHORT_NAME"]?>"></div>
					<div class="root-catalog__product-name">
						<h3><a class="dot-link-multi-line__name" target="" href="<?=$arSection["SECTION_PAGE_URL"]?>">
							<div class="root-catalog__inline-block"><?=$arSection["UF_SHORT_NAME"]?></div>
							</a></h3>
					</div>
					<?
					if ($arResult['SORTED_SECTIONS'][$arSection['ID']]) {
						foreach ($arResult['SORTED_SECTIONS'][$arSection['ID']] as $k) {
							$arSection = $arResult['SECTIONS'][$k];
		/*echo '<pre>$arSection = '.__FILE__.' LINE: '.__LINE__;	
		print_r($arSection);		
		echo '</pre>';	
		die();	*/	
							
							?><div class="root-catalog__hover-wrapper">
								<li class="root-catalog__hover"><a class="dot-link-multi-line__name" target="" href="<?=$arSection["SECTION_PAGE_URL"]?>">
									<div class="root-catalog__inline-block"><?=$arSection["UF_SHORT_NAME"]?></div>
									</a></li>
								<div class="root-catalog__popup">
									<img class="root-catalog__popup-background" src="/local/frontend/build/img/svg/background_of_miniature.svg">
									<img class="root-catalog__popup-img" src="<?=$arSection["PICTURE"]['SRC']?>">
								</div>
							</div>
							<br>
							<?
							
						}
					}
				?></div><?
			}
		?></div><?
	?></div><?
}
?></div>