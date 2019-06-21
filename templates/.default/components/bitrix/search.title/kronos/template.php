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
$this->setFrameMode(true);?>
<?
$INPUT_ID = trim($arParams["~INPUT_ID"]);
if(strlen($INPUT_ID) <= 0)
	$INPUT_ID = "title-search-input";
$INPUT_ID = CUtil::JSEscape($INPUT_ID);

$CONTAINER_ID = trim($arParams["~CONTAINER_ID"]);
if(strlen($CONTAINER_ID) <= 0)
	$CONTAINER_ID = "title-search";
$CONTAINER_ID = CUtil::JSEscape($CONTAINER_ID);

if($arParams["SHOW_INPUT"] !== "N"):?>
	<?
	if ($arParams['MODE'] == 'MOBILE') {
		?>
		<div class="search search_test search_mob" id="<?echo $CONTAINER_ID?>">
			<form autocomplete="off" action="<?echo $arResult["FORM_ACTION"]?>">
				<div class="search__icon">
					<svg>
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-search"></use>
					</svg>
				</div>
				<div class="search__input"><input class="search-query js-remove-placeholder" type="text" name="q" placeholder="Поиск" id="<?echo $INPUT_ID?>"/></div>
				<div class="search__btn"><a class="dot-link-one-line"><span class="dot-link-one-line__name" onClick="$('#<?echo $CONTAINER_ID?> .search__submit').click();" href="javascript:void(0);">Найти</span></a>
				</div>
				<button class="search__close js-search-close" type="button">
					<svg>
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-close-search"></use>
					</svg>
				</button>
				<button type="submit" style="display:none;" class="search__submit"></button>
			</form>
		</div>
		<?
	} else {
		?>
		<a class="dot-link-one-line js-search" title="<?=GetMessage("CT_BST_SEARCH_BUTTON");?>">
			<svg class="header-icon-search">
				<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-search"></use>
			</svg><span class="dot-link-one-line__name"><?=GetMessage("CT_BST_SEARCH_BUTTON");?></span>
		</a>
	
			
		<div class="search search_test search_desktop" id="<?echo $CONTAINER_ID?>" >
			<form autocomplete="off" action="<?echo $arResult["FORM_ACTION"]?>">
				<div class="search__icon">
					<svg>
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-search"></use>
					</svg>
				</div>
				<div class="search__input">
					<input class="search-query js-remove-placeholder" type="text" name="q" placeholder="Введите название товара" id="<?echo $INPUT_ID?>"/>
				</div>
				<div class="search__btn"><a class="dot-link-one-line" onClick="$('#<?echo $CONTAINER_ID?> .search__submit').click();" href="javascript:void(0);"><span class="dot-link-one-line__name"><?=GetMessage("CT_BST_SEARCH_BUTTON");?></span></a></div>
				<button class="search__close js-search-close" type="button">
					<svg>
						<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-close-search"></use>
					</svg>
				</button>
				<button type="submit" style="display:none;" class="search__submit"></button>
			</form>
		</div>
		<?
		
	}
?>
	
<?endif?>
<script>
	BX.ready(function(){
		new JCTitleSearch({
			'AJAX_PAGE' : '<?echo CUtil::JSEscape(POST_FORM_ACTION_URI)?>',
			'CONTAINER_ID': '<?echo $CONTAINER_ID?>',
			'INPUT_ID': '<?echo $INPUT_ID?>',
			'MIN_QUERY_LEN': 3
		});
	});
</script>
