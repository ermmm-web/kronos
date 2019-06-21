<?
$arResult = KRONOS_CATALOG::get_download_catalog_data ();
?>

<a class="banner-download banner-download_index popup-modal-ajax" style="background-image: url(/local/frontend/build/img/banner5.jpg)" href="/popup/download/" title="Скачать каталог с ценами">
	<div class="banner-download__content">
		<div class="banner-download__link">
			<svg>
				<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-download"></use>
			</svg>Скачать каталог с ценами</div>
		<div class="banner-download__info"><span>PDF <?=$arResult['FILE_SIZE']?> Мб</span>Обновлён: <?=$arResult['FILE_TIME']?></div>
	</div>
</a>
