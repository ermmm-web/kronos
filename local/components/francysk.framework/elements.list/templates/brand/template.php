<div class="section">
    <div class="container">
        <div class="row">
            <div class="col-lt-4">
                <div class="section-head section-head_column">
                    <h2 class="h1">Лучшие бренды</h2>
                    <div class="section-head__descr">
                        <p>
                            Мы собрали более&nbsp;50 популярных<br>и&nbsp;востребованных брендов
                        </p>
                        <a href="#" class="btn btn_default btn_link visible-phx">Все бренды</a>
                    </div>
                </div>
            </div>
            <div class="col-lt-8">
                <div class="partners-table">
                    <? foreach ( $arResult["ITEMS"] as $arItem ): ?>
                        <div class="partner">
                            <a href="<?= $arItem["DETAIL_PAGE_URL"];?>" title="<?= $arItem["NAME"];?>" class="partner__wrap">
                                <span class="partner__pic">
                                    <img src="<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"];?>" alt="<?= $arItem["NAME"];?>">
                                </span>
                                <i class="partner__icon"></i>
                            </a>
                        </div>
                    <? endforeach; ?>                    
                </div>
                <div class="partners-table__foot hidden-phx">
                    <a href="#" class="btn btn_default btn_link">Все бренды</a>
                </div>
            </div>
        </div>
    </div>
</div>