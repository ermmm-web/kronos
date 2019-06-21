<?
if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
	die();
?>
<!DOCTYPE html>
<html>

<head>
	<? $APPLICATION->ShowHead(); ?>
	<title>
		<? $APPLICATION->ShowTitle(); ?>
	</title>
	<link rel="shortcut icon" type="image/x-icon" href="/favicon.ico" />
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<meta name="viewport" content="width=device-width, initial-scale=1">

	<?

	//Bitrix\Main\Page\Asset::getInstance()->addCss("/local/frontend/build/css/index.css");
	//Bitrix\Main\Page\Asset::getInstance()->addCss("/bitrix/css/main/bootstrap.css");
	// $this->addExternalCss('/bitrix/css/main/bootstrap.css');


	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/modernizr-custom.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/svg4everybody.legacy.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/jquery-3.3.1.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/jquery.mousewheel.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/jquery.mCustomScrollbar.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/jquery.inputmask.bundle.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/jquery.magnific-popup.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/jquery.dotdotdot.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/swiper.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/cloudzoom2.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/tooltipster.bundle.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/countUp.js");
	//Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/bootstrap.min.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/kronos_main.js");
	Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/main_add.js");
	

	 include $_SERVER["DOCUMENT_ROOT"] . "/header_metrics.php" ?>
	<link href="/local/templates/kronos/vasiliy-css.css" type="text/css" rel="stylesheet" />
	<link href="/local/templates/kronos/popups.css" type="text/css" rel="stylesheet" />
	<!-- Latest compiled and minified CSS -->
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/css/bootstrap.min.css" integrity="sha384-HSMxcRTRxnN+Bdg0JdbxYKrThecOKuH5zCYotlSAcp1+c8xmyTe9GYg1l9a69psu" crossorigin="anonymous">
	<!-- Latest compiled and minified JavaScript -->
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js" integrity="sha384-aJ21OjlMXNL5UyIl/XNwTMqvzeRMZH2w8c5cRVpzpU8Y5bApTppSuUkhZXN0VxHd" crossorigin="anonymous"></script>	
	
</head>

