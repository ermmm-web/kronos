<div id="members" class="main-members">
    <div class="container">
        <div class="main-members-title">
            <h2>Участники</h2>
        </div>
        <div class="member-wrap">
            <div class="row">
                <? foreach ($arResult["ITEMS"] as $arItem): ?>
                <div class="col-lg-4 col-md-4  col-sm-4 col-xs-12">
                    <div class="member-card">
                        <div class="member-card-image" style="background-image: url(<?= $arResult["FILES"][$arItem["PREVIEW_PICTURE"]]["SRC"];?>)"></div>
                        <div class="member-card-wrap">
							<div class="member-headliner"><b style="color:#ff2147;">15%</b> скидка на все блюда</div>
                            <h3 class="member-card-title"><?= $arItem["NAME"]?></h3>
                            <div class="member-card-text"><?= $arItem["PREVIEW_TEXT"]?></div>
                        </div>
                        <div class="member-card-link"><?= html_entity_decode($arItem["CODE"]); ?></div>
                    </div>
                </div>
                <? endforeach; ?>
            </div>
        </div>
    </div>
</div>