<? if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true) die(); ?>

<? if (!empty($arResult)): ?>
    <ul class="level-1">
        <?
            $previousLevel = 0;
            foreach ($arResult as $arItem):
        ?>
            <? if ($previousLevel && $arItem["DEPTH_LEVEL"] < $previousLevel): ?>
                <?= str_repeat("</ul></li>", ($previousLevel - $arItem["DEPTH_LEVEL"])); ?>
            <? endif;?>
            <? if ($arItem["IS_PARENT"]): ?>
                <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                    <li class="nav-drop">
                        <a target="" class="nav-drop-expander" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"];?>" class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?><? endif ?>">&nbsp;</a>                        
                        <a target="" class="nav-drop-text" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"];?>" class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?><? endif ?>">
                             <?= $arItem["TEXT"];?>
                        </a>                        
                        <div class="nav__ul">
                            <ul class="level-2">
                <? else: ?>
                    <li class="nav-drop">
                        <a target="" class="nav-drop-expander" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"];?>" class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?><? endif ?>">&nbsp;</a>                        
                        <a target="" class="nav-drop-text" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"];?>" class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?><? endif ?>">
                            <?= $arItem["TEXT"] ?>
                            <div class="nav__img">
                                <div class="nav__img-content">
                                    <div class="nav__img-content-inner"><img src="/local/frontend/build/img/mini.png" alt=""></div>
                                </div>
                                <div class="nav__img-arrow"></div>
                                <div class="nav__img-arrow-white"></div>
                            </div>
                        </a>                        
					
                        <div class="nav__ul">
                            <ul class="level-3">
                <? endif ?>
            <? else: ?>
                <? if ($arItem["PERMISSION"] > "D"): ?>
                    <? if ($arItem["DEPTH_LEVEL"] == 1): ?>
                        <li>
                            <a target="" href="<?= $arItem["LINK"] ?>" class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?>root-item<? endif ?>">
                                <?= $arItem["TEXT"];?>
                            </a>
                        </li>
                    <? else:?>
                        <li <?= $arItem["DEPTH_LEVEL"] > 2 ? 'class="nav-dot"' : '';?>>
                            <a target="" href="<?= $arItem["LINK"] ?>" title="<?= $arItem["TEXT"];?>">
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
                        <li><a target="" href="" class="<? if ($arItem["SELECTED"]): ?>root-item-selected<? else: ?>root-item<? endif ?>" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a></li>
                    <? else: ?>
                        <li><a target="" href="" class="denied" title="<?= GetMessage("MENU_ITEM_ACCESS_DENIED") ?>"><?= $arItem["TEXT"] ?></a></li>
                    <? endif ?>
                <? endif ?>

            <? endif ?>

            <? $previousLevel = $arItem["DEPTH_LEVEL"]; ?>

        <? endforeach ?>

        <? if ($previousLevel > 1)://close last item tags?>
            <?= str_repeat("</div></ul></li>", ($previousLevel - 1)); ?>
        <? endif ?>
    </ul>
    <div class="menu-clear-left"></div>
<? endif ?>          