<? require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");

if (intval($_REQUEST['ELEMENT_ID'])) {
	CModule::IncludeModule('catalog');



	Add2BasketByProductID(
		$_REQUEST['ELEMENT_ID'],
		1,
		false,
		false
	);
	if ($ex = $GLOBALS['APPLICATION']->GetException())
	echo '<br>'.$ex->GetString();
}
die();
