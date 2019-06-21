<?php

namespace Francysk\Framework\Objects;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

use Francysk\Framework\Objects\Person;

class Company
{
    private $iPerson;
    private $ID;
    
    static private $instance = null;
    
    public function __construct() {
        $this->ID = false;
        $this->initialize();
    }
    
    private function initPerson() {
        $this->iPerson = Person::getInstance()->getID();
    }
    
    public function getPersonID() {
        $this->iPerson;
    }
    
    private function initCompanyID() {
        $this->ID = Person::getInstance()->getCompanyID();
    }
    
    public function getID() {
        return $this->ID;
    }
    
    private function initialize() {
        $this->initPerson();
        $this->initCompanyID();
    }
    
    static public function getInstance() {
        
        if( self::$instance == null ) {
            self::$instance = new self();
        }
        
        return self::$instance;
    }
}