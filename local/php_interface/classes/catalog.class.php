<?
AddEventHandler("search", "BeforeIndex", Array("KRONOS_CATALOG", "BeforeIndexHandler"));
AddEventHandler("iblock", "OnAfterIBlockElementUpdate", Array("KRONOS_CATALOG", "OnAfterIBlockElementUpdate"));

class KRONOS_CATALOG {
	function prepare_more_photo_item ($file_id, $youtube = '') {
		return array (
			'FULL' 			=> CFile::GetFileArray($file_id),
			'PREVIEW_LIST' 	=> CFile::ResizeImageGet($file_id, array('width'=>380, 'height'=>214), BX_RESIZE_IMAGE_PROPORTIONAL, true),
			'PREVIEW' 		=> CFile::ResizeImageGet($file_id, array('width'=>461, 'height'=>219), BX_RESIZE_IMAGE_PROPORTIONAL, true),
			'THUMBNAIL' 	=> CFile::ResizeImageGet($file_id, array('width'=>202, 'height'=>162), BX_RESIZE_IMAGE_PROPORTIONAL, true),
			'YOUTUBE' 		=> $youtube,
		);
	}
	function translit ($name, $MODE = 'EN_TO_RU') {
		$ar = array ( // EN => RU
			'Q' => 'К',
			'W' => 'В',
			'E' => 'Е',
			'R' => 'Р',
			'T' => 'Т',
			'Y' => 'У',
			'U' => 'Ю',
			'I' => 'И',
			'O' => 'О',
			'P' => 'П',
			'A' => 'А',
			'S' => 'С',
			'D' => 'Д',
			'F' => 'Ф',
			'G' => 'Г',
			'H' => 'Ш',
			'J' => 'ДЖ',
			'K' => 'К',
			'L' => 'Л',
			'Z' => 'З',
			'X' => 'КС',
			'C' => 'К',
			'V' => 'В',
			'B' => 'Б',
			'N' => 'Н',
			'M' => 'М',
		);

		$name = str_replace(array_keys($ar), array_values($ar), $name);
		return $name;
	}

	function OnAfterIBlockElementUpdate ($arFields) {
		if ($arFields['NAME']) {
			$arResult = array();

			/* PREPARE SINS */
			// e.g. DF-244С, Т-224, RD-244С, 2091Д, G85
			$upper 	= strtoupper($arFields['NAME']);
			$ar 	= explode(' ', $upper);
			foreach ($ar as $v) {
				if (preg_match_all('@ ([^0-9]{0,5})([0-9]{1,5})([^0-9]{0,5}) @', ' '.$v.' ', $matches)) {

					foreach ($matches[0] as $vv) {
						$vv 	= trim($vv);
						$arParamsTrans = array(
							"max_len" 				=> "75", // ???????? ?????????? ??? ?? 75 ????????
							"change_case" 			=> "U", // ????? ????????????? ? ??????? ????????
							"replace_space" 		=> " ", // ?????? ??????? ?? ?????? ?????????????
							"replace_other" 		=> " ", // ?????? ????? ??????? ?? ?????? ?????????????
							"delete_repeat_replace" => "true", // ??????? ????????????? ?????? ?????????????
							"use_google" 			=> "false", // ????????? ????????????? google
						);
						$temp	= Cutil::translit($vv, "ru", $arParamsTrans);

						$arParamsTrans = array(
							"max_len" 				=> "75", // ???????? ?????????? ??? ?? 75 ????????
							"change_case" 			=> "U", // ????? ????????????? ? ??????? ????????
							"replace_space" 		=> "", // ?????? ??????? ?? ?????? ?????????????
							"replace_other" 		=> "", // ?????? ????? ??????? ?? ?????? ?????????????
							"delete_repeat_replace" => "true", // ??????? ????????????? ?????? ?????????????
							"use_google" 			=> "false", // ????????? ????????????? google
						);
						$temp2	= Cutil::translit($vv, "ru", $arParamsTrans);

						$temp3	= self::translit($temp);
						$temp4	= self::translit($temp2);
						$temp5	= self::translit($vv);

						$arResult[$temp] = $temp;
						$arResult[$temp2] = $temp2;
						$arResult[$temp3] = $temp3;
						$arResult[$temp4] = $temp4;
						$arResult[$temp5] = $temp5;

						//echo '<br>$temp = '.$temp;
						//echo '<br>$temp2 = '.$temp2;
						//echo '<br>$temp3 = '.$temp3;
						//echo '<br>$temp4 = '.$temp4;
					}
				}
			}

			/* GET CUR SINS */
			if ($arResult) {
				$value = array();
				$res = CIBlockElement::GetProperty($arFields["IBLOCK_ID"], $arFields["ID"], "sort", "asc", array("CODE" => "SEARCH_SIN"));
				while ($ob = $res->GetNext()) {
					$arResult[$ob['VALUE']] = $ob['VALUE'];
				}

				/* SAVE SINS */
				CIBlockElement::SetPropertyValuesEx($arFields['ID'], false, array('SEARCH_SIN' => $arResult));
				CIBlockElement::UpdateSearch($arFields['ID'], true);
			}

			/*if ($GLOBALS['USER']->GetID() == 10) {
				echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;
				print_r($arResult);
				echo '</pre>';

				// die();
			}*/


			/* TRANSLIT */
			// $temp 	= preg_replace('@[А-ЯЁ]@', ' ', $upper);
			//$temp	= Cutil::translit($temp, "ru", $arParamsTrans);

		}


	}

