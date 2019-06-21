<?php

class symfony_component extends CModule {

    const MODULE_ID = "symfony.component";

    public $MODULE_ID = self::MODULE_ID;
    public $MODULE_VERSION;
    public $MODULE_VERSION_DATE;
    public $MODULE_NAME;
    public $MODULE_DESCRIPTION;
    
    public function __construct() {
        $arModuleVersion = array();
        include dirname( __FILE__ ) . '/version.php';
        
        $this->MODULE_VERSION = '0';
        $this->MODULE_VERSION_DATE = '';

        if (is_array($arModuleVersion) && array_key_exists("VERSION", $arModuleVersion))
        {
            $this->MODULE_VERSION = $arModuleVersion["VERSION"];
            $this->MODULE_VERSION_DATE = $arModuleVersion["VERSION_DATE"];
        }

        $this->MODULE_NAME = "Модуль с компонентами SYMFONY";
        $this->MODULE_DESCRIPTION = "Модуль с компонентами SYMFONY";
        
        $this->PARTNER_NAME = "Eka-soft";
        $this->PARTNER_URI  = "http://eka-soft.by/";

    }

    
    public function DoInstall() {
        $this->installDB();
    }
    
    public function DoUnistall() {
        $this->unInstallDB();
    }
    
    
    public function installDB() {
        return RegisterModule(self::MODULE_ID);
    }
    
    public function unInstallDB() {
        return UnRegisterModule(self::MODULE_ID);
    }
}
