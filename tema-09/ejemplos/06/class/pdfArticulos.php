<?php

class pdfArticulos extends FPDF
{
    public function Header()
    {
        // logo
        $this->image('logo/logo.jpg', 10, 5, 20);
        $this->SetFont('Arial', 'B', 10);
        // Subraya la cabecera
        $this->Cell(0, 16, iconv('UTF-8', 'ISO-8859-1', 'Listado de artículos'), 'B', 1, 'R');
        // Salto de línea de 5mm
        $this->ln(5);

    }

    public function Footer()
    {
        $this->setY(-10);
        $this->SetFont('Arial', 'B', 10);
        $this->Cell(0, 10, 'Page' . $this->PageNo() . '/{nb}', 'T', 0, 'C');
    }

    public function Titulo()
    {
        $this->SetFont('Courier', 'B', 12);
        $this->SetFillColor(200);
        $this->Cell(0, 16, iconv('UTF-8', 'ISO-8859-1', 'Listado de artículos'), 0, 0, 'C', true);

        $this->ln(20);
    }

    public function Cabecera()
    {

        $this->SetFont('Courier', 'B', 10);
        $this->SetFillColor(100, 180, 80);

        $this->Cell(10, 7, iconv('UTF-8', 'ISO-8859-1', 'Id'), 'B', 0, 'R', true);
        $this->Cell(50, 7, iconv('UTF-8', 'ISO-8859-1', 'Descripción'), 'B', 0, 'L', true);
        $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Fabricante'), 'B', 0, 'L', true);
        $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Categorías'), 'B', 0, 'L', true);
        $this->Cell(40, 7, iconv('UTF-8', 'ISO-8859-1', 'Etiquetas'), 'B', 0, 'L', true);
        $this->Cell(30, 7, iconv('UTF-8', 'ISO-8859-1', 'Precio'), 'B', 1, 'R', true);
    }

}

?>