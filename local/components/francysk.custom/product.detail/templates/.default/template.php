<?
$oView = new \Francysk\Framework\View\Card($arResult["ITEMS"][0]);
?>
<div class="detail">
    <div class="detail__top">
        <div class="container">
            <div class="detail__row detail__row-title">
                <div class="detail__col">
                    <div class="detail__title">
                        <h1 class="js-dotdotdot"><? $GLOBALS["APPLICATION"]->showTitle(false); ?></h1>
                    </div>
                </div>
                <div class="detail__col d-tb-none">
                    <div class="detail__info3 d-dt2x-none d-lt-block">
                        <a class="dot-link-one-line" href="">
                            <span class="dot-link-one-line__name">Все товары бренда &#171;Кентавр&#187;</span>
                        </a>
                    </div>
                </div>
            </div>
            <div class="detail__row detail__row-auto">
                <div class="detail__col">
                    <ul class="border-dot-list detail__info1">
                        <li>
                            <?= $oView->getStatus(); ?>                            
                        </li>
                        <li class="d-tb-none">
                            <?= $oView->getCountBuyLink(); ?>                            
                        </li>
                        <li class="d-dt2x-none d-tb-block">
                            <?= $oView->getCountBuyLink(); ?>
                        </li>
                    </ul>
                </div>
                <div class="detail__col"> 
                    <div class="detail__info-row">
                        <ul class="detail__info2">
                            <? foreach ($arResult["ITEMS"][0]["PROPERTIES"]["BONUS"]["VALUE"] as $pid): ?>
                                <? $aBonus = \Francysk\Framework\Objects\Bonus::getInstance()->get($pid); ?>
                                <li class="<?= $aBonus["CODE"]; ?>">
                                    <img src="<?= $aBonus["ICON_SRC"]; ?>" alt="<?= $aBonus["NAME"]; ?>" titile="<?= $aBonus["NAME"]; ?>" />
                                    <span><?= $aBonus["NAME"]; ?></span>                                    
                                </li>
                            <? endforeach; ?>
                            <?
                                // вывод количествао подарков
                                $iCountPodarki = count($arResult["ITEMS"][0]["PROPERTIES"]["BIND_PODAROK"]["VALUE"]);
                            ?>
                            <? if( $iCountPodarki > 0 ): ?>
                                <li class="percent">
                                    <a href="/popup/presents/?id=<?= $arResult["ITEMS"][0]["ID"];?>" class="popup-modal-ajax" title="Подарки">
                                        <img src="/local/frontend/build/img/svg/percent.svg" alt="Подарки" title="Подарки" />
                                        <span><?= $iCountPodarki; ?> <?= Francysk\Framework\Tools\TextDecline::getWordNum($iCountPodarki, ['подарок', 'подарка', 'подарков'])?></span>
                                    </a>
                                </li>
                            <? endif; ?>
                        </ul>
                        <div class="detail__info3 d-lt-none"><a class="dot-link-one-line" href=""><span class="dot-link-one-line__name">Все товары бренда &#171;Кентавр&#187;</span></a></div>
                    </div>
                </div>
            </div>
            <div class="detail__row">
                <div class="detail__col">
                    <div class="detail__gallery">
                        <div class="detail-gallery swiper-container">
                            <div class="swiper-wrapper">                             
                                <? foreach ($arResult["ITEMS"][0]["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $pid): ?>
                                    <div class="swiper-slide">
                                        <div class="swiper-lazy-preloader"></div>
                                        <? if ($arResult["ITEMS"][0]["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]): ?>
                                            <div class="detail-gallery__item">
                                                <a class="detail-gallery__item popup-youtube" href="<?= $arResult["ITEMS"][0]["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key] ?>" style="background-image: url(<?= $arResult["FILES"][$pid]["SRC"]; ?>);">
                                                    <img class="swiper-lazy"  data-src="<?= $arResult["FILES"][$pid]["SRC"]; ?>" alt="<?= $arResult["ITEMS"][0]["NAME"]; ?>" title="<?= $arResult["ITEMS"][0]["NAME"]; ?>">
                                                    <svg class="detail-gallery-thumbs__play">
                                                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-youtube-fill"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        <? else: ?>
                                            <div class="detail-gallery__item">
                                                <img class="swiper-lazy cloudzoom-image" data-cloudzoom="zoomImage:'<?= $arResult["FILES"][$pid]["SRC"]; ?>'" data-src="<?= $arResult["FILES"][$pid]["SRC"]; ?>" alt="<?= $arResult["ITEMS"][0]["NAME"]; ?>" >
                                            </div>
                                        <? endif; ?>
                                    </div>
                                <? endforeach; ?>

                                <div class="swiper-slide"><a class="detail-gallery__item detail-gallery__item-link popup-modal-ajax" href="popup/popup-free-call.html" title="Закажите бесплатный звонок">
                                        <div><img src="/local/frontend/build/img/image3.png" alt="">
                                            <div class="detail-gallery__item-link-text"><span>Закажите бесплатный звонок</span></div>
                                        </div>
                                        <svg class="lupa">
                                        <use xlink:href="img/sprite-custom.svg#svg-icon-lupa"></use>
                                        </svg></a></div>
                                <div class="swiper-slide"><a class="detail-gallery__item detail-gallery__item-link" href="#" title="Задайте вопрос">
                                        <div><img src="/local/frontend/build/img/image2.png" alt="">
                                            <div class="detail-gallery__item-link-text"><span>Задайте вопрос</span></div>
                                        </div>
                                        <svg class="lupa">
                                        <use xlink:href="img/sprite-custom.svg#svg-icon-lupa"></use>
                                        </svg></a></div>

                            </div>
                            <div class="swiper-button-prev-kronos point-animation">
                                <svg>
                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
                                </svg>
                            </div>
                            <div class="swiper-button-next-kronos point-animation">
                                <svg> 
                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
                                </svg>
                            </div>
                        </div>
                        <div class="detail-gallery-thumbs swiper-container">
                            <div class="swiper-wrapper">
                                <? foreach ($arResult["ITEMS"][0]["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $key => $pid): ?>
                                    <div class="swiper-slide">
                                        <? if ($arResult["ITEMS"][0]["PROPERTIES"]["MORE_PHOTO"]["DESCRIPTION"][$key]): ?>
                                            <div class="detail-gallery-thumbs__item">
                                                <a style="background-image: url(<?= $arResult["FILES"][$pid]["SRC"]; ?>);">
                                                    <svg class="detail-gallery-thumbs__play">
                                                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-youtube-fill"></use>
                                                    </svg>
                                                </a>
                                            </div>
                                        <? else: ?>
                                            <div class="swiper-lazy-preloader"></div>
                                            <div class="detail-gallery-thumbs__item">
                                                <a><img class="swiper-lazy" data-src="<?= $arResult["FILES"][$pid]["SRC"]; ?>" alt="<?= $arResult["ITEMS"][0]["NAME"]; ?>" title="<?= $arResult["ITEMS"][0]["NAME"]; ?>"></a>
                                            </div>
                                        <? endif; ?>                                        
                                    </div>
                                <? endforeach; ?>


                                <div class="swiper-slide">
                                    <div class="detail-gallery-thumbs__item"><a style="background-image: url(/local/frontend/build/img/image4.jpg);"></a></div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="detail-gallery-thumbs__item"><a style="background-image: url(/local/frontend/build/img/image5.jpg);"></a></div>
                                </div>
                            </div>
                        </div>
                        <div class="detail-gallery-pagination">
                            Фото <span class="detail-gallery-pagination__active">2 </span> из <span class="detail-gallery-pagination__count">34</span>
                        </div>
                    </div>
                </div>
                <div class="detail__col detail__main">
                    <div class="detail__block">
                        <div class="detail__block-top">
                            <div class="detail__triggers detail__triggers-desktop">
                                <div class="detail-triggers detail-triggers_scroll detail-triggers_scroll_07 swiper-container">
                                    <div class="swiper-wrapper">
                                        <? foreach ($arResult["ITEMS"][0]["PROPERTIES"]["TRIGGERS"]["VALUE"] as $pid): ?>
                                            <? $aTrigger = \Francysk\Framework\Objects\Triggers::getInstance()->get($pid);
											
			

											 ?>
                                            <div class="swiper-slide">
                                                <div class="detail-triggers__item js-tooltip" data-position-x="left;+12" title="<?= $aTrigger["PREVIEW_TEXT"]; ?>">
                                                    <div class="detail-triggers__item-img"><img class="detail-triggers__item-img-normal" src="<?= $aTrigger["PREVIEW_PICTURE_SRC"]; ?>" alt="<?= $aTrigger["NAME"]; ?>"><img class="detail-triggers__item-img-hover" src="<?= $aTrigger["PREVIEW_PICTURE_SRC"]; ?>" alt="<?= $aTrigger["NAME"]; ?>"></div>
                                                    <div class="detail-triggers__item-name js-tooltip-target"><?= $aTrigger["NAME"]; ?></div>
                                                </div>
                                            </div>
                                        <? endforeach; ?>
                                    </div>
                                    <div class="swiper-scrollbar swiper-scrollbar_style-1"></div>
                                </div>
                            </div>
                        </div>
                        <div class="detail__block-bottom">
                            <div class="detail__action">
                                <? if (!empty($arResult["ITEMS"][0]["PROPERTIES"]["DEADLINE"]["VALUE"]) && time() < strtotime($arResult["ITEMS"][0]["PROPERTIES"]["DEADLINE"]["VALUE"]) ): ?>
                                    <div class="detail-action">
                                        <div class="detail-action__text">
                                            До окончания акции<br>&#171;+<?=$iCountPodarki;?> <?= Francysk\Framework\Tools\TextDecline::getWordNum($iCountPodarki, ['подарок', 'подарка', 'подарков'])?>&#187; осталось
                                        </div>
                                        <div class="detail-action__date">
                                            <ul>
                                                <?
                                                    $dTime = strtotime($arResult["ITEMS"][0]["PROPERTIES"]["DEADLINE"]["VALUE"]);
                                                    $dDay = date("d", $dTime);
                                                    $dHour = date("H", $dTime);
                                                    $dMin = date("m", $dTime);
                                                    $dSec = date("s", $dTime);
                                                ?>
                                                <li><span class="js-countUpDeadline" data-start="0" data-end="<?= $dDay; ?>"><?= $dDay; ?></span><span>Д</span></li>
                                                <li class="detail-action__dot"></li>
                                                <li><span class="js-countUpDeadline" data-start="0" data-end="<?= $dHour; ?>"><?= $dHour?></span><span>Ч</span></li>
                                                <li class="detail-action__dot"></li>
                                                <li><span class="js-countUpDeadline" data-start="0" data-end="<?= $dMin; ?>"><?= $dMin?></span><span>М</span></li>
                                                <li class="detail-action__dot"></li>
                                                <li><span class="js-countUpDeadline" data-start="0" data-end="<?= $dSec; ?>"><?= $dSec?></span><span>С</span></li>
                                            </ul>
                                        </div>
                                    </div>
                                <? endif; ?>
                            </div>
                            <div class="detail__price">
                                <div>
                                    <?= $oView->getPrice(); ?>       
                                </div>
                            </div>
                            <div class="detail__buttons">
                                <!--a.btn.btn_green.btn_size21(href="#", title="") Рассчитать цену-->
                                <!--a.btn.btn_size21(href="#", title="") Рассрочка/кредит-->
                                <!--a.btn.btn_green.btn_size21(href="#", title="") Расчёт цены-->
                                <!--a.btn.btn_size21(href="#", title="") Рассрочка/кредит--><a class="btn btn_green btn_size21" href="#" title="">Купить</a><a class="btn btn_size21" href="#" title="">Рассрочка/кредит</a>
                            </div>
                            <div class="detail__links">
                                <ul class="border-dot-list">
                                    <li><a class="dot-link-one-line dot-link-one-line_wrap-mobile" href="#"><span class="dot-link-one-line__name">Сообщить о снижении цены</span><span class="dot-link-one-line__mob"> (Следят <?= $arResult["ITEMS"][0]["PROPERITES"]["COUNT_LOOK"]["VALUE"];?> человек)</span></a></li>
                                    <li><a class="dot-link-one-line dot-link-one-line_wrap-mobile" href="#"><span class="dot-link-one-line__name">Нашли дешевле?</span></a></li>
                                </ul>
                            </div>
                            <div class="detail__views">
                                <?if( $arResult["ITEMS"][0]["PROPERTIES"]["COUNT_LOOK"]["VALUE"] >  0 ):?>
                                    Следят <?= $arResult["ITEMS"][0]["PROPERTIES"]["COUNT_LOOK"]["VALUE"];?> человек
                                <?endif;?>
                            </div>
                        </div>
                    </div>
                    <div class="detail__sert">
                        <div class="detail-sert swiper-container">
                            <div class="swiper-wrapper">
                                <? foreach ($arResult["SERTIFICAT"]["ITEMS"] as $arItem): ?>
                                    <div class="swiper-slide">
                                        <div class="detail-sert__item">
                                            <a href="<?= $arResult["SERTIFICAT"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>" title="<?= $arItem["NAME"]; ?>">
                                                <svg class="lupa">
                                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-lupa"></use>
                                                </svg>
                                                <span class="detail-sert__text"><?= $arItem["NAME"]; ?></span>
                                                <img src="<?= imageResize(["WIDTH" => 121, "HEIGHT" => 169], $arResult["SERTIFICAT"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]); ?>" title="<?= $arItem["NAME"]; ?>" alt="<?= $arItem["NAME"]; ?>" />
                                            </a>
                                        </div>
                                    </div>
                                <? endforeach; ?>                                
                            </div>
                            <div class="swiper-button-prev-kronos point-animation">
                                <svg>
                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-down"></use>
                                </svg>
                            </div>
                            <div class="swiper-button-next-kronos point-animation">
                                <svg>
                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-up"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                    <div class="detail__banner"> 
                        <div class="detail-banner swiper-container">
                            <div class="swiper-wrapper">
                                <div class="swiper-slide">
                                    <div class="detail-banner__item empty"> <span>Баннер</span></div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="detail-banner__item empty"> <span>Баннер</span></div>
                                </div>
                                <div class="swiper-slide">
                                    <div class="detail-banner__item empty"> <span>Баннер</span></div>
                                </div>
                            </div>
                            <div class="swiper-button-prev-kronos point-animation">
                                <svg>
                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
                                </svg>
                            </div>
                            <div class="swiper-button-next-kronos point-animation">
                                <svg>
                                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
                                </svg>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="detail__bottom">
        <div class="container">
            <div class="detail__row detail__row-opt">
                <div class="detail-products-brend-and-share">
                    <a class="detail-products-brend-and-share__brend dot-link-one-line" href="#" title="Все товары бренда &amp;#171;Кентавр&amp;#187;">
                        <span class="dot-link-one-line__name">Все товары бренда &#171;Кентавр&#187;</span>
                    </a>
                    <a class="detail-products-brend-and-share__share dot-link-one-line" href="#" title="Поделиться">
                        <img src="/local/frontend/build/img/svg/share.svg" alt="">
                        <span class="dot-link-one-line__name">Поделиться</span>
                    </a>
                </div>
                <div class="detail__tabs">
                    <div class="tabs">
                        <a class="active js-tab" href="#description" title="Описание">Описание</a>
                        <a class="js-tab" href="#ch" title="">Характеристики</a>
                        <a class="js-tab" href="#comp" title="">Комплектация</a>
                        <a class="js-tab" href="#review" title="">Отзывы<span class="anim-destination"><span data-hover="12">12</span></span></a>
                        <a class="js-tab" href="#naves" title="">Навесное оборудование<span class="anim-destination"><span data-hover="12">12</span></span></a>
                        <a class="js-tab" href="#video" title="">Видео<span class="anim-destination"><span data-hover="356">356</span></span></a>
                        <a class="d-dt2x-none d-tbx-block js-tab" href="#certificates" title="">Сертификаты<span class="anim-destination"><span data-hover="12"> 12</span></span></a>
                    </div>
                </div>
                <div class="detail__opt">
                    <a class="dot-link-one-line" href="#" title="">
                        <img src="/local/frontend/build/img/svg/opt.svg" alt=""><span class="dot-link-one-line__name">Купить оптом</span>
                    </a>
                </div>
            </div>
            <div class="detail__tabs-container">
                <div class="tabs-container">
                    <div class="tabs-container__inner">
                        <div class="tabs-container-head">
                            <div class="tabs-container-head__text js-close-tab">Назад</div>
                            <div class="tabs-container-head__close js-close-tab"></div>
                        </div>
                        <div class="tab-container js-tab-container" id="naves">
                            <div class="detail-bg detail-bg_2" style="background-image: url(img/image6.png)"></div>
                            <div class="detail-content">
                                <div class="detail-naves">
                                    <div class="detail-tab-name detail-tab-name_padding">Навесное оборудование</div>
                                    <? /*
                                      <div class="detail-products">
                                      <?
                                      foreach( $arResult["NAVES"]["ITEMS"] as $arItem ):
                                      $oView = new Francysk\Framework\View\Card($arItem);
                                      ?>
                                      <div class="detail-products__item">
                                      <div class="product product_320">
                                      <div class="product__center">
                                      <div class="product__name"><a class="js-dotdotdot" href="#"><span><??></span></a></div>
                                      <div class="product__status">
                                      <?= $oView->getStatus(); ?>
                                      </div>
                                      <div class="product__image-mob"><img src="<?= $arResult["NAVES"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"];?>" alt="<?= $arItem["NAME"];?>"/></div>
                                      <div class="product__info-bottom">
                                      <div class="product__garant"><img class="img-responsive" src="img/svg/garant-product.svg" alt=""/><span>Гарантия лучшей цены</span></div>
                                      <div class="product__new"><img class="img-responsive" src="img/svg/new.svg" alt=""/><span>Новинка</span></div>
                                      </div>
                                      </div>
                                      <div class="product__full">
                                      <div class="product__price">
                                      <div><span class="price-old">1 499 999</span><span class="price-old price-not-through"> р.</span></div>
                                      <div><span class="price">1 499 999</span><span class="price price-not-through"> р.</span></div>
                                      </div>
                                      <div class="product__link"><a class="btn btn_white" href="#" title="Подробнее">Подробнее</a></div>
                                      </div>
                                      </div>
                                      <div class="product product_960">
                                      <div class="product__top">
                                      <div class="product__row product__row-1">
                                      <div class="product__top-left">
                                      <div class="product__name"><a class="js-dotdotdot" href="#">Flagman RX MTZ Max Pro Edition с японским двигателем Flagman RX MTZ Max Pro Edition с японским двигателем Flagman RX MTZ Max Pro Edition с японским двигателем</a></div>
                                      </div>
                                      <div class="product__top-right">
                                      <div class="product__info-top">
                                      <div class="product__review"><a href="#" title="0 отзывов"><span>0 отзывов</span></a></div>
                                      <div class="product__status">
                                      <div class="status">В наличии</div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      <div class="product__row product__row-2">
                                      <div class="product__top-left">
                                      <div class="product__top-col">
                                      <div class="product__gift-count"><img src="img/svg/gift5.svg" alt="5 подарков"/>Подарков</div>
                                      <div class="product__price">
                                      <div><span class="price-old">1 499 999</span><span class="price-old price-not-through"> р.</span></div>
                                      <div><span class="price">1 499 999</span><span class="price price-not-through"> р.</span></div>
                                      </div>
                                      </div>
                                      <div class="product__top-col">
                                      <div class="product__props">
                                      <div class="props props_product">
                                      <div class="props__table">
                                      <div class="props__tr">
                                      <div class="props__td">Разработано:</div>
                                      <div class="props__td"><img src="img/Belarus3.png" alt="«БелТрактора»"/>«БелТрактора»</div>
                                      </div>
                                      <div class="props__tr">
                                      <div class="props__td">Ширина колеи:</div>
                                      <div class="props__td">1080–1200 мм</div>
                                      </div>
                                      <div class="props__tr">
                                      <div class="props__td">Мощность:</div>
                                      <div class="props__td">24 л. с.</div>
                                      </div>
                                      <div class="props__tr">
                                      <div class="props__td">Колёсная формула:</div>
                                      <div class="props__td">4 × 2</div>
                                      </div>
                                      <div class="props__tr">
                                      <div class="props__td">Тип привода:</div>
                                      <div class="props__td">Прямой</div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      <div class="product__top-right">
                                      <div class="product__gallery">
                                      <div class="product__image" data-count="5"><a class="product__image-more" href="" title="">
                                      <div class="product__image-more-info"><img src="img/svg/photo.svg" alt=""/><span class="dot-link-one-line__name">Ещё 12 фотографий</span></div></a>
                                      <div class="product__image-preload">
                                      <div class="swiper-lazy-preloader"></div>
                                      </div>
                                      <div class="product__image-target"><img src="img/traktor2.jpg" alt=""/></div>
                                      </div>
                                      <div class="product__pagination">
                                      <div class="pagination-line"><a class="active" href="img/photo4.png"></a><a href="img/photo2.png"></a><a href="img/photo4.png"></a><a href="img/photo2.png"></a><a href="img/photo4.png"></a></div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      <div class="product__bottom">
                                      <div class="product__action">
                                      <div class="product__links"><a class="btn btn_min" href="#">Подробнее</a><a class="btn btn_green btn_min" href="#">Купить</a><a class="dot-link-one-line" href="#" title="Рассрочка/кредит"><span class="dot-link-one-line__name">Рассрочка/кредит</span></a>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      <?endforeach;?>
                                      <div class="detail-products__item">
                                      <div class="product product_320">
                                      <div class="product__center">
                                      <div class="product__name"><a class="js-dotdotdot" href="#"><span>Flagman RX MTZ Max Pro Edition с японским двигателем Flagman RX MTZ Max Pro Edition с японским двигателем Flagman RX MTZ Max Pro Edition с японским двигателем</span></a></div>
                                      <div class="product__status">
                                      <div class="status">В наличии</div>
                                      </div>
                                      <div class="product__image-mob"><img src="img/traktor2.jpg" alt=""/></div>
                                      <div class="product__info-bottom">
                                      <div class="product__garant"><img class="img-responsive" src="img/svg/garant-product.svg" alt=""/><span>Гарантия лучшей цены</span></div>
                                      <div class="product__new"><img class="img-responsive" src="img/svg/new.svg" alt=""/><span>Новинка</span></div>
                                      </div>
                                      </div>
                                      <div class="product__full">
                                      <div class="product__price">
                                      <div><span class="price-old">1 499 999</span><span class="price-old price-not-through"> р.</span></div>
                                      <div><span class="price">1 499 999</span><span class="price price-not-through"> р.</span></div>
                                      </div>
                                      <div class="product__link"><a class="btn btn_white" href="#" title="Подробнее">Подробнее</a></div>
                                      </div>
                                      </div>
                                      <div class="product product_960">
                                      <div class="product__top">
                                      <div class="product__row product__row-1">
                                      <div class="product__top-left">
                                      <div class="product__name"><a class="js-dotdotdot" href="#">Flagman RX MTZ Max Pro Edition с японским двигателем Flagman RX MTZ Max Pro Edition с японским двигателем Flagman RX MTZ Max Pro Edition с японским двигателем</a></div>
                                      </div>
                                      <div class="product__top-right">
                                      <div class="product__info-top">
                                      <div class="product__review"><a href="#" title="7 отзывов"><span>7 отзывов</span></a></div>
                                      <div class="product__status">
                                      <div class="status">В наличии</div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      <div class="product__row product__row-2">
                                      <div class="product__top-left">
                                      <div class="product__top-col">
                                      <div class="product__gift-count"><img src="img/svg/gift5.svg" alt="5 подарков"/>Подарков</div>
                                      <div class="product__price">
                                      <div><span class="price-old">1 499 999</span><span class="price-old price-not-through"> р.</span></div>
                                      <div><span class="price">1 499 999</span><span class="price price-not-through"> р.</span></div>
                                      </div>
                                      </div>
                                      <div class="product__top-col">
                                      <div class="product__props">
                                      <div class="props props_product">
                                      <div class="props__table">
                                      <div class="props__tr">
                                      <div class="props__td">Разработано:</div>
                                      <div class="props__td"><img src="img/Belarus3.png" alt="«БелТрактора»"/>«БелТрактора»</div>
                                      </div>
                                      <div class="props__tr">
                                      <div class="props__td">Ширина колеи:</div>
                                      <div class="props__td">1080–1200 мм</div>
                                      </div>
                                      <div class="props__tr">
                                      <div class="props__td">Мощность:</div>
                                      <div class="props__td">24 л. с.</div>
                                      </div>
                                      <div class="props__tr">
                                      <div class="props__td">Колёсная формула:</div>
                                      <div class="props__td">4 × 2</div>
                                      </div>
                                      <div class="props__tr">
                                      <div class="props__td">Тип привода:</div>
                                      <div class="props__td">Прямой</div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      <div class="product__top-right">
                                      <div class="product__gallery">
                                      <div class="product__image" data-count="5"><a class="product__image-more" href="" title="">
                                      <div class="product__image-more-info"><img src="img/svg/photo.svg" alt=""/><span class="dot-link-one-line__name">Ещё 12 фотографий</span></div></a>
                                      <div class="product__image-preload">
                                      <div class="swiper-lazy-preloader"></div>
                                      </div>
                                      <div class="product__image-target"><img src="img/traktor2.jpg" alt=""/></div>
                                      </div>
                                      <div class="product__pagination">
                                      <div class="pagination-line"><a class="active" href="img/photo4.png"></a><a href="img/photo2.png"></a><a href="img/photo4.png"></a><a href="img/photo2.png"></a><a href="img/photo4.png"></a></div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      <div class="product__bottom">
                                      <div class="product__action">
                                      <div class="product__links"><a class="btn btn_min" href="#">Подробнее</a><a class="btn btn_green btn_min" href="#">Купить</a><a class="dot-link-one-line" href="#" title="Рассрочка/кредит"><span class="dot-link-one-line__name">Рассрочка/кредит</span></a>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div>
                                      </div> */ ?>
                                    <div class="banner-block">
                                        <div class="banner-block__col banner-block__col_100">
                                            <div class="banner-products banner-products_100">
                                                <?
                                                foreach ($arResult["NAVES"]["ITEMS"] as $arItem):
                                                    $oViewNaves = new \Francysk\Framework\View\Card($arItem);
                                                    ?>
                                                    <div class="banner-products__item banner-products__item_normal">
                                                        <div class="banner-product banner-product_left">
                                                            <div class="banner-product__normal">
                                                                <div class="banner-product__top">
                                                                    <div class="banner-product__category"><?= $oViewNaves->getCategory(); ?></div>
                                                                    <div class="banner-product__name">
                                                                        <a href="<?= $arItem["DETAIL_PAGE_URL"]; ?>" title="<? ?>"><?= $oViewNaves->getShortName(); ?></a></div>
                                                                    <div class="banner-product__status">
                                                                        <?= $oViewNaves->getStatus(); ?>
                                                                    </div>
                                                                </div>
                                                                <div class="banner-product__bottom">
                                                                    <div class="banner-product__price">
                                                                        <div class="price-old">1 499 999 р.</div>
                                                                        <div class="price">1 499 999 р.</div>
                                                                    </div>
                                                                </div>
                                                                <div class="banner-product__img">
                                                                    <img src="<?= $arResult["NAVES"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>" alt="Flagman RX" draggable="false"/></div>
                                                                <div class="banner-product__zoom">
                                                                    <svg>
                                                                    <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-lupa"></use>
                                                                    </svg>
                                                                </div>
                                                            </div>
                                                            <div class="banner-product__open banner-product-open">
                                                                <div class="banner-product-open__top">
                                                                    <div class="banner-product-open__top-left">
                                                                        <div class="banner-product-open__category"><?= $oViewNaves->getCategory(); ?></div>
                                                                    </div>
                                                                    <div class="banner-product-open__top-right">
                                                                        <div class="banner-product-open__triggers">
                                                                            <ul>
                                                                                <? foreach ($arItem["PROPERTIES"]["BONUS"]["VALUE"] as $pid): ?>
                                                                                    <? $aBonus = \Francysk\Framework\Objects\Bonus::getInstance()->get($pid); ?>
                                                                                    <li class="<?= $aBonus["CODE"]; ?>">
                                                                                        <img src="<?= $aBonus["ICON_SRC"]; ?>" alt="<?= $aBonus["NAME"]; ?>" titile="<?= $aBonus["NAME"]; ?>" />
                                                                                        <span><?= $aBonus["NAME"]; ?></span>                                    
                                                                                    </li>
                                                                                <? endforeach; ?>   
                                                                            </ul>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="banner-product-open__name">
                                                                    <a href="<?= $arItem["DETAIL_URL_PAGE"]; ?>" title="Flagman RX MTZ Edition"><?= $oViewNaves->getShortName(); ?></a></div>
                                                                <div class="banner-product-open__status">
                                                                    <?= $oViewNaves->getStatus(); ?>
                                                                </div>
                                                                <div class="banner-product-open__main">
                                                                    <div class="banner-product-open__main-left">
                                                                        <div class="banner-product-open__price">
                                                                            <div class="js-banner-product-countUp price price_normal" data-end="128 999 р." data-start="0">0</div>
                                                                        </div>
                                                                        <div class="banner-product-open__count">
                                                                            <a class="dot-link-lines" href="#" title="7 654 человек уже купили этот товар!"><span class="dot-link-lines__name">7 654 человек уже купили этот товар!</span></a>
                                                                        </div>
                                                                    </div>
                                                                    <div class="banner-product-open__main-right">
                                                                        <div class="banner-product-open__image" data-count="8"><a class="banner-product-open__image-more" href="" title="">
                                                                                <div class="banner-product-open__image-more-info"><img src="/local/frontend/build/img/svg/photo.svg" alt=""/><span class="dot-link-one-line__name">Ещё 12 фотографий</span></div></a>
                                                                            <div class="banner-product-open__image-preload">
                                                                                <div class="swiper-lazy-preloader"></div>
                                                                            </div>
                                                                            <div class="banner-product-open__image-target"><img src="<?= $arResult["NAVES"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>" alt="Flagman RX MTZ Edition" draggable="false"/></div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                                <div class="banner-product-open__pagination">
                                                                    <div class="pagination-line">
                                                                        <a class="active" href="<?= $arResult["NAVES"]["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"]; ?>" title=""></a>
                                                                        <? foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUES"] as $pid): ?>
                                                                            <a href="<?= $arResult["NAVES"]["FILES"][$pid]["SRC"]; ?>" title=""></a>
                                                                        <? endforeach; ?>
                                                                    </div>
                                                                </div>
                                                                <?
                                                                $APPLICATION->IncludeComponent("francysk.custom:present", "", array("FRANCYSKFRAEMWORK_ENTITY" => "2",
                                                                    "FRANCYSKFRAEMWORK_FUNCTION_DECORATOR" => "",
                                                                    "FRANCYSKFRAEMWORK_SYSTEM" => "1",
                                                                    "GET_SECTION_BOOL" => "N",
                                                                    "IBLOCK_ID" => "2",
                                                                    "IBLOCK_TYPE" => "1c_catalog",));
                                                                ?>
                                                                <div class="banner-product-open__props">
                                                                    <div class="props props_product-banner">
                                                                        <div class="props__table">
                                                                            <? foreach ($arItem["PROPERTIES"] as $code => $values): ?>
                                                                                <? if (strripos($code, "MINI_") === false) continue; ?>
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
                                                                <div class="banner-product-open__action"><a class="btn" href="#" title="">Подробнее</a><a class="btn btn_green" href="#" title="">Купить</a><a class="dot-link-lines" href="#" title=""><span class="dot-link-lines__name">Рассрочка/кредит</span></a>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                <? unset($oViewNaves); endforeach; ?>                                                                                                                                                
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="detail__form">
                                    <div class="detail-form detail-form_1">
                                        <div class="detail-form__name section-title"> <span>Остались вопросы?</span></div>
                                        <div class="detail-form__row detail-form__row-top">
                                            <div class="detail-form__col detail-form__col_max">
                                                <div class="detail-form__text">Мы с удовольствием на них ответим! <br>Ежедневно, с 9:00 до 18:00 </div>
                                            </div>
                                            <div class="detail-form__col">
                                                <form>
                                                    <div class="input-phone" data-lang="ru">
                                                        <label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
                                                        <label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
                                                        <div class="input-phone__row">
                                                            <div class="input-phone__input">
                                                                <div class="input-phone__placeholder" tabindex="0"><span class="input-phone__code">+7 </span><span class="input-phone__phone">___ ___-__-__ </span></div>
                                                                <input id="input-phone" type="tel" placeholder="+7 ___ ___-__-__">
                                                            </div>
                                                            <div class="input-phone__lang">
                                                                <div class="lang" data-lang="ru"><a class="lang__current"><img src="img/Russia.png" alt=""></a>
                                                                    <div class="lang__list">
                                                                        <div class="lang__list-table"><a class="active lang__list-row" data-lang="ru">
                                                                                <div class="lang__list-cell">Россия</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/Russia.png" alt="Россия"></div>
                                                                                </div></a><a class="lang__list-row" data-lang="by">
                                                                                <div class="lang__list-cell">Беларусь</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/Belarus.png" alt="Беларусь"></div>
                                                                                </div></a><a class="lang__list-row" data-lang="kz">
                                                                                <div class="lang__list-cell">Қазақстан</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kazakhstan.png" alt="Қазақстан"></div>
                                                                                </div></a><a class="lang__list-row" data-lang="ky">
                                                                                <div class="lang__list-cell">Кыргыз</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kyrgyzstan.png" alt="Кыргыз"></div>
                                                                                </div></a><a class="lang__list-row" data-lang="arm">
                                                                                <div class="lang__list-cell">Հայաստանի</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/armenia.png" alt="Հայաստանի"></div>
                                                                                </div></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn_white" type="submit">Перезвоните мне</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="detail-form__row detail-form__row-bottom">
                                            <div class="detail-form__col detail-form__col_left">
                                                <div class="detail-form__row detail-form__row-count">
                                                    <div class="detail-form__col detail-form__col_max">
                                                        <div class="detail-form__text2">Мы ежемесячно подсчитываем количество <br>и индекс удовлетворенности наших клиентов. </div>
                                                    </div>
                                                    <div class="detail-form__col">
                                                        <div class="detail-form__count"><span class="js-countUp" data-start="0" data-end="1345" data-increment="1" data-increment-delay="5000">0</span><span class="detail-form__text2">
                                                                человек стали нашими покупателями <br>в прошлом месяце</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-form__col detail-form__col_right">
                                                <div class="detail-form__row detail-form__row-satisfaction">
                                                    <div class="satisfaction-index">
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/1.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent js-countUp" data-start="0" data-end="78" data-suffix="%">0%</div>
                                                                <div class="satisfaction-index__item-text">очень довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/2.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent js-countUp" data-start="0" data-end="19" data-suffix="%">0%</div>
                                                                <div class="satisfaction-index__item-text">довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/3.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent js-countUp" data-start="0" data-end="3" data-suffix="%">0%</div>
                                                                <div class="satisfaction-index__item-text">недовольны</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-container js-tab-container" id="certificates">
                            <div class="detail-bg detail-bg_2" style="background-image: url(img/image6.png)"></div>
                            <div class="detail-content">
                                <div class="detail-certificates">
                                    <div class="detail-tab-name">Сертификаты</div>
                                    <div class="detail-certificates__inner">
                                        <div class="detail-certificates__item"><a href="#" title="">
                                                <svg class="lupa">
                                                <use xlink:href="img/sprite-custom.svg#svg-icon-lupa"></use>
                                                </svg><span class="detail-certificates__text">Увеличить</span><img src="img/sert1.png" alt=""></a></div>
                                        <div class="detail-certificates__item"><a href="#" title="">
                                                <svg class="lupa">
                                                <use xlink:href="img/sprite-custom.svg#svg-icon-lupa"></use>
                                                </svg><span class="detail-certificates__text">Увеличить</span><img src="img/sert1.png" alt=""></a></div>
                                        <div class="detail-certificates__item"><a href="#" title="">
                                                <svg class="lupa">
                                                <use xlink:href="img/sprite-custom.svg#svg-icon-lupa"></use>
                                                </svg><span class="detail-certificates__text">Увеличить</span><img src="img/sert1.png" alt=""></a></div>
                                    </div>
                                </div>
                                <div class="detail__form">
                                    <div class="detail-form detail-form_1">
                                        <div class="detail-form__name section-title"> <span>Остались вопросы?</span></div>
                                        <div class="detail-form__row detail-form__row-top">
                                            <div class="detail-form__col detail-form__col_max">
                                                <div class="detail-form__text">Мы с удовольствием на них ответим! <br>Ежедневно, с 9:00 до 18:00 </div>
                                            </div>
                                            <div class="detail-form__col">
                                                <form>
                                                    <div class="input-phone">
                                                        <label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
                                                        <label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
                                                        <div class="input-phone__row">
                                                            <div class="input-phone__input">
                                                                <input id="input-phone" type="tel" placeholder="+7 ___ ___-__-__">
                                                            </div>
                                                            <div class="input-phone__lang">
                                                                <div class="lang"><a class="js-lang-open"><img src="img/Russia.png" alt=""></a>
                                                                    <div class="lang__list">
                                                                        <div class="lang__list-table"><a class="lang__list-row js-lang-close">
                                                                                <div class="lang__list-cell">Россия</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag lang__flag_active"><img src="img/Russia.png" alt="Россия"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Беларусь</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/Belarus.png" alt="Беларусь"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Қазақстан</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kazakhstan.png" alt="Қазақстан"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Кыргыз</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kyrgyzstan.png" alt="Кыргыз"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Հայաստանի</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/armenia.png" alt="Հայաստանի"></div>
                                                                                </div></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn_white" type="submit">Перезвоните мне</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="detail-form__row detail-form__row-bottom">
                                            <div class="detail-form__col detail-form__col_left">
                                                <div class="detail-form__row detail-form__row-count">
                                                    <div class="detail-form__col detail-form__col_max">
                                                        <div class="detail-form__text2">
                                                            Мы ежемесячно подсчитываем количество 
                                                            и индекс удовлетворенности наших клиентов. 
                                                        </div>
                                                    </div>
                                                    <div class="detail-form__col">
                                                        <div class="detail-form__count"><span>1345</span><span class="detail-form__text2">человек стали нашими покупателями в прошлом месяце</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-form__col detail-form__col_right">
                                                <div class="detail-form__row detail-form__row-satisfaction">
                                                    <div class="satisfaction-index">
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/1.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">78%</div>
                                                                <div class="satisfaction-index__item-text">очень довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/2.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">19%</div>
                                                                <div class="satisfaction-index__item-text">довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/3.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">3%</div>
                                                                <div class="satisfaction-index__item-text">недовольны</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-container active js-tab-container" id="description">
                            <div class="detail-bg detail-bg_2" style="background-image: url(/local/frontend/build/img/image6.png)"></div>
                            <div class="detail-content">
                                <div class="detail-desc">
                                    <div class="detail-tab-name">Описание</div>
                                    <div class="desc">
                                        <div class="desc__inner">
                                            <?= $arResult["ITEMS"][0]["DETAIL_TEXT"]; ?>
                                        </div>
                                    </div>
                                    <div class="detail-btn"><a class="btn btn_min btn_green" href="#" title="Рассчитать цену">Рассчитать цену</a><a class="btn btn_min" href="#" title="Рассрочка/кредит">Рассрочка/кредит</a></div>
                                </div>
                                <div class="detail__form">
                                    <div class="detail-form detail-form_1">
                                        <div class="detail-form__name section-title"> <span>Остались вопросы?</span></div>
                                        <div class="detail-form__row detail-form__row-top">
                                            <div class="detail-form__col detail-form__col_max">
                                                <div class="detail-form__text">Мы с удовольствием на них ответим! <br>Ежедневно, с 9:00 до 18:00 </div>
                                            </div>
                                            <div class="detail-form__col">
                                                <form>
                                                    <div class="input-phone">
                                                        <label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
                                                        <label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
                                                        <div class="input-phone__row">
                                                            <div class="input-phone__input">
                                                                <input id="input-phone" type="tel" placeholder="+7 ___ ___-__-__">
                                                            </div>
                                                            <div class="input-phone__lang">
                                                                <div class="lang"><a class="js-lang-open"><img src="img/Russia.png" alt=""></a>
                                                                    <div class="lang__list">
                                                                        <div class="lang__list-table"><a class="lang__list-row js-lang-close">
                                                                                <div class="lang__list-cell">Россия</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag lang__flag_active"><img src="img/Russia.png" alt="Россия"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Беларусь</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/Belarus.png" alt="Беларусь"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Қазақстан</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kazakhstan.png" alt="Қазақстан"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Кыргыз</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kyrgyzstan.png" alt="Кыргыз"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Հայաստանի</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/armenia.png" alt="Հայաստանի"></div>
                                                                                </div></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn_white" type="submit">Перезвоните мне</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="detail-form__row detail-form__row-bottom">
                                            <div class="detail-form__col detail-form__col_left">
                                                <div class="detail-form__row detail-form__row-count">
                                                    <div class="detail-form__col detail-form__col_max">
                                                        <div class="detail-form__text2">
                                                            Мы ежемесячно подсчитываем количество 
                                                            и индекс удовлетворенности наших клиентов. 
                                                        </div>
                                                    </div>
                                                    <div class="detail-form__col">
                                                        <div class="detail-form__count"><span>1345</span><span class="detail-form__text2">человек стали нашими покупателями в прошлом месяце</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-form__col detail-form__col_right">
                                                <div class="detail-form__row detail-form__row-satisfaction">
                                                    <div class="satisfaction-index">
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/1.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">78%</div>
                                                                <div class="satisfaction-index__item-text">очень довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/2.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">19%</div>
                                                                <div class="satisfaction-index__item-text">довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/3.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">3%</div>
                                                                <div class="satisfaction-index__item-text">недовольны</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-container js-tab-container" id="ch">
                            <div class="detail-bg detail-bg_1" style="background-image: url(/local/frontend/build/img/image.png)"></div>
                            <div class="detail-content">
                                <div class="detail-ch">
                                    <div class="detail-tab-name detail-tab-name_padding">Характеристики</div>
                                    <?= $oView->getHtmlProps();?>                                                                                                                                             
                                </div>
                                <div class="detail__form">
                                    <div class="detail-form detail-form_2">
                                        <div class="detail-form__name">Хотите лично пообщаться с кем-то из наших клиентов?</div>
                                        <div class="detail-form__row detail-form__row-top">
                                            <div class="detail-form__col detail-form__col_max">
                                                <div class="detail-form__text">
                                                    Оставьте номер своего телефона, мы предоставим 
                                                    Вам контакты клиентов, купивших интересующую 
                                                    Вас технику, что бы Вы могли лично узнать обо всех 
                                                    её плюсах и минусах и определиться с выбором. 
                                                </div>
                                            </div>
                                            <div class="detail-form__col">
                                                <form>
                                                    <div class="input-phone">
                                                        <label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
                                                        <label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
                                                        <div class="input-phone__row">
                                                            <div class="input-phone__input">
                                                                <input id="input-phone" type="tel" placeholder="+7 ___ ___-__-__">
                                                            </div>
                                                            <div class="input-phone__lang">
                                                                <div class="lang"><a class="js-lang-open"><img src="img/Russia.png" alt=""></a>
                                                                    <div class="lang__list">
                                                                        <div class="lang__list-table"><a class="lang__list-row js-lang-close">
                                                                                <div class="lang__list-cell">Россия</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag lang__flag_active"><img src="img/Russia.png" alt="Россия"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Беларусь</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/Belarus.png" alt="Беларусь"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Қазақстан</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kazakhstan.png" alt="Қазақстан"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Кыргыз</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kyrgyzstan.png" alt="Кыргыз"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Հայաստանի</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/armenia.png" alt="Հայաստանի"></div>
                                                                                </div></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn_white" type="submit">Отправить</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="detail-form__row detail-form__row-bottom">
                                            <div class="detail-form__col detail-form__col_left">
                                                <div class="detail-form__row detail-form__row-count">
                                                    <div class="detail-form__col detail-form__col_max">
                                                        <div class="detail-form__text2">
                                                            Мы ежемесячно подсчитываем количество 
                                                            и индекс удовлетворенности наших клиентов. 
                                                        </div>
                                                    </div>
                                                    <div class="detail-form__col">
                                                        <div class="detail-form__count"><span>1345</span><span class="detail-form__text2">человек стали нашими покупателями в прошлом месяце</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-form__col detail-form__col_right">
                                                <div class="detail-form__row detail-form__row-satisfaction">
                                                    <div class="satisfaction-index">
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/1.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">78%</div>
                                                                <div class="satisfaction-index__item-text">очень довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/2.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">19%</div>
                                                                <div class="satisfaction-index__item-text">довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/3.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">3%</div>
                                                                <div class="satisfaction-index__item-text">недовольны</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-container js-tab-container" id="comp">
                            <div class="detail-bg detail-bg_2" style="background-image: url(/local/frontend/build/img/image6.png)"></div>
                            <div class="detail-content">
                                <div class="detail-comp">
                                    <div class="detail-tab-name">Комплектация</div>
                                    <div class="detail-comp__inner">
                                        <?
                                        $iCount = count($oView->getComplectacia());
                                        $index = 1;
                                        ?>
                                        <? foreach ($oView->getComplectacia() as $pid => $value): ?>
                                            <? if ($index === 1): ?>
                                                <div class="detail-comp__item">                                                    
                                                    <ul>
                                                    <? endif; ?>
                                                    <li><?= $value ?></li>                                                
                                                    <? if ($index % 5 == 0 || ($pid + 1) == $iCount): ?>
                                                    </ul>
                                                </div>
                                                <?
                                                $index = 0;
                                            endif;
                                            ++$index;
                                            ?>
                                        <? endforeach; ?>                                        
                                    </div>
                                </div>
                                <div class="detail__form">
                                    <div class="detail-form detail-form_1">
                                        <div class="detail-form__name section-title"> <span>Остались вопросы?</span></div>
                                        <div class="detail-form__row detail-form__row-top">
                                            <div class="detail-form__col detail-form__col_max">
                                                <div class="detail-form__text">Мы с удовольствием на них ответим! <br>Ежедневно, с 9:00 до 18:00 </div>
                                            </div>
                                            <div class="detail-form__col">
                                                <form>
                                                    <div class="input-phone">
                                                        <label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
                                                        <label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
                                                        <div class="input-phone__row">
                                                            <div class="input-phone__input">
                                                                <input id="input-phone" type="tel" placeholder="+7 ___ ___-__-__">
                                                            </div>
                                                            <div class="input-phone__lang">
                                                                <div class="lang"><a class="js-lang-open"><img src="img/Russia.png" alt=""></a>
                                                                    <div class="lang__list">
                                                                        <div class="lang__list-table"><a class="lang__list-row js-lang-close">
                                                                                <div class="lang__list-cell">Россия</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag lang__flag_active"><img src="img/Russia.png" alt="Россия"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Беларусь</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/Belarus.png" alt="Беларусь"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Қазақстан</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kazakhstan.png" alt="Қазақстан"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Кыргыз</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kyrgyzstan.png" alt="Кыргыз"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Հայաստանի</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/armenia.png" alt="Հայաստանի"></div>
                                                                                </div></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn_white" type="submit">Перезвоните мне</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="detail-form__row detail-form__row-bottom">
                                            <div class="detail-form__col detail-form__col_left">
                                                <div class="detail-form__row detail-form__row-count">
                                                    <div class="detail-form__col detail-form__col_max">
                                                        <div class="detail-form__text2">
                                                            Мы ежемесячно подсчитываем количество 
                                                            и индекс удовлетворенности наших клиентов. 
                                                        </div>
                                                    </div>
                                                    <div class="detail-form__col">
                                                        <div class="detail-form__count"><span>1345</span><span class="detail-form__text2">человек стали нашими покупателями в прошлом месяце</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-form__col detail-form__col_right">
                                                <div class="detail-form__row detail-form__row-satisfaction">
                                                    <div class="satisfaction-index">
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/1.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">78%</div>
                                                                <div class="satisfaction-index__item-text">очень довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/2.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">19%</div>
                                                                <div class="satisfaction-index__item-text">довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/3.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">3%</div>
                                                                <div class="satisfaction-index__item-text">недовольны</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-container js-tab-container" id="video">
                            <div class="detail-bg detail-bg_1" style="background-image: url(/local/frontend/build/img/image.png)"></div>
                            <div class="detail-content">

                                <?
                                $APPLICATION->IncludeComponent("francysk.custom:video", "card", [
                                    "FRANCYSKFRAEMWORK_ENTITY" => "2",
                                    "FRANCYSKFRAEMWORK_FUNCTION_DECORATOR" => "",
                                    "FRANCYSKFRAEMWORK_SYSTEM" => "1",
                                    "GET_SECTION_BOOL" => "N",
                                    "IBLOCK_ID" => "7",
                                    "PRODUCT_ID" => $arResult["ITEMS"][0]["ID"],
                                ]);
                                ?>
                            </div>
                            <div class="detail__form">
                                <div class="detail-form detail-form_2">
                                    <div class="detail-form__name">Хотите лично пообщаться с кем-то из наших клиентов?</div>
                                    <div class="detail-form__row detail-form__row-top">
                                        <div class="detail-form__col detail-form__col_max">
                                            <div class="detail-form__text">
                                                Оставьте номер своего телефона, мы предоставим 
                                                Вам контакты клиентов, купивших интересующую 
                                                Вас технику, что бы Вы могли лично узнать обо всех 
                                                её плюсах и минусах и определиться с выбором. 
                                            </div>
                                        </div>
                                        <div class="detail-form__col">
                                            <form>
                                                <div class="input-phone">
                                                    <label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
                                                    <label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
                                                    <div class="input-phone__row">
                                                        <div class="input-phone__input">
                                                            <input id="input-phone" type="tel" placeholder="+7 ___ ___-__-__">
                                                        </div>
                                                        <div class="input-phone__lang">
                                                            <div class="lang"><a class="js-lang-open"><img src="img/Russia.png" alt=""></a>
                                                                <div class="lang__list">
                                                                    <div class="lang__list-table"><a class="lang__list-row js-lang-close">
                                                                            <div class="lang__list-cell">Россия</div>
                                                                            <div class="lang__list-cell">
                                                                                <div class="lang__flag lang__flag_active"><img src="img/Russia.png" alt="Россия"></div>
                                                                            </div></a><a class="lang__list-row" href="#">
                                                                            <div class="lang__list-cell">Беларусь</div>
                                                                            <div class="lang__list-cell">
                                                                                <div class="lang__flag"><img src="img/Belarus.png" alt="Беларусь"></div>
                                                                            </div></a><a class="lang__list-row" href="#">
                                                                            <div class="lang__list-cell">Қазақстан</div>
                                                                            <div class="lang__list-cell">
                                                                                <div class="lang__flag"><img src="img/kazakhstan.png" alt="Қазақстан"></div>
                                                                            </div></a><a class="lang__list-row" href="#">
                                                                            <div class="lang__list-cell">Кыргыз</div>
                                                                            <div class="lang__list-cell">
                                                                                <div class="lang__flag"><img src="img/kyrgyzstan.png" alt="Кыргыз"></div>
                                                                            </div></a><a class="lang__list-row" href="#">
                                                                            <div class="lang__list-cell">Հայաստանի</div>
                                                                            <div class="lang__list-cell">
                                                                                <div class="lang__flag"><img src="img/armenia.png" alt="Հայաստանի"></div>
                                                                            </div></a></div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <button class="btn btn_white" type="submit">Отправить</button>
                                            </form>
                                        </div>
                                    </div>
                                    <div class="detail-form__row detail-form__row-bottom">
                                        <div class="detail-form__col detail-form__col_left">
                                            <div class="detail-form__row detail-form__row-count">
                                                <div class="detail-form__col detail-form__col_max">
                                                    <div class="detail-form__text2">
                                                        Мы ежемесячно подсчитываем количество 
                                                        и индекс удовлетворенности наших клиентов. 
                                                    </div>
                                                </div>
                                                <div class="detail-form__col">
                                                    <div class="detail-form__count"><span>1345</span><span class="detail-form__text2">человек стали нашими покупателями в прошлом месяце</span></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="detail-form__col detail-form__col_right">
                                            <div class="detail-form__row detail-form__row-satisfaction">
                                                <div class="satisfaction-index">
                                                    <div class="satisfaction-index__item">
                                                        <div class="satisfaction-index__item-img"><img src="/local/frontend/build/img/1.png" alt=""></div>
                                                        <div class="satisfaction-index__item-info">
                                                            <div class="satisfaction-index__item-percent">78%</div>
                                                            <div class="satisfaction-index__item-text">очень довольны</div>
                                                        </div>
                                                    </div>
                                                    <div class="satisfaction-index__item">
                                                        <div class="satisfaction-index__item-img"><img src="/local/frontend/build/img/2.png" alt=""></div>
                                                        <div class="satisfaction-index__item-info">
                                                            <div class="satisfaction-index__item-percent">19%</div>
                                                            <div class="satisfaction-index__item-text">довольны</div>
                                                        </div>
                                                    </div>
                                                    <div class="satisfaction-index__item">
                                                        <div class="satisfaction-index__item-img"><img src="/local/frontend/build/img/3.png" alt=""></div>
                                                        <div class="satisfaction-index__item-info">
                                                            <div class="satisfaction-index__item-percent">3%</div>
                                                            <div class="satisfaction-index__item-text">недовольны</div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="tab-container js-tab-container" id="review">
                            <div class="detail-bg detail-bg_2" style="background-image: url(/local/frontend/build/img/image6.png)"></div>
                            <div class="detail-content">
                                <?
                                $APPLICATION->IncludeComponent(
                                        "francysk.custom:reviews", "", Array(
                                    "ELEMENT_COUNT" => "",
                                    "FRANCYSKFRAEMWORK_ENTITY" => "2",
                                    "FRANCYSKFRAEMWORK_FUNCTION_DECORATOR" => "collectSection",
                                    "FRANCYSKFRAEMWORK_SYSTEM" => "1",
                                    "GET_SECTION_BOOL" => "N",
                                    "IBLOCK_ID" => "9",
                                    "IBLOCK_TYPE" => "media",
                                    "SORT_FIELD_1" => "SORT",
                                    "SORT_FIELD_2" => "NAME",
                                    "SORT_VALUE_1" => "asc",
                                    "SORT_VALUE_2" => "",
                                    "CLASS" => "reviews_product",
                                        )
                                );
                                ?>

                                <div class="detail__form">
                                    <div class="detail-form detail-form_1">
                                        <div class="detail-form__name section-title"> <span>Остались вопросы?</span></div>
                                        <div class="detail-form__row detail-form__row-top">
                                            <div class="detail-form__col detail-form__col_max">
                                                <div class="detail-form__text">Мы с удовольствием на них ответим! <br>Ежедневно, с 9:00 до 18:00 </div>
                                            </div>
                                            <div class="detail-form__col">
                                                <form>
                                                    <div class="input-phone">
                                                        <label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
                                                        <label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
                                                        <div class="input-phone__row">
                                                            <div class="input-phone__input">
                                                                <input id="input-phone" type="tel" placeholder="+7 ___ ___-__-__">
                                                            </div>
                                                            <div class="input-phone__lang">
                                                                <div class="lang"><a class="js-lang-open"><img src="img/Russia.png" alt=""></a>
                                                                    <div class="lang__list">
                                                                        <div class="lang__list-table"><a class="lang__list-row js-lang-close">
                                                                                <div class="lang__list-cell">Россия</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag lang__flag_active"><img src="img/Russia.png" alt="Россия"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Беларусь</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/Belarus.png" alt="Беларусь"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Қазақстан</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kazakhstan.png" alt="Қазақстан"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Кыргыз</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/kyrgyzstan.png" alt="Кыргыз"></div>
                                                                                </div></a><a class="lang__list-row" href="#">
                                                                                <div class="lang__list-cell">Հայաստանի</div>
                                                                                <div class="lang__list-cell">
                                                                                    <div class="lang__flag"><img src="img/armenia.png" alt="Հայաստանի"></div>
                                                                                </div></a></div>
                                                                    </div>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <button class="btn btn_white" type="submit">Перезвоните мне</button>
                                                </form>
                                            </div>
                                        </div>
                                        <div class="detail-form__row detail-form__row-bottom">
                                            <div class="detail-form__col detail-form__col_left">
                                                <div class="detail-form__row detail-form__row-count">
                                                    <div class="detail-form__col detail-form__col_max">
                                                        <div class="detail-form__text2">
                                                            Мы ежемесячно подсчитываем количество 
                                                            и индекс удовлетворенности наших клиентов. 
                                                        </div>
                                                    </div>
                                                    <div class="detail-form__col">
                                                        <div class="detail-form__count"><span>1345</span><span class="detail-form__text2">человек стали нашими покупателями в прошлом месяце</span></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="detail-form__col detail-form__col_right">
                                                <div class="detail-form__row detail-form__row-satisfaction">
                                                    <div class="satisfaction-index">
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/1.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">78%</div>
                                                                <div class="satisfaction-index__item-text">очень довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/2.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">19%</div>
                                                                <div class="satisfaction-index__item-text">довольны</div>
                                                            </div>
                                                        </div>
                                                        <div class="satisfaction-index__item">
                                                            <div class="satisfaction-index__item-img"><img src="img/3.png" alt=""></div>
                                                            <div class="satisfaction-index__item-info">
                                                                <div class="satisfaction-index__item-percent">3%</div>
                                                                <div class="satisfaction-index__item-text">недовольны</div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

