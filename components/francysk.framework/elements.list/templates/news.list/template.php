<div class="jsReload">
    <div class="news">
        <div class="container">
            <div class="news-section">
                <div class="row">
                    <div class="row">
                        <div class="col-md-3">
                            <div class="news-title">Новости за
                                <div class="news-filter">
                                    <select class="formstyler jsHrefAction">
                                        <option value="0" data-href="/press_tsentr/">все время</option>
                                        <? foreach ( $arResult["SECTIONS"]["ITEMS"] as $arItem ): prent($arItem);?>
                                            <option value="<?= $arItem["ID"]; ?>" <?= $arItem["CHECKED"] ? 'selected' : ''; ?> data-href="<?= $arItem["SECTION_PAGE_URL"]; ?>"><?= $arItem["NAME"]; ?></option>
                                        <? endforeach; ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-9">
                            <div class="news-list">
                                <? foreach ( $arResult["ITEMS"] as $arItem ): ?>
                                    <div class="news-item js-hover">
                                        <a class="pic js-lnk" href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" title="<?= $arItem["NAME"]; ?>" style="background-image: url(<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"] ?>)"></a>
                                        <div class="descr">
                                            <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="title js-lnk" title="<?= $arItem["NAME"]; ?>"><?= $arItem["NAME"]; ?></a>
                                            <div class="date"><?= $arItem["DATE"]; ?></div>
                                        </div>
                                    </div>
                                <? endforeach; ?>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <? if ( $arResult["DB"]->NavRecordCount > $arParams["ELEMENT_COUNT"] ): ?>
        <? $GLOBALS["APPLICATION"]->IncludeComponent("bitrix:system.pagenavigation", "francysk", array("NAV_RESULT" => $arResult["DB"])); ?>
    <? endif; ?>
</div>