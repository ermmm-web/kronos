<div class="elements">
    <h1 class="elements_title"><? $GLOBALS["APPLICATION"]->ShowTitle(); ?></h1>
    <div class="elements_list row">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <div class="elements_item col-sm-4 col-xs-6">
                <a class="pic image-popup" href="<?= $arResult["FILES"][$arItem["DETAIL_PICTURE"]]["SRC"]; ?>" title="<?= $arItem["NAME"]; ?>">
                    <img src="<?= imageResize(array("WIDTH" => 289, "HEIGHT" => 188), $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]); ?>" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>">
                </a>
                <div class="descr">
                    <div class="title">
                        <?= $arItem["NAME"]; ?>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
    </div>
</div>
