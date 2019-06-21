<?php

namespace Francysk\Framework\Objects;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

class Person {

    static private $instance = null;
    private $oModel;
    private $ID;

    public function __construct() {
        $this->ID = false;
        $this->oModel = new \Francysk\Framework\Model\FCIBlockElementAllProp(array());

        if (\CUser::getID() > 0) {
            $this->initialize();
        }
    }

    protected function initialize() {

        $oCache = new \CPHPCache;

        $this->ID = \CUser::getID();

        if ($oCache->initCache($this->getTimeCache(), $this->getCacheID(), "/objects")) {
            $result = $oCache->getVars();
            $this->initParams($result);
        } elseif( $oCache->startDataCache($this->getTimeCache(), $this->getCacheID(), "/objects")) {
            $result = $this->getDate();
            $this->initParams($result);

            $oCache->endDataCache($result);
        }
    }

    private function getDate() {
        $result = $this->getResult();

        if (!is_array($result) || empty($result)) {
            $this->ID = false;
            return false;
        }

        return $result;
    }

    private function initParams($result) {
        $this->iCompany = $result["PROPERTIES"]["COMPANY"]["VALUE"];
    }

    private function getResult() {
        return $this->oModel->addFilter(
                                array(
                                    "IBLOCK_ID" => IBLOCK_PREPSTAVITEL,
                                    "PROPERTY_USER" => $this->ID,
                                    "PROPERTY_PREDSTAVITEL_VALUE" => "Y"))
                        ->execute()
                        ->fetch();
    }
    
    public function getCompanyID() {
        return $this->iCompany;
    }
    
    public function getID() {
        return $this->ID;
    }

    protected function getTimeCache() {
        return 30 * 60;
    }

    protected function getCacheID() {
        return md5("PERSONAL_".\CUser::getID());
    }

    static public function getInstance() {

        if (self::$instance == null) {
            self::$instance = new self;
        }

        return self::$instance;
    }

}