<body>


	<div class="page">
		<header class="header">
			<div class="header__desktop">
				<div id="panel">
					<? $APPLICATION->ShowPanel(); ?>
				</div>
				<div class="container">
					<div class="header-info">
						<div>
							<div class="logo"><a href="/" title="Главная"><img class="img-responsive" src="/local/frontend/build/img/logo.svg" alt="Кронос сельхозтехника оптом и в розницу" /><span class="logo__text">Сельхозтехника оптом и&nbsp;в&nbsp;розницу</span></a></div>

							<? $APPLICATION->IncludeComponent(
								"bitrix:menu",
								"sections-elements",
								array(
									"ALLOW_MULTI_SELECT" => "N",
									"CHILD_MENU_TYPE" => "top",
									"COMPONENT_TEMPLATE" => "sections-elements",
									"DELAY" => "N",
									"MAX_LEVEL" => "3",
									"MENU_CACHE_GET_VARS" => array(),
									"MENU_CACHE_TIME" => "3600",
									"MENU_CACHE_TYPE" => "A",
									"MENU_CACHE_USE_GROUPS" => "N",
									"MENU_THEME" => "site",
									"ROOT_MENU_TYPE" => "top",
									"USE_EXT" => "Y"
								),
								false
							); ?>

							<div class="header__lang d-lt-none">
								<? $APPLICATION->IncludeFile("/local/include/custom_users/general/lang.php"); ?>
							</div>
						</div>
						<div>
							<div class="header__item">
								<ul>
									<li>
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/review.php"); ?>
									</li>
									<li class="header__item-line">
										<?
										$APPLICATION->IncludeComponent(
											"bitrix:search.title",
											"kronos",
											array(
												"CATEGORY_0" => array("iblock_1c_catalog"),
												"CATEGORY_0_TITLE" => "",
												"CATEGORY_0_iblock_1c_catalog" => array("2"),
												"CHECK_DATES" => "N",
												"CONTAINER_ID" => "title-search",
												"CONVERT_CURRENCY" => "N",
												"INPUT_ID" => "title-search-input",
												"NUM_CATEGORIES" => "1",
												"ORDER" => "rank",
												"PAGE" => "#SITE_DIR#poisk/index.php",
												"PREVIEW_HEIGHT" => "60",
												"PREVIEW_TRUNCATE_LEN" => "",
												"PREVIEW_WIDTH" => "60",
												"PRICE_CODE" => array("Цена розница"),
												"PRICE_VAT_INCLUDE" => "Y",
												"SHOW_INPUT" => "Y",
												"SHOW_OTHERS" => "N",
												"SHOW_PREVIEW" => "Y",
												"TEMPLATE_THEME" => "blue",
												"TOP_COUNT" => "4",
												"USE_LANGUAGE_GUESS" => "N"
											)
										); ?>


									</li>
								</ul>
							</div>
							<div class="header__item">
								<ul>
									<li>
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/video.php"); ?>
									</li>
									<li>
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/shop.php"); ?>
									</li>
									<li class="header__item-only-line">
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/free_call_top.php"); ?>
									</li>
								</ul>
							</div>
							<div class="header__item">
								<ul>
									<li class="header__item-lang">
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/lang.php"); ?>
									</li>
									<li class="header__item-phone header__item-line">
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/phone_call.php"); ?>
									</li>
									<li>
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/free_call_top.php"); ?>
									</li>
								</ul>
							</div>
						</div>
					</div>
				</div>
			</div>

			<div class="header__mob">
				<div class="container">
					<div class="header-info-mob">
						<div class="header-info-mob__left">
							<div class="logo">
								<a href="/" title="Главная"><img class="img-responsive" src="/local/frontend/build/img/logo-mob.svg" alt="Главная"></a>
							</div>
						</div>
						<div class="header-info-mob__right">
							<div class="menu-mob">
								<ul>
									<li>
										<a class="js-toggle-header-popup" href="#menu-mob-popup-freecall">
											<svg class="menu-mob-phone">
												<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-phone"></use>
											</svg>
										</a>
									</li>
									<li>
										<a class="js-toggle-header-popup" href="#menu-mob-popup-write-to-us">
											<svg class="menu-mob-mail">
												<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-mail-2"></use>
											</svg>
										</a>
									</li>
									<li>
										<a class="js-toggle-header-popup" href="#menu-mob-popup-shop">
											<svg class="menu-mob-location">
												<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-location"></use>
											</svg>
										</a>
									</li>
									<li>
										<a class="hamburger">
											<div class="hamburger__line"></div>
											<div class="hamburger__line"></div>
											<div class="hamburger__line"></div>
										</a>
									</li>
								</ul>
							</div>
						</div>
						<div class="menu-mob-popup-bg"></div>
						<div class="menu-mob-popup menu-mob-popup_freecall" id="menu-mob-popup-freecall">
							<div class="menu-mob-popup__content">
								<div class="menu-mob-popup__scroll">
									<button class="menu-mob-popup__close js-close-header-popup"></button>
									<div class="menu-mob-popup-freecall">
										<? $APPLICATION->IncludeFile("/popup/free-call/index.php"); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="menu-mob-popup menu-mob-popup_shop" id="menu-mob-popup-shop">
							<div class="menu-mob-popup__content">
								<div class="menu-mob-popup__scroll">
									<button class="menu-mob-popup__close js-close-header-popup"></button>
									<div class="menu-mob-popup-shop">
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/mobile_shop.php"); ?>
									</div>
								</div>
							</div>
						</div>
						<div class="menu-mob-popup menu-mob-popup_write-to-us" id="menu-mob-popup-write-to-us">
							<div class="menu-mob-popup__content">
								<div class="menu-mob-popup__scroll">
									<button class="menu-mob-popup__close js-close-header-popup"></button>
									<div class="menu-mob-popup-write-to-us">
										<? $APPLICATION->IncludeFile("/local/include/custom_users/general/write_to_us.php"); ?>
									</div>
								</div>
							</div>
						</div>
					</div>
					<div class="header-search-mob">
						<?
						$APPLICATION->IncludeComponent(
							"bitrix:search.title",
							"kronos",
							array(
								'MODE' => 'MOBILE',

								"CATEGORY_0" => array("iblock_1c_catalog"),
								"CATEGORY_0_TITLE" => "",
								"CATEGORY_0_iblock_1c_catalog" => array("2"),
								"CHECK_DATES" => "N",
								"CONTAINER_ID" => "title-search-mob",
								"CONVERT_CURRENCY" => "N",
								"INPUT_ID" => "title-search-input-mob",
								"NUM_CATEGORIES" => "1",
								"ORDER" => "rank",
								"PAGE" => "#SITE_DIR#poisk/index.php",
								"PREVIEW_HEIGHT" => "60",
								"PREVIEW_TRUNCATE_LEN" => "",
								"PREVIEW_WIDTH" => "60",
								"PRICE_CODE" => array("Цена розница"),
								"PRICE_VAT_INCLUDE" => "Y",
								"SHOW_INPUT" => "Y",
								"SHOW_OTHERS" => "N",
								"SHOW_PREVIEW" => "Y",
								"TEMPLATE_THEME" => "blue",
								"TOP_COUNT" => "4",
								"USE_LANGUAGE_GUESS" => "N"
							)
						); ?>
						<!--form-->
						<!--  input(type="text", name="q", placeholder="Поиск")-->
						<!--  button-->
						<!--    span Найти-->
					</div>
				</div>
			</div>
			<div class="header__bottom">
				<? $APPLICATION->IncludeComponent(
					"bitrix:news.list",
					"kronos.big-slider",
					array(
						"ACTIVE_DATE_FORMAT" => "d.m.Y",
						"ADD_SECTIONS_CHAIN" => "N",
						"AJAX_MODE" => "N",
						"AJAX_OPTION_ADDITIONAL" => "",
						"AJAX_OPTION_HISTORY" => "N",
						"AJAX_OPTION_JUMP" => "N",
						"AJAX_OPTION_STYLE" => "Y",
						"CACHE_FILTER" => "N",
						"CACHE_GROUPS" => "Y",
						"CACHE_TIME" => "36000000",
						"CACHE_TYPE" => "A",
						"CHECK_DATES" => "Y",
						"DETAIL_URL" => "",
						"DISPLAY_BOTTOM_PAGER" => "N",
						"DISPLAY_DATE" => "N",
						"DISPLAY_NAME" => "Y",
						"DISPLAY_PICTURE" => "Y",
						"DISPLAY_PREVIEW_TEXT" => "Y",
						"DISPLAY_TOP_PAGER" => "N",
						"FIELD_CODE" => array(
							0 => "DETAIL_PICTURE",
							1 => "",
						),
						"FILTER_NAME" => "",
						"HIDE_LINK_WHEN_NO_DETAIL" => "N",
						"IBLOCK_ID" => "1",
						"IBLOCK_TYPE" => "media",
						"INCLUDE_IBLOCK_INTO_CHAIN" => "N",
						"INCLUDE_SUBSECTIONS" => "N",
						"MESSAGE_404" => "",
						"NEWS_COUNT" => "20",
						"PAGER_BASE_LINK_ENABLE" => "N",
						"PAGER_DESC_NUMBERING" => "N",
						"PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
						"PAGER_SHOW_ALL" => "N",
						"PAGER_SHOW_ALWAYS" => "N",
						"PAGER_TEMPLATE" => ".default",
						"PAGER_TITLE" => "Новости",
						"PARENT_SECTION" => "654",
						"PARENT_SECTION_CODE" => "",
						"PREVIEW_TRUNCATE_LEN" => "",
						"PROPERTY_CODE" => array(
							0 => "",
							1 => "DETAIL_PICTURE",
							2 => "",
						),
						"SET_BROWSER_TITLE" => "N",
						"SET_LAST_MODIFIED" => "N",
						"SET_META_DESCRIPTION" => "N",
						"SET_META_KEYWORDS" => "N",
						"SET_STATUS_404" => "N",
						"SET_TITLE" => "N",
						"SHOW_404" => "N",
						"SORT_BY1" => "ACTIVE_FROM",
						"SORT_BY2" => "SORT",
						"SORT_ORDER1" => "DESC",
						"SORT_ORDER2" => "ASC",
						"STRICT_SECTION_CHECK" => "N",
						"COMPONENT_TEMPLATE" => "kronos.big-slider"
					),
					false
				); ?>
			</div>
		</header>

		<?
		/* IS SET IN FOOTER */
		$APPLICATION->ShowViewContent('triggers');
		?>

		<div class="content">
			<? if ($APPLICATION->GetCurPage(false) !== '/') : ?>
				<div class="top-content">
					<div class="container">
						<div class="top-content__row">
							<div class="top-content__col">
								<? $APPLICATION->IncludeComponent(
									"bitrix:breadcrumb",
									"francysk",
									array(
										"PATH" => "",
										"SITE_ID" => "s1",
										"START_FROM" => "0"
									)
								);
								?>
							</div>
							<div class="top-content__col">
								<div class="social">
									<div class="social__drop">
										<div class="social__drop-content">
											<div>
												<ul class="social__list">
													<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
													<li><a href="#"><i class="fab fa-vk"></i></a></li>
													<li><a href="#"><i class="fab fa-youtube"></i></a></li>
													<li><a href="#"><i class="fab fa-instagram"></i></a></li>
													<li><a href="#"><i class="fab fa-odnoklassniki"></i></a></li>
													<li><a href="#"><i class="fab fa-twitter"></i></a></li>
												</ul>
											</div>
											<div>
												<ul class="social__list">
													<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
													<li><a href="#"><i class="fab fa-vk"></i></a></li>
													<li><a href="#"><i class="fab fa-youtube"></i></a></li>
													<li><a href="#"><i class="fab fa-instagram"></i></a></li>
													<li><a href="#"><i class="fab fa-odnoklassniki"></i></a></li>
													<li><a href="#"><i class="fab fa-twitter"></i></a></li>
												</ul>
											</div>
											<div>
												<ul class="social__list">
													<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
													<li><a href="#"><i class="fab fa-vk"></i></a></li>
													<li><a href="#"><i class="fab fa-youtube"></i></a></li>
													<li><a href="#"><i class="fab fa-instagram"></i></a></li>
													<li><a href="#"><i class="fab fa-odnoklassniki"></i></a></li>
													<li><a href="#"><i class="fab fa-twitter"></i></a></li>
												</ul>
											</div>
											<div>
												<ul class="social__list">
													<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
													<li><a href="#"><i class="fab fa-vk"></i></a></li>
													<li><a href="#"><i class="fab fa-youtube"></i></a></li>
													<li><a href="#"><i class="fab fa-instagram"></i></a></li>
													<li><a href="#"><i class="fab fa-odnoklassniki"></i></a></li>
													<li><a href="#"><i class="fab fa-twitter"></i></a></li>
												</ul>
											</div>
										</div>
										<div class="social__drop-arrow"></div>
										<div class="social__drop-arrow-white"></div>
									</div>
									<ul class="social__list">
										<li><a href="#"><i class="fab fa-facebook-f"></i></a></li>
										<li><a href="#"><i class="fab fa-vk"></i></a></li>
										<li><a href="#"><i class="fab fa-youtube"></i></a></li>
										<li><a href="#"><i class="fab fa-instagram"></i></a></li>
										<li><a href="#"><i class="fab fa-odnoklassniki"></i></a></li>
										<li><a href="#"><i class="fab fa-twitter"></i></a></li>
										<li><a href="#"><i class="social__add js-toggle-social"></i></a></li>
									</ul>
								</div>
							</div>
						</div>
					</div>
				</div>
				<div class="container">
				<? endif; ?>