<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul>
        <?
            $previousLevel = 0;
            foreach ($arResult as $arItem): 
                if( $arItem["PARAMS"]["FROM_IBLOCK"] && $arItem["DEPTH_LEVEL"] >= 3 ) continue;
        ?>
            <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
                <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
            <? endif;?>
            <? if ($arItem["IS_PARENT"] && !($arItem["PARAMS"]["FROM_IBLOCK"] && $arItem["DEPTH_LEVEL"] == 2)): ?>
                <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                    <li class="menu-drop-item">
                        <a href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"];?>" class="btn-wave <? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?>root-item<? endif ?>">
                            <div class="btn-wave-container">
                                <? \Francysk\Framework\View\Base::textHtmlEffect($arItem["TEXT"]); ?>                                
                            </div>
                        </a>
                        <div class="menu__drop menu__drop-catalog">
                            <div class="menu__drop-bg"></div>
                                <ul>
                <? else: ?>
                    <li<? if ($arItem["SELECTED"]): ?> class="item-selected"<? endif ?>><a href="<?= $arItem["LINK"] ?>" class="parent"><?= $arItem["TEXT"] ?></a>
                                <ul>
                <? endif ?>
            <? else: ?>
                <? if ($arItem["PERMISSION"] > "D"): ?>
                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                        <li>
                            <a href="<?= $arItem["LINK"] ?>" class="btn-wave <? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?>root-item<? endif ?>">
                                <div class="btn-wave-container">
                                    <span class="link-text">
                                        <? 
                                            $aText = preg_split('//u', $arItem["TEXT"], -1, PREG_SPLIT_NO_EMPTY);
                                            $sText = implode("</span><span>", $aText);
                                        ?>
                                        <span><?= $sText;?></span>
                                    </span>
                                    <span class="link-hover">
                                        <span><?= $sText;?></span>
                                    </span>
                                </div>
                            </a>
                        </li>
                    <? else:?>
                        <li<? if ($arItem["SELECTED"]): ?> class="item-selected"<? endif ?>>
                            <a href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"];?>">
                                <?if( !empty($arItem["PARAMS"]["ICON"]) ):?>
                                    <div class="menu__drop-icon">
                                        <img src="<?= $arItem["PARAMS"]["ICON"];?>" alt="<?= $arItem["TEXT"];?>" title="<?= $arItem["TEXT"];?>">
                                    </div>
                                <?endif;?>
                                <?= $arItem["TEXT"] ?>
                            </a>                                
                        </li>
                    <? endif ?>

                <? else: ?>

                                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                                        <li><a href="" class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?>root-item<? endif ?>" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a></li>
                                    <? else: ?>
                                        <li><a href="" class="denied" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a></li>
                                    <? endif ?>

                                <? endif ?>

                            <? endif ?>

                            <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

                        <? endforeach ?>

                        <? if ($previousLevel > 1)://close last item tags?>
                            <?= str_repeat("</ul></li>", ($previousLevel - 1)); ?>
    <? endif ?>

                    </ul>
                    <div class="menu-clear-left"></div>
<? endif ?>          