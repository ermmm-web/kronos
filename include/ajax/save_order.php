<?

use Bitrix\Main\Context,
    Bitrix\Currency\CurrencyManager,
    Bitrix\Sale\Order,
    Bitrix\Sale\Basket,
    Bitrix\Sale\Delivery,
    Bitrix\Sale\PaySystem;
	
 
require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/prolog_before.php");


		// include($_SERVER['DOCUMENT_ROOT'].'/popup/popup-thanks/index.php');


if ($_REQUEST['ELEMENT_ID']) {
	CModule::IncludeModule('sale');
	CModule::IncludeModule('iblock');
	CModule::IncludeModule('catalog');
	
	if (!$_REQUEST['DELIVERY_ID']) {
		$_REQUEST['DELIVERY_ID'] = 2;	
	}
	
	if (!$_REQUEST['PAY_SYSTEM_ID']) {
		$_REQUEST['PAY_SYSTEM_ID'] = 2;	
	}
	
	$arUser = KRONOS_CATALOG::prepare_user();
	
	// require_once($_SERVER['DOCUMENT_ROOT'].'/local/php_interface/manager.class.php');
	
	$arItems = array();
	
	
	/* GET PODAROK FOR BASKET PROPS */
	$IBLOCK_ID = CIBlockElement::GetIBlockByID($_REQUEST['ELEMENT_ID']);

    $propPODAROK = array();
    $res = CIBlockElement::GetProperty($IBLOCK_ID, $_REQUEST['ELEMENT_ID'], "sort", "asc", array("CODE" => "BIND_PODAROK_BIND"));
    if ($ob = $res->GetNext()) {
		$propPODAROK = $ob;
    }	

	/*echo '<pre>$propPODAROK = '.__FILE__.' LINE: '.__LINE__;	
	print_r($propPODAROK);		
	echo '</pre>';	*/


	// 41 = BIND_PODAROK_BIND
	$iterator = CIBlockElement::GetPropertyValues($IBLOCK_ID, array('ID' => $_REQUEST['ELEMENT_ID']), true, array("ID" => 41));
	while ($row = $iterator->Fetch()) {
        
		foreach ($row[41] as $LINKED_ELEMENT_ID) {
			$arFilter 	= array(   
				"IBLOCK_ID"	=> $propPODAROK['LINK_IBLOCK_ID'],    
				"ID"		=> $LINKED_ELEMENT_ID,    
			);
			$arSelect 	= array('ID', 'NAME');
			$res 		= CIBlockElement::GetList(array("ID"=>"DESC"), $arFilter, false, array("nTopCount"=>1), $arSelect);
			if ($arFields = $res->GetNext()){
				$arPODAROK[] = $arFields;
			}
		}
	}
	
	/* ORDER COMMENT */
	
	$comment = '';
	
	if ($_REQUEST['input-phone']) {
		$comment .= 'Телефон: '.$_REQUEST['input-phone']."\n\n";
	}
	if ($_REQUEST['CREDIT_TYPE']) {
		$comment .= 'Тип: '.$_REQUEST['CREDIT_TYPE']."\n\n";
	}
	if ($_REQUEST['CREDIT_TIME']) {
		$comment .= 'Срок кредита: '.$_REQUEST['CREDIT_TIME']."\n";
	}
	if ($_REQUEST['CREDIT_START']) {
		$comment .= 'Сумму первоначального взноса: '.$_REQUEST['CREDIT_START']."\n";
	}
	if ($_REQUEST['CREDIT_CONDITION']) {
		foreach ($_REQUEST['CREDIT_CONDITION'] as $v) {
			$comment .= 'Условия кредита: '.$v."\n";
		}
	}
	if ($_REQUEST['RASCHET_NAVES']) {
		$comment .= 'Навесное оборудование: '.implode(', ', $_REQUEST['RASCHET_NAVES'])."\n\n";
	}
	if ($_REQUEST['RASCHET_DISCOUNT_CARD']) {
		$comment .= 'Дисконтная карта: '.implode(', ', $_REQUEST['RASCHET_DISCOUNT_CARD'])."\n\n";
	}
	if ($_REQUEST['RASCHET_NAVES']) {
		$comment .= 'Дополнительно для рассчёта: '.implode(', ', $_REQUEST['RASCHET_MORE'])."\n\n";
	}
	if ($_REQUEST['RASCHET_DELIVERY']) {
		$comment .= 'Доставка: '.implode(', ', $_REQUEST['RASCHET_DELIVERY'])."\n";
	}
	if ($_REQUEST['RASCHET_DELIVERY_REGION']) {
		$comment .= 'Область доставки: '.$_REQUEST['RASCHET_DELIVERY_REGION']."\n";
	}
	if ($_REQUEST['RASCHET_DELIVERY_CITY']) {
		$comment .= 'Город доставки: '.$_REQUEST['RASCHET_DELIVERY_CITY']."\n\n";
	}
	/*echo '<pre>$arPODAROK = '.__FILE__.' LINE: '.__LINE__;	
	print_r($arPODAROK);		
	echo '</pre>';	*/		
			
//die();

	
	/*$arSelect 	= array('ID', 'IBLOCK_ID', 'NAME', 'DETAIL_PAGE_URL', );
	$arFilter = array("ID" => $_REQUEST['ELEMENT_ID']);
	$res = CIBlockElement::GetList(array('ID' => 'DESC'), $arFilter, false, array("nTopCount"=>1), $arSelect);
	if ($arFields = $res->GetNext()) {
		$arFields['COUNT'] 		= 1;
		$arFields['PRICE'] 		= $_REQUEST['PRICES'][$k];
		$arFields['CURRENCY'] 	= 'BYN';
		$arItems[] 				= $arFields;
	}*/
	
	
	

	/* ADD ORDER 
	$basket = Bitrix\Sale\Basket::create(SITE_ID);
	
	// Создаём корзины
	foreach ($arItems as $v) {
		$item = $basket->createItem('catalog', $v['ID']);
		$ar_fields = array(
			'NAME' 						=> $v['NAME'], 
			'DETAIL_PAGE_URL' 			=> $v['DETAIL_PAGE_URL'], 
			'PRICE' 					=> $v['PRICE'],
			'QUANTITY' 					=> $v['COUNT'],
			'CURRENCY'	 				=> $v['CURRENCY'],
			'PRODUCT_PROVIDER_CLASS' 	=> 'CCatalogProductProvider',
			'CATALOG_XML_ID'			=> $v['IBLOCK_ID'],
			'PRODUCT_XML_ID'	 		=> $v['ID'],
			'CUSTOM_PRICE' 				=> 'Y',
			'IGNORE_CALLBACK_FUNC' 		=> 'Y',
			// 'FUSER_ID'					=> $arStore['USER_ID']
		);

		$item->setFields($ar_fields);
	}*/
	
	Add2BasketByProductID($_REQUEST['ELEMENT_ID']);
	
	$basket = Bitrix\Sale\Basket::loadItemsForFUser(Bitrix\Sale\Fuser::getId(), Bitrix\Main\Context::getCurrent()->getSite());
	
	
	foreach ($basket as $basketItem) {
		$arProps = array();
		//echo $basketItem->getField('NAME') . ' - ' . $basketItem->getQuantity() . '<br />';
		$basketPropertyCollection = $basketItem->getPropertyCollection(); 
		// $basketPropertyCollection = $basket->getPropertyCollection();
		
		foreach ($arPODAROK as $k => $ar) {
			$arProps[] = array(
			   'NAME' => $propPODAROK['NAME'],
			   'CODE' => 'PODAROK_'.$k,
			   'VALUE' => '['.$ar['ID'].'] '.$ar['NAME'],
			   'SORT' => 100 + $k*100,
			);	
		}
		$basketPropertyCollection->setProperty($arProps);	
	}


	/*echo '<pre>$basket = '.__FILE__.' LINE: '.__LINE__;	
	print_r($basket);		
	echo '</pre>';	*/		




	// Создаёт новый заказ
	$order = Order::create(SITE_ID, $arUser['ID']);
	$order->setPersonTypeId(1);
	// $order->setField('CURRENCY', SITE_CURRENCY);
	//$order->setField('STATUS_ID', 'SS');
	if ($comment) {
		$order->setField('USER_DESCRIPTION', $comment);
	}
	$order->setBasket($basket);

	// Создаём одну отгрузку и устанавливаем способ доставки
	$shipmentCollection = $order->getShipmentCollection();
	$service = Bitrix\Sale\Delivery\Services\Manager::getById($_REQUEST['DELIVERY_ID']);
	$shipment = $shipmentCollection->createItem();
	$shipment->setFields(array(
		'DELIVERY_ID' 			=> $service['ID'],
		'DELIVERY_NAME' 		=> $service['NAME'],
		//'BASE_PRICE_DELIVERY' 	=> 0,
		//'CURRENCY' 				=> 'BYN'
	));/**/

	$shipmentItemCollection = $shipment->getShipmentItemCollection();
	foreach ($basket as $basketItem) {
        $item = $shipmentItemCollection->createItem($basketItem);
        $item->setQuantity($basketItem->getQuantity());
    }
	
	// Устанавливаем свойства
	$propertyCollection = $order->getPropertyCollection();

	/*echo '<pre>$arUser = '.__FILE__.' LINE: '.__LINE__;	
	print_r($arUser);		
	echo '</pre>';	*/		

	
	$phoneProp = $propertyCollection->getPhone();
	$phoneProp->setValue($arUser['PHONE']);
	$nameProp = $propertyCollection->getPayerName();
	$nameProp->setValue($arUser['NAME']);
	//$emailProp = $propertyCollection->getUserEmail();
	//$emailProp->setValue('info@stranamasterov.by');
	//$locProp = $propertyCollection->getDeliveryLocation();
	//$locProp->setValue(3305); // minsk
	//$zipProp = $propertyCollection->getDeliveryLocationZip();
	//$zipProp->setValue(220000);
	//$addressProp = $propertyCollection->getAddress();
	//$addressProp->setValue($arStore['ADDRESS']);

	// Создаём оплату
	$paymentCollection = $order->getPaymentCollection();
	$payment = $paymentCollection->createItem(
		Bitrix\Sale\PaySystem\Manager::getObjectById($_REQUEST['PAY_SYSTEM_ID'])
	);
	$payment->setFields(array(
		"SUM" 			=> $order->getPrice(),
		"CURRENCY" 		=> $order->getCurrency(),
	));
	
	// Сохраняем
	/*if ($GLOBALS['USER']->GetID() == 1) {
		echo '<br>KASSA 1';
	}*/
	$order->doFinalAction(true);
	/*if ($GLOBALS['USER']->GetID() == 1) {
		echo '<br>KASSA 2';
	}*/
	$result = $order->save();
	/*if ($GLOBALS['USER']->GetID() == 1) {
		echo '<br>KASSA 3';
	}*/
	if (!$result->isSuccess()) {
		echo $result->getErrors();
	} else {
		$ORDER_ID = $order->getId();
	}

	// $ORDER_ID = CSaleOrder::Add($arFields);
	if ($ORDER_ID) {
		include($_SERVER['DOCUMENT_ROOT'].'/popup/popup-thanks/index.php');
		/*echo '<div class="alert alert-success">Ваша заявка принята. Ожидайте звонка менеджера.</div>';	*/
	} else {

		echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
		print_r($result->getErrors());		
		echo '</pre>';			

		
		echo 'ERROR';	
	}
}


require_once($_SERVER["DOCUMENT_ROOT"]."/bitrix/modules/main/include/epilog_after.php");

