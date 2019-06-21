<?php

if( !empty($arParams["PRODUCTS"]) ) {
    $entity = new Francysk\Framework\Entity\Elements(null);
    $entity->getModel()->addFilter(["ID" => $arParams["PRODUCTS"]]);
    $arResult["PRODUCTS"] = $entity->getResult();    
}
