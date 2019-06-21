<?php

namespace Francysk\Base\Decorator;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class AbstractDecorator {
    
    protected $objComponent;
    protected $objEntity;
    
    protected $collectFilesCodes;
    
    protected $callbackFunction = "decoratorItem";
    
    protected function __construct($_objComponent) {
        $this->objComponent = $_objComponent;
    }
    
    public function addCallbackFunction($method) {
        $this->callbackFunction[] = $method;
    }
    
    public function setCallbackFunction($functionName) {
        $this->callbackFunction = $functionName;
    }
    
    public function decorateFiles($row) {
        $uploadDir = \COption::GetOptionString("main", "upload_dir", "upload");
        $row["SRC"] = "/$uploadDir/" . $row["SUBDIR"] . "/" . $row["FILE_NAME"];
        
        if( method_exists(get_class($this->objComponent), "decorateFiles") && $this->objComponent != null ) {
            $row = $this->objComponent->decorateFiles($row);
        }
        
        return $row;
    }
    
    /**
     * Функция добавления в кода обработки файла в общий массив кодов
     * @param array $arCodesImages      - массив кодов файлов
     * @return object $this
     */
    public function addCollectFiles($arCodesFiles = array()) {
        if( !is_array($arCodesFiles) ) {
            return false;
        }
        
        $this->collectFilesCodes = array_merge($this->collectFilesCodes, $arCodesFiles);

        return $this;
    }
    
    public function initEntity($_objEntity) {
        $this->objEntity = $_objEntity;
    }
    
    protected function collectFiles($row) {
        foreach( $this->collectFilesCodes as $code ) {
            if( $row[$code] > 0 ) {
                $this->objEntity->addFiles($row[$code]);
            } elseif( $row["PROPERTIES"][$code]["VALUE"] > 0 ) {
                $this->objEntity->addFiles($row["PROPERTIES"][$code]["VALUE"]);
            }
        }
    }
    
    public function decoreateNavParams($objCDBResult) {
        return array(
          "bNavStart"   => $objCDBResult->bNavStart,
          "bShowAll"    => $objCDBResult->bShowAll,
          "NavNum"      => $objCDBResult->NavNum,
          "NavPageCount"=> $objCDBResult->NavPageCount,
          "NavPageNomer"=> $objCDBResult->NavPageSize,
          "NavRecordCount"=> $objCDBResult->NavRecordCount,
        );
    }
    
    public function getComponent() {
        return $this->objComponent;
    }
}