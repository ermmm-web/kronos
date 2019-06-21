<?php
namespace Francysk\Base\Model;

\CModule::IncludeModule("highloadblock"); 
use \Bitrix\Highloadblock as HL;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class Highloadblock extends Elements {
    
    private $objHighload;
    
    public function __construct( $_objDecorator, $iHighload ) {
        parent::__construct($_objDecorator);

        $this->initHighload($iHighload);
    }
    
    public function getElements( $key = true ) {
        $highload = $this->objHighload;

        $this->dbResult = $highload::getList(array(
          "filter" => $this->arFilter,
        ));
        
        $result = array();
        if( $key  ) {
            while( $row = $this->dbResult->fetch() ) {
                $row = $this->objDecorator->decorateItem($row);
                $result[$row["ID"]] = $row;
            }
        } else {
            $result = $this->dbResult->fetchAll();
        }
        
        return $result;
    }

    public function setFilter( $arFilter = array() ) {
        $this->arFilter = array();
    }
    
    public function makeFilter( $arParams ) {
        return $this;
    }
    
    private function initHighload($iHighload) {
        $hlblock = HL\HighloadBlockTable::getById($iHighload)->fetch();
        $entity  = HL\HighloadBlockTable::compileEntity($hlblock);
        $this->objHighload = $entity->getDataClass();
    }
}