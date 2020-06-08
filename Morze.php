<?php

class Morze {

    private $szerzo;
    private $idezet;
    
    function __construct($szerzo, $idezet) {
        $this->szerzo = $szerzo;
        $this->idezet = $idezet;
    }
    function getSzerzo() {
        return $this->szerzo;
    }

    function getIdezet() {
        return $this->idezet;
    }

    function setSzerzo($szerzo): void {
        $this->szerzo = $szerzo;
    }

    function setIdezet($idezet): void {
        $this->idezet = $idezet;
    }


}
