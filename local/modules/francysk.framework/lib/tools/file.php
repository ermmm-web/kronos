<?php

namespace Francysk\Base\Tools;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class File
{

    /**
     * Функция возвращает расширение файла
     * @param sting $name - название или путь к файлу
     * @return sting расширение к файлу
     */
    static public function extensionFile( $name ) {
        $nameExplode = explode('.', $name);
        return $nameExplode[count($nameExplode) - 1];
    }

}