	function BeforeIndexHandler($arFields) {
		if($arFields["MODULE_ID"] == "iblock" && $arFields["PARAM2"] == 2) {
			if(array_key_exists("TITLE", $arFields)) {

				$value = array();
				$res = CIBlockElement::GetProperty($arFields["PARAM2"], $arFields["ITEM_ID"], "sort", "asc", array("CODE" => "SEARCH_SIN"));
				while ($ob = $res->GetNext()) {
					/*if ($GLOBALS['USER']->GetID() == 10) {
						echo '<pre>$ob = '.__FILE__.' LINE: '.__LINE__;
						print_r($ob);
						echo '</pre>';
					}*/
					$value[] = $ob['VALUE'];
				}
				if ($value) {
					$arFields["TITLE"] .= ' ###'.implode(', ', $value).'###';
				}

				// $arFields["BODY"] .= " самые свежие новости";
			}
		}
		return $arFields;
	}
	function show_more_photo ($arItem) {
		?><div class="product__gallery">
			<div class="product__image" <? if($arItem["USE_MORE_PHOTO"] > 1):?>data-count="<?= $arItem["USE_MORE_PHOTO"] ?>"<?endif;?>>
				<a class="product__image-more" href="" title="">
					<div class="product__image-more-info">
						<img src="/local/frontend/build/img/svg/photo.svg" alt=""/>Ещё <?=$arItem["MORE_MORE_PHOTO"]?> фотографий
					</div>
				</a>
				<div class="product__image-preload">
					<div class="swiper-lazy-preloader"></div>
				</div>
				<div class="product__image-target">
					<img src="<?= $arItem['PREVIEW_PICTURE']["src"]; ?>" title="<?= $arItem["NAME"];?>" alt="<?= $arItem["NAME"];?>"/>
				</div>
			</div>

			<? if($arItem["USE_MORE_PHOTO"] > 1): ?>
				<div class="product__pagination">
					<div class="pagination-line">
						<a class="active" href="<?= $arItem['PREVIEW_PICTURE']["src"]; ?>"></a>
						<? foreach ($arItem['DISPLAY_PROPERTIES']["MORE_PHOTO"] as $arPhoto): ?>
							<a href="<?=$arPhoto['PREVIEW_LIST']["src"] ?>"></a>
						<? endforeach; ?>
					</div>
				</div>
			<? endif; ?>
		</div><?

	}

	function show_props ($arItem) {
		?><div class="product__props">
			<div class="props props_product">
				<div class="props__table">
					<? foreach ($arItem["DISPLAY_PROPERTIES"] as $code => $values):
						/*echo '<pre>$values = '.__FILE__.' LINE: '.__LINE__;
						print_r($values);
						echo '</pre>';
						echo '<br<code = '.$code;*/
						$show = true;

						if (!$values['VALUE']) {
							$show = false;
						} elseif (in_array($code, array('BIND_PODAROK', 'BONUS'))) {
							$show = false;
						} elseif ($arItem['SECTION']['UF_PROP_CODES'] && !in_array($code, $arItem['SECTION']['UF_PROP_CODES'])) {
							$show = false;
						}

						if ($show) {

							?><div class="props__tr props__tr_<?=$code?>">
								<div class="props__td"><?=trim($values["HINT"] ? $values["HINT"] : $values["NAME"]) ?>:</div>
								<div class="props__td"><?
									if ($values["PROPERTY_TYPE"] == "E") {
										$values['VALUE'] = $values['ITEM']["NAME"];

										if ($values['ITEM']["PREVIEW_PICTURE"] > 0) {
											?><img src="<?= $values['ITEM']["PREVIEW_PICTURE"]["SRC"]; ?>" alt="<?= $values['ITEM']["NAME"]; ?>" title="<?= $values['ITEM']["NAME"]; ?>" /><?
										}
									} ?>
									<?= $values['VALUE']; ?> <?= $values["DESCRIPTION"]; ?>
								</div>
							</div><?

						}
					 ?>
					<? endforeach; ?>
				</div>
			</div>
		</div><?
	}

