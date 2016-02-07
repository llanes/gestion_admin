<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    // $this->load->add_package_path('/third_party/fpdf/fpdf.php', FALSE);
    require_once APPPATH."/third_party/fpdf/fpdf.php";
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Caja_dia extends FPDF{
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            $this->Image('./files/Screenshot_1.jpg',15,9,50);
            $this->Image('./files/1.jpg',15,7,185	);
            $this->Image('./files/1.jpg',15,23,185	);


            // $this->Cell(195,20,'','',0,'C',0);
            $this->SetFont('Arial','B',13);
			// $this->SetFillColor(0, 219, 247, 0.3);
			// $this->SetDrawColor(0, 219, 247, 0.3);
			// $this->SetTextColor(0, 219, 247, 0.3);
			// 

            $this->Cell(30);
            $this->Cell(120,10,'Gestion Eventos',0,0,'C');
            $this->SetFont('Arial','',9);
            $this->Cell(50,10,'Fecha:  '.date('Y-d-m').' ',0,0,'C');
            $this->Ln(5);
            $this->SetFont('Arial','B',10);
            $this->Cell(30);
            $this->Cell(120,10,'Informe de Caja del Dia',0,0,'C');
            $this->Ln(20);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }


}


/* End of file Caja_dia.php */
/* Location: ./application/libraries/Caja_dia.php */
