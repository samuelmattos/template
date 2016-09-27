<?php

/*
 * To change this license header, choose License Headers in Project Properties.
 * To change this template file, choose Tools | Templates
 * and open the template in the editor.
 */
header("Content-type: application/json; charset=utf-8");
require_once '/../../lib/php/template/Template.php';
require_once '/../../lib/php/core/db/DB.php';
require_once '/../../lib/php/core/Config.php';
require_once '/../../lib/php/core/db/PgSQLDB.php';
require_once '/../../lib/php/core/db/PgSQLQueries.php';
require_once '/../../lib/php/core/Evento.php';
$eventos = DB::getInstance()->get_eventos_json();
echo json_encode($eventos, JSON_UNESCAPED_UNICODE);
