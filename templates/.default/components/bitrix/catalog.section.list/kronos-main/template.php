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


if (0 < $arResult["SECTIONS_COUNT"]) {
	?><div class="category-select"><?

	foreach ($arResult['SECTIONS'] as &$arSection)
	{
		$this->AddEditAction($arSection['ID'], $arSection['EDIT_LINK'], $strSectionEdit);
		$this->AddDeleteAction($arSection['ID'], $arSection['DELETE_LINK'], $strSectionDelete, $arSectionDeleteParams);

		?>
		<div class="category-select__el"><a class="category-select__el-wrap" href="<?=$arSection['SECTION_PAGE_URL']; ?>">
			<canvas class="elastic-border elastic-border_right" width="100" height="336"></canvas>
			<div class="category-select__descr">
				<h3 class="h3"><span><?=$arSection["UF_SHORT_NAME"]?></span></h3><?
				if ($arSection["UF_SHORT_NAME_SUB"]) {
					?><p class="category-select__subttl"><?=$arSection["UF_SHORT_NAME_SUB"]?></p><?
				}
				?>
			</div>
			<div class="category-select__pic"><img src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection["UF_SHORT_NAME"]?>"></div>
			</a>
		</div>
		<?
	}
	?>
	<div class="category-select__el"><a class="category-select__el-wrap" href="/">
		<canvas class="elastic-border elastic-border_right" width="100" height="336"></canvas>
		<div class="category-select__descr">
			<h3 class="h3"><span>Запчасти</span></h3>
		</div>
		<div class="category-select__pic"><img src="<?=$arSection['PICTURE']['SRC']?>" alt="<?=$arSection["UF_SHORT_NAME"]?>"></div>
		</a>
	</div>
	<?
	
}
?></div>