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
<div class="detail-form__row detail-form__row-bottom">
	<div class="detail-form__col detail-form__col_left">
		<div class="detail-form__row detail-form__row-count">
			<div class="detail-form__col detail-form__col_max">
				<div class="detail-form__text2">
					Мы ежемесячно подсчитываем количество 
					и индекс удовлетворенности наших клиентов. 
				</div>
			</div>
			<div class="detail-form__col">
				<div class="detail-form__count"><span><?=$arResult['DISPLAY_PROPERTIES']['BUYERS']['VALUE']?></span><span class="detail-form__text2">человек стали нашими покупателями в прошлом месяце</span></div>
			</div>
		</div>
	</div>
	<div class="detail-form__col detail-form__col_right">
		<div class="detail-form__row detail-form__row-satisfaction">
			<div class="satisfaction-index">
				<div class="satisfaction-index__item">
					<div class="satisfaction-index__item-img"><img src="img/1.png" alt=""></div>
					<div class="satisfaction-index__item-info">
						<div class="satisfaction-index__item-percent"><?=$arResult['DISPLAY_PROPERTIES']['VERY_GLAD']['VALUE']?>%</div>
						<div class="satisfaction-index__item-text">очень довольны</div>
					</div>
				</div>
				<div class="satisfaction-index__item">
					<div class="satisfaction-index__item-img"><img src="img/2.png" alt=""></div>
					<div class="satisfaction-index__item-info">
						<div class="satisfaction-index__item-percent"><?=$arResult['DISPLAY_PROPERTIES']['GLAD']['VALUE']?>%</div>
						<div class="satisfaction-index__item-text">довольны</div>
					</div>
				</div>
				<div class="satisfaction-index__item">
					<div class="satisfaction-index__item-img"><img src="img/3.png" alt=""></div>
					<div class="satisfaction-index__item-info">
						<div class="satisfaction-index__item-percent"><?=(100 - $arResult['DISPLAY_PROPERTIES']['VERY_GLAD']['VALUE'] - $arResult['DISPLAY_PROPERTIES']['GLAD']['VALUE'])?>%</div>
						<div class="satisfaction-index__item-text">недовольны</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</div>
<?