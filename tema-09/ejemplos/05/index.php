<?php
/*
    Hola mundo FPDF

    Parámetros clase fpdf
*/

# Cargamos clase fpdf
require('fpdf/fpdf.php');
// require('class/pdfArticulos.php');

$pdf = new FPDF();
$pdf->SetFont('Times', '', 10);
$pdf->AddPage();
$pdf->Image('logo/logo.jpg', 10, 10, 190);
$pdf->Output();


?>