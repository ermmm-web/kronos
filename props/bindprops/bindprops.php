<?php

class FPBindProps extends CUserTypeString {

    public function GetUserTypeDescription() {
        return array(
            "USER_TYPE_ID" => "fp_bind_props",
            "CLASS_NAME" => "FPBindProps",
            "DESCRIPTION" => "Привязка к свойству",
            "BASE_TYPE" => "int",
        );
    }

    public function GetIBlockPropertyDescription() {
        return array(
         "PROPERTY_TYPE"        => "S",
         "USER_TYPE"            => "FPBindProps",
         "DESCRIPTION"          => "Francysk - Привязка к свойству",
         'GetPropertyFieldHtml' => array('FPBindProps', 'GetPropertyFieldHtml'),
         'GetAdminListViewHTML' => array('FPBindProps', 'GetAdminListViewHTML'),
         'GetPropertyFieldHtmlMulty' => array('FPBindProps', 'GetPropertyFieldHtmlMulty'),
         'GetSettingsHTML'      => array('FPBindProps', 'GetSettingsHTML'),
        );
    }
    
    public function htmlBlock($name, $listValue, $listGrupp, $value) {
        $str = '<div>';
        $str .= self::htmlSelect($name.'[VALUE]', $listValue, $value["VALUE"]);
        $str .= self::htmlSelect($name.'[DESCRIPTION]', $listGrupp, $value["DESCRIPTION"]);
        $str .= '</div>';
        return $str;
    }
    
    public static function htmlSelect($name, $aPropValue, $value) {
        $str = '<select name="'.$name.'" style="float: left; width: 50%;" class="js-select2"><option value="">--//--</option>';
        foreach($aPropValue as $aProp ) {
            $str .= '<option value="'.$aProp["ID"].'" '.($aProp['ID']==$value ? 'selected' : '').'>' . $aProp["NAME"] . "</option>";
        }
        $str .= "</select>";        
        
        return $str;
    }
    
    public function GetSettingsHTML($arUserField = false, $arHtmlControl, $bVarsFromForm) {        
        
    }
    
    function GetPropertyFieldHtmlMulty($arProperty, $values, $strHTMLControlName) {
        $aGrupp = self::getGrupp();
        $aPropValue = self::getPropValue();
        
        $html = '';
        
        if( !empty($values) ) {            
            foreach($values as $pid => $val ) {
                $html .= self::htmlBlock($strHTMLControlName["VALUE"].'['.$pid.']',  $aPropValue, $aGrupp, $val);
            }
        }
        
        $html .= self::htmlBlock($strHTMLControlName["VALUE"].'[n1]', $aPropValue, $aGrupp);
        $html .= self::htmlBlock($strHTMLControlName["VALUE"].'[n2]', $aPropValue, $aGrupp);
        $html .= self::htmlBlock($strHTMLControlName["VALUE"].'[n3]', $aPropValue, $aGrupp);
        $html .= self::htmlBlock($strHTMLControlName["VALUE"].'[n4]', $aPropValue, $aGrupp);
        $html .= self::htmlBlock($strHTMLControlName["VALUE"].'[n5]', $aPropValue, $aGrupp);
        $html .= self::htmlBlock($strHTMLControlName["VALUE"].'[n6]', $aPropValue, $aGrupp);
        
        $html .= '<script
  src="http://code.jquery.com/jquery-3.3.1.slim.min.js"
  integrity="sha256-3edrmyuQ0w65f8gfBsqowzjJe2iM6n0nKciPUp8y+7E="
  crossorigin="anonymous"></script><link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/css/select2.min.css" rel="stylesheet" />
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script><script>$("select.js-select2").select2();</script>';
        
        return $html;
    }
    
    public function GetSettingsHTHML($a , $b, $c ) {
        prent("!!!!!");
    }
    
    public function GetOptionsHtml($arProperty, $values) {
        prent('optuions');
        
    }
     function GetAdminListViewHTML($arProperty, $value, $strHTMLControlName) {
        prent('sef'); 
    }
    
    function GetEditFormHTML($arUserField, $arHtmlControl) {
        prent('ssss');
        //return self::getEditHTML($arHtmlControl['NAME'], $arHtmlControl['VALUE'], false);
    }

    function GetAdminListEditHTML($arUserField, $arHtmlControl) {
        prent('aaaa'); die;
        return self::getViewHTML($arHtmlControl['NAME'], $arHtmlControl['VALUE'], true);
    }
    
    
    
    private static function getGrupp() {
        \CBitrixComponent::includeComponentClass("francysk.lib:hl.gruppprop");
        $db = \HLGruppProp::getList();
        while( $row = $db->fetch() ) {
            $result[] = [
              "ID" => $row["ID"],
                "NAME" => $row["UF_NAME"],
            ];
        }
        
        return $result;
    }
    
    private static function getPropValue() {
        $ob = \CIBlockProperty::getList(["SORT" => "ASC"], ["IBLOCK_ID" => IBLOCK_ID_PRODUCT]);
        while( $row = $ob->fetch() ) {
            $aPropValue[] = $row;
        }
        
        return $aPropValue;
    }
    
}
