<?php

namespace Francysk\Framework\Tools;

if ( !defined("B_PROLOG_INCLUDED") || B_PROLOG_INCLUDED !== true )
    die();

class HtmlHelper
{

    static public function viewStartRating($iRating ) {
        for ( $i = 1; $i <= 5; ++$i ):
            ?>
            <i class="rating__item <?if( $i < $iRating ):?>full<?elseif((($i - $iRating ) < 1 && $iRating < $i )):?>half<?endif;?>"></i>
        <? endfor;
    }
}