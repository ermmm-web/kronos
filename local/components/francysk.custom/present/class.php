<?php

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

\CBitrixComponent::includeComponentClass("francysk.framework:base.component");

class Present extends \CBitrixComponent
{
    public function executeComponent() {
        $this->includeComponentTemplate();
    }
}