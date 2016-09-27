<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */

class Evento {

    private $id_evento;
    private $descricao;
    private $local;
    private $dt_ini;
    private $dt_fim;

    public function __construct($id_evento, $descricao, $local, $dt_ini, $dt_fim) {
        $this->set_descricao($descricao);
        $this->set_dt_fim($dt_fim);
        $this->set_dt_ini($dt_ini);
        $this->set_id_evento($id_evento);
        $this->set_local($local);
    }

    public function set_id_evento($id_evento) {
        $this->id_evento = $id_evento;
    }

    public function get_id_evento() {
        return $this->id_evento;
    }

    public function set_descricao($descricao) {
        $this->descricao = $descricao;
    }

    public function get_descricao() {
        return $this->descricao;
    }

    public function set_local($local) {
        $this->local = $local;
    }

    public function get_local() {
        return $this->local;
    }

    public function set_dt_ini($dt_ini) {
        $this->dt_ini = $dt_ini;
    }

    public function get_dt_ini() {
        return $this->dt_ini;
    }

    public function set_dt_fim($dt_fim) {
        $this->dt_fim = $dt_fim;
    }

    public function get_dt_fim() {
        return $this->dt_fim;
    }

}
