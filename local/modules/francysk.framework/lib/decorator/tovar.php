<?php

namespace Francysk\Base\Decorator;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Tovar extends ElementsFull {
    
    public function __construct($_objComponent = null) {
        parent::__construct($_objComponent);
    }

    public function decorateItem($row) {
        $row = parent::decorateItem($row);
       
        $row["PRICES"] = $this->objEntity->getPrices($row["ID"]);
        $this->objEntity->setItem($row);
        
        $this->objEntity->transfarmation();
        
        return $row;
    }
    
    public function decoratePrice($arPrices) {

        if( method_exists(get_class($this->objComponent), "decoratePrice") && $this->objComponent != null ) {
            $arPrices = $this->objComponent->decoratePrice($arPrices);
        }
        
        $result = array(
          "PRICE"       => $arPrices["RESULT_PRICE"]["BASE_PRICE"],
          "CURRENCY"    => $arPrices["RESULT_PRICE"]["CURRENCY"],
        );
        
        if( count($arPrices["DISCOUNT_LIST"]) > 0 ) {
            $result["PRICE"] = $arPrices["RESULT_PRICE"]["DISCOUNT_PRICE"];
            
            $result["DISCOUNT"] = array(
              "OLD_PRICE" => $arPrices["RESULT_PRICE"]["BASE_PRICE"],
              "PERCENT" => (int) $arPrices["RESULT_PRICE"]["PERCENT"],
              "DISCOUNT" => $arPrices["RESULT_PRICE"]["DISCOUNT"],
            );
        }
        
        $result["HTML"]["PRICE"] =  number_format((float) $result["PRICE"], 2, " руб.", " ").' коп.';
        $result["HTML"]["PRICE_BYR"] =  number_format((int) ceil($result["PRICE"]*10000 / 100)*100, 0, "", " ");
        if( isset($result["DISCOUNT"]) ) {
            $result["HTML"]["OLD_PRICE"] = number_format((float) $result["DISCOUNT"]["OLD_PRICE"], 2, " руб.", " ").' коп.';
            $result["HTML"]["DISCOUNT"] = number_format((float) $result["DISCOUNT"]["DISCOUNT"], 2, " руб.", " ").' коп.';
        }
                
        return $result;
    }
    
    public function collectAttributes($row) {
        foreach( $this->objEntity->getAttributes() as $code ) {
            if( isset($row["PROPERTIES"][$code]) && $row["PROPERTIES"][$code]["VALUE"] != '' ) {
                $row["ATTRIBUTES"][$code] = $row["PROPERTIES"][$code]["VALUE"];
            }
        }

        return $row;
    }
}