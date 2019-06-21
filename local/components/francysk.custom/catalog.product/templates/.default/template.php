<div class="catalog__products">
        <? foreach ($arResult["ITEMS"] as $arItem): ?>
            <?
                $oView = new \Francysk\Framework\View\ListGoods($arItem);
            ?>

            <? $index = 0; ?>
            <? $max = 6; ?>
            <? $count = 0; ?>
            <? foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $id): ?>
                <?
                    $index++;
                    $count++;
                    if ($index >= $max) {
                        break;
                    }
                ?>
            <? endforeach; ?>

            <div class="catalog__product">
                <div class="product product_960">
                    <div class="product__top">
                        <div class="product__row product__row-1">
                            <div class="product__top-left">
                                <div class="product__name">
                                    <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" class="js-dotdotdot" title="<?= $arItem["NAME"]; ?>"><?= $oView->getName(); ?></a>
                                </div>
                            </div>
                            <div class="product__top-right">

                                <div class="product__top-top-right">
                                    <div class="product__left-side">
                                        <div class="product__review product__info-top"><a href="#" title="7 отзывов"><span>7 отзывов</span></a></div>
                                    </div>
                                    <div class="product__right-side">
                                        <div class="product__status product__info-top">
                                            <?= $oView->getStatus(); ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="product__row product__row-2">
                            <div class="product__top-left">
                                <div class="product__top-col">
                                    <div class="product__gift-count">
                                        <?= $oView->getPodarki(); ?>
                                    </div>
                                    <div class="product__price">
                                        <div><span class="price-old">1 499 999</span><span class="price-old price-not-through"> р.</span></div>
                                        <div><span class="price">1 499 999</span><span class="price price-not-through"> р.</span></div>
                                    </div>
                                </div>
                                <div class="product__top-col">
                                    <div class="product__props">
                                        <div class="props props_product">
                                            <div class="props__table">
                                                <? foreach ($arItem["PROPERTIES"] as $code => $values): ?>
                                                    <? if (strripos($code, "MINI_") === false || empty($values["VALUE"])) continue; ?>
                                                    <div class="props__tr">
                                                        <div class="props__td"><?= $values["HINT"] ? $values["HINT"] : $values["NAME"]; ?>:</div>
                                                        <div class="props__td">
                                                            <? if ($values["PROPERTY_TYPE"] == "E"): ?>
                                                                <? $p = $arResult["DOP"]["ITEMS"][$values["VALUE"]]; ?>
                                                                <? $values["VALUE"] = $p["NAME"]; ?>
                                                                <? if ($p["PREVIEW_PICTURE"] > 0): ?>
                                                                    <img src="<?= $arResult["DOP"]["FILES"][$p["PREVIEW_PICTURE"]]["SRC"]; ?>" alt="<?= $p["NAME"]; ?>" title="<?= $p["NAME"]; ?>" />
                                                                <? endif; ?>
                                                            <? endif; ?>
                                                            <?= $values["VALUE"]; ?> <?= $values["DESCRIPTION"]; ?>
                                                        </div>
                                                    </div>
                                                <? endforeach; ?>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__top-right">
                                <div class="product__gallery">
                                    <div class="product__image" <?if($count > 1):?>data-count="<?= $count ?>"<?endif;?>>
                                        <a class="product__image-more" href="" title="">
                                            <div class="product__image-more-info">
                                                <img src="/local/frontend/build/img/svg/photo.svg" alt=""/>Ещё 12 фотографий
                                            </div>
                                        </a>
                                        <div class="product__image-preload">
                                            <div class="swiper-lazy-preloader"></div>
                                        </div>
                                        <div class="product__image-target">
                                            <img src="<?= imageResize(["WIDTH" => 380, "HEIGHT" => 214], $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]); ?>" title="<?= $arItem["NAME"];?>" alt="<?= $arItem["NAME"];?>"/>
                                        </div>
                                    </div>
                                    <? if($count > 1): ?>
                                        <div class="product__pagination">
                                            <div class="pagination-line">
                                                <a class="active" href="<?= imageResize(["WIDTH" => 380, "HEIGHT" => 214], $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]); ?>"></a>
                                                <? $index = 0; ?>
                                                <? foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $id): ?>
                                                    <?
                                                    $index++;
                                                    if ($index >= $count) break;
                                                    ?>
                                                    <a href="<?= imageResize(["WIDTH" => 380, "HEIGHT" => 214], $arResult["FILES"][$id]["SRC"]); ?>"></a>
                                                <? endforeach; ?>
                                            </div>
                                        </div>
                                    <? endif; ?>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product__bottom">
                        <div class="product__action">
                            <div class="product__links"><a class="btn btn_min" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Подробнее</a><a class="btn btn_green btn_min" href="#">Купить</a><a class="dot-link-one-line" href="#" title="Рассрочка/кредит"><span class="dot-link-one-line__name">Рассрочка/кредит</span></a>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="product product_1920">
                    <div class="product__top">
                        <div class="product__row">
                            <div class="product__top-left">
                                <div class="product__name">
                                    <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" title="<?= $arItem["NAME"]; ?>"><?= $oView->getName(); ?></a>
                                </div>
                                <div class="product__props">
                                    <div class="props props_product">
                                        <div class="props__table">
                                            <? foreach ($arItem["PROPERTIES"] as $code => $values): ?>
                                                <? if (strripos($code, "MINI_") === false || empty($values["VALUE"])) continue; ?>
                                                <div class="props__tr">
                                                    <div class="props__td"><?= $values["HINT"] ? $values["HINT"] : $values["NAME"]; ?>:</div>
                                                    <div class="props__td">
                                                        <? if ($values["PROPERTY_TYPE"] == "E"): ?>
                                                            <? $p = $arResult["DOP"]["ITEMS"][$values["VALUE"]]; ?>
                                                            <? $values["VALUE"] = $p["NAME"]; ?>
                                                            <? if ($p["PREVIEW_PICTURE"] > 0): ?>
                                                                <img src="<?= $arResult["DOP"]["FILES"][$p["PREVIEW_PICTURE"]]["SRC"]; ?>" alt="<?= $p["NAME"]; ?>" title="<?= $p["NAME"]; ?>" />
                                                            <? endif; ?>
                                                        <? endif; ?>
                                                        <?= $values["VALUE"]; ?> <?= $values["DESCRIPTION"]; ?>
                                                    </div>
                                                </div>
                                            <? endforeach; ?>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="product__top-right">
                                <div class="product__top-top-right">
                                    <div class="product__left-side">
                                        <div class="product__review product__info-top"><a href="#" title="7 отзывов"><span>7 отзывов</span></a></div>
                                        <div class="product__garant"><img class="img-responsive" src="/local/frontend/build/img/svg/garant-product.svg" alt=""/><span>Гарантия<br/>лучшей цены</span></div>
                                    </div>
                                    <div class="product__right-side">
                                        <div class="product__status product__info-top">
                                            <?= $oView->getStatus(); ?>
                                        </div>
                                        <? foreach( $arItem["PROPERTIES"]["BONUS"]["VALUE"] as $pid ):?>
                                            <div class="product__price-down">
                                                <? $aBonus = \Francysk\Framework\Objects\Bonus::getInstance()->get($pid); ?>
                                                <? if (!empty($aBonus["PREVIEW_PICTURE_SRC"])): ?>
                                                    <img class="img-responsive" src="<?= $aBonus["PREVIEW_PICTURE_SRC"];?>" alt="<?= $aBonus["NAME"];?>" title="<?= $aBonus["NAME"];?>" />
                                                <? endif; ?>

                                                <span><?= $aBonus["PREIEW_TEXT"]; ?></span>
                                            </div>
                                        <? endforeach;?>
                                    </div>
                                </div>



                                <div class="product__gallery">
                                    <div class="product__image" <?if($count > 1):?>data-count="<?= $count ?>"<?endif;?>>
                                        <a class="product__image-more" href="<?= $arItem["NAME"]; ?>" title="<?= $arItem["NAME"]; ?>">
                                            <div class="product__image-more-info">
                                                <img src="/local/frontend/build/img/svg/photo.svg" alt="<?= $arItem["NAME"]; ?>"/><span class="dot-link-one-line__name">Ещё <?= count($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"]); ?> фотографий</span>
                                            </div>
                                        </a>
                                        <div class="product__image-preload">
                                            <div class="swiper-lazy-preloader"></div>
                                        </div>
                                        <div class="product__image-target"><img src="<?= imageResize(["WIDTH" => 288, "HEIGHT" => 162], $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]); ?>"/></div>
                                    </div>

                                    <? if($count > 1): ?>
                                    <div class="product__pagination">
                                        <div class="pagination-line">
                                            <a class="active" href="<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>"></a>
                                            <? $index = 0; ?>
                                            <? foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $id): ?>
                                                <?
                                                    $index++;
                                                    if ($index >= $count) break;
                                                ?>
                                                <a href="<?= imageResize(["WIDTH" => 288, "HEIGHT" => 162], $arResult["FILES"][$id]["SRC"]); ?>"></a>
                                            <? endforeach; ?>
                                        </div>
                                    </div>
                                    <? endif; ?>
                                    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="product__bottom">
                        <div class="product__spec">Специальная цена до 30.12</div>
                        <div class="product__action">
                            <div class="product__links"><a class="btn btn_min" href="<?= $arItem["DETAIL_PAGE_URL"] ?>">Подробнее</a><a class="btn btn_green btn_min" href="#">Купить</a><a class="dot-link-one-line" href="#" title="Рассрочка/кредит"><span class="dot-link-one-line__name">Рассрочка/кредит</span></a>
                            </div>
                            <div class="product__price"><span class="price-old">1 499 999 р.</span><span class="price">1 499 999 р.</span></div>
                        </div>
                    </div>
                </div>
            </div>
        <? endforeach; ?>
<?
$APPLICATION->IncludeComponent("bitrix:system.pagenavigation", "arrows", array(
  "NAV_RESULT" => $arResult["DB"],
));
?>
        <a class="catalog__next" href="#" title="Следующая страница">
            <div class="product-next">
                <div class="product-next__icon"></div>
                <div class="product-next__name">Следующая страница</div>
            </div></a>
</div>