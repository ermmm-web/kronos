<!DOCTYPE html>

<html lang="ru-RU">

    <head>

        <meta charset="UTF-8">

        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <meta http-equiv="X-UA-Compatible" content="IE=edge">        

        <?

        $GLOBALS["APPLICATION"]->ShowHead();

        ?>

        <title><? $GLOBALS["APPLICATION"]->ShowTitle(); ?></title>

        <?

        Bitrix\Main\Page\Asset::getInstance()->addCss("/local/frontend/build/css/index.css");
        Bitrix\Main\Page\Asset::getInstance()->addCss("/bitrix/css/main/bootstrap.css");
		// $this->addExternalCss('/bitrix/css/main/bootstrap.css');

        ?>

        <?

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

        Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/libs/bootstrap.min.js");
        Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/main.js");
        Bitrix\Main\Page\Asset::getInstance()->AddJs("/local/frontend/build/js/main_add.js");

        ?>

        <? include $_SERVER["DOCUMENT_ROOT"] . "/header_metrics.php" ?>        

    </head>

    <body>

        <?

        $APPLICATION->ShowPanel();

        ?>        
<?

if ($_REQUEST['bitrix_include_areas'] == 'Y' && $GLOBALS['USER']->GetID() == 10) {
	?><style>header.header{display:none;}</style><?
}

