<?php

namespace Francysk\Framework\Fabrica;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class Entity implements \Francysk\Base\Interfaces\Fabrica
{

    const ELEMENT = 1;
    const TOVAR = 2;
    const TOVARSKU = 3;
    const STRUCTURE = 4;
    const ELEMENT_PROPERTY = 5;
    const PROPERTIES = 6;
    const SECTION_ELEMENT = 7;

    private $oModel;
    private $oDecorator;
    private $oCollectioResult;

    private function __construct( $oModel, $_objDecorator ) {
        $this->objModel = $_objModel;
        $this->objDecorator = $_objDecorator;
    }

    public function getObject( $_objModel, $_objDecorator ) {
        return new self($_objModel, $_objDecorator);
    }

    public function getClass( $type ) {
        switch ( $type ) {
            case self::ELEMENT :
                return new \Francysk\Base\Entity\BaseElement();
            case self::TOVAR :
                return new \Francysk\Base\Entity\Tovar($this->objModel, $this->objDecorator);
            case self::TOVARSKU :
                return new \Francysk\Base\Entity\TovarSKU($this->objModel, $this->objDecorator);
            case self::STRUCTURE :
                return new \Francysk\Base\Entity\Structure($this->objModel, $this->objDecorator);
            case self::ELEMENT_PROPERTY :
                return new \Francysk\Base\Entity\ItemProp($this->objModel, $this->objDecorator);
            case self::PROPERTIES :
                return new \Francysk\Base\Entity\Properties($this->objModel, $this->objDecorator);
            case self::SECTION_ELEMENT :
                return new \Francysk\Base\Entity\SectionElements($this->objModel, $this->objDecorator);
        }
    }

}
