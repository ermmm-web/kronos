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
<div class="index-download">
	<div class="container">
		<div class="section-title">
			<h2 class="index-download__header"><span><b>Скачайте каталог с <span class="hidden-phx">лучшими</span> ценами</b><br>
				<span class="index-download__header_light">на все минитрактора и&nbsp;мотоблоки России</span></span></h2>
		</div>
		<div class="index-download__flex">
			<div class="index-download__left"><a class="index-download__youtube-btn" href="#"><img class="hidden-phx" src="/local/frontend/build/img/root_catalog/movie.svg"><span class="index-download__youtube-btn__text"><span>Смотреть видео о&nbsp;каталоге</span></span><img class="visible-phx" src="/local/frontend/build/img/root_catalog/youtube.svg"></a></div>
			<div class="index-download__right">
				<div class="index-download-list hidden-phx">
					<div class="index-download-list__title">Каталог в&nbsp;цифрах:</div>
					<div class="index-download-list__wrap">
						<div class="index-download-list__el">
							<div class="index-download-list__num"><?=$arResult['DISPLAY_PROPERTIES']['MODELS']['VALUE']?></div>
							<div class="index-download-list__text">
								<div>моделей</div>
								<div>техники</div>
							</div>
						</div>
						<div class="index-download-list__el">
							<div class="index-download-list__num"><?=$arResult['DISPLAY_PROPERTIES']['MANUFACTURES']['VALUE']?></div>
							<div class="index-download-list__text">
								<div>производителя</div>
								<div>техники</div>
							</div>
						</div>
						<div class="index-download-list__el">
							<div class="index-download-list__num"><?=number_format($arResult['DISPLAY_PROPERTIES']['DOWNLOADS']['VALUE'], 0, ",", " ")?></div>
							<div class="index-download-list__text">
								<div>человек</div>
								<div>скачали каталог</div>
							</div>
						</div>
					</div>
				</div>
				<div class="index-download__info">
					<div class="index-download__button hidden-phx"><a class="index-download__button-wrap popup-modal-ajax" href="/popup/download/"><img src="/local/frontend/build/img/root_catalog/arrow.svg" alt="arrow">Скачать бесплатный каталог</a></div>
					<div class="index-download__description">
						<div class="index-download__description-item index-download__description-item_point">PDF</div>
						<div class="index-download__description-item_orange"><?=$arResult['FILE_SIZE']?> Мб</div>
						<div class="index-download__description-item index-download__description-item_sm">Обновлен:</div>
						<div class="index-download__description-item_orange index-download__description-item_sm"><?=$arResult['FILE_TIME']?></div>
					</div>
				</div>
			</div>
		</div>
		<div class="index-download__background" style="background-image: url('/local/frontend/build/img/root_catalog/bg_ru.png')"></div>
	</div>
	
	
	
	
	<div class="index-download__block visible-phx">
		<div class="index-download__block-item-name">
			<div class="index-download__block-item-number">1</div>
			<div class="index-download__block-item-text">
				<div>Введите номер Вашего</div>
				<div>телефона:</div>
			</div>
		</div>
		<? KRONOS_CATALOG::show_phone_sub (); ?>

		<button class="btn index-download__send-button">Отправить</button>
		<div class="index-download__block-item-description">
			<div class="index-download__block-item-description-img"><img src="/local/frontend/build/img/svg/sms.svg" alt="sms"></div>
			<div class="index-download__block-item-description-text">В течение 15 секунд мы пришлём на него бесплатное SMS с кодом, чтобы убедиться, что Вы — реальный человек.</div>
		</div>
		<div class="index-download__block-item-name">
			<div class="index-download__block-item-number">2</div>
			<div class="index-download__block-item-text">
				<div>Введите код из SMS ниже</div>
				<div>и нажмите «Скачать»:</div>
			</div>
		</div>
		<div class="input">
			<div class="input__input">
				<input class="index-download__confirm js-remove-placeholder" type="text" name="index-download__confirm" placeholder="1234">
			</div>
		</div>
		<button class="btn index-download__send-button">Скачать</button>
		<div class="index-download__block-item-description">
			<div class="index-download__block-item-description-img"><img src="/local/frontend/build/img/svg/secure.svg" alt="secure"></div>
			<div class="index-download__block-item-description-text">Мы не передаём Ваш номер третьим лицам и не используем его для рассылки рекламы.</div>
		</div>
	</div>
</div>