<?php

\CBitrixComponent::includeComponentClass("francysk.lib:hl");

class HLGruppProp extends HL
{
    const ID = 1;
    
    public function getCacheID($aFilter): string {
        return md5(serialize($aFilter));
    }
    
    public function getPathCache(): string {
        return "/grupprop";
    }
}
