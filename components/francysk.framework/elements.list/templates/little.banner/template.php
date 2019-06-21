<? foreach ( $arResult["ITEMS"] as $arItem ): ?>
    <div class="col-tb-6 col-lt-4">
        <div class="banner ">
            <div class="banner__wrap">
                <div class="banner__pic">
                    <img title="<?= $arItem["NAME"];?>" alt="<?= $arItem["NAME"];?>" src="<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"];?>">
                </div>
                <h3 class="h2"><?= $arItem["PREVIEW_TEXT"];?></h3>
                <?if( $arItem["CODE"] ):?>
                    <a href="<?= $arItem["CODE"];?>" title="<?= $arItem["NAME"];?>" class="btn btn_default btn_link">В каталог</a>
                <?elseif($arItem["PROPERTIES"]["DOP_INFO"]["VALUE"]["TEXT"]) :?>
                    <p class="banner__info"><?= html_entity_decode($arItem["PROPERTIES"]["DOP_INFO"]["VALUE"]["TEXT"]); ?></p>
                <?endif;?>                
            </div>
        </div>
    </div>    
<? endforeach; ?>