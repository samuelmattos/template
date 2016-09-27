<?php

/**
 * index da Home encaminha para a view do home.
 */
$user = Session::getInstance()->get(AC::K_CURRENT_USER);

try {
    $eventos = DB::getInstance()->get_eventos();
    $css = '<link href="' . PATH . 'datepicker/css/datepicker.css" rel="stylesheet" media="screen"/>';
    THome::display_header("Cadastro Evento", $css);
    THome::bar_nav();
    THome::list_evento($eventos);
    $load .='<script src="' . PATH . 'datepicker/js/bootstrap-datepicker.js"></script>';
    $load = '<script src="' . PATH . 'manager/lib/js/agenda.js" rel="stylesheet"></script>';
    $load .= ' 
<script>
          $(document).ready(function(){
        $(\'#datepicker\').datepicker();
         var agenda = new Agenda();
    })
        </script>';
    THome::display_footer($load);
} catch (Exception $e) {
    Template::display_exception($e);
}
?>
