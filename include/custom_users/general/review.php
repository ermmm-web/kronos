<?
CModule::IncludeModule('iblock');
$arFilter 	= array(   
	"IBLOCK_ID"	=> IBLOCK_ID_REVIEW,    
	"ACTIVE"	=> 'Y',    
);
$arSelect 	= array('IBLOCK_ID');
$res 		= CIBlockElement::GetList(array("IBLOCK_ID"=>"DESC"), $arFilter, array('IBLOCK_ID'), array("nTopCount"=>5000), $arSelect);
while($arFields = $res->GetNext()){
	$count = $arFields['CNT'];	
}

?>
<a class="dot-link-one-line" href="/otzyvy/" title="Отзывы">
	<svg class="header-icon-review">
		<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-review"></use>
	</svg><span class="dot-link-one-line__name">Отзывы</span><span class="dot-link-one-line__count anim-destination"><span data-hover="<?=$count?>"><?=$count?></span></span>
</a>
