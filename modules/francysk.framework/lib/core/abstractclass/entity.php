<?php

namespace Francysk\Framework\Core\AbstractClass;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

abstract class Entity
{
    /**
     * Объект компонента
     * @var CBitrixComponent
     */
    protected $oComponent;
    
    /**
     * Массив логики работы
     * @var array
     */
    protected $aLogic;
    
    /**
     * Массив декораторов для каждой логики
     * @var array
     */
    protected $aDecorator;
    
    /**
     * Массив коллекций результатов каждой логики
     * @var array
     */
    protected $aCollectionResult;
    
    /**
     * Имя функции callback-а
     * @var string
     */
    protected $sCallback;

    protected function __construct($oComponent = null) {
        if ($oComponent) {
            $this->oComponent = $oComponent;
        }

        $this->initVars();

        $this->initLogic();
        $this->initDecorator();
        $this->initCollectionResult();
    }
    
    protected function initVars() {
        $this->oModel = new \Francysk\Framework\Model\FCIBlockElement();
        $this->oCollectionResult = new \Francysk\Framework\Collection\Result();
        $this->sCallback = false;
    }

    protected function getLogicResult($logic) {
        return $this->aCollectionResult[$logic];
    }
    
    protected function decorateElement($logic, $row) {
        foreach ($this->aDecorator[$logic] as $oDecorator) {
            $row = $oDecorator->decorateElement($row);
        }

        return $row;
    }
    
    public function setCallbackDecoratorFunction($sCallback) {
        $this->sCallback = $sCallback;
    }
    
    public function setCollectionResult($oCollection) {
        $this->oCollectionResult = $oCollection;
        return $this;
    }

    public function getModel() {
        return $this->oModel;
    }
    
    public function setModel($oModel) {
        $this->oModel = $oModel;
        return $this;
    }
    
    abstract protected function initLogic();
    abstract protected function initDecorator();
    abstract protected function initCollectionResult();
    abstract protected function getResult();

}
