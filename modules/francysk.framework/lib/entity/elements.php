<?php

namespace Francysk\Framework\Entity;

use Francysk\Framework\Decorator;
use Francysk\Framework\Core\AbstractClass\Entity;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Elements extends Entity
{
    protected $aFiles;
    protected $aFilesIDs;
    
    public function __construct($oComponent = null) {
        parent::__construct($oComponent);
        $this->initFilesID();
    }
    
    public function executeEntity() {
        foreach ( $this->aLogic as $logic ) {
            $model = call_user_func([$this, "getLogicModel{$logic}"]);
            if( !is_object($model) ) {
                continue;
            }
            while( $row = $model->fetch() ) {
                $row = $this->decorateElement($logic, $row);
                
                $this->process($logic, $row);

                if(is_object($this->oComponent) && $this->sCallback ) {
                    $row = call_user_func([$this->oComponent, $this->sCallback], $row, $logic);
                }
                $this->aCollectionResult[$logic]->add($row);
            }
        }
    }
    
    public function process($logic, $row) {
        $this->pushFiles($row);
    }
    
    public function getLogicModelITEMS() {
        $this->oModel->execute();
        return $this->oModel;
    }
    
    public function getLogicModelFILES() {
        if( count($this->aFilesIDs) <= 0 ) {
            return false;
        } 
        
        $model = new \Francysk\Framework\Model\Files();
        $model->setFilter(array("@ID" => implode(",", $this->aFilesIDs)));
        $model->execute();
        return $model;
    }
    
    public function pushFiles($row) {
        foreach( $this->aFiles as $fileCode ) {
            if( isset($row[$fileCode]) && $row[$fileCode] > 0) {
                $this->aFilesIDs[] = $row[$fileCode];
            }
        }
    }

    public function getResult() {
        $this->initCollectionResult();
        $this->executeEntity();
        return array(
          "ITEMS" => $this->aCollectionResult["ITEMS"]->getResult(),
          "FILES" => $this->aCollectionResult["FILES"]->getResult(),
          "DB" => $this->oModel->getMetaDate(),
        );
    }

    protected function initLogic() {
        $this->aLogic = array(
        "ITEMS",
        "FILES"
        );
        
        return $this;
    }
    
    protected function initFilesID() {
        $this->aFiles = array(
            "PREVIEW_PICTURE",
            "DETAIL_PICTURE"
        );
    }

    protected function initDecorator() {
        $this->aDecorator["ITEMS"] = array();
        $this->aDecorator["FILES"] = array(
          new Decorator\Files()
        );
    }
    
    protected function initCollectionResult() {
        $this->aCollectionResult["ITEMS"] = $this->oCollectionResult;
        $this->aCollectionResult["FILES"] = new \Francysk\Framework\Collection\ResultByID();
    }
}
