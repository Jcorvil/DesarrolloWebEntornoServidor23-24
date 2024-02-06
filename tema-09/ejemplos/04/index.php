<?php
/*
    Hola mundo FPDF

    Parámetros clase fpdf
*/

# Cargamos clase fpdf
require('fpdf/fpdf.php');

# Declaro variables
$id = 1;
$apellidos = 'Coronil Villalba';
$nombre = 'Jorge';

# Creamos objeto de la clase fpdf
$pdf = new FPDF('P', 'mm', 'A4');

# Establecemos tipo letra
$pdf->SetFont('Courier', '', 12);

# Añadimos nueva página
$pdf->AddPage();

# Color de fonto de celda
$pdf->SetFillColor(240, 120, 10);

# Creamos la primera celda
$pdf->Cell(40, 10, iconv('UTF-8', 'ISO-8859-1', '¡Hola mundo FPDF!'));

# Añadimos nueva página
$pdf->AddPage('L');

# Documento
$pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', 'ID: '), 1, 0, 'R', true);
$pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', $id), 1, 1);
$pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', 'Nombre: '), 1, 0, 'R', true);
$pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', $nombre), 1, 1);
$pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', 'Apellidos: '), 1, 0, 'R', true);
$pdf->Cell(60, 10, iconv('UTF-8', 'ISO-8859-1', $apellidos), 1, 1);

# Cerramos el pdf
$pdf->Output('D', 'doc.pdf', true);