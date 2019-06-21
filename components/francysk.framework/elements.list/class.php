<?php



if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )

    die();



\CBitrixComponent::includeComponentClass("francysk.framework:base.component");



class ElementsList extends BaseComponent

{

    public function executeComponent() {

        if( $this->startResultCache() ) {



            $this->arResult = $this->getResult();



            $this->includeComponentTemplate();

        }

    }



    public function promotionTime($row, $logic){

        if ( $logic == "ITEMS" ) {

            if ( !empty($row["ACTIVE_TO"]) ) {

                $currentTime = time();

                $activeToTime = strtotime($row["ACTIVE_TO"]);

                $time = $activeToTime - $currentTime;



                if ($time < 0) {

                    $time = 0;

                }



                $seconds = $time % 60;

                $minutes = ($time / 60) % 60;

                $hours = floor($time / 60 / 60);



                $row["ACTIVE_TO_TIME"] = [

                    "TIME" => $activeToTime * 1000,

                    "S" => $seconds,

                    "M" => $minutes,

                    "H" => $hours,

                ];

            }

        }



        return $row;

    }

    

    public function isChecked($row, $logic) {
        if( $logic == "ITEMS" ) {

            $row["CHECKED"] = $row["CODE"] == $_REQUEST["SECTION_CODE"] ? true : false;

        }

        

        return $row;

    }

    

    public function dateByActive($row, $logic) {

        if( $logic != "ITEMS" ) {

            return $row;

        }

        

        $row["DATE"] = Francysk\Framework\Core\Tools::rusdate(strtotime($row["ACTIVE_FROM"]), 'j %MONTH% Y' );



        return $row;

    }



    public function dateCollection($row, $logic){

        if ($logic == "ITEMS"){

            $dateReview = new \Bitrix\Main\Type\DateTime($row["ACTIVE_FROM"]);

            $row["DATE"] = $dateReview->format("Y-m-d");

        }



        return $row;

    }

    

    public function addCustomParams() {

        $this->model->setNavParams($this->oParams->getNavParams());

    }

}