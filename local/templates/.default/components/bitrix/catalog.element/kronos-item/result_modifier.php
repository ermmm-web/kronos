<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

/*$arResult["PREVIEW_PICTURE"] = CFile::ResizeImageGet($arResult["PREVIEW_PICTURE"]['ID'], array('width'=>208, 'height'=>162), BX_RESIZE_IMAGE_PROPORTIONAL, true);

KRONOS_CATALOG::prepare_element($arResult);*/
