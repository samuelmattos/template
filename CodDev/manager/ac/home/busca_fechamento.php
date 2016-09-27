<?php

/*
 * To change this template, choose Tools | Templates
 * and open the template in the editor.
 */
$user = Session::getInstance()->get(AC::K_CURRENT_USER);
AC::check_access($user);
try {
    $fechamentos = array();
    $dt_ini = str_replace('/', '-', $_POST['dataInicial']);
    $dt_fim = str_replace('/', '-', $_POST['dataFinal']);
    if (!empty($_POST['dataInicial']) && !empty($_POST['dataFinal'])) {
        $dt_ini = date("Y-m-d 00:00:00", strtotime($dt_ini));
        $dt_fim = date("Y-m-d 23:59:59", strtotime($dt_fim));
        $user = Session::getInstance()->get(AC::K_CURRENT_USER);
        $codCentral = $user->get_codCentralZeus();
       
        $fechamentos = DB::getInstance()->get_fechamentos($codCentral, $dt_ini, $dt_fim);
        $codigo = $user->get_codigo();
        THome::exibe_fechamento($fechamentos, $codigo);
    } else {
        THome::exibe_fechamento($fechamentos, $codigo);
    }
} catch (Exception $e) {
    Template::display_exception($e);
}
?>
