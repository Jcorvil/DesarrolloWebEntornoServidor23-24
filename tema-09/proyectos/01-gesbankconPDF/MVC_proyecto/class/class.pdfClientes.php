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
        // Header y Footer no hace falta porque son métodos predefinidos de FPDF.
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

    function contenido($clientes)
    {
        // Encabezado de la tabla
        $this->headerTabla();

        // Contenido
        $this->SetFont('Arial', '', 10);
        foreach ($clientes as $cliente) {
            // GetY y PageBreakTrigger son métodos de FPDF.
            // 
            // GetY obtiene la posición actual del puntero. Al añadir 7, hace que el puntero "pare" cuando queden 
            // 7 "unidades" para llegar al final de la página (para respetar el margen).
            // PageBreakTrigger determina el margen de la página, de manera que sea activa si "GetY" entra en su zona.
            if ($this->GetY() + 7 > $this->PageBreakTrigger) {
                $this->AddPage();
                $this->headerTabla();
            }
            $this->Cell(10, 7, mb_convert_encoding($cliente->id, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
            $this->Cell(50, 7, mb_convert_encoding($cliente->cliente, 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
            $this->Cell(50, 7, mb_convert_encoding($cliente->email, 'ISO-8859-1', 'UTF-8'), 1, 0, 'L');
            $this->Cell(20, 7, mb_convert_encoding($cliente->telefono, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
            $this->Cell(30, 7, mb_convert_encoding($cliente->ciudad, 'ISO-8859-1', 'UTF-8'), 1, 0, 'C');
            $this->Cell(30, 7, mb_convert_encoding($cliente->dni, 'ISO-8859-1', 'UTF-8'), 1, 1, 'C');
        }
    }


    function headerTabla()
    {
        $this->SetFont('Arial', 'B', 10);
        $this->SetFillColor(190, 190, 190);

        $this->Cell(10, 7, mb_convert_encoding('ID', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $this->Cell(50, 7, mb_convert_encoding('Cliente', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $this->Cell(50, 7, mb_convert_encoding('Email', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $this->Cell(20, 7, mb_convert_encoding('Teléfono', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $this->Cell(30, 7, mb_convert_encoding('Ciudad', 'ISO-8859-1', 'UTF-8'), 1, 0, 'C', true);
        $this->Cell(30, 7, mb_convert_encoding('DNI', 'ISO-8859-1', 'UTF-8'), 1, 1, 'C', true);
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