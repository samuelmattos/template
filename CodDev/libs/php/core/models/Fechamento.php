<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 * 
 */

class Fechamento {

    private $evento;
    private $auxiliar;
    private $dt_recebido;
    private $descricao;
    private $txt_fechamento;
    private $cod_central_zeus;

    public function __construct($evento, $auxiliar, $dt_recebido, $descricao, $txt_fechamento, $cod_central_zeus) {
        $this->set_evento($evento);
        $this->set_auxiliar($auxiliar);
        $this->set_dt_recebido($dt_recebido);
        $this->set_descricao($descricao);
        $this->set_txt_fechamento($txt_fechamento);
        $this->set_cod_central_zeus($cod_central_zeus);
    }

    public function set_evento($evento) {
        $this->evento = $evento;
    }

    public function get_evento() {
        return $this->evento;
    }

    public function set_auxiliar($auxiliar) {
        $this->auxiliar = $auxiliar;
    }

    public function get_auxiliar() {
        return $this->auxiliar;
    }

    public function set_dt_recebido($dt_recebido) {
        $this->dt_recebido = $dt_recebido;
    }

    public function get_dt_recebido() {
        return $this->dt_recebido;
    }

    public function set_descricao($descricao) {
        $this->descricao = $descricao;
    }

    public function get_descricao() {
        return $this->descricao;
    }

    public function set_txt_fechamento($txt_fechamento) {
        $this->txt_fechamento = $txt_fechamento;
    }

    public function get_txt_fechamento() {
        return $this->txt_fechamento;
    }

    public function set_cod_central_zeus($cod_central_zeus) {
        $this->cod_central_zeus = $cod_central_zeus;
    }

    public function get_cod_central_zeus() {
        return $this->cod_central_zeus;
    }

}

?>
