<?

foreach ($arResult["ITEMS"] as $k => $arItem) {
	foreach ($arItem["PROPERTIES"] as $code => $values) {
		// if ($values['PROPERTY_TYPE'] == 'L') {
			
			$arResult["ITEMS"][$k]["PROPERTIES"][$code]['NAME'] = preg_replace('@\([^)]+\)@', '', $values["NAME"]);
		/*} else {
			echo '<pre>$values = '.__FILE__.' LINE: '.__LINE__;	
			print_r($values);		
			echo '</pre>';			
			
		}*/
	}
}
