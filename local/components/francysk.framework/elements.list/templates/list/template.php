<div class="events__list">
    <div class="events__list-wrap">
        <? foreach ( $arResult["ITEMS"] as $arItem ): ?>
            <div class="event <?if($arItem["PROPERTIES"]["HIT"]["VALUE"]):?>hot<?elseif($arItem["PROPERTIES"]["FUTURE"]["VALUE"]):?>future<?endif;?>">
                <div class="event__wrap">
                    <a href="<?= $arItem["DETAIL_PAGE_URL"];?>" title="<?= $arItem["NAME"];?>" class="event__lnk">
                        <div class="event__pic">
                            <img src="<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"];?>" title="<?= $arItem["NAME"];?>" alt="<?= $arItem["NAME"];?>">
                            <div class="event__age">1-2 года</div>
                            <i class="event__icon"></i>
                        </div>
                        <div class="event__descr">
                            <time class="event__date">30 сентября</time>
                            <div class="event__title"><?= $arItem["NAME"];?></div>
                        </div>
                    </a>
                </div>
            </div>
        <? endforeach; ?>
    </div>
    <div class="events__list-more">
        <a href="#" class="btn btn-default">Еще немножечко</a>
    </div>
</div>