<div class="row">
    <div class="col-lt-9">
        <div class="section_bg">
            <div class="section-head section-head_info-page">
                <h1 class="h1"><?= $GLOBALS["APPLICATION"]->ShowTitle();?></h1>
                <div class="section-image">
                    <img src="<?= imageResize(["WIDTH" => 104, "HEIGHT" => 0], $arResult["FILES"][$arResult["ITEMS"][0]["PREVIEW_PICTURE"]]["SRC"]);?>" alt="<?= $arResult["ITEMS"][0]["NAME"];?>" title="<?= $arResult["ITEMS"][0]["NAME"];?>">
                </div>
            </div>
            <div class="info-page">
                <div class="advantages">
                    <div class="advantages__item">
                        <div class="advantages-item">
                            <div class="advantages-item__index">1</div>
                            <div class="advantages-item__name">Мировой лидер</div>
                            <div class="advantages-item__desc">
                                <p>С 1919 г. компания Beurer GmbH является одним из мировых лидеров на рынке инновационных изделий в области здоровья</p>
                            </div>
                        </div>
                    </div>
                    <div class="advantages__item">
                        <div class="advantages-item">
                            <div class="advantages-item__index">2</div>
                            <div class="advantages-item__name">Немецкое качество</div>
                            <div class="advantages-item__desc">
                                <p>Техника для здоровья Бойрер – качественная немецкая продукция для Вашего хорошего самочувствия, комфорта и красоты</p>
                            </div>
                        </div>
                    </div>
                    <div class="advantages__item">
                        <div class="advantages-item">
                            <div class="advantages-item__index">3</div>
                            <div class="advantages-item__name">Подходит для детей</div>
                            <div class="advantages-item__desc">
                                <p>Бойрер поддерживает актуальный тренд здоровья и помогает Вам и Вашим близким оставаться здоровыми</p>
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <h2>О бренде</h2>
                <?= $arResult["ITEMS"][0]["DETAIL_TEXT"]; ?>                
            </div>
        </div>
    </div>
    <div class="col-lt-3">
        <div class="section_bg">
            <div class="card-aside">
                <div class="card-aside__item">
                    <div class="navigation">
                        <div class="navigation__name">Похожие бренды</div>
                        <nav>
                            <ul>
                                <li><a href="#">CocaCola</a></li>
                                <li><a href="#">Google</a></li>
                                <li><a href="#">Hearge</a></li>
                                <li><a href="#">Apple</a></li>
                                <li><a href="#">Microsoft</a></li>
                            </ul>
                        </nav>
                    </div>
                </div>
            </div>
        </div>
        <div class="section_transparent">
            <a href="#brand-products" class="btn btn_default btn_arrow js-scrollTo">К товарам Beurer GmbH</a>
        </div>
    </div>
</div>