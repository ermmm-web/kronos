<? if(!empty($arResult["ITEMS"])): ?>
    <? foreach($arResult["ITEMS"] as $arItem): ?>
        <? if(!empty($arItem["PROPERTIES"]["MAP"]["VALUE"])): ?>
        <div class="js-map-marker" data-marker="{
                &quot;icon&quot;: &quot;/local/frontend/build/image/svg/placeholder.svg&quot;,
                &quot;position&quot;: &quot;<?= $arItem["PROPERTIES"]["MAP"]["VALUE"] ?>&quot;
              }"></div>
        <? endif; ?>
    <? endforeach; ?>
<? endif; ?>