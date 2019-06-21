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

<div class="clients-section__faq">
    <div class="section-nav"><h2 class="clients-section__title">Часто задаваемые вопросы</h2></div>
    <div class="faq js-custom-scroll-y">
        <ul class="accordion accordion_mobile-popup">
            <?foreach($arResult["ITEMS"] as $arItem):?>
                <li class="accordion__item"><span class="accordion__head"><?echo $arItem["NAME"]?></span>
                    <div class="accordion__body">
                        <div class="accordion__close">Назад</div>
                        <div class="accordion__body-wrap"><?echo $arItem["PREVIEW_TEXT"];?></div>
                    </div>
                </li>
            <?endforeach;?>
        </ul>
        <ul class="accordion__accordion accordion_mobile-popup">
            <?foreach($arResult["ITEMS"] as $arItem):?>
            <li class="accordion__item accordion__item_hide"><span class="accordion__head"><?echo $arItem["NAME"]?></span>
                <div class="accordion__body">
                    <div class="accordion__close">Назад</div>
                    <div class="accordion__body-wrap"><?echo $arItem["PREVIEW_TEXT"];?></div>
                </div>
            </li>
            <?endforeach;?>
        </ul>
        <div class="faq__btn">
            <button class="btn btn_white">Все вопросы</button>
        </div>
    </div>
</div>

