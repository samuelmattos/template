<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */

class Usuario {

    private $codigo = array();
    private $razaoSocial;
    private $endereco;
    private $bairro;
    private $cidade;
    private $estado;
    private $codCentralZeus = array();

    public function __construct($razaoSocial, $endereco, $bairro, $cidade, $estado) {
        $this->set_razaoSocial($razaoSocial);
        $this->set_endereco($endereco);
        $this->set_bairro($bairro);
        $this->set_cidade($cidade);
        $this->set_estado($estado);
    }

    public function set_codigo($codigo) {
        $this->codigo = $codigo;
    }

    public function get_codigo() {
        return $this->codigo;
    }

    public function set_razaoSocial($razaoSocial) {
        $this->razaoSocial = $razaoSocial;
    }

    public function get_razaoSocial() {
        return $this->razaoSocial;
    }

    public function set_endereco($endereco) {
        $this->endereco = $endereco;
    }

    public function get_endereco() {
        return $this->endereco;
    }

    public function set_bairro($bairro) {
        $this->bairro = $bairro;
    }

    public function get_bairro() {
        return $this->bairro;
    }

    public function set_cidade($cidade) {
        $this->cidade = $cidade;
    }

    public function get_cidade() {
        return $this->cidade;
    }

    public function set_estado($estado) {
        $this->estado = $estado;
    }

    public function get_estado() {
        return $this->estado;
    }

    public function set_codCentralZeus($codCentralZeus) {
        $this->codCentralZeus = $codCentralZeus;
    }

    public function get_codCentralZeus() {
        if (sizeof($this->codCentralZeus) == 1) {
            return $this->codCentralZeus[0];
        } else {
            return $this->codCentralZeus;
        }
    }

}

?>
