<?php

namespace Francysk\Framework\Objects;


if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Object;
use Francysk\Framework\Core\Config;

class BindProp extends Object {
    
    private $aElementToBind;
    
    /*
     * Тк несколько разделов имеют одинаковые свойства и чтобы не увеливать хранения в памяти лишних пар 
     * idРаздела => idСвойства
     * тут запишем привязки и сохраним в кеше одну
     */
    private $aOptimaze;
    
    private $aSectionProp;
    private $aGruppProp;
    private $aProp;
    private $aPropCode;
    
    static protected $instance = null;
    
    public function getGruppOnSection($iSection) {
        // $iSection = $this->aOptimaze[$iSection];
        return $this->aGruppProp[$iSection];
    }
    
    public function getPropOnSection($iSection) {
        $iSection = $this->aOptimaze[$iSection];
        return $this->aSectionProp[$iSection];
    }
    
    public function getPropName($iID) {
        return $this->aProp[$iID];
    }
    
    
    protected function initModel() {
        $this->oModel = $GLOBALS["DB"]->Query("SELECT * FROM b_iblock_element_property WHERE IBLOCK_PROPERTY_ID IN (182, 183)");
    }
    
    protected function initParams( $result ) {
        $this->aProp = $result["PROP"];
        $this->aPropCode = $result["PROP_CODE"];

        foreach( $result["BIND"] as $iElement => $arItem ) {
             
            $iSection = false;
            foreach( $arItem["SECTIONS"] as $id ) {
                if( !$iSection ) {
                    $iSection = $id;
                }
                
                $this->aOptimaze[$id] = $iSection;
				
				foreach( $arItem["PROPS"] as $iProp => $iGroup ) {
					$this->aSectionProp[$id][$iProp] = $iProp;
					$this->aGruppProp[$id][$iGroup][$iProp] = $this->aPropCode[$iProp];
				}
            }
        }

		/*echo '<pre>$this = '.__FILE__.' LINE: '.__LINE__;	
		print_r($this);		
		echo '</pre>';	*/		
		
    }
    
    protected function getDate(): array {
        $result = [];
        
        while ( $row = $this->oModel->fetch() ) {           
            if( $row["IBLOCK_PROPERTY_ID"] == 182 ) {
                $result["BIND"][$row["IBLOCK_ELEMENT_ID"]]["SECTIONS"][$row["VALUE"]] = $row["VALUE"];
            } elseif( $row["IBLOCK_PROPERTY_ID"] == 183 ) {
                $props[$row["VALUE"]] = $row["VALUE"];
                $result["BIND"][$row["IBLOCK_ELEMENT_ID"]]["PROPS"][$row["VALUE"]] = $row["DESCRIPTION"];
            }
        }
        
        $db = \Bitrix\Iblock\PropertyTable::getList(["filter" => ["ID" => $props]]);
        while( $row = $db->fetch() ) {
            $result["PROP"][$row["ID"]] = $row["NAME"];
            $result["PROP_CODE"][$row["ID"]] = $row["CODE"];
        }
       
        return $result;
    }
    
    public function get($iID) {
        return $this->aData[$iID];
    }
    
    protected function getTimeCache(): int {
        return 30 * 600;
    }
    
    protected function getCacheID(): String {
        return md5("OBJECTS_BINDPROP");
    }
    
    static public function getInstance() {

        if (static::$instance == null) {
            static::$instance = new static();
        }

        return static::$instance;
    }
}
