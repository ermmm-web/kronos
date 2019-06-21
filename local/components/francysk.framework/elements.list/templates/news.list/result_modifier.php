<?php

$entity = new Francysk\Framework\Entity\Sections($this->__component);
$model  = $entity->getModel();
$model->addFilter(["IBLOCK_ID" => $arParams["IBLOCK_ID"]]);
$entity->setCallbackDecoratorFunction("isChecked");

$arResult["SECTIONS"] = $entity->getResult();

unset($model);
unset($entity);

$this->__component->arResult["SECTIONS"] = $arResult["SECTIONS"];
$this->__component->setResultCacheKeys(["SECTIONS"]);