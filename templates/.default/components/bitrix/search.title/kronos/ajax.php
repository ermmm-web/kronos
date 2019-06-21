<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>
<?
if(!empty($arResult["CATEGORIES"])) {

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($arResult);		
echo '</pre>';	*/		

	
?>

<div class="search_desktop_ajax search__result" >
	<!--<div class="search__result-count">Нашлось 123 совпадения</div>-->
	<div class="search__result-list-scroll js-custom-scroll-y">

		<table class="title-search-result search__result-list">
			<?foreach($arResult["CATEGORIES"] as $category_id => $arCategory):?>
				<!--<tr>
					<th class="title-search-separator">&nbsp;</th>
					<td class="title-search-separator">&nbsp;</td>
				</tr>-->
				<?foreach($arCategory["ITEMS"] as $i => $arItem):?>
				
				<tr class="search__result-item">
					<? /*if($i == 0):?>
						<th>&nbsp;<?echo $arCategory["TITLE"]?></th>
					<?else:?>
						<th>&nbsp;</th>
					<?endif*/ ?>
	
					<? if($category_id === "all"):?>
						<!--<td class="title-search-all"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>-->
					<?elseif(isset($arResult["ELEMENTS"][$arItem["ITEM_ID"]])):
						$arElement = $arResult["ELEMENTS"][$arItem["ITEM_ID"]];
					?>
					<td class="search__result-item-img">
						<a href="<?echo $arItem["URL"]?>" title="<?echo $arItem["NAME"]?>"><img src="<?echo $arElement["PICTURE"]["src"]?>" alt="<?echo $arItem["NAME"]?>" width="<?echo $arElement["PICTURE"]["width"]?>" height="<?echo $arElement["PICTURE"]["height"]?>" /></a>
					</td>
					<td class="search__result-item-name">
						<a href="<?echo $arItem["URL"]?>" title="<?echo $arItem["NAME"]?>"> <?echo $arItem["NAME"]?></a>
					</td>
						<? /*foreach($arElement["PRICES"] as $code=>$arPrice):?>
							<?if($arPrice["CAN_ACCESS"]):?>
								<p class="title-search-price"><?=$arResult["PRICES"][$code]["TITLE"];?>:&nbsp;&nbsp;
								<?if($arPrice["DISCOUNT_VALUE"] < $arPrice["VALUE"]):?>
									<s><?=$arPrice["PRINT_VALUE"]?></s> <span class="catalog-price"><?=$arPrice["PRINT_DISCOUNT_VALUE"]?></span>
								<?else:?><span class="catalog-price"><?=$arPrice["PRINT_VALUE"]?></span><?endif;?>
								</p>
							<?endif;?>
						<?endforeach;*/ ?>
					
					<?elseif(isset($arItem["ICON"])):?>
						<!--<td class="title-search-item"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>-->
					<?else:?>
						<!--<td class="title-search-more"><a href="<?echo $arItem["URL"]?>"><?echo $arItem["NAME"]?></a></td>-->
					<?endif;?>
				</tr>
				<?endforeach;?>
			<?endforeach;?>
			<!--<tr>
				<th class="title-search-separator">&nbsp;</th>
				<td class="title-search-separator">&nbsp;</td>
			</tr>-->
		</table>
		<div class="title-search-fader"></div>
		</div><?
		if (sizeof($arResult["ELEMENTS"]) >= $arParams['TOP_COUNT']) {
			?><div class="search__result-btn"><a class="btn" href="<?=$arResult["CATEGORIES"]['all']['ITEMS'][0]['URL']?>" title="Все результаты">Все результаты</a></div><?
		}
		?>
	</div>
	
</div>

	
<?
} else {
?>	
	<div class="search__no-result" style="display:none;">
		<div class="search__no-result-text search__no-result-text_red">Ваш запрос не дал результатов.
			<br/>Попробуйте сформулировать его по-другому.</div>
		<div class="search__no-result-text">Вы также можете связаться
			<br/>с нашим отделом продаж:</div>
		<div class="search__no-result-contacts">
			<ul class="border-dot-list">
				<li>
					<div>
						<a class="search__no-result-phone" href="tel:+78005559862">
							<svg>
								<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-phone"></use>
							</svg>+7 800 555-98-62</a>
					</div>
					<div class="search__no-result-text-small">Звонок бесплатный</div>
				</li>
				<li>
					<div>9:00&ndash;18:00 (Мск)</div>
					<div class="search__no-result-text-small">Без выходных</div>
				</li>
			</ul>
			<div class="search__no-result-email"><a class="dot-link-one-line" href="mailto:info@kronos5.ru"><span class="dot-link-one-line__name">info@kronos5.ru</span></a></div>
		</div>
	</div>


<?
	
}
?>