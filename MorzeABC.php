<?php

class MorzeABC {

    private $betu;
    private $morzejel;
    
    function __construct($betu, $morzejel) {
        $this->betu = $betu;
        $this->morzejel = $morzejel;
    }

    function getBetu() {
        return $this->betu;
    }

    function getMorzejel() {
        return $this->morzejel;
    }

    function setBetu($betu): void {
        $this->betu = $betu;
    }

    function setMorzejel($morzejel): void {
        $this->morzejel = $morzejel;
    }


    
}
