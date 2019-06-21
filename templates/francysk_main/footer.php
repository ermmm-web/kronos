<?

if( !defined("NO_VIEW_TRIGGER")) {
	$APPLICATION->IncludeComponent(
	"kronos:triggers", 
	".default", 
	array(
		"COMPONENT_TEMPLATE" => ".default"
	),
	false
);
}