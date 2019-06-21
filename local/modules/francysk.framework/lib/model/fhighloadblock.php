<?php

namespace Francysk\Framework\Model;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Model;

class FHighloadBlock extends Model
{
    private $oHighload;
    
    private $limit;
    
    protected function initParams( $arParams ) {
        \CModule::includeModule('highloadblock');
        parent::initParams($arParams);
        $this->limit = false;
    }
    
    public function initHighload($id) {
        $hlblock = \Bitrix\Highloadblock\HighloadBlockTable::getById($id)->fetch();
        $entity  = \Bitrix\Highloadblock\HighloadBlockTable::compileEntity($hlblock);
        $this->oHighload = $entity->getDataClass();
    }
    
    public function fetch() {
        return $this->oBDResult->fetch();
    }
    
    public function setLimit($limit) {
        $this->limit = $limit;
        return $this;
    }
    
    public function execute() {
        $highload = $this->oHighload;

        $fields = [
          "order" => $this->aOrder,
          "filter" => $this->aFilter,
        ];
        
        if( $this->limit ) {
            $fields["limit"] = $this->limit;
        }
        
        $this->oBDResult = $highload::getList($fields);
        //$this->oBDResult = $highload::getList(["order" => $this->aOrder, "filter" => $this->aFilter]);

        return $this;
    }
}