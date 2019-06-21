<div class="detail-video">
    <div class="detail-tab-name detail-tab-name_padding">Видео</div>
    <div class="detail-video__inner">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="detail-video__item">
                <a class="video popup-youtube" href="<?= $arItem["PROPERTIES"]["LINK_YOUTUBE"]["VALUE"]; ?>">
                    <div class="video__bg" style="background-image: url(<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>)"></div>
                    <div class="video__play"></div>
                    <div class="video__content">
                        <div class="video__content-top">
                            <div class="video__group">Видеообзор</div>
                            <div class="video__time video__time_top">22:15</div>
                        </div>
                        <div class="video__content-bottom">
                            <div class="video__name"><?= $arItem["NAME"]; ?></div>
                            <div class="video__time video__time_bottom">22:15</div>
                        </div>
                    </div></a>
            </div>
        <? endforeach; ?>                
        <div class="detail-video__item detail-video__item_all">
            <a class="dot-link-one-line video-all" href="#" title="Смотреть все видео">
                <div class="video-all__block">
                    <svg>
                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-video-next"></use>
                    </svg>
                    <div class="dot-link-one-line__name video-all__name">Смотреть все видео</div>
                </div>
            </a>               
        </div>
        <div class="detail-video__item d-lt-none"></div>
        <div class="detail-video__item d-lt-none"></div>
    </div>
</div>


