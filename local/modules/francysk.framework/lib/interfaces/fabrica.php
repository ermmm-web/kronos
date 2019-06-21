<?php

namespace Francysk\Base\Interfaces;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

interface Fabrica {
    public function getClass($type);
}