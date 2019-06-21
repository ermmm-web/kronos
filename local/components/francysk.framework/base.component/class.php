<?php

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Core\Component;
use Francysk\Framework\Core\Fabrica;
use Francysk\Framework\Core\Config\FieldsClassParams;

class BaseComponent extends \CBitrixComponent
{

    protected $model;
    protected $entity;
    public $oParams;

    /**
     * Записываем элемент
     * @param array $arFields
     * @return int
     */
    public function addElement( $arFields ) {

        $objElement = new \CIBlockElement;
        $ID = $objElement->add($arFields);

        return $ID;
    }

    /**
     * Обновляем элемент
     * @param array $arFields
     * @return int
     */
    protected function updateElement( $ID, $arFields ) {
        $objElement = new \CIBlockElement;
        $ID = $objElement->Update($ID, $arFields);

        return $ID;
    }

    /**
     * Функция преобразует из array([0] => array()) просто в array(), для простоты
     * доступа к данным
     * @param arrary $arResult
     * @return array
     */
    protected function modifyResult( $arResult ) {
        if ( isset($arResult[0]) && count($arResult) == 1 ) {
            return $arResult[0];
        }
        return $arResult;
    }

    public function issetItem( $key ) {
        return isset($this->arResult["ITEMS"][$key]);
    }

    /**
     * Возвращает данные из $arResult
     * @param string $key
     * @return array
     */
    public function arResult( $key ) {
        return $this->arResult[$key];
    }

    /**
     * Функция записываем в переменную результат выборки
     * @param string $key
     */
    public function saveItems( $key = "ITEMS" ) {
        $this->arResult = $this->modifyResult($this->entity->getResult());
    }

    /**
     * Функция возвращает данные сущности из базы данных измененные декоратором
     * @return array
     */
    public function getItems() {
        return $this->modifyResult($this->entity->getItems());
    }

    public function onPrepareComponentParams( $arParams ) {
        $this->createObjects($arParams)
                ->initParamsModel();

        return $arParams;
    }

    public function createObjects( $arParams ) {

        $this->oParams = new Component\ParamsValue($arParams);

        if ( $this->oParams->makeEntity() ) {
            $this->entity = Fabrica\Entity::initEntity($this)->getClass($this->oParams->getEntity());
            $this->model = $this->entity->getModel();
            $this->entity->setCallbackDecoratorFunction($this->oParams->getCallabackDecoratorFunction());

            $this->addCustomParams();
        }

        return $this;
    }

    protected function addCustomParams() {
        return $this;
    }

    /**
     * Задает базовые параметры для сущности
     * @param array $arParams
     * @return \BaseComponent
     */
    public function initParamsModel() {
        if( $this->oParams->makeEntity() ) {
            $this->model->setOrder($this->oParams->getModelOrder())
                    ->setFilter($this->oParams->getModelFilter());
        }

        return $this;
    }

    public function getResult() {
        return $this->entity->getResult();
    }

    /**
     * �?нициализирует основные переменные
     * @param array $arParams
     * @return \BaseComponent
     */
    public function initVars( $arParams = null ) {
        $this->arResult["FILES"] = array();

        return $this;
    }

    protected function saveItemsDate() {
        \Francysk\Base\Core\Context::getInstance('local')->set("ITEMS", $this->arResult["ITEMS"]);
    }

    /**
     * Сохраняет $arResult в статическую переменную
     */
    protected function saveResultDate() {
        Francysk\Framework\Core\Context::getInstance('local')->set($this->arParams[FieldsClassParams::SAVE_SET], $this->arResult);
    }

    protected function getResultDate( $var ) {
        return Francysk\Framework\Core\Context::getInstance('local')->get($var);
    }

    protected function addCatalogViewedSession() {
        $_SESSION["FR_PRODUCTS_VIEW"][$this->arResult["ITEMS"][0]["ID"]] = $this->arResult["ITEMS"][0]["ID"];
    }
    
    protected function addCatalogViewed() {
        \CModule::IncludeModule("catalog");
        \CModule::IncludeModule("sale");
        
        $iUser = (int) \CSaleBasket::GetBasketUserID(false);
        \Bitrix\Catalog\CatalogViewedProductTable::refresh($this->arResult["ITEMS"][0]["ID"], $iUser);
    }

}
