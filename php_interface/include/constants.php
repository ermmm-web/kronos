<?php



// переменная пути папки для кэша ресайза картинок

define("RESIZE_IMAGE_PATH", "/images/cache/");



// переменная для проверки главной страницы

if( $GLOBALS["APPLICATION"]->GetCurPage() == "/" ) {

    define("IS_MAIN_PAGE", "Y");

}



define("IBLOCK_ID_PRODUCT",     2); // инфоблок товаров (минитрактора и тд)

define("IBLOCK_ID_PROIZVODSTVO",4); // инфоболк ghjbpdjlcndj
define("IBLOCK_ID_TRIGGER",     5); // инфоблок триггеров
define("IBLOCK_ID_BONUS",       6); // инфоблок бонусов
define("IBLOCK_ID_SERTIFICAT",  8); // инфоблок сертификатов

define("IBLOCK_ID_VIDEO",  7); // инфоблок видео
define("IBLOCK_ID_REVIEW",  9); // инфоблок отзывы
