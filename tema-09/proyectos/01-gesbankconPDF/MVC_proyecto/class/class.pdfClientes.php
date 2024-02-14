<?php

require('fpdf/fpdf.php');

class pdfClientes extends FPDF
{
    function __construct()
    {
        // Llamada al constructor de FPDF
        parent::__construct();
        // Nueva página
        $this->AddPage();

        // Es necesario llamar al título para que se muestre.
        // Header y Footer no hace falta porque son métodos predeficinos de FPDF.
        $this->titulo();
    }

    function Header()
    {
        // Encabezado
        $this->SetFont('Arial', 'B', 12);

        $this->Cell(60, 10, mb_convert_encoding('GESBANK 1.0', 'ISO-8859-1', 'UTF-8'), 0, 0, 'L');
        $this->Cell(60, 10, mb_convert_encoding('Jorge Coronil Villalba', 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');
        $this->Cell(60, 10, mb_convert_encoding('2DAW 23/24', 'ISO-8859-1', 'UTF-8'), 0, 1, 'R');

        // Borde inferior
        $this->Cell(0, 0, '', 'T', 1, 'C');
    }


    function titulo()
    {
        // Título del PDF
        $this->SetFont('Arial', 'B', 12);
        $this->Cell(0, 10, mb_convert_encoding('Listado de clientes.', 'ISO-8859-1', 'UTF-8'), 0, 1);
        // Fecha de generación del PDF
        $this->Cell(0, 10, mb_convert_encoding('Fecha: ' . date('Y-m-d H:i:s'), 'ISO-8859-1', 'UTF-8'), 0, 1);

        $this->Ln(10);
    }

    function contenido()
    {

    }


    function Footer()
    {
        // Pie de página
        $this->SetY(-15);
        $this->SetFont('Arial', '', 10);

        // Borde superior
        $this->Cell(0, 0, '', 'T', 1, 'C');
        // Contador de páginas
        $this->Cell(0, 10, mb_convert_encoding('Página ' . $this->PageNo(), 'ISO-8859-1', 'UTF-8'), 0, 0, 'C');

    }
}


?>