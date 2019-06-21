<?php



if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();



use Francysk\Framework\Objects\BindProp;



class FrancyskEvent

{

    static public function addBeforeElement(&$arFields) {

        

        if( self::isIblockProduct($arFields) ) {

            if( !self::checkProps($arFields) ) {

                return false;

            }                        

        }

        

        return true;

    }

    

    static public function updateBeforeElement(&$arFields) {

        if( self::isIblockProduct($arFields) ) {

            if( !self::checkProps($arFields) ) {

                return false;

            }         

        }

        

        return true;

    }

    

    static private function checkProps($arFields) {

        $iSection = $arFields["IBLOCK_SECTION"][0];

        

        $bReturn = true;



        foreach( BindProp::getInstance()->getPropOnSection($iSection) as $iProp ) {

            if( empty($arFields["PROPERTY_VALUES"][$iProp])) {

                $bReturn = false;

                $aError[] = BindProp::getInstance()->getPropName($iProp); 

                continue;

            }

            

            $first = array_shift($arFields["PROPERTY_VALUES"][$iProp]);

            

            if( empty($first["VALUE"]) ) {

                $bReturn = false;

                $aError[] = BindProp::getInstance()->getPropName($iProp); 

                continue;

            }

        }

        

        if( !$bReturn ) {

          //  $GLOBALS["APPLICATION"]->ThrowException("Не заполненны обязательные характеристики:\n- ".implode("\n- ", $aError));

        }
$bReturn = true;


        return $bReturn;

    }

    

    static private function isIblockProduct($arFields): bool {

        return $arFields["IBLOCK_ID"] == IBLOCK_ID_PRODUCT;

    }

}