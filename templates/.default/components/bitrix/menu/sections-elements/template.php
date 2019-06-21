<?if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();?>

<?if (!empty($arResult)):?>

    <div class="menu">
        <ul>
            <?php
            $previousLevel = 0;

            foreach($arResult as $arItem):?>
            <?if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel):?>
                <?=str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"]));?>
            <?endif?>

            <?if ($arItem["IS_PARENT"]):?>

            <?if ($arItem["DEPTH_LEVEL"] == 1):?>
            <?php
            //showme_var($arItem);
            ?>
            <li class="<?if ($arItem['SELECTED']):?>section--active <?else:?>section <?endif?>menu-drop-item">
                <a href="<?=$arItem["LINK"]?>" class="<?if ($arItem['SELECTED']):?> name--active <?else:?>name <?endif?>btn-wave">
                    <span class="btn-wave-container">
                        <span class="link-text"><?=$arItem["TEXT"]?></span>
                        <span class="link-hover"><?=$arItem["TEXT"]?></span>
                    </span>
                </a>

                <span class="menu__drop-bg"></span>

                <ul class="<?if ($arItem['SELECTED']):?>element-list--active <?else:?>element-list <?endif?>menu__drop">
                    <?else:?>
                    <li class="<?if ($arItem['SELECTED']):?>element-list__item--active <?else:?>element-list__item<?endif?>">
                        <a href="<?=$arItem["LINK"]?>" class="parent <?if ($arItem['SELECTED']):?>item-selected <?endif?>btn-wave">
                            <span class="btn-wave-container">
                                <span class="link-text"><?=$arItem["TEXT"]?></span>
                                <span class="link-hover"><?=$arItem["TEXT"]?></span>
                            </span>
                        </a>

                        <ul>
                            <?endif?>

                            <?else:?>
                                <?if ($arItem["PERMISSION"] > "D"):?>

                                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                        <li class="<?if ($arItem['SELECTED']):?>section--almost-active <?else:?>section<?endif?>">
                                            <a href="<?=$arItem["LINK"]?>" class="<?if ($arItem['SELECTED']):?>name name--active <?else:?>name <?endif?>btn-wave">
                                                <span class="btn-wave-container">
                                                    <span class="link-text"><?=$arItem["TEXT"]?></span>
                                                    <span class="link-hover"><?=$arItem["TEXT"]?></span>
                                                </span>
                                            </a>
                                        </li>
                                    <?else:?>
                                        <li class="<?if ($arItem['SELECTED']):?>element-list__item--active <?else:?>element-list__item<?endif?>">



                                            <a href="<?=$arItem["LINK"]?>" class=" <?if ($arItem["SELECTED"]):?>item-selected <?endif?>btn-wave" data-image="">

                                                <?$res = CIBlockElement::GetByID($arItem["PARAMS"]["ID"]);if($obRes = $res->GetNextElement()){$ar_icon = $obRes->GetProperty("UF_ICON");}?>

                                                <span class="menu__drop-icon"><img src="<?=CFile::GetPath($ar_icon["VALUE"])?>" alt=""></span>

                                                <span class="btn-wave-container">
                                                    <span class="link-text"><?=$arItem["TEXT"]?></span>
                                                    <span class="link-hover"><?=$arItem["TEXT"]?></span>
                                                </span>
                                            </a>
                                        </li>
                                    <?endif?>

                                <?else:?>

                                    <?if ($arItem["DEPTH_LEVEL"] == 1):?>
                                        <li class="<?if ($arItem['SELECTED']):?>section--almost-active <?else:?>section<?endif?>">
                                            <a href="<?=$arItem["LINK"]?>" class="<?if ($arItem['SELECTED']):?>name name--active <?else:?>name <?endif?>btn-wave" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">
                                                <span class="btn-wave-container">
                                                    <span class="link-text"><?=$arItem["TEXT"]?></span>
                                                    <span class="link-hover"><?=$arItem["TEXT"]?></span>
                                                </span>
                                            </a>
                                        </li>
                                    <?else:?>
                                        <li class="<?if ($arItem['SELECTED']):?>element-list__item--active <?else:?>element-list__item<?endif?>">
                                            <a href="<?=$arItem["CODE"]?>" class="denied btn-wave" title="<?=GetMessage("MENU_ITEM_ACCESS_DENIED")?>">
                                                <span class="btn-wave-container">
                                                    <span class="link-text"><?=$arItem["TEXT"]?></span>
                                                    <span class="link-hover"><?=$arItem["TEXT"]?></span>
                                                </span>
                                            </a>
                                        </li>
                                    <?endif?>

                                <?endif?>

                            <?endif?>

                            <?$previousLevel = $arItem["DEPTH_LEVEL"];?>

                            <?endforeach?>

                            <?if ($previousLevel > 1)://close last item tags?>
                                <?=str_repeat("</ul></li>", ($previousLevel-1) );?>
                            <?endif?>

                        </ul>
    </div>

<?endif?>