	function prepare_user () {
		$arResult = array();
		if ($GLOBALS["USER"]->IsAuthorized()) {
			$rsUser = CUser::GetByID($GLOBALS["USER"]->GetID());
			$arResult = $rsUser->Fetch();
			$arResult['PHONE']	= $arResult['PERSONAL_PHONE'];
		} else {
			CModule::IncludeModule('sale');
			$arResult['PHONE']	= $_REQUEST['PHONE'];
			$arResult['NAME']	= $_REQUEST['NAME'];
			$arResult['ID']		= \CSaleUser::GetAnonymousUserID();
		}
		return $arResult;
	}
	function prepare_element (&$arResult, $max_photo = 6) {
		CModule::IncludeModule('iblock');

		if ($arResult['PREVIEW_PICTURE']) {
			$arResult['PREVIEW_PICTURE_SMALL'] = CFile::ResizeImageGet($arResult['PREVIEW_PICTURE']['ID']?$arResult['PREVIEW_PICTURE']['ID']:$arResult['PREVIEW_PICTURE'], array('width'=>380, 'height'=>214), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			$arResult['PREVIEW_PICTURE']['src'] = $arResult['PREVIEW_PICTURE_SMALL']['src'];
		}

		if ($arResult['IBLOCK_SECTION_ID']) {
			$arSelect = array('ID', 'UF_PROP_CODES');
			$arFilter = array('IBLOCK_ID' => $arResult['IBLOCK_ID'], 'ID' => $arResult['IBLOCK_SECTION_ID']);
			$rSection = CIBlockSection::GetList(array('ID' => 'DESC'), $arFilter, false, $arSelect, array("nTopCount"=>1) );
			if ($arSection = $rSection->GetNext()) {
				$arResult['SECTION']['UF_PROP_CODES'] = $arSection['UF_PROP_CODES'];
				/*echo '<!--';
				echo '<pre>$arSection = '.__FILE__.' LINE: '.__LINE__;
				print_r($arSection);
				echo '</pre>';
				echo '-->';*/
			}
		}

		foreach ($arResult["DISPLAY_PROPERTIES"] as $code => $values) {
			if ($values['PROPERTY_TYPE'] == 'E') {
				if ($values['LINK_ELEMENT_VALUE']) {
					foreach ($values['LINK_ELEMENT_VALUE'] as $k => $v) {

						if ($v['IBLOCK_ID'] == 6) { // BONUS
							$res = CIBlockElement::GetProperty($v['IBLOCK_ID'], $v['ID'], "sort", "asc", array("CODE" => "ICON"));
							if ($ob = $res->GetNext()) {
								$v['ICON'] = CFile::GetFileArray($ob['VALUE']);
							}
						} elseif ($v['IBLOCK_ID'] == 2) { // PODARKI
							$v['PREVIEW_PICTURE_SMALL'] = CFile::ResizeImageGet($v['PREVIEW_PICTURE'], array('width'=>230, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);

						} elseif ($v['IBLOCK_ID'] == 8) { // SERTIFICAT
							$v['PREVIEW_PICTURE_SMALL'] = CFile::ResizeImageGet($v['PREVIEW_PICTURE'], array('width'=>230, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);

						} elseif ($v['IBLOCK_ID'] == 13) { // DESCRIPTIONS
							/* PREVIEW_TEXT */
							$arFilter 	= array(
								"IBLOCK_ID"	=> $v['IBLOCK_ID'],
								"ID"		=> $v['ID'],
							);
							$arSelect 	= array('ID', 'PREVIEW_TEXT');
							$res 		= CIBlockElement::GetList(array("ID"=>"DESC"), $arFilter, false, array("nTopCount"=>1), $arSelect);
							if ($arFields = $res->GetNext()){
								$v['PREVIEW_TEXT'] = $arFields['PREVIEW_TEXT'];
							}


							/* MORE_PHOTO */
							$res = CIBlockElement::GetProperty($v['IBLOCK_ID'], $v['ID'], "sort", "asc", array("CODE" => "MORE_PHOTO"));
							while ($ob = $res->GetNext()) {
								$v['MORE_PHOTO'][] = CFile::GetFileArray($ob['VALUE']);
							}

							/* YOUTUBE */
							$res = CIBlockElement::GetProperty($v['IBLOCK_ID'], $v['ID'], "sort", "asc", array("CODE" => "YOUTUBE"));
							while ($ob = $res->GetNext()) {
								$v['YOUTUBE'] = $ob['VALUE'];
							}

							$v['PREVIEW_PICTURE_SMALL'] = CFile::ResizeImageGet($v['PREVIEW_PICTURE'], array('width'=>345, 'height'=>400), BX_RESIZE_IMAGE_PROPORTIONAL, true);

						} else {
							$v['PREVIEW_PICTURE_SMALL'] = CFile::ResizeImageGet($v['PREVIEW_PICTURE'], array('width'=>208, 'height'=>162), BX_RESIZE_IMAGE_PROPORTIONAL, true);

						}
						$v['PREVIEW_PICTURE'] = CFile::GetFileArray($v['PREVIEW_PICTURE']);

						$arResult["DISPLAY_PROPERTIES"][$code]['LINK_ELEMENT_VALUE'][$k] = $v;
					}
				} else {
					$arFilter 	= array(
						"IBLOCK_ID"	=> $values['LINK_IBLOCK_ID'],
						"ID"		=> $values['VALUE'],
					);
					$arSelect 	= array('ID', 'NAME', 'PREVIEW_PICTURE');
					$res 		= CIBlockElement::GetList(array("ID"=>"DESC"), $arFilter, false, array("nTopCount"=>1), $arSelect);
					if ($arFields = $res->GetNext()){
						$arFields['PREVIEW_PICTURE'] = CFile::GetFileArray($arFields['PREVIEW_PICTURE']);
						if (sizeof()) {

						}
						$arResult["DISPLAY_PROPERTIES"][$code]['ITEM'] = $arFields;
					}

				}

				if ($code == 'BONUS') {
					usort($arResult["DISPLAY_PROPERTIES"][$code]['LINK_ELEMENT_VALUE'], function ($a, $b) {
						if ($a['SORT'] > $b['SORT']) {
							return 1;
						} else {
							return 0;
						}
					});
				}

			} elseif ($code == 'COUNTRY') {

				switch ($values['VALUE_XML_ID']) {
					case 'BELARUS':
						$arResult["DISPLAY_PROPERTIES"][$code]['SRC'] = '/local/frontend/build/img/Belarus.png';
					break;
				}


			} elseif ($values['PROPERTY_TYPE'] == 'G') {
				$arFilter 	= array(
					"IBLOCK_ID"		=> $values['LINK_IBLOCK_ID'],
					"SECTION_ID"	=> $values['VALUE'],
					"ACTIVE"		=> 'Y',
				);
				$arSelect 	= array('ID', 'NAME', 'DETAIL_TEXT', 'PREVIEW_PICTURE', 'PREVIEW_TEXT', 'PROPERTY_YOUTUBE');
				$res 		= CIBlockElement::GetList(array("SORT"=>"ASC"), $arFilter, false, array("nTopCount"=>5000), $arSelect);
				while ($arFields = $res->GetNext()){

					/*echo '<pre>$arFields = '.__FILE__.' LINE: '.__LINE__;
					print_r($arFields);
					echo '</pre>';*/

					/* GET MORE PHOTO */
					$iterator = CIBlockElement::GetPropertyValues($values['LINK_IBLOCK_ID'], array('ID' => $arFields['ID']), true, array('ID' => 219));
					while ($row = $iterator->Fetch()) {
						/*echo '<pre>$row = '.__FILE__.' LINE: '.__LINE__;
						print_r($row);
						echo '</pre>';	*/
						$arFields['MORE_PHOTO'] = $row[219];
					}


					foreach ($arFields['MORE_PHOTO'] as $k => $v) {
						$arFields['MORE_PHOTO'][$k] = CFile::ResizeImageGet($v, array('width' => 350, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL, true);
					}

					$arFields['PREVIEW_PICTURE_SMALL'] = CFile::ResizeImageGet($arFields['PREVIEW_PICTURE'], array('width' => 350, 'height' => 300), BX_RESIZE_IMAGE_PROPORTIONAL, true);

					$arFields['YOUTUBE'] = $arFields['PROPERTY_YOUTUBE_VALUE'];

/*echo '<pre>$arFields = '.__FILE__.' LINE: '.__LINE__;
print_r($arFields);
echo '</pre>';	*/


					$arResult['DISPLAY_PROPERTIES']['DESCRIPTIONS']['LINK_ELEMENT_VALUE'][] = $arFields;
				}

			}
			$arResult["DISPLAY_PROPERTIES"][$code]['NAME'] = preg_replace('@\([^)]+\)@', '', $values["NAME"]);
		}

		/*
		echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;
		print_r($arResult["DISPLAY_PROPERTIES"]['BIND_PODAROK']);
		echo '</pre>';

		echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;
		print_r($arResult["DISPLAY_PROPERTIES"]);
		echo '</pre>';	*/


		/* MORE PHOTO */
		/*if ($arResult["PROPERTIES"]["MORE_PHOTO"]['VALUE']) {
			$values = $arResult["PROPERTIES"]["MORE_PHOTO"]['VALUE'];

			foreach ($values as $file_id) {
				$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"][] = CFile::GetFileArray($file_id);
				$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO_PREVIEW"][] = CFile::ResizeImageGet($file_id, array('width'=>208, 'height'=>162), BX_RESIZE_IMAGE_PROPORTIONAL, true);
			}
		}*/

		if ($arResult["PROPERTIES"]["MORE_PHOTO"]['VALUE']) {
			$values 						= $arResult["PROPERTIES"]["MORE_PHOTO"]['VALUE'];
			$arResult["TOTAL_MORE_PHOTO"] 	= sizeof($values);

			if ($max_photo) {
				$values = array_slice($values, 0, $max_photo - 1);
			}

			$arResult["MORE_MORE_PHOTO"] 	= $arResult["TOTAL_MORE_PHOTO"] - $max_photo;
			$arResult["USE_MORE_PHOTO"] 	= 1 + min($max_photo, $arResult["TOTAL_MORE_PHOTO"]);

			foreach ($values as $file_id) {
				$arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"][] = self::prepare_more_photo_item ($file_id);
			}
		}
		
		/*if ($GLOBALS['USER']->GetID() == 10) {
			echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;
			print_r($arResult["PROPERTIES"]["MORE_PHOTO"]);
			echo '</pre>';
			echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;
			print_r($arResult["DISPLAY_PROPERTIES"]["MORE_PHOTO"]);
			echo '</pre>';
		
		}*/



		/* FIND NAVESNOE OBORUDOVANIE */
		if ($arResult["DISPLAY_PROPERTIES"]["BIND_OBORUDOVANIE"]['VALUE']) {
			$arResult["NAVES_COUNT"] = sizeof($arResult["DISPLAY_PROPERTIES"]["BIND_OBORUDOVANIE"]['VALUE']);
		}

		/* FIND REVIEWS COUNT */
		CModule::IncludeModule('iblock');
		$arFilter 	= array(
			"IBLOCK_ID"			=> 1,
			"PROPERTY_PRODUCT"	=> $arResult['ID'],
		);
		// $arSelect 	= array('ID', 'NAME', 'ACTIVE');
		$res 		= CIBlockElement::GetList(array("ID"=>"DESC"), $arFilter, false, array("nTopCount"=>5000), $arSelect);
		while ($arFields = $res->GetNext()){
			$arResult["REVIEWS"][] = $arFields;
		}
		if ($arResult["REVIEWS"]) {
			$arResult["REVIEWS_COUNT"] = sizeof($arResult["REVIEWS"]);
		}


		/* FIND VIDEO COUNT */
		CModule::IncludeModule('iblock');
		$arFilter 	= array(
			"IBLOCK_ID"			=> 7,
			"PROPERTY_PRODUCT"	=> $arResult['ID'],
		);
		// $arSelect 	= array('ID', 'NAME', 'ACTIVE');
		$res 		= CIBlockElement::GetList(array("ID"=>"DESC"), $arFilter, false, array("nTopCount"=>5000), $arSelect);
		while ($arFields = $res->GetNext()){
			$arResult["VIDEOS"][] = $arFields;
		}
		if ($arResult["VIDEOS"]) {
			$arResult["VIDEOS_COUNT"] = sizeof($arResult["VIDEOS"]);
		}

		/* PODAROK */
		if ($arResult["PROPERTIES"]["BIND_PODAROK"]["VALUE"]) {
			$arResult["PODAROK_COUNT"] = sizeof($arResult["PROPERTIES"]["BIND_PODAROK"]["VALUE"]);
		} else {
			$arResult["PODAROK_COUNT"] = 0;
		}

		/* SECTION */
		if (!$arResult['SECTION']) {
			$arSelect = array('ID', 'IBLOCK_ID', 'NAME', 'UF_SHORT_NAME');
			$arFilter = array('IBLOCK_ID' => $arResult['IBLOCK_ID'], 'ID' => $arResult['IBLOCK_SECTION_ID']);
			$rSection = CIBlockSection::GetList(array('ID' => 'DESC'), $arFilter, false, $arSelect, array("nTopCount"=>1) );
			while($arSection = $rSection->GetNext()) {
				if (!$arSection['UF_SHORT_NAME']) {
					$arSection['UF_SHORT_NAME'] = $arSection['NAME'];
				}/**/
				$arResult['SECTION'] = $arSection;
			}
		}

/*echo '<pre>$arParams = '.__FILE__.' LINE: '.__LINE__;
print_r($arParams);
echo '</pre>';


echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;
print_r($arResult['SECTION']);
echo '</pre>';
die();*/

	}
	function show_bonuses ($arResult) {
		?><ul>
		<? if( $arResult["PODAROK_COUNT"] > 0 ): ?>
			<li class="percent">
				<a href="/popup/presents/?id=<?= $arResult["ID"];?>" class="popup-modal-ajax" title="Подарки">
					<img src="/local/frontend/build/img/svg/percent.svg" alt="Подарки" title="Подарки" />
					<span><?= $arResult["PODAROK_COUNT"]; ?> <?= Francysk\Framework\Tools\TextDecline::getWordNum($iCountPodarki, ['подарок', 'подарка', 'подарков'])?></span>
				</a>
			</li>
		<? endif; ?>
		<? foreach ($arResult["DISPLAY_PROPERTIES"]["BONUS"]["LINK_ELEMENT_VALUE"] as $aBonus): ?>
			<li class="<?= $aBonus["CODE"]; ?>">
				<img src="<?= $aBonus["ICON"]["SRC"]; ?>" alt="<?= $aBonus["NAME"]; ?>" titile="<?= $aBonus["NAME"]; ?>" />
				<span><?= $aBonus["NAME"]; ?></span>                                    
			</li>
		<? endforeach; ?>
		</ul><?
	}
	function show_element ($arResult) {
		self::prepare_element($arResult);

	}
	function show_price($arResult, $mode = 'old_down') {
		/*if ($arResult['MIN_PRICE']['DISCOUNT_VALUE']) {

			?>
			<div class="product__price"><?
				if ($arResult['MIN_PRICE']['DISCOUNT_DIFF']) {
					?><div><span class="price-old"><?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span><!--<span class="price-old price-not-through"> р.</span>--></div><?

				}

				?><div><span class="price"><?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></span><!--<span class="price price-not-through"> р.</span>--></div>
			</div>
			<?
		}*/

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;
print_r($arResult['MIN_PRICE']);
echo '</pre>';
die();*/
		if ($arResult['MIN_PRICE']['DISCOUNT_VALUE']) {
			if ($arResult['MIN_PRICE']['DISCOUNT_DIFF']) {
				if ($mode == 'old_down') {
					?>
					<div class="banner-product-open__price banner-product-open__price_old">
						<div class="js-banner-product-countUp price" data-end="<?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?>" data-start="<?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?>"><?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></div>
						<div class="js-banner-product-countUp price-old" data-end="<?=$arResult['MIN_PRICE']['PRINT_VALUE']?>" data-start="0"><?=$arResult['MIN_PRICE']['PRINT_VALUE']?></div>
					</div>
					<?
				} else {
					?>
					<div class="banner-product-open__price banner-product-open__price_old">
						<div class="js-banner-product-countUp price-old" data-end="<?=$arResult['MIN_PRICE']['PRINT_VALUE']?>" data-start="0"><?=$arResult['MIN_PRICE']['PRINT_VALUE']?></div>
						<div class="js-banner-product-countUp price" data-end="<?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?>" data-start="<?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?>"><?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></div>
					</div>
					<?
				}
			} else {
				?>
				<div class="banner-product-open__price">
					<div class="js-banner-product-countUp price price_normal" data-end="<?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?>" data-start="0"><?=$arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']?></div>
				</div>
				<?
			}
		}
	}
	function show_buttons ($arResult, $full = true) {
		if ($full) {
			?><div class="product__links">
				<a target="" class="btn btn_min" href="<?= $arResult["DETAIL_PAGE_URL"] ?>">Подробнее</a><?
				self::show_buttons_sub($arResult);
			?></div><?
		} else {
			?><div class="product__link"><a class="btn btn_white" href="<?= $arResult["DETAIL_PAGE_URL"]; ?>" target="" title="Подробнее">Подробнее</a></div><?
		}
	}
	function show_buttons_sub ($arResult) {
		if ($arResult['MIN_PRICE']['PRINT_DISCOUNT_VALUE']) {
			?><a target="" class="btn btn_green btn_min popup-modal-ajax" href="/popup/popup-buy/?ELEMENT_ID=<?=$arResult['ID']?>&MODE=BUY">Купить</a><?
		} else {
			?><a target="" class="btn btn_green btn_min popup-modal-ajax" href="/popup/popup-buy/?ELEMENT_ID=<?=$arResult['ID']?>&MODE=CALC">Рассчитать цену</a><?
		} ?>
		<a target="" class="dot-link-one-line popup-modal-ajax" href="/popup/popup-buy/?ELEMENT_ID=<?=$arResult['ID']?>&MODE=CREDIT" title="Рассрочка/кредит"><span class="dot-link-one-line__name">Рассрочка/кредит</span></a>
		<?
		
	}
	function show_reviews ($arResult) {
		if ($arResult["REVIEWS_COUNT"]) {
			?><div class="product__review product__info-top">
				<a href="#" target="" title="<?=$arResult["REVIEWS_COUNT"]?> отзывов"><span><?=$arResult["REVIEWS_COUNT"]?> отзывов</span></a>
			</div><?
		}
	}
	function show_gifts ($arResult) {
		if ($arResult["PODAROK_COUNT"]) {
			$s = $arResult["PODAROK_COUNT"].' '.Francysk\Framework\Tools\TextDecline::getWordNum($iCountPodarki, ['подарок', 'подарка', 'подарков']);
			?><div class="product__gift-count">
				<img src="/local/frontend/build/img/svg/gift<?=$arResult["PODAROK_COUNT"]?>.svg" alt="<?=$s?>"><?=$s?>
			</div><?
		}
	}
	function show_gifts_2 ($arResult) {
		if ($arResult["PODAROK_COUNT"]) {
			$s = Francysk\Framework\Tools\TextDecline::getWordNum($arResult["PODAROK_COUNT"], ['подарок', 'подарка', 'подарков']);
			?><a class="dot-link-one-line popup-modal-ajax" href="/popup/presents/?id=<?=$arResult['ID']?>"><img src="img/svg/gift<?=$arResult["PODAROK_COUNT"]?>.svg" alt=""><span class="dot-link-one-line__name"><?=$arResult["PODAROK_COUNT"]?> <?=$s?></span></a><?
		}
	}

	function show_gifts_images ($arResult) {
		if ($arResult["PODAROK_COUNT"]) {
			/*echo '<pre>$BIND_PODAROK = '.__FILE__.' LINE: '.__LINE__;
			print_r($arResult['PROPERTIES']["BIND_PODAROK"]);
			echo '</pre>';	*/
			?><div>
				<div class="txt">Подарки <br>к этому товару:</div>
				<div class="banner-product-open__gift">
				<?
				foreach ($arResult['DISPLAY_PROPERTIES']["BIND_PODAROK"]["LINK_ELEMENT_VALUE"] as $ar) {
					?><div class="banner-product-open__gift-item">
						<div class="gift js-tooltip tooltipstered" data-position-x="left" data-offset-x="-58" data-offset-y="-20">
							<div class="gift__plus"></div>
							<img src="<?=$ar['PREVIEW_PICTURE_SMALL']['src']?>" alt="<?=$ar['NAME']?>">
						</div>
					</div><?
				}
				?></div>
			</div><?
		}
	}

	function show_allready_buy ($arResult) {
		if ($arResult['PROPERTIES']['COUNT_BUY']['VALUE']) {
			?><a class="dot-link-one-line popup-modal-ajax" href="/popup/number-buyers/" title="Количество купивших"><span class="dot-link-one-line__name"><?=$arResult['PROPERTIES']['COUNT_BUY']['VALUE']?> человек уже купили этот товар!</span></a>	<?
		}
	}

	function show_have_qu () {
		?>
		<div class="detail__form">
			<div class="detail-form detail-form_1">
				<div class="detail-form__name section-title"> <span>Остались вопросы?</span></div>
				<div class="detail-form__row detail-form__row-top">
					<div class="detail-form__col detail-form__col_max">
						<div class="detail-form__text">Мы с удовольствием на них ответим! <br>Ежедневно, с 9:00 до 18:00 </div>
					</div>
					<div class="detail-form__col">
						<form id="save_phone_form" class="save_phone_form" method="post" enctype="multipart/form-data">
							<input type="hidden" name="MODE" value="have_qu">
							<div class="input-phone">
								<label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
								<label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
								<? KRONOS_CATALOG::show_phone_sub (); ?>
							</div>
							<button class="btn btn_white" type="submit">Перезвоните мне</button>
						</form>
					</div>
				</div>
				<? self::show_glad (); ?>

			</div>
		</div>
		<?
	}
	function call_client () {
		?>
		<div class="detail__form">
			<div class="detail-form detail-form_2">
				<div class="detail-form__name">Хотите лично пообщаться с кем-то из наших клиентов?</div>
				<div class="detail-form__row detail-form__row-top">
					<div class="detail-form__col detail-form__col_max">
						<div class="detail-form__text">
							Оставьте номер своего телефона, мы предоставим
							Вам контакты клиентов, купивших интересующую
							Вас технику, что бы Вы могли лично узнать обо всех
							её плюсах и минусах и определиться с выбором.
						</div>
					</div>
					<div class="detail-form__col">
						<? self::show_phone ('call_client'); ?>
					</div>
				</div>
				<? self::show_glad (); ?>
			</div>
		</div>
		<?
	}
	function show_phone_sub () {
		?>
		<div class="input-phone__container">
			<div class="input-phone input-phone_mob" data-lang="ru">
				<div class="input-phone__row">
					<div class="input-phone__input">
						<div class="input-phone__placeholder" tabindex="0">
							<div class="input-phone__placeholder-inner">
								<span class="input-phone__code">+7 </span><span class="input-phone__phone">___ ___-__-__</span>
							</div>
						</div>
						<input id="input-phone" name="input-phone" type="tel" placeholder="+7 ___ ___-__-__" >
					</div>
					<div class="input-phone__lang">
						<div class="lang" data-lang="ru"><a class="lang__current"><img src="/local/frontend/build/img/Russia.png" alt="Россия"></a>
							<div class="lang__list">
								<div class="lang__list-table">
									<a class="lang__list-row active" data-lang="ru">
										<div class="lang__list-cell">Россия</div>
										<div class="lang__list-cell">
											<div class="lang__flag"><img src="/local/frontend/build/img/Russia.png" alt="Россия"></div>
										</div>
									</a>
									<a class="lang__list-row" data-lang="by">
										<div class="lang__list-cell">Беларусь</div>
										<div class="lang__list-cell">
											<div class="lang__flag"><img src="/local/frontend/build/img/Belarus.png" alt="Беларусь"></div>
										</div>
									</a>
									<a class="lang__list-row" data-lang="kz">
										<div class="lang__list-cell">Қазақстан</div>
										<div class="lang__list-cell">
											<div class="lang__flag"><img src="/local/frontend/build/img/kazakhstan.png" alt="Қазақстан"></div>
										</div>
									</a>
									<a class="lang__list-row" data-lang="ky">
										<div class="lang__list-cell">Кыргыз</div>
										<div class="lang__list-cell">
											<div class="lang__flag"><img src="/local/frontend/build/img/kyrgyzstan.png" alt="Кыргыз"></div>
										</div>
									</a>
									<a class="lang__list-row" data-lang="arm">
										<div class="lang__list-cell">Հայաստանի</div>
										<div class="lang__list-cell">
											<div class="lang__flag"><img src="/local/frontend/build/img/armenia.png" alt="Հայաստանի"></div>
										</div>
									</a>
								</div>
							</div>
						</div>
					</div>

				</div>
			</div>
		</div>
		<script>App.mask.phone.init(".input-phone__container");</script>

		<?

	}
	function show_phone ($mode = 'free-call') {
		?>
		<form id="save_phone_form" class="save_phone_form" method="post" enctype="multipart/form-data">
			<input type="hidden" name="MODE" value="<?=$mode?>">
			<div class="input-phone__container">
				<div class="input-phone">
					<label class="d-tb-none" for="input-phone">Введите номер Вашего телефона:</label>
					<label class="d-dt2x-none d-tb-block" for="input-phone">Ваш телефон:</label>
				</div>
				<? self::show_phone_sub (); ?>
			</div>
			<button class="btn btn_white" type="submit">Отправить</button>
		</form>
		<?
	}
	function show_glad () {
		?>
		<div class="detail-form__row detail-form__row-bottom">
			<div class="detail-form__col detail-form__col_left">
				<div class="detail-form__row detail-form__row-count">
					<div class="detail-form__col detail-form__col_max">
						<div class="detail-form__text2">
							Мы ежемесячно подсчитываем количество
							и индекс удовлетворенности наших клиентов.
						</div>
					</div>
					<div class="detail-form__col">
						<div class="detail-form__count"><span>1345</span><span class="detail-form__text2">человек стали нашими покупателями в прошлом месяце</span></div>
					</div>
				</div>
			</div>
			<div class="detail-form__col detail-form__col_right">
				<div class="detail-form__row detail-form__row-satisfaction">
					<div class="satisfaction-index">
						<div class="satisfaction-index__item">
							<div class="satisfaction-index__item-img"><img src="/local/frontend/build/img/1.png" alt=""></div>
							<div class="satisfaction-index__item-info">
								<div class="satisfaction-index__item-percent">78%</div>
								<div class="satisfaction-index__item-text">очень довольны</div>
							</div>
						</div>
						<div class="satisfaction-index__item">
							<div class="satisfaction-index__item-img"><img src="/local/frontend/build/img/2.png" alt=""></div>
							<div class="satisfaction-index__item-info">
								<div class="satisfaction-index__item-percent">19%</div>
								<div class="satisfaction-index__item-text">довольны</div>
							</div>
						</div>
						<div class="satisfaction-index__item">
							<div class="satisfaction-index__item-img"><img src="/local/frontend/build/img/3.png" alt=""></div>
							<div class="satisfaction-index__item-info">
								<div class="satisfaction-index__item-percent">3%</div>
								<div class="satisfaction-index__item-text">недовольны</div>
							</div>
						</div>
					</div>
				</div>
			</div>
		</div>
		<?
	}
	function show_address ($arItem) {
		?><div class="address">
			<svg>
			<use xlink:href="/local/frontend/build/img/sprite-custom.svg#svg-icon-point"></use>
			</svg>
			<span class="address__text">
				<span class="address__point"><?= $arItem["PROPERTIES"]["ADDRESS"]["VALUE"]; ?></span>
				<span class="address__country">
					<img src="<?=$arItem["DISPLAY_PROPERTIES"]["COUNTRY"]["SRC"]; ?>" title="<?= $arItem["PROPERTIES"]["COUNTRY"]["VALUE"]; ?>" alt="<?= $arItem["PROPERTIES"]["COUNTRY"]["VALUE"]; ?>">
					<span><?= $arItem["PROPERTIES"]["COUNTRY"]["VALUE"]; ?></span>
				</span>
			</span>
		</div><?
	}
	function show_brand ($arResult) {
		?><a class="dot-link-one-line" target="" href="<?=$arResult['MANUFACTURE_SECTION_PAGE_URL']?>">
			<span class="dot-link-one-line__name">Все товары бренда &#171;<?=$arResult['MANUFACTURE']['VALUE']?>&#187;</span>
		</a><?
	}
	function show_list ($max_count = 4, $filter_sufix = '', $template = 'kronos-bonus') {
		/*if ($GLOBALS['arrFilterProducts']['>SORT']) {

		}*/

		// echo '<br>SORT '.$filter_sufix.' = '.$GLOBALS['arrFilterProducts'.$filter_sufix]['>SORT'];

		if (!$GLOBALS['arrFilterProducts'.$filter_sufix]['>PROPERTY_MAIN_SORT']) {
			$GLOBALS['arrFilterProducts'.$filter_sufix]['>PROPERTY_MAIN_SORT'] = 0;
		}
		$GLOBALS['APPLICATION']->IncludeComponent(
			"bitrix:catalog.top",
			"kronos",
			Array(
				'MAX_COUNT' 	=> $max_count,
				'TEMPLATE'		=> $template,
				"FILTER_NAME" 	=> "arrFilterProducts".$filter_sufix,

				"ACTION_VARIABLE" => "action",
				"ADD_PICT_PROP" => "-",
				"ADD_PROPERTIES_TO_BASKET" => "Y",
				"ADD_TO_BASKET_ACTION" => "ADD",
				"BASKET_URL" => "/personal/basket.php",
				"CACHE_FILTER" => "N",
				"CACHE_GROUPS" => "N",
				"CACHE_TIME" => "36000000",
				"CACHE_TYPE" => "A",
				"COMPARE_NAME" => "CATALOG_COMPARE_LIST",
				"COMPATIBLE_MODE" => "Y",
				"CONVERT_CURRENCY" => "N",
				"CUSTOM_FILTER" => "",
				"DETAIL_URL" => "",
				"DISPLAY_COMPARE" => "N",
				"ELEMENT_COUNT" => "15",
				"ELEMENT_SORT_FIELD" => "PROPERTY_MAIN_SORT",
				"ELEMENT_SORT_FIELD2" => "",
				"ELEMENT_SORT_ORDER" => "asc",
				"ELEMENT_SORT_ORDER2" => "desc",
				"ENLARGE_PRODUCT" => "STRICT",
				"HIDE_NOT_AVAILABLE" => "N",
				"HIDE_NOT_AVAILABLE_OFFERS" => "N",
				"IBLOCK_ID" => "2",
				"IBLOCK_TYPE" => "1c_catalog",
				"LABEL_PROP" => array(),
				"LINE_ELEMENT_COUNT" => "3",
				"MESS_BTN_ADD_TO_BASKET" => "В корзину",
				"MESS_BTN_BUY" => "Купить",
				"MESS_BTN_COMPARE" => "Сравнить",
				"MESS_BTN_DETAIL" => "Подробнее",
				"MESS_NOT_AVAILABLE" => "Нет в наличии",
				"OFFERS_LIMIT" => "5",
				"PARTIAL_PRODUCT_PROPERTIES" => "N",
				"PRICE_CODE" => array("Цена розница"),
				"PRICE_VAT_INCLUDE" => "Y",
				"PRODUCT_BLOCKS_ORDER" => "price,props,sku,quantityLimit,quantity,buttons",
				"PRODUCT_ID_VARIABLE" => "id",
				"PRODUCT_PROPS_VARIABLE" => "prop",
				"PRODUCT_QUANTITY_VARIABLE" => "quantity",
				"PRODUCT_ROW_VARIANTS" => "[{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false},{'VARIANT':'2','BIG_DATA':false}]",
				"PRODUCT_SUBSCRIPTION" => "N",
				"PROPERTY_CODE_MOBILE" => array(),
				"ROTATE_TIMER" => "30",
				"SECTION_URL" => "",
				"SEF_MODE" => "N",
				"SEF_RULE" => "",
				"SHOW_CLOSE_POPUP" => "N",
				"SHOW_DISCOUNT_PERCENT" => "N",
				"SHOW_MAX_QUANTITY" => "N",
				"SHOW_OLD_PRICE" => "N",
				"SHOW_PAGINATION" => "N",
				"SHOW_PRICE_COUNT" => "1",
				"SHOW_SLIDER" => "N",
				"SLIDER_INTERVAL" => "3000",
				"SLIDER_PROGRESS" => "N",
				"TEMPLATE_THEME" => "blue",
				"USE_ENHANCED_ECOMMERCE" => "N",
				"USE_PRICE_COUNT" => "N",
				"USE_PRODUCT_QUANTITY" => "N",
				"VIEW_MODE" => "SECTION"
			)
		);


	}
	function get_download_catalog_data () {
		$arResult = array();
		$file = $_SERVER['DOCUMENT_ROOT'].'/upload/katalog.pdf';
		$arResult['FILE_SIZE'] = round(filesize($file)/1024/1024, 1);
		//$arResult['FILE_TIME'] = date ("d.m.Y", filemtime($file));
		$arResult['FILE_TIME'] = date ("d.m.Y", time() - 7*24*60*60);
		return $arResult;
	}
	function get_regions_list() {
		$arResult = array();
		CModule::IncludeModule('iblock');
		$arFilter 	= array(   
			"IBLOCK_ID"	=> 21,    
			"ACTIVE"	=> 'Y',    
		);
		$arSelect 	= array('NAME');
		$res 		= CIBlockElement::GetList(array("NAME"=>"ASC"), $arFilter, false, array("nTopCount"=>200), $arSelect);
		while ($arFields = $res->GetNext()){
			$arResult[] = 	$arFields['NAME'];	
		}
		return $arResult;
	}
}