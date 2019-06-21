<?

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

$arLoadProductArray = Array(
	"IBLOCK_ID"      	=> 19,
	"CODE"           	=> $_REQUEST['input-phone'],
	"ACTIVE"         	=> "Y",
	"PREVIEW_TEXT"   	=> $_SERVER['HTTP_REFERER'],
	"DETAIL_TEXT_TYPE"  => 'text',
);


if ($_REQUEST['MODE'] == 'free-call' && $_REQUEST['input-phone']) {
	$arLoadProductArray["NAME"] 		= 'Бесплатный звонок';

	
} elseif ($_REQUEST['MODE'] == 'founded-cheaper' && $_REQUEST['input-phone']) {
	$arLoadProductArray["NAME"]	 		= 'Нашли дешевле';
	$arLoadProductArray["DETAIL_TEXT"] 	= 'Ваше имя: '.$_REQUEST['POPUP_FOUNDED_CHEAPER_NAME']."\n".'Ссылка на товар в другом магазине: '.$_REQUEST['POPUP_FOUNDED_CHEAPER_LINK'];
	
	
} elseif ($_REQUEST['MODE'] == 'send-to-director' && $_REQUEST['POPUP_SEND_TO_DIRECTOR']) {
	$arLoadProductArray["NAME"] 		= 'Написать директору';
	$arLoadProductArray["DETAIL_TEXT"] 	= $_REQUEST['POPUP_SEND_TO_DIRECTOR'];
	
	
} elseif ($_REQUEST['MODE'] == 'tender' && $_REQUEST['input-phone']) {
	$arLoadProductArray["NAME"] 		= 'Тендер';
	$arLoadProductArray["DETAIL_TEXT"] 	= 'Ваше имя: '.$_REQUEST['POPUP_INVITE_TENDER_NAME']."\n".'Ваш электронный адрес: '.$_REQUEST['POPUP_INVITE_TENDER_ADDRESS']."\n".'Ваша компания: '.$_REQUEST['POPUP_INVITE_TENDER_COMPANY'];
	
	
} elseif ($_REQUEST['MODE'] == 'look-discount' && $_REQUEST['input-phone']) {
	$arLoadProductArray["NAME"] 		= 'Сообщить о снижении цены';
	
	
} elseif ($_REQUEST['MODE'] == 'have_qu' && $_REQUEST['input-phone']) {
	$arLoadProductArray["NAME"] 		= 'Остались вопросы';
	
	
} elseif ($_REQUEST['MODE'] == 'call_client' && $_REQUEST['input-phone']) {
	$arLoadProductArray["NAME"] 		= 'Пообщаться с клиентом';
	
	
} elseif ($_REQUEST['sender_subscription'] == 'add') {
	include($_SERVER['DOCUMENT_ROOT'].'/popup/popup-thanks/index.php');
}
	

if ($arLoadProductArray) {
	CModule::IncludeModule('iblock');
	$el = new CIBlockElement;

	if ($_FILES['file']) {
		$arLoadProductArray['PROPERTY_VALUES']['FILE'] = CFile::MakeFileArray($_FILES['file']['tmp_name']);
	}

	$arSelect = array('ID', 'NAME');
	$arFilter = array('IBLOCK_ID' => 19, 'NAME' => $arLoadProductArray['NAME']);
	$rSection = CIBlockSection::GetList(array('ID' => 'DESC'), $arFilter, false, $arSelect, array("nTopCount"=>1) );
	if ($arSection = $rSection->GetNext()) {
		$SECTION_ID = $arSection['ID'];		
	} else {
		$bs = new CIBlockSection;
		$arFields = Array(
		  "ACTIVE" 		=> 'Y',
		  "IBLOCK_ID" 	=> 19,
		  "NAME" 		=> $arLoadProductArray['NAME'],
		);
		
	  	$SECTION_ID = $bs->Add($arFields);
	}
	$arLoadProductArray['IBLOCK_SECTION_ID'] = $SECTION_ID;
	
	if($PRODUCT_ID = $el->Add($arLoadProductArray)) {
		include($_SERVER['DOCUMENT_ROOT'].'/popup/popup-thanks/index.php');
	} else {
		echo "Error: ".$el->LAST_ERROR;
	}
}

require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");
