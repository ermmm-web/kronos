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


<div class="triggers swiper-container swiper-no-swiping js-swiper">
    <div class="swiper-wrapper">

        <?foreach($arResult["ITEMS"] as $arItem):?>
        <div class="swiper-slide">
            <div class="trigger-item">
                <div class="trigger-item__normal">
                    <div class="trigger-item__icon">
                        <div class="trigger-item__icon-container"><img src="/local/frontend/build/img/trigger4.svg" alt="Бесплатная доставка до порога" /></div>
                    </div>
                    <div class="trigger-item__content">
                        <div class="trigger-item__text"><?echo $arItem["NAME"]?></div>
<!--                        <div class="trigger-item__info-text">По всей Беларуси!</div>-->
                    </div>
                </div>
                <div class="trigger-item__js">
                    <div class="trigger-item__blobs">
                        <div></div>
                    </div>
                    <div class="trigger-item__icon">
                        <div class="trigger-item__icon-container"><img src="/local/frontend/build/img/trigger4.svg" alt="<?echo $arItem["NAME"]?>" /></div>
                    </div>
                    <div class="trigger-item__hover">
                        <div class="trigger-item__full">
                            <div class="trigger-item__desc"><?echo $arItem["PREVIEW_TEXT"];?></div>
                            <div class="trigger-item__link"><a class="dot-link-one-line" href="#" title="Бесплатная доставка до порога"><span class="dot-link-one-line__name">Подробнее</span></a></div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <?endforeach;?>

    </div>
    <div class="swiper-button swiper-button-prev-kronos swiper-button-prev-kronos_gray point-animation">
        <svg>
            <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
        </svg>
    </div>
    <div class="swiper-button swiper-button-next-kronos swiper-button-next-kronos_gray point-animation">
        <svg>
            <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
        </svg>
    </div>
</div>



