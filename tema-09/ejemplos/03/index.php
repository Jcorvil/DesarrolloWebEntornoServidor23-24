<?php
/*
    Hola mundo FPDF

    Parámetros clase fpdf
*/

# Cargamos clase fpdf
require('fpdf/fpdf.php');

# Creamos objeto de la clase fpdf
$pdf = new FPDF('P', 'mm', 'A4');

# Establecemos tipo letra
$pdf->SetFont('Courier', '', 12);

# Añadimos nueva página
$pdf->AddPage();

# Creamos la primera celda
$pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', '¡Hola mundo FPDF!'));

# Añadimos nueva página
$pdf->AddPage('L');

# Creamos la primera celda
$pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', 'Segunda página'));

# Cerramos el pdf
$pdf->Output();