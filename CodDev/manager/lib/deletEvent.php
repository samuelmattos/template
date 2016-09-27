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
    $id_evento = (int)$_POST['id_evento'];
    DB::getInstance()->delete_event($id_evento);
}