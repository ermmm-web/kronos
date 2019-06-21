<?php

\CBitrixComponent::includeComponentClass("francysk.lib:hl");

class HLCountBuy extends HL
{
    const ID = 2;
    
    public function getCacheID($aFilter): string {
        return "OBJECT_COUNT_BUY";
    }
    
    public function getPathCache(): string {
        return "/countbuy";
    }
}
