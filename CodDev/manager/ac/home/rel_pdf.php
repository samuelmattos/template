<?php

if (!defined("PATH")) {
    define('PATH', '');
}
require_once ('../../../lib/aplicacao.php');
require_once ('../../../lib/php/models/Session.php');
require_once ('../../../lib/php/models/Usuario.php');
$user = Session::getInstance()->get(AC::K_CURRENT_USER);
$codigo = $user->get_codigo();
AC::check_access($user);


require_once("fpdf/fpdf.php");

class PDF extends FPDF {

// Page footer
    function Footer() {
        // Position at 1.5 cm from bottom
        $this->SetY(-15);
        // Arial italic 8
        $this->SetFont('Arial', 'I', 8);
        // Page number
        $this->Cell(0, 10, utf8_decode('Zamith Tecnologia - Vigisoft Sistema de monitoramento de Alarmes'), 0, 0, 'C');
    }

}

try {
    $fechamentos = Session::getInstance()->get('FECHAMENTOS');
    $pdf = new PDF("L", "pt", "A4");
    $pdf->AddPage();
    $pdf->SetFont('arial', 'B', 16);
    $pdf->Cell(0, 6, utf8_decode('Relatório'), 0, 0, 'C');
    $pdf->SetFont('arial', 'B', 12);
    $pdf->Cell(0, 6, date("d-m-Y H:i:s"), 0, 1, 'R');
    $pdf->Cell(0, 6, "", "B", 1, 'C');
    $pdf->Ln(50);

//cabeçalho da tabela
    $pdf->SetFont('arial', 'B', 12);
    $pdf->Cell(50, 20, utf8_decode('Código'), 1, 0, "L");
    $pdf->Cell(50, 20, 'Evento', 1, 0, "L");
    $pdf->Cell(50, 20, 'Auxiliar', 1, 0, "L");
    $pdf->Cell(100, 20, 'Data Recebido', 1, 0, "L");
    $pdf->Cell(260, 20, utf8_decode('Descrição'), 1, 0, "L");
    $pdf->Cell(270, 20, 'Texto Fechamento', 1, 1, "L");



//linhas da tabela
    $pdf->SetFont('arial', '', 10);
    $cod_central = $fechamentos[0]['CodCentralZeus'];
    for ($i = 1; $i < sizeof($fechamentos); $i++) {
        if ($cod_central == $fechamentos[$i]['CodCentralZeus']) {
            $pdf->Cell(50, 20, $codigo[$cod_central], 1, 0, "L");
            $pdf->Cell(50, 20, $fechamentos[$i]['Evento'], 1, 0, "L");
            $pdf->Cell(50, 20, $fechamentos[$i]['Auxiliar'], 1, 0, "L");
            $pdf->Cell(100, 20, $fechamentos[$i]['DATArecebido'], 1, 0, "L");
            $pdf->Cell(260, 20, utf8_decode($fechamentos[$i]['DESCricao']), 1, 0, "L");
            $pdf->Cell(270, 20, utf8_decode($fechamentos[$i]['TEXTofechamento']), 1, 1, "L");
        } else {
            $pdf->Cell(50, 20, '', 1, 0, "L");
            $pdf->Cell(50, 20, '', 1, 0, "L");
            $pdf->Cell(50, 20, '', 1, 0, "L");
            $pdf->Cell(100, 20, '', 1, 0, "L");
            $pdf->Cell(260, 20, '', 1, 0, "L");
            $pdf->Cell(270, 20, '', 1, 1, "L");
        }
        $cod_central = $fechamentos[$i]['CodCentralZeus'];
    }
    $pdf->Output("commandos.pdf", "D");
} catch (Exception $e) {
    Template::display_exception($e);
}
?>
