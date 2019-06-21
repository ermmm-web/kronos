<?php

namespace Francysk\Framework\View;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Base
{
    protected $aItem;
    
    public function __construct($aItem) {
        $this->aItem = $aItem;
    }
    
    public function getShortName() {
        return $this->aItem["PROPERTIES"]["NAME"]["VALUE"];
    }
    
    public function getStatus(): String {
        if( empty($this->aItem["PROPERTIES"]["PREORDER"]["VALUE"]) ) {
            if( $this->aItem["PROPERTIES"]["STORE_SALE"]["VALUE"] > 0 ) {
                return sprintf('<div class="status">Осталось %s шт.</div>', $this->aItem["PROPERTIES"]["STORE_SALE"]["VALUE"]);
            } else {
                return '<div class="status">В наличии</div>';
            }
        } else {
            return '<div class="status status_red">Под заказ</div>';
        }
    }
    
    public function getNameProp($sCode) {
        return $this->aItem["PROPERTIES"][$sCode]["HINT"] ? $this->aItem["PROPERTIES"][$sCode]["HINT"] : $this->aItem["PROPERTIES"][$sCode]["NAME"];        
    }
    
    public function getNamePropByID($iID) {
        
    }
    
    public function getPropertyValue($sCode) {
        $aProp = $this->aItem["PROPERTIES"][$sCode];
        
        $result = '-';
        
        if( $aProp["LINK_IBLOCK_ID"] == IBLOCK_ID_PROIZVODSTVO ) {
            $aPropValue = \Francysk\Framework\Objects\Property\Brend::getInstance()->get($aProp["VALUE"]);
            $result = '<img src="'.$aPropValue["PREVIEW_PICTURE_SRC"].'" alt="'.$aPropValue["NAME"].'" title="'.$aPropValue["NAME"].'">'.$aPropValue["NAME"];
        } else {
            $result = $aProp["VALUE"];
        }
        
        return $result;
    }
        
    public function getCountBuyLink(): String {
        
        $iValue = $this->aItem["PROPERTIES"]["COUNT_BUY"]["VALUE"];
        
        return sprintf('<a class="dot-link-one-line popup-modal-ajax" href="/popup/countbuy/" title="Количество купивших"><span class="dot-link-one-line__name">%s человек уже купили этот товар!</span></a>', $iValue);
    }
    
    public function getPodarki() {
        return '<img src="/local/frontend/build/img/svg/gift5.svg" alt="5 подарков"/>Подарков';
    }
    
    static public function textHtmlEffect($sName) {
        ?>    
        <span class="link-text">
        <? 
            $sName = html_entity_decode(str_replace(" ", "&nbsp;", $sName)); 
            $aText = preg_split('//u', $sName, null, PREG_SPLIT_NO_EMPTY);
            $sText = implode("</span><span>", $aText);
        ?>
            <span><?= $sText;?></span> 
        </span>
        <span class="link-hover">
            <span><?= $sText;?></span> 
        </span><?
    }
    
    public function getCategory() {
        $iSection = $this->aItem["IBLOCK_SECTION_ID"];
        $aSection = \Francysk\Framework\Objects\StructureCatalog::getInstance($this->aItem["IBLOCK_ID"])->getSectionByID($iSection);
        return $aSection["NAME"];
    }
}