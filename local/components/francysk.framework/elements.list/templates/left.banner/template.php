<? foreach ( $arResult["ITEMS"] as $arItem ): ?>
    <div class="banners-block__el">
        <? $css = ""; ?>
        <? if ( $arItem["PROPERTIES"]["COLOR"]["VALUE"] ): ?>
            <? $css = "banner_" . $arItem["PROPERTIES"]["COLOR"]["VALUE_XML_ID"]; ?>
        <? endif; ?>
        <? if ( $arItem["PROPERTIES"]["BACKGROUND_ALL"]["VALUE"] ): ?>
            <? $css .= " banner_bg"; ?>
        <? endif; ?>
        <div class="banner <?= $css; ?>">
            <a href="<?= $arItem["CODE"]; ?>" title="<?= $arItem["CODE"]; ?>" class="banner__wrap">
                <div class="banner__pic">
                    <img src="<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>" alt="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>">
                </div>
                <h3 class="h2"><?= $arItem["PREVIEW_TEXT"]; ?></h3>
                <? if (  $arItem["PROPERTIES"]["DOP_INFO"]["VALUE"]["TEXT"] ): ?>
                    <p class="banner__info"><?= html_entity_decode($arItem["PROPERTIES"]["DOP_INFO"]["VALUE"]["TEXT"]); ?></p>
                <? endif; ?>
            </a>
        </div>
    </div>
<? endforeach; ?>   