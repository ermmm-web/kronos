<?php

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

\CBitrixComponent::includeComponentClass("francysk.framework:elements.list");

class CatalogProduct extends ElementsList {

    public function executeComponent() {
        if ($this->startResultCache()) {

            $this->arResult = $this->getResult();

            $this->initSpravochnik();
//            $this->initNaves();

/*echo '<pre>$arResult = '.__FILE__.' LINE: '.__LINE__;	
print_r($this->arResult);		
echo '</pre>';			
echo '<pre>$arParams = '.__FILE__.' LINE: '.__LINE__;	
print_r($this->$arParams);		
echo '</pre>';	*/		
            $this->includeComponentTemplate();
        }
    }  
    
    public function initSpravochnik() {    
        $entity = new \Francysk\Framework\Entity\Elements;
        $entity->setCollectionResult(new Francysk\Framework\Collection\ResultByID());
        $entity->getModel()
                ->addFilter(["=ID" => $this->arParams["SPRAVOCHNIK"]]);

        $this->arResult["DOP"] = $entity->getResult();
   }

    public function collectDate($row, $logic) {
        if ($logic == "ITEMS") {
            foreach ($row["PROPERTIES"] as $code => $value) {
                if (in_array($code, ["MINI_MANUFACTURE"])) {
                    $this->arParams["SPRAVOCHNIK"][$value["VALUE"]] = $value["VALUE"];
                }
            }                
        }

        return $row;
    }

}
