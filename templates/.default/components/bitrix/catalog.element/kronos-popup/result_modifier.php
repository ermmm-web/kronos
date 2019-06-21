<? if (!defined('B_PROLOG_INCLUDED') || B_PROLOG_INCLUDED !== true) die();

/**
 * @var CBitrixComponentTemplate $this
 * @var CatalogElementComponent $component
 */

$component = $this->getComponent();
$arParams = $component->applyTemplateModifications();

KRONOS_CATALOG::prepare_element($arResult);

$arResult['REGIONS'] = KRONOS_CATALOG::get_regions_list();

// $arResult['USER'] = KRONOS_CATALOG::prepare_user();