?>

        <div class="page">       

            <header class="header">

                <div class="header__desktop">

                    <div class="container-fluid">

                        <div class="header-info">

                            <div>

                                <? $GLOBALS["APPLICATION"]->IncludeFile("/local/include/custom_users/general/logo.php"); ?>

                                <?$APPLICATION->IncludeComponent(
                                    "bitrix:news.list",
                                    "main-menu",
                                    array(
                                        "ACTIVE_DATE_FORMAT" => "d.m.Y",
                                        "ADD_SECTIONS_CHAIN" => "N",
                                        "AJAX_MODE" => "N",
                                        "AJAX_OPTION_ADDITIONAL" => "",
                                        "AJAX_OPTION_HISTORY" => "N",
                                        "AJAX_OPTION_JUMP" => "N",
                                        "AJAX_OPTION_STYLE" => "N",
                                        "CACHE_FILTER" => "N",
                                        "CACHE_GROUPS" => "Y",
                                        "CACHE_TIME" => "36000000",
                                        "CACHE_TYPE" => "A",
                                        "CHECK_DATES" => "Y",
                                        "COMPONENT_TEMPLATE" => "main-menu",
                                        "DETAIL_URL" => "",
                                        "DISPLAY_BOTTOM_PAGER" => "N",
                                        "DISPLAY_DATE" => "N",
                                        "DISPLAY_NAME" => "Y",
                                        "DISPLAY_PICTURE" => "N",
                                        "DISPLAY_PREVIEW_TEXT" => "N",
                                        "DISPLAY_TOP_PAGER" => "N",
                                        "FIELD_CODE" => array(
                                            0 => "",
                                            1 => "",
                                        ),
                                        "FILTER_NAME" => "",
                                        "HIDE_LINK_WHEN_NO_DETAIL" => "N",
                                        "IBLOCK_ID" => "15",
                                        "IBLOCK_TYPE" => "system",
                                        "INCLUDE_IBLOCK_INTO_CHAIN" => "N",
                                        "INCLUDE_SUBSECTIONS" => "Y",
                                        "MEDIA_PROPERTY" => "",
                                        "MESSAGE_404" => "",
                                        "NEWS_COUNT" => "20",
                                        "PAGER_BASE_LINK_ENABLE" => "N",
                                        "PAGER_DESC_NUMBERING" => "N",
                                        "PAGER_DESC_NUMBERING_CACHE_TIME" => "36000",
                                        "PAGER_SHOW_ALL" => "N",
                                        "PAGER_SHOW_ALWAYS" => "N",
                                        "PAGER_TEMPLATE" => ".default",
                                        "PAGER_TITLE" => "Новости",
                                        "PARENT_SECTION" => "",
                                        "PARENT_SECTION_CODE" => "",
                                        "PREVIEW_TRUNCATE_LEN" => "",
                                        "PROPERTY_CODE" => array(
                                            0 => "_MENU_LINK",
                                            1 => "_MENU_ICON",
                                            2 => "",
                                        ),
                                        "SEARCH_PAGE" => "/search/",
                                        "SET_BROWSER_TITLE" => "N",
                                        "SET_LAST_MODIFIED" => "N",
                                        "SET_META_DESCRIPTION" => "N",
                                        "SET_META_KEYWORDS" => "N",
                                        "SET_STATUS_404" => "N",
                                        "SET_TITLE" => "N",
                                        "SHOW_404" => "N",
                                        "SLIDER_PROPERTY" => "",
                                        "SORT_BY1" => "ACTIVE_FROM",
                                        "SORT_BY2" => "SORT",
                                        "SORT_ORDER1" => "DESC",
                                        "SORT_ORDER2" => "ASC",
                                        "STRICT_SECTION_CHECK" => "Y",
                                        "TEMPLATE_THEME" => "blue",
                                        "USE_RATING" => "N",
                                        "USE_SHARE" => "N"
                                    ),
                                    false
                                );?>

                                <div class="header__lang d-lt-none">

                                    <div class="lang" data-lang="ru"><a class="lang__current"><img src="/local/frontend/build/img/Russia.png" alt=""></a>

                                      <div class="lang__list">

                                        <div class="lang__list-table"><a class="active lang__list-row" data-lang="ru">

                                            <div class="lang__list-cell">Россия</div>

                                            <div class="lang__list-cell">

                                              <div class="lang__flag"><img src="/local/frontend/build/img/Russia.png" alt="Россия"></div>

                                            </div></a><a class="lang__list-row" data-lang="by">

                                            <div class="lang__list-cell">Беларусь</div>

                                            <div class="lang__list-cell">

                                              <div class="lang__flag"><img src="/local/frontend/build/img/Belarus.png" alt="Беларусь"></div>

                                            </div></a><a class="lang__list-row" data-lang="kz">

                                            <div class="lang__list-cell">Қазақстан</div>

                                            <div class="lang__list-cell">

                                              <div class="lang__flag"><img src="/local/frontend/build/img/kazakhstan.png" alt="Қазақстан"></div>

                                            </div></a><a class="lang__list-row" data-lang="ky">

                                            <div class="lang__list-cell">Кыргыз</div>

                                            <div class="lang__list-cell">

                                              <div class="lang__flag"><img src="/local/frontend/build/img/kyrgyzstan.png" alt="Кыргыз"></div>

                                            </div></a><a class="lang__list-row" data-lang="arm">

                                            <div class="lang__list-cell">Հայաստանի</div>

                                            <div class="lang__list-cell">

                                              <div class="lang__flag"><img src="/local/frontend/build/img/armenia.png" alt="Հայաստանի"></div>

                                            </div></a></div>

                                      </div>

                                    </div>

                                </div>

                            </div>

                            <div>

                                <div class="header__item">

                                    <ul>

                                        <li>

                                            <a class="dot-link-one-line" href="/otzyvy/" title="Отзывы">

                                                <svg class="header-icon-review">

                                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-review"></use>

                                                </svg>

                                                <span class="dot-link-one-line__name">Отзывы</span>

                                                <span class="dot-link-one-line__count anim-destination">

                                                    <span data-hover="2355">2355</span>                                                        

                                                </span>

                                            </a>

                                        </li>

                                        <li class="header__item-line">

                                            <a class="dot-link-one-line" href="#" title="Поиск">

                                                <svg class="header-icon-search">

                                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-search"></use>

                                                </svg>

                                                <span class="dot-link-one-line__name">Поиск</span>

                                            </a>

                                        </li>

                                    </ul>

                                </div>

                                <div class="header__item">

                                    <ul>

                                        <li>

                                            <a class="dot-link-one-line" href="#" title="Видео">

                                                <svg class="header-icon-video">

                                                <use xlink:href="/local/frontend/build/img/img/sprite-custom.svg#svg-icon-video"></use>

                                                </svg><span class="dot-link-one-line__name">Видео</span><span class="dot-link-one-line__count anim-destination"><span data-hover="95"> 95</span></span>

                                            </a>

                                        </li>

                                        <li>

                                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/magazine_top.php"); ?>                                           

                                        </li>

                                        <li class="header__item-only-line">

                                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/free_call_top.php"); ?> 

                                        </li>

                                    </ul>

                                </div>

                                <div class="header__item">

                                    <ul>

                                        <li class="header__item-lang">

                                            <div class="lang">

                                                <a class="js-lang-open"><img src="/local/frontend/build/img/Russia.png" alt=""></a>

                                                <div class="lang__list">

                                                    <div class="lang__list-table"><a class="lang__list-row js-lang-close">

                                                            <div class="lang__list-cell">Россия</div>

                                                            <div class="lang__list-cell">

                                                                <div class="lang__flag lang__flag_active"><img src="img/Russia.png" alt="Россия"></div>

                                                            </div></a><a class="lang__list-row" href="#">

                                                            <div class="lang__list-cell">Беларусь</div>

                                                            <div class="lang__list-cell">

                                                                <div class="lang__flag"><img src="img/Belarus.png" alt="Беларусь"></div>

                                                            </div></a><a class="lang__list-row" href="#">

                                                            <div class="lang__list-cell">Украина</div>

                                                            <div class="lang__list-cell">

                                                                <div class="lang__flag"><img src="img/Ukraine.png" alt="Украина"></div>

                                                            </div></a></div>

                                                </div>

                                            </div>

                                        </li>

                                        <li class="header__item-phone header__item-line">

                                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/phone_top.php"); ?>                                            

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

                    <div class="container-fluid">

                        <div class="header-info-mob">

                            <div class="header-info-mob__left">

                                <div class="logo">

                                    <a href="/" title="Главная">

                                        <img class="img-responsive" src="/local/frontend/build/img/logo-mob.svg" alt="Главная">

                                    </a>

                                </div>

                            </div>

                            <div class="header-info-mob__right">

                                <div class="menu-mob">

                                    <ul>

                                        <li><a href="#">

                                                <svg class="menu-mob-phone">

                                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-phone"></use>

                                                </svg></a></li>

                                        <li><a href="#">

                                                <svg class="menu-mob-mail">

                                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-mail"></use>

                                                </svg></a></li>

                                        <li><a href="#">

                                                <svg class="menu-mob-location">

                                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-location"></use>

                                                </svg></a></li>

                                        <li><a class="hamburger">

                                                <div class="hamburger__line"></div>

                                                <div class="hamburger__line"></div>

                                                <div class="hamburger__line"></div></a>

                                        </li>

                                    </ul>

                                </div>

                            </div>

                        </div>

                        <div class="header-search-mob">

                            <form>

                                <input type="text" name="q" placeholder="Поиск">

                                <button><span>Найти</span></button>

                            </form>

                        </div>

                    </div>

                </div>

                <div class="header__bottom">

                    <?

                    $APPLICATION->IncludeComponent("francysk.custom:top.banner", "", array("ELEMENT_COUNT" => "",

                        "FRANCYSKFRAEMWORK_ENTITY" => "2",

                        "FRANCYSKFRAEMWORK_FUNCTION_DECORATOR" => "",

                        "FRANCYSKFRAEMWORK_SYSTEM" => "1",

                        "GET_SECTION_BOOL" => "N",

                        "IBLOCK_ID" => "1",

                        "IBLOCK_TYPE" => "media",

                        "SORT_FIELD_1" => "SORT",

                        "SORT_FIELD_2" => "NAME",

                        "SORT_VALUE_1" => "asc",

                        "SORT_VALUE_2" => "")

                    );

                    ?>

                </div>

            </header>

            <?
			
			/* IS SET IN FOOTER */
			$APPLICATION->ShowViewContent('triggers');
			
			?>

            <div class="content">

                <div class="top-content">

                    <div class="container-fluid">

                        <div class="top-content__row">

                            <div class="top-content__col">

                                <?

                                $APPLICATION->IncludeComponent(

                                        "bitrix:breadcrumb", "francysk", Array(

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

