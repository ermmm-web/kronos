<article class="b-content col-sm-9" id="jsConfig" data-street="<?= $arResult["ITEMS"][0]["PROPERTIES"]["ADDRESS"]["VALUE"]; ?>" data-coord='<?= $arResult["ITEMS"][0]["PROPERTIES"]["COORDINATE"]["VALUE"]; ?>'>
    <div class="b-content__wrap">
        <h1 class="h1"><?= $GLOBALS["APPLICATION"]->ShowTitle(); ?></h1>
        <div class="article-head">
            <div class="rating">
                <div class="rating__list">
                    <?= Francysk\Framework\Tools\HtmlHelper::viewStartRating($arResult["ITEMS"][0]["PROPERTIES"]["RATING"]["VALUE"]); ?>
                </div>
                <div class="rating__text"><?= $arResult["ITEMS"][0]["PROPERTIES"]["RATING"]["VALUE"]; ?> Pnk</div>
            </div>
            <time class="article-date"><?= $arResult["ITEMS"][0]["DATE_FROM"][0]; ?> <?= \Francysk\Framework\Tools\Month::getMonth($arResult["ITEMS"][0]["DATE_FROM"][1], \Francysk\Framework\Tools\Month::P_ROD) ?> </time>
        </div>
        <p>
            <?= $arResult["ITEMS"][0]["PREVIEW_TEXT"]; ?>
        </p>
        <? if ( !empty($arResult["ITEMS"][0]["PROPERTIES"]["PRODUCTS"]["VALUE"]) ): ?>
            <div class="product">
                <div class="product__list">
                    <? foreach ( $arResult["PRODUCTS"]["ITEMS"] as $arItem ): ?>
                        <div class="product__item">
                            <div class="product__item-pic">
                                <img src="<?= $arResult["PRODUCTS"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"];?>" alt="<?= $arItem["NAME"]?> - <?= $arItem["ID"];?>">
                            </div>
                            <div class="product__item-descr">
                                <div class="title"><?= $arItem["NAME"];?></div>
                                <div class="product__item-price">
                                    <span class="sum"><?= $arItem["PREVIEW_TEXT"];?></span>
                                </div>
                            </div>
                        </div>
                    <? endforeach; ?>
                </div>
            </div>
        <? endif; ?>
        <? if ( count($arResult["ITEMS"][0]["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) > 0 && is_array($arResult["ITEMS"][0]["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) ): ?>
            <div class="slider">
                <div class="swiper-container">
                    <div class="swiper-wrapper">
                        <? foreach ( $arResult["ITEMS"][0]["PROPETIES"]["MORE_PHOTO"]["VALUE"] as $id => $pid ): ?>
                            <div class="swiper-slide">
                                <div class="slider__item">
                                    <img src="<?= $arResult["FILES"][$pid]["SRC"]; ?>" alt="<?= $arResult["ITEMS"][0]["NAME"]; ?> картинка <?= $id + 1; ?>" title="<?= $arResult["ITEMS"][0]["NAME"]; ?> картинка <?= $id + 1; ?>">
                                </div>
                            </div>
                        <? endforeach; ?>
                    </div>
                    <? if ( count($arResult["ITEMS"][0]["PROPERTIES"]["MORE_PHOTO"]["VALUE"]) > 1 ): ?>
                        <div class="swiper-button-prev"></div>
                        <div class="swiper-button-next"></div>
                    <? endif; ?>
                </div>
            </div>
        <? endif; ?>
        <?= $arResult["ITEMS"][0]["DETAIL_TEXT"]; ?>
        <? if ( count($arResult["ITEMS"][0]["PROPERTIES"]["PLUS"]["VALUE"]) > 0 || count($arResult["ITEMS"][0]["PROPERTIES"]["MINUS"]["VALUE"]) > 0 ): ?>
            <div class="options">
                <? if ( count($arResult["ITEMS"][0]["PROPERTIES"]["PLUS"]["VALUE"]) > 0 ): ?>
                    <ul class="options__list plus">
                        <? foreach ( $arResult["ITEMS"][0]["PROPERTIES"]["PLUS"]["VALUE"] as $text ): ?>
                            <li class="options__item"><?= $text; ?></li>
                        <? endforeach; ?>
                    </ul>
                <? endif; ?>
                <? if ( count($arResult["ITEMS"][0]["PROPERTIES"]["MINUS"]["VALUE"]) > 0 ): ?>
                    <ul class="options__list minus">
                        <? foreach ( $arResult["ITEMS"][0]["PROPERTIES"]["PLUS"]["VALUE"] as $text ): ?>
                            <li class="options__item"><?= $text; ?></li>
                        <? endforeach; ?>
                    </ul>
                <? endif; ?>
            </div>
        <? endif; ?>
        <div class="article-foot">
            <div class="rating rating-lg">
                <div class="rating__list">
                    <?= Francysk\Framework\Tools\HtmlHelper::viewStartRating($arResult["ITEMS"][0]["PROPERTIES"]["RATING"]["VALUE"]); ?>
                </div>
                <div class="rating__text"><?= $arResult["ITEMS"][0]["PROPERTIES"]["RATING"]["VALUE"]; ?></div>
            </div>
            <p>
                <?= html_entity_decode($arResult["ITEMS"][0]["PROPERTIES"]["ITOG"]["VALUE"]["TEXT"]); ?>
            </p>
        </div>
    </div>
</article>
<aside class="b-aside col-sm-3">
    <div class="b-aside__wrap">
        <div class="contacts-aside">
            <? if ( !empty($arResult["ITEMS"][0]["PROPERTIES"]["COORDINATE"]["VALUE"]) ): ?>
                <div class="contacts-aside__map" id="mapEvent"></div>
            <? endif; ?>
            <address><?= $arResult["ITEMS"][0]["PROPERTIES"]["ADDRESS"]["VALUE"]; ?></address>
            <? if ( count($arResult["ITEMS"][0]["PROPERTIES"]["PHONES"]["VALUE"]) > 0 ): ?>
                <p>
                    Контактные телефоны:<br>
                    <? foreach ( $arResult["ITEMS"][0]["PROPERTIES"]["PHONES"]["VALUE"] as $pid => $value ): ?>
                        <a href="tel:<?= $arResult["ITEMS"][0]["PROPERTIES"]["PHONES"]["DESCRIPTION"][$pid]; ?>" title="<?= $value; ?>"><?= $value ?></a><br>
                    <? endforeach; ?>
                </p>
            <? endif; ?>
            <? if ( $arResult["ITEMS"][0]["PROPERTIES"]["SITE"]["VALUE"] != '' ): ?>
                <p>
                    Сайт:<br>
                    <a href="<?= $arResult["ITEMS"][0]["PROPERTIES"]["SITE"]["VALUE"]; ?>" title="<?= $arResult["ITEMS"][0]["NAME"]; ?>" target="_blank"><?= $arResult["ITEMS"][0]["PROPERTIES"]["SITE"]["VALUE"]; ?></a>
                </p>
            <? endif; ?>
            <p>
                <?= html_entity_decode($arResult["ITEMS"][0]["PROPERTIES"]["TIME_WORKS"]["VALUE"]["TEXT"]); ?>
            </p>
        </div>
    </div>
    <? if ( !empty($arResult["ITEMS"][0]["PROPERTIES"]["TIME_START"]["VALUE"]) || !empty($arResult["ITEMS"][0]["PROPERTIES"]['CAHSH']["VALUE"]) ): ?>
        <div class="b-aside__wrap">
            <div class="event actual">
                <div class="event__wrap">
                    <div class="event__lnk">
                        <div class="event__descr">
                            <div class="event__ttl">Время проведения</div>
                            <time class="event__date"><?= $arResult["ITEMS"][0]["PROPERTIES"]["TIME_START"]["VALUE"]; ?></time>
                            <div class="event__price">
                                <div class="event__ttl">Стоимость</div>
                                <? foreach ( $arResult["ITEMS"][0]["PROPERTIES"]['CASH']["VALUE"] as $pid => $name ): ?>
                                    <div class="event__price-item">
                                        <div class="text"><?= $name; ?></div>
                                        <div class="sum"><span><?= $arResult["ITEMS"][0]["PROPERTIES"]['CASH']["DESCRIPTION"][$pid]; ?></span></div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    <? endif; ?>

    <div class="b-aside__wrap">
        <div class="event actual">
            <div class="event__wrap">
                <div class="event__lnk">
                    <div class="event__pic">
                        <img src="<?= $arResult["FILES"][$arResult["ITEMS"][0]["DETAIL_PICTURE"]]["SRC"]; ?>" alt="<?= $arResult["ITEMS"][0]["NAME"]; ?> - дополнительное фото">
                        <i class="event__icon"></i>
                    </div>
                    <div class="event__descr">
                        <div class="event__ttl">Время проведения</div>
                        <time class="event__date"><?= $arResult["ITEMS"][0]["PROPERTIES"]["TIME_START"]["VALUE"]; ?></time>
                        <div class="event__price">
                            <div class="event__ttl">Стоимость</div>
                            <? foreach ( $arResult["ITEMS"][0]["PROPERTIES"]['CAHSH']["VALUE"] as $pid => $name ): ?>
                                <div class="event__price-item">
                                    <div class="text"><?= html_entity_decode($name); ?></div>
                                    <div class="sum"><span><?= $arResult["ITEMS"][0]["PROPERTIES"]['CAHSH']["DESCRIPTION"][$pid]; ?></span></div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</aside>