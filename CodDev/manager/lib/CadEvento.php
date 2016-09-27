<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
require_once '/../../libs/php/template/Template.php';
require_once '/../../libs/php/core/db/DB.php';
require_once '/../../libs/php/core/Config.php';
require_once '/../../libs/php/core/db/PgSQLDB.php';
require_once '/../../libs/php/core/db/PgSQLQueries.php';
require_once '/../../libs/php/core/Evento.php';
if ($_POST) {
    $endereco = $_POST['local'];
    $dt_ini = $_POST['dt_ini'];
    $dt_fim = $_POST['dt_fim'];
    $descricao = $_POST['descricao'];
    DB::getInstance()->insert_event($descricao, $endereco, $dt_ini, $dt_fim);
}