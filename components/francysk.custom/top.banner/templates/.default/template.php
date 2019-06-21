<div class="banner">
    <div class="banner__slider swiper-container js-swiper">
        <div class="swiper-wrapper">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="swiper-slide">
                    <div class="banner-slide">
                        <div class="banner-slide__desktop" style="background-image: url(<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>); padding-top:29%;">
                            <div class="container">
                                <div class="banner-slide__tablet" style="width: 65%;">
                                    <img src="<?= $arResult["FILES"][$arItem["DETAIL_PICTURE"]]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>">
                                </div>
                                <div class="banner-slide__mobile">
                                    <img src="<?= $arResult["FILES"][$arItem["DETAIL_PICTURE"]]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>">
                                </div>
                                <div class="banner-slide__inner">
                                    <div class="banner-slide__info">
                                        <div class="banner-slide__name"><?= $arItem["PREVIEW_TEXT"]; ?></div>
                                        <div class="banner-slide__desc"><?= $arItem["DETAIL_TEXT"]; ?></div>
                                        <div class="banner-slide__button"> <a class="btn btn_transparent" href="#" title="КЕНТАВР Т-15">Подробнее</a></div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
        <div class="banner-pagination-wrapper">
            <div class="container">
                <div class="banner-pagination"></div>
            </div>
        </div>
    </div>
</div>