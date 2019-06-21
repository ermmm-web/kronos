<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

\CModule::includeModule("symfony.component");
\CBitrixComponent::includeComponentClass("francysk.framework:get.element.request");

use Francysk\Framework\Core\Config\FieldsClassParams;
use Symfony\Component\HttpFoundation\Request;

class ProductDetail extends GetElementByRequest {

    public function executeComponent() {
        if ($this->startResultCache()) {

            $this->arResult = $this->getResult();

            $this->getSertificat();
            $this->getNaves();
            
            $this->includeComponentTemplate();
        }

        $this->saveResultDate();
    }
    
    public function getNaves() {
        if( empty($this->arResult["ITEMS"][0]["PROPERTIES"]["BIND_OBORUDOVANIE"]["VALUE"]) ) {
            return $this;
        }
        
        $entity = new \Francysk\Framework\Entity\ElementsWithProp();
        $entity->getModel()
                ->addFilter(["=IBLOCK_ID" => $this->arParams["IBLOCK_ID"], "=ID" => $this->arResult["ITEMS"][0]["PROPERTIES"]["BIND_OBORUDOVANIE"]["VALUE"]]);
        
        $this->arResult["NAVES"] = $entity->getResult();
    }

    public function getSertificat() {
        if (empty($this->arResult["ITEMS"][0]["PROPERTIES"]["SERTIFICAT"]["VALUE"])) {
            return $this;
        }
        $entity = new Francysk\Framework\Entity\Elements();
        $entity->getModel()
                ->addFilter(["IBLOCK_ID" => IBLOCK_ID_SERTIFICAT, "ACTIVE" => "Y", "=ID" => $this->arResult["ITEMS"][0]["PROPERTIES"]["SERTIFICAT"]["VALUE"]]);
        
        $entity->setCollectionResult(new Francysk\Framework\Collection\ResultByID);
        
        $this->arResult["SERTIFICAT"] = $entity->getResult();

        return  $this;
    }

}
