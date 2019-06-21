<?

class KRONOS_AGENTS {
	function stat_agent () {
		CModule::IncludeModule('iblock');
		CModule::IncludeModule('highloadblock');
		
		$hlblock = Bitrix\Highloadblock\HighloadBlockTable::getById(2)->fetch();   
		$entity	 = Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
		$entity_data_class = $entity->getDataClass();
				
		$arFilter 	= array(   
			"IBLOCK_ID"	=> IBLOCK_ID_PRODUCT,    
			"ACTIVE"	=> 'Y',    
		);
		$arSelect 	= array('ID', 'NAME', 'PROPERTY_COUNT_BUY', 'PROPERTY_CONTROL_COUNT_BUY', 'PROPERTY_COUNT_BUY_DATE');
		$res 		= CIBlockElement::GetList(array("ID"=>"DESC"), $arFilter, false, array("nTopCount"=>1000), $arSelect);
		while ($arFields = $res->GetNext()){
			echo '<pre>$arFields = '.__FILE__.' LINE: '.__LINE__;	
			print_r($arFields);		
			echo '</pre>';	
			
			if ($arFields['PROPERTY_CONTROL_COUNT_BUY_VALUE']) {
				$rsData = $entity_data_class::getList(array(
				   'select' => array('UF_COUNT', 'UF_PERIOD'),
				   'order' => array('ID' => 'ASC'),
				   'limit' => '1',
				   'filter' => array('UF_XML_ID' => $arFields['PROPERTY_CONTROL_COUNT_BUY_VALUE']) 
				));
				if ($el = $rsData->fetch()){
					echo '<pre>$el = '.__FILE__.' LINE: '.__LINE__;	
					print_r($el);		
					echo '</pre>';
					
					$next_date = MakeTimeStamp($arFields['PROPERTY_COUNT_BUY_DATE_VALUE']) + $el['UF_COUNT']*24*60*60;
					
					if ($next_date < time()) {
						echo '<br>UPDATE';
						CIBlockElement::SetPropertyValuesEx(
							$arFields['ID'],
							IBLOCK_ID_PRODUCT,
							array(
								'COUNT_BUY' 		=> $arFields['PROPERTY_COUNT_BUY_VALUE'] + $el['UF_COUNT'],
								'COUNT_BUY_DATE' 	=> ConvertTimeStamp(),
							)
						);
					}
				}				
			}
			
		}
	}
}