<div class="product-list">
    <div class="container container-wide">
        <div class="product-list__wrap">
            <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="product">
                    <div class="product__wrap">
                        <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" title="<?= $arItem["NAME"]; ?>" class="product__link">
                            <? if(!empty($arItem["ACTIVE_TO_TIME"])): ?>
                                <div class="product__time">До конца акции: <span class="js-timer" data-date="<?= $arItem["ACTIVE_TO_TIME"]["TIME"] ?>"><?= $arItem["ACTIVE_TO_TIME"]["H"] . " ч " . $arItem["ACTIVE_TO_TIME"]["M"] . " м " . $arItem["ACTIVE_TO_TIME"]["S"] ?> с</span></div>
                            <? endif; ?>
                            <div class="product__pic">
                                <img src="<?= $arItem["PROPERTIES"]["FILES"]["VALUE"]; ?>" alt="Picture">
                            </div>
                            <div class="product__head">
                                <!--<div class="product__subttl">мобильный телефон</div>-->
                                <h2 class="product__ttl"><?= $arItem["NAME"]; ?></h2>
                                <p>(код товара <?= $arItem["ID"]; ?>)</p>
                            </div>
                        </a>
                        <div class="cost">
                            <? foreach ($arResult["PRICE"][$arItem["ID"]] as $arPrice): ?>
                                <div class="cost__item">
                                    <div class="cost-sum">
                                        <div class="cost-sum__num"><?= $arPrice["PRICE_FORMAT"];?></div>
                                        <div class="cost-sum__count">от <?= $arItem["PROPERTIES"]["COUNT_P".$arPrice["CATALOG_GROUP_ID"]]["VALUE"];?> шт.</div>
                                    </div>
                                    <div class="cost-nav js-product-item"
                                         data-render-type="element"
                                         data-product-id="<?=$arPrice["PRODUCT_ID"]?>"
                                         data-price-id="<?=$arPrice["ID"]?>"
                                         data-min="<?= $arItem["PROPERTIES"]["COUNT_P".$arPrice["CATALOG_GROUP_ID"]]["VALUE"];?>"
                                    ></div>
                                </div>
                            <? endforeach; ?>
                        </div>
                    </div>
                </div>
            <? endforeach; ?>
        </div>
    </div>
</div>