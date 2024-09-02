<?php

namespace connect;

class Contrato {
    private $orgaoId;
    private $nome;
    private $objeto;
    private $dataIni;
    private $dataFim;
    private $valor;

    public function setOrgaoId($orgaoId) {
        $this->orgaoId = $orgaoId;
    }

    public function getOrgaoId() {
        return $this->orgaoId;
    }

    public function setNome($nome) {
        $this->nome = $nome;
    }

    public function getNome() {
        return $this->nome;
    }

    public function setObjeto($objeto) {
        $this->objeto = $objeto;
    }

    public function getObjeto() {
        return $this->objeto;
    }

    public function setDataIni($dataIni) {
        $this->dataIni = $dataIni;
    }

    public function getDataIni() {
        return $this->dataIni;
    }

    public function setDataFim($dataFim) {
        $this->dataFim = $dataFim;
    }

    public function getDataFim() {
        return $this->dataFim;
    }

    public function setValor($valor) {
        $this->valor = $valor;
    }

    public function getValor() {
        return $this->valor;
    }
}
