<div class="memo">
    <div class="container">
        <div class="memo_wrap">
            <div class="js-ld">
                <div class="js-ld_name">Частным лицам</div>
                <ul class="nav nav-tabs js-ld_list" role="tablist">
                    <? $first = true; ?>
                    <? foreach ( $arResult["SECTIONS"] as $pid => $arItem ): ?>
                        <li role="presentation" class="js-ld_item <?= $first ? 'active' : ''; $first = false;?>">
                            <a href="#memo<?= $pid;?>" aria-controls="memo<?= $pid;?>" role="tab" data-toggle="tab"><?= $arItem["NAME"];?></a>
                        </li>
                    <? endforeach; ?>
                </ul>
            </div>
            <div class="tab-content">
                <?$first = true; foreach( $arResult["SECTIONS"] as $pid => $arItem ):?>
                    <div role="tabpanel" class="tab-pane fade in  <?= $first ? 'active' : ''; $first = false;?>" id="memo<?= $pid;?>">
                        <div class="row">
                            <div class="col-md-4">
                                <div class="memo_descr">
                                    <h2 class="memo_title">Памятка страхователю</h2>
                                    <div class="memo_text">
                                        <?= $arItem["DESCRIPTION"];?>
                                    </div>
                                    <a href="<?= $arItem["CODE"];?>" class="btn btn-invert btn-arr">
                                        Подробнее
                                        <svg class="icon icon-arrow">
                                            <use xlink:href="/local/frontend/build/images/sprite.svg#arrow"></use>
                                        </svg>
                                    </a>
                                </div>
                            </div>
                            <div class="col-md-8">
                                <div class="memo-slider curgrab initSlider">
                                    <div class="swiper-container">
                                        <div class="swiper-wrapper">
                                            <?foreach( $arResult["ITEMS"][$pid] as $item ): ?>
                                                <div class="swiper-slide" href="<?= $arItem["DETAIL_PAGE_URL"];?>" title="<?= $arItem["NAME"];?>">
                                                    <div class="pic">
                                                        <img src="<?= $arResult["FILES"][$item["PREVIEW_PICTURE"]]["SRC"];?>" alt="<?= $item["NAME"];?>" title="<?= $item["NAME"];?>" >
                                                    </div>
                                                    <div class="descr">
                                                        <div class="text">
                                                            <?= $item["NAME"];?>
                                                        </div>
                                                    </div>
                                                </div>
                                            <?endforeach;?>
                                        </div>
                                        <div class="memo-slider_pagin">
                                            <div class="memo-slider_prev"></div>
                                            <div class="memo-slider_next"></div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                <?endforeach;?>
            </div>
        </div>
    </div>
</div>