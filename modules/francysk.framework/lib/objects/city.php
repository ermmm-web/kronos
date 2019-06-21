<?php

namespace Francysk\Framework\Objects;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\AbstractClass\Object;
use Francysk\Framework\Core\Config;

class City extends Object
{
    private $aCity;
    
    private $iCurrentCity = 2;
    
    protected function initModel() {
        $this->oModel = new \Francysk\Framework\Model\FCIBlockElement;
        $this->oModel->setOrder(["SORT" => "ASC"])
                ->addFilter(["IBLOCK_ID" => 2, "ACTIVE" => "Y"]);
    }
    
    protected function initParams( $result ) {
        foreach( $result as $city ) {
            $this->aCity[$city["ID"]] = $city;
        }
    }
    
    protected function getDate() {
        $result = [];
        $this->oModel->execute();
        while ( $row = $this->oModel->fetch() ) {
            $result[] = $row;
        }

        return $result;
    }
    
    public function setCurrentCity($id) {
        $this->iCurrentCity = $id;
    }
    
    public function getCurrentCity() {
        return $this->iCurrentCity;
    }
    
    public function getCity() {
        return $this->aCity;
    }
    
    public function getCityByID($id) {
        return$this->aCity[$id];
    }
}