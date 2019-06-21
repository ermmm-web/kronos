<div class="slider-main">
    <div class="swiper-container">
        <div class="swiper-wrapper">
            <? foreach ( $arResult["ITEMS"] as $arItem ): ?>
                <div class="swiper-slide">
                    <div class="slider-main__slide" style="background-image: url(<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>)" >
                        <div class="slider-main__descr">
                            <h2 class="h1"><?= $arItem["PREVIEW_TEXT"]; ?></h2>
                            <? if ( !empty($arItem["CODE"]) ): ?>
                                <a href="<?= $arItem["CODE"]; ?>" class="btn btn_default">Посмотреть</a>
                            <? endif; ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
            <? if ( count($arResult["ITEMS"]) > 1 ): ?>
                <div class="swiper-pagination"></div>
            <? endif; ?>
        </div>
    </div>
</div>