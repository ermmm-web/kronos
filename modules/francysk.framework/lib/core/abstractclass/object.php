<?php

namespace Francysk\Framework\Core\AbstractClass;

if (!defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true)
    die();

abstract class Object
{
    static protected $instance = null;
    
    protected $iIblockID;
    
    protected $oModel;
    
    public function __construct($iIblockId) {
        $this->initModel();
        $this->initialize();                
    }
    
    protected function initialize() {
        
        $oCache = new \CPHPCache;
        
        if( $oCache->InitCache($this->getTimeCache(), $this->getCacheID(), "/objects") ) {
            $result = $oCache->GetVars();
        } elseif ( $oCache->StartDataCache($this->getTimeCache(), $this->getCacheID(), "/objects") ) {
            $result = $this->getDate();
            
            $oCache->endDataCache($result);
        }
        
        $this->initParams($result);
    }

    protected function getTimeCache(): int {
        return 30 * 60;
    }
    
    protected function getCacheID(): String {
        return md5("OBJECTS");
    }
    
    static public function getInstance(int $iBlock = 0) {

        if (static::$instance[$iBlock] == null) {
            static::$instance[$iBlock] = new static($iBlock);
        }

        return static::$instance[$iBlock];
    }
    
    abstract protected function initModel();
    abstract protected function getDate();
    abstract protected function initParams($result);
}