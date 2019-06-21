<?
CModule::IncludeModule('iblock');
$arFilter 	= array(   
	"IBLOCK_ID"	=> IBLOCK_ID_VIDEO,    
	"ACTIVE"	=> 'Y',    
);
$arSelect 	= array('IBLOCK_ID');
$res 		= CIBlockElement::GetList(array("IBLOCK_ID"=>"DESC"), $arFilter, array('IBLOCK_ID'), array("nTopCount"=>5000), $arSelect);
while($arFields = $res->GetNext()){
	$count = $arFields['CNT'];	
}

?>
<a class="dot-link-one-line" href="/video/" title="Видео">
	<svg class="header-icon-video">
		<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-video"></use>
	</svg><span class="dot-link-one-line__name">Видео</span><span class="dot-link-one-line__count anim-destination"><span data-hover="<?=$count?>"> <?=$count?></span></span>
</a>
