<?php

namespace Francysk\Framework\View;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Objects\BindProp;

class Card extends Base
{   
    private $aGroupProperty;
    
    public function __construct($aItem) {
        parent::__construct($aItem);        
    }
    
    public function getHtmlProps(): String {

		/*echo '<pre>$this = '.__FILE__.' LINE: '.__LINE__;	
		print_r($this->aItem['PROPERTIES']['MINI_MANUFACTURE']);		
		echo '</pre>';	*/		

		
        $html = '';
        $htmlSub = '';
        foreach( $this->getGroupProperty() as $aProp ) {

			/*echo '<pre>$aProp = '.__FILE__.' LINE: '.__LINE__;	
			print_r($aProp);		
			echo '</pre>';	*/		
			
            $htmlSub = '<div class="detail-ch__item"><div class="detail-ch__name">'.$aProp["NAME"].'</div><div class="detail-ch__props"><div class="props"><div class="props__table">';
            $bOk = false;

            foreach ($aProp["PROPS"] as $code) {
				if (!$code) {
					continue;	
				}
                $name = $this->getNameProp($code);
				$name = trim(preg_replace('@\([^)]+\)@', '', $name)) ;
                $value 	= $this->getPropertyValue($code);
                $xml_id = $this->aItem['PROPERTIES'][$code]['XML_ID'];
				// echo '<br>$xml_id = '.$xml_id;
                
                if(!empty($value) ) {
                    $bOk = true;
                    $htmlSub .= '<div class="props__tr '.$code.'">';
                    $htmlSub .= '<div class="props__td">'.$name.':</div>';
                    $htmlSub .= '<div class="props__td">'.$value.' '.$xml_id.'</div>';
                    $htmlSub .= '</div>';
                }                
            }
            
            if( !$bOk ) {
                $htmlSub = '';
            } else {
                $htmlSub .= '</div></div></div></div>';
            }
            
            $html .= $htmlSub;
        }
        
        return $html;
    }
    
    public function getGroupProperty(): array {
        \CBitrixComponent::includeComponentClass("francysk.lib:hl.gruppprop");
        $aGruppProp = \HLGruppProp::get(new \Francysk\Framework\Collection\ResultByID(), []);
 
        $index = 0;

		/*$ar = BindProp::getInstance()->getGruppOnSection($this->aItem["IBLOCK_SECTION_ID"]);

		echo '<pre>$arResult 3 = '.__FILE__.' LINE: '.__LINE__;	
		print_r($ar);		
		echo '</pre>';	*/		

		
        foreach( BindProp::getInstance()->getGruppOnSection($this->aItem["IBLOCK_SECTION_ID"]) as $iGrupp => $iProp ) {


			
            $result[$index++] = [
                "NAME" => $aGruppProp[$iGrupp]["UF_NAME"],
                "PROPS" => $iProp
            ];
        }

        return $result;
        
        /*return [
            [
                "NAME" => "Общие",
                "PROPS" => ["MINI_MANUFACTURE", "WEIGHT", "GABARITY", "KABINA", "TIP_ZADNEI_NAVESKI", "ELEKTROROZETKA", "TIP_TORMOZNOI_SISTEMY", "GIDRO_RULIA", "GIDROVYHODY", "GARANTIAY"],            
            ],
            [
                "NAME" => "Двигатель",
                "PROPS" => ["MARKA_DVIGATELYA", "ENGINE", "ZILINDRY", "TIP_SMAZKI", "RASHOD_TOPLIVA", "SYSTEM_ZAPUSK", "OHLADI_TRA"],
            ],
            [
                "NAME" => "Трансмиссия",
                "PROPS" => ["PRIVOD", "KOLICHESTVO_PEREDACH", "TIP_SCEPLENIYA", "TIP_KOROBKI_PEREDACH", "BLOKIROVKA_DIFFERENZIALA", "CHASTOTA_VRASHCHENIYA_VOM_OB"]
            ],
            [
                "NAME" => "Ходовая часть",
                "PROPS" => ["DOROJNYI_PROSVET", "MAX_SPEED", "MINI_FORMULA", "PEREDNIE_KOLESA", "ZADNIE_KOLESA", "SHIRINA_KOLEI"]
            ],
            [
                "NAME" => "Обработка",
                "PROPS" => ["SHIRINA_ZAXVATA_POCHVOFREZY", "GLUBINA_OBRABOTKI"]
            ]
        ];*/
    }
    
    public function getPrice(): String {                
        $html = '';
        
        if( $this->aItem["PROPERTIES"]["PRICE"]["VALUE"] > 0 ) {
            $html = sprintf('<div class="price">%s р.</div>', number_format($this->aItem["PROPERTIES"]["PRICE"]["VALUE"], 0, " ", " "));
            
            if( !empty($this->aItem["PROPERTIES"]["BONUS"]["VALUE"]) ) {
                foreach( $this->aItem["PROPERTIES"]["BONUS"]["VALUE"] as $id ) {
                    if( \Francysk\Framework\Objects\Bonus::getInstance()->isPersent($id) ) {
                        $aPersent = \Francysk\Framework\Objects\Bonus::getInstance()->getPersent($id);
                        
                        //$oldPrice = $aPersent["PERSENT"] / 100 * $this->aItem["PROPERTIES"]["PRICE"]["VALUE"] + $this->aItem["PROPERTIES"]["PRICE"]["VALUE"];
                        $oldPrice = $this->aItem["PROPERTIES"]["PRICE"]["VALUE"] / ((100 - $aPersent["PERSENT"])/100);
                        $html .= sprintf('<div class="price-old"><span>%s</span> р.</div>', number_format($oldPrice, 0, " ", " "));
                    }
                }
            }
        }
        return $html;
    }    
    
    public function getComplectacia(): array {
        $result = [];
       
        $result = $this->aItem["PROPERTIES"]["COMPLECT"]["VALUE"];
        
        return $result;
    }
}