<? if(!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED!==true)die();

$file = $_SERVER['DOCUMENT_ROOT'].'/upload/katalog.pdf';
$arResult['FILE_SIZE'] = round(filesize($file)/1024/1024, 1);

$arResult['FILE_TIME'] = date ("d.m.Y", filemtime($file));