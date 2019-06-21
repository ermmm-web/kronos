<?php

namespace Francysk\Base\Tools;

if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true) die();

class ValidateForms extends Validate
{
    const T_INPUT = 1;
    const T_EMAIL = 2;
    const T_DATE = 3;
    const T_TEXTAREA = 4;
}