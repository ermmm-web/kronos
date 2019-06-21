<?if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();
/** @var array $arParams */
/** @var array $arResult */
/** @global CMain $APPLICATION */
/** @global CUser $USER */
/** @global CDatabase $DB */
/** @var CBitrixComponentTemplate $this */
/** @var string $templateName */
/** @var string $templateFile */
/** @var string $templateFolder */
/** @var string $componentPath */
/** @var CBitrixComponent $component */
$this->setFrameMode(true);
?>


<div class="banner">
    <div class="banner__slider swiper-container js-swiper" id="banner-slider">
        <div class="swiper-wrapper">

            <?foreach($arResult["ITEMS"] as $arItem):?>
            <div class="swiper-slide">
                <div class="banner-slide">
                    <div class="banner-slide__desktop" style="background-image: url(<?=$arItem["PREVIEW_PICTURE"]["SRC"]?>);padding-top:29%;">
                        <!--.banner-slide__mask-->
                        <!--  .banner-slide__mask-inner(style="background-image: url(/local/frontend/build/img/slide.png);")-->
                    </div>
                    <div class="container">
                        <div class="banner-slide__tablet" style="width: 65%;"><img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt=""></div>
                        <div class="banner-slide__mobile"><img src="<?=$arItem["DETAIL_PICTURE"]["SRC"]?>" alt="" /></div>
                        <div class="banner-slide__inner">
                            <div class="banner-slide__info">
                                <div class="banner-slide__name">
                                    <div class="banner-slide__name-text"><?echo $arItem["NAME"]?></div>
                                </div>
                                <div class="banner-slide__desc">
                                    <div class="banner-slide__desc-text"><?echo $arItem["PREVIEW_TEXT"];?></div>
                                </div>
                                <div class="banner-slide__button">
                                    <div class="banner-slide__button-text"><a class="btn btn_transparent" href="<?=$arItem["PROPERTIES"]['UF_LINK']['VALUE']?>" title="<?echo $arItem["NAME"]?>">Подробнее</a></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?endforeach;?>
        </div>
        <div class="banner-pagination-wrapper">
            <div class="container">
                <div class="banner-pagination"></div>
            </div>
        </div>
    </div>
</div>