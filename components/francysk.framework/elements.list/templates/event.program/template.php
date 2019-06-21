<div id="event-program" class="event-program">
    <div class="container">
        <div class="shadow row">
            <div class="col-lg-12 col-md-12 col-sm-12">
                <div class="event-program-title">
                    <h2>Мастер-классы</h2>
                </div>
                <div class="event-program-wrap">
                    <div class="row">
                        <div class="col-lg-12 col-md-12 col-sm-12">
                        <? foreach ($arResult["ITEMS"] as $id => $arItem): ?>
                            <? $isEven = ($id % 2 == 0) ? true : false ?>



                                <div class="<?= $isEven ? "event-program-item col-lg-7 col-md-7 col-sm-7" : "event-program-item col-lg-7 col-lg-offset-4 col-md-7 col-md-offset-4 col-sm-7 col-sm-offset-4" ?>  ">

                                    <? if (!$isEven): ?>
                                        <div class="<?= $isEven ? "time-wrap col-lg-5 col-md-6 col-sm-5" : "time-wrap col-lg-5 col-md-6 col-sm-5 col-lg-offset-1 col-md-offset-0 col-sm-offset-1" ?>">
                                            <div class="item-time"><?= $arItem["CODE"]?></div>
                                            <div class="item-time-note"><?= $arItem["PROPERTIES"]["MEMBER"]["VALUE"]; ?></div>
                                            <div class="item-time-note"><?= $arItem["PROPERTIES"]["AGE"]["VALUE"]; ?></div>
                                            <div class="vert-line"></div>
                                        </div>
                                        <div class="horz-line"></div>
                                    <? endif; ?>

                                    <div class="col-lg-9 col-md-8 col-sm-8 col-xs-12">
                                        <div class="item-text-wrap">
                                            <h3 class="item-text-title"><?= $arItem["NAME"]?></h3>
                                            <div class="item-text"><?= $arItem["PREVIEW_TEXT"]?></div>





                                            <? if (!empty($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"])): ?>
                                                <a href="" class="item-link" data-toggle="modal" data-target="#modalGallery<?= $arItem["ID"] ?>">Фото предыдущего мастер-класса</a>
                                                <div id="modalGallery<?= $arItem["ID"] ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">×</button>
                                                                <h4 class="modal-title">Фото предыдущего мастер-класса</h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <div id="gallery<?= $arItem["ID"] ?>" class="gallery" style="display:none;">
                                                                    <? foreach ($arItem["PROPERTIES"]["MORE_PHOTO"]["VALUE"] as $fileid): ?>
                                                                        <img alt="" src="<?= $arResult["FILES"][$fileid]["SRC"] ?>"
                                                                             data-image="<?= $arResult["FILES"][$fileid]["SRC"] ?>"
                                                                             data-description="">
                                                                    <? endforeach; ?>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? endif; ?>




                                            <? if (!empty($arItem["DETAIL_TEXT"])): ?>
                                                <a href="" class="item-link" data-toggle="modal" data-target="#modalVideo<?= $arItem["ID"] ?>">Видео</a>
                                                <div id="modalVideo<?= $arItem["ID"] ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                            </div>
                                                            <div class="modal-body">
                                                                <?= $arItem["DETAIL_TEXT"]  ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? endif; ?>


                                            <? if (!empty($arItem["PROPERTIES"]["TEXT"]["VALUE"]["TEXT"])): ?>
                                                <a href="" class="item-link" data-toggle="modal" data-target="#modalText<?= $arItem["ID"] ?>">Подробнее о программе</a>
                                                <div id="modalText<?= $arItem["ID"] ?>" class="modal fade" role="dialog">
                                                    <div class="modal-dialog">
                                                        <div class="modal-content">
                                                            <div class="modal-header">
                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                <h4 class="modal-title"><?= $arItem["NAME"] ?></h4>
                                                            </div>
                                                            <div class="modal-body">
                                                                <p><?=html_entity_decode($arItem["PROPERTIES"]["TEXT"]["VALUE"]["TEXT"])?></p>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                            <? endif; ?>


                                        </div>
                                    </div>

                                    <? if ($isEven): ?>
                                        <div class="horz-line"></div>
                                        <div class=" time-wrap col-lg-5 col-md-6 col-sm-5">
                                            <div class="item-time"><?= $arItem["CODE"]?></div>
                                            <div class="item-time-note"><?= $arItem["PROPERTIES"]["MEMBER"]["VALUE"]; ?></div>
                                            <div class="item-time-note"><?= $arItem["PROPERTIES"]["AGE"]["VALUE"]; ?></div>
                                            <? ?>
                                            <div class="vert-line"></div>
                                        </div>
                                    <? endif; ?>


                                </div>

                    <? endforeach; ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>