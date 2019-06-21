<?php

namespace Francysk\Framework\Tools;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Month
{

    const SHORT = 1;  //  сокращение месяца
    const P_ROD = 2;  //  родительский падеж

    static private $aMonth;

    static public function getMonth( $iMonth, $sType ) {
        $month = self::getMonths();

        return $month[$iMonth][$sType];
    }

    static public function getMonths(): array {
        return self::$aMonth = [
          "01" => [
            self::SHORT => "янв",
            self::P_ROD => "января",
          ],
          "02" => [
            self::SHORT => "фев",
            self::P_ROD => "февраля"
          ],
          "03" => [
            self::SHORT => "март",
            self::P_ROD => "марта"
          ],
          "04" => [
            self::SHORT => "апрл",
            self::P_ROD => "апреля",
          ],
          "05" => [
            self::SHORT => "май",
            self::P_ROD => "мая"
          ],
          "06" => [
            self::SHORT => "июнь",
            self::P_ROD => "июня"
          ],
          "07" => [
            self::SHORT => "июль",
            self::P_ROD => "июля"
          ],
          "09" => [
            self::SHORT => "сен",
            self::P_ROD => "сентября",
          ],
          "08" => [
            self::SHORT => "авг",
            self::P_ROD => "августа"
          ],
          "10" => [
            self::SHORT => "окт",
            self::P_ROD => "октября"
          ],
          "11" => [
            self::SHORT => "нояб",
            self::P_ROD => "ноября"
          ],
          "12" => [
            self::SHORT => "декб",
            self::P_ROD => "декабря"
          ],      
        ];
    }

}
