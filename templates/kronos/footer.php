<?
if(!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true)
    die();


if( !defined("NO_VIEW_TRIGGER")) {
    $APPLICATION->IncludeComponent(
        "kronos:triggers", "", array()
    );
}
?>
        <? if ($APPLICATION->GetCurPage(false) !== '/'): ?>
            </div>
        <? endif; ?>
    </div>
    <footer class="footer">

        <div class="footer__mobile footer__contacts-mobile">
            <div class="container">
                <div class="footer__contacts-mobile-inner">
                    <? $APPLICATION->IncludeFile("/local/include/custom_users/general/slider_contacts.php"); ?>
                </div>
            </div>
        </div>
        <!--<div class="footer__top">
            <div class="container">
                <a class="dot-link-one-line dot-link-one-line_arrow point-animation" href="#" title=""> <span class="dot-link-one-line__name">Почему покупают у нас</span>
                    <svg class="dot-link-one-line__arrow">
                        <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
                    </svg>
                </a>
            </div>
        </div>-->
        <div class="footer__bottom">
            <div class="container">
                <div class="footer__bottom-row">
                    <div class="footer__bottom-left">
                        <div class="footer__triggers">
                            <div class="triggers-wrap">
                                <? include($_SERVER['DOCUMENT_ROOT'].'/local/include/templates/triggers.php'); ?>
                            </div>
                        </div>
                        <div class="footer__contacts footer__contacts-desktop">
                            <div class="footer__contacts-left">
                                <div class="footer-logo">
                                    <? $APPLICATION->IncludeFile("/local/include/custom_users/general/logo_footer.php"); ?>
                                </div>
                                <div class="footer-phone">
                                    <? $APPLICATION->IncludeFile("/local/include/custom_users/general/free_call_footer.php"); ?>
                                </div>
                                <div class="footer-contacts-list">
                                    <ul class="border-dot-list">
                                        <li>
                                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/free_call_top.php"); ?>
                                        </li>
                                        <li>
                                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/email.php"); ?>
                                        </li>
                                    </ul>
                                </div>
                            </div>
                            <div class="footer__contacts-right">
                                <div class="footer__contacts-gallery">
                                    <? $APPLICATION->IncludeFile("/local/include/custom_users/general/slider_contacts.php"); ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="footer__bottom-right">
                        <? $APPLICATION->IncludeFile("/local/include/custom_users/general/slider_shop.php"); ?>

                        <div class="footer__bottom-links">
                            <div>
                                <div class="social-list">
                                    <? $APPLICATION->IncludeFile("/local/include/custom_users/general/social_right.php"); ?>
                                </div>
                                <div class="footer-links">
                                    <ul>
                                        <li><? $APPLICATION->IncludeFile("/local/include/custom_users/general/tender.php"); ?></li>
                                        <li><? $APPLICATION->IncludeFile("/local/include/custom_users/general/director.php"); ?></li>
                                    </ul>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="footer__bottom-row footer__bottom-row-mobile">
                    <div class="footer__contacts-left">
                        <div class="footer-logo">
                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/logo_footer.php"); ?>
                        </div>
                        <div class="footer-phone">
                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/free_call_footer.php"); ?>
                        </div>
                        <div class="footer-contacts-list">
                            <ul class="border-dot-list">
                                <li>
                                    <? $APPLICATION->IncludeFile("/local/include/custom_users/general/free_call_top.php"); ?>
                                </li>
                                <li>
                                     <? $APPLICATION->IncludeFile("/local/include/custom_users/general/email.php"); ?>
                                </li>
                            </ul>
                        </div>
                    </div>
                    <div class="footer__contacts-right">
                        <div class="footer__contacts-gallery">
                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/slider_contacts.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="footer__tablet">
            <div class="container">
                <div class="footer__tablet-row">
                    <div class="footer__tablet-col">
                        <div class="social-list social-list_row">
                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/social.php"); ?>
                        </div>
                    </div>
                    <div class="footer__tablet-col">
                        <ul class="border-dot-list">
                            <li><? $APPLICATION->IncludeFile("/local/include/custom_users/general/tender.php"); ?></li>
                            <li><? $APPLICATION->IncludeFile("/local/include/custom_users/general/director.php"); ?></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>

        <div class="footer__mobile">
            <div class="footer__mobile-top">
                <div class="container">
                    <div class="footer__mobile-logo">
                        <div class="footer-logo">
                            <a href="/" title=""><img src="/local/frontend/build/img/logo.svg" alt=""></a>
                        </div>
                    </div>
                    <div class="footer__mobile-phone"><a class="dot-link-one-line" href="tel:+78005559862" title="+7 800 555-98-62"><span class="dot-link-one-line__name">+7 800 555-98-62</span></a></div>
                    <div class="footer__mobile-time">Ежедневно
                        <br>9:00-19:00 (Мск)</div>
                    <div class="footer__mobile-links">
                        <ul>
                            <li>
                                <? $APPLICATION->IncludeFile("/local/include/custom_users/general/free_call_top.php"); ?>
                            </li>
                            <li>
                                 <? $APPLICATION->IncludeFile("/local/include/custom_users/general/email.php"); ?>
                            </li>
                            <li>
                                <? $APPLICATION->IncludeFile("/local/include/custom_users/general/director.php"); ?>
                            </li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="footer__mobile-bottom">
                <div class="container">
                    <div class="footer__mobile-social">
                        <div class="social-list social-list_flex">
                            <? $APPLICATION->IncludeFile("/local/include/custom_users/general/social.php"); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </footer>

    <? $APPLICATION->IncludeFile("/local/include/custom_users/general/download.php"); ?>
</div>


<div class="popup-content" id="popup-content">
    <div class="popup-content__scroll">
        <div class="popup-content__head">
            <div class="popup-content__head-text js-close-content-popup">Назад</div>
            <div class="popup-content__head-close js-close-content-popup"></div>
        </div>
        <div class="popup-content__body" id="popup-content-body"></div>
    </div>
</div>
<!--<script src="/local/frontend/build/js/libs/all.min.js"></script>
<script src="/local/frontend/build/js/main.js"></script>-->

<script>
    $(".link-text").each(function () {
        var characters = $(this).text().split("");
        $this = $(this);
        $this.empty();
        $.each(characters, function (i, el) {
            if(el === ' '){
                el = '&nbsp;'
            }
            $this.append("<span>" + el + "</span>");
        });
    });
    $(".link-hover").each(function () {
        var characters = $(this).text().split("");
        $this = $(this);
        $this.empty();
        $.each(characters, function (i, el) {
            if(el === ' '){
                el = '&nbsp;'
            }
            $this.append("<span>" + el + "</span>");
        });
    });
    $('.menu').addClass('done');
</script>


</body>
</html>