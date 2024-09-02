<?php

namespace connect;

class Orgao {
    private $razao_social, $cnpj, $pais, $poder, $esfera;
    public function setRazao($r) {
        $this->razao_social = $r;
    }
    public function setCnpj($r) {
        $this->cnpj = $r;
    }
    public function setPais($r) {
        $this->pais = $r;
    }
    public function setPoder($r) {
        $this->poder = $r;
    }
    public function setEsfera($r) {
        $this->esfera = $r;
    }

    public function getRazao() {
        return $this->razao_social;
    }
    public function getCnpj() {
        return $this->cnpj;
    }
    public function getPais() {
        return $this->pais;
    }
    public function getPoder() {
        return $this->poder;
    }
    public function getEsfera() {
        return $this->esfera;
    }
}