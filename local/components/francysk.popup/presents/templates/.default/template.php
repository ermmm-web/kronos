<div class="popup popup-gift">
    <div class="popup__body">
        <div class="popup__name">Дарим <?= count($arResult["ITEMS"]);?> <?= Francysk\Framework\Tools\TextDecline::getWordNum(count($arResult["ITEMS"]), ['подарок', 'подарка', 'подарков'])?>!</div>
        <div class="popup__gift">
            <?foreach( $arResult["ITEMS"] as $arItem ):?>
                <div class="popup__gift-item">
                    <a class="popup__gift-link" href="<?= $arItem["DETAIL_PAGE_URL"];?>" title="<?= $arItem["NAME"];?>">
                        <div class="popup__gift-img">
                            <div class="popup__gift-plus"></div>
                            <img src="<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"];?>" alt="<?= $arItem["NAME"];?>" title="<?= $arItem["NAME"];?>"/>
                        </div>
                        <div class="popup__gift-name popup__gift-name_desktop js-dotdotdot"><?= $arItem["NAME"];?></div>
                        <div class="popup__gift-name popup__gift-name_mobile dot-link-lines js-dotdotdot">
                            <span class="dot-link-lines__name"><?= $arItem["NAME"];?></span>
                        </div>
                    </a>
                </div>
            <?endforeach;?>
        </div>
    </div>
    <script>App.dotdotdot(".popup-gift");</script>
</div>