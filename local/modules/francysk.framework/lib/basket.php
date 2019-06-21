<?php

namespace Francysk\Base;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Basket {
    
    static public function getIDs() {
        $dbResult = \CSaleBasket::getList(
                array(),
                array(
                  "FUSER_ID" => \CSaleBasket::GetBasketUserID(),
                  "LID" => SITE_ID,
                  "ORDER_ID" => "NULL"
                ),
                false,
                false,
                array()
        );
        $result = array();
        while( $row = $dbResult->fetch() ) {
            $result[] = $row["PRODUCT_ID"];
        }
        
        return $result;
    }
}