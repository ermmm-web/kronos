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

<div class="content-head__video-name"><a class="dot-link-one-line dot-link-one-line_arrow point-animation" href="#" title="Все видео"><span class="dot-link-one-line__name">Все видео</span><svg class="dot-link-one-line__arrow"><use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use></svg></a></div>
<div class="content-head__video-content">
    <div class="video-gallery video-gallery_head2 swiper-container js-swiper" data-sync="#banner-slider">
        <div class="video-gallery-info">
            <div class="video-gallery__title">Как выбрать лучший трактор</div>
            <ul class="video-gallery__nav">
                <li class="dot-link-one-line"><a class="dot-link-one-line__name" href="#">Все видео</a></li>
                <li class="dot-link-one-line"><a class="dot-link-one-line__name" href="#">Подпишитесь на наш канал</a></li>
            </ul>
        </div>
        <div class="swiper-wrapper">

            <?foreach($arResult["ITEMS"] as $k => $arItem):?>
                <?if($k==0 || $k==3 || $k==6 || $k==9):?><div class="swiper-slide"><?endif;?>
                <div class="video-gallery__item">
                    <a class="video popup-youtube-gallery" href="<?=$arItem["PROPERTIES"]['LINK_YOUTUBE']['VALUE']?>">
                        <div class="video__bg" style="background-image: url(<?=imageResize(["WIDTH" => 448, "HEIGHT" => 252], $arItem["PREVIEW_PICTURE"]["SRC"]); ?>)"></div>
                        <div class="video__play"></div>
                        <div class="video__content">
                            <div class="video__content-top">
                                <div class="video__group">Видеообзор</div>
                            </div>
                            <div class="video__content-bottom">
                                <div class="video__name"><?echo $arItem["NAME"]?></div>
                                <div class="video__time"><?=$arItem["PROPERTIES"]['TIME']['VALUE']?></div>
                            </div>
                        </div>
                    </a>
                </div>
                <?if($k==1 || $k==4 || $k==7 || $k==10):?></div><?endif;?>
            <?endforeach;?>

        </div>
        <div class="swiper-button-prev-kronos swiper-button-prev-kronos_gray point-animation">
            <svg>
                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-left"></use>
            </svg>
        </div>
        <div class="swiper-button-next-kronos swiper-button-next-kronos_gray point-animation">
            <svg>
                <use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-right"></use>
            </svg>
        </div>
        <div class="swiper-pagination swiper-pagination-kronos"></div>
    </div>
</div>