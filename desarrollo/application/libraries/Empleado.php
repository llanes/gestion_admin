<?php
defined('BASEPATH') OR exit('No direct script access allowed');

    // Incluimos el archivo fpdf
    // $this->load->add_package_path('/third_party/fpdf/fpdf.php', FALSE);
    require_once APPPATH."/third_party/fpdf/fpdf.php";
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Empleado extends FPDF{
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            $this->Image('./files/Screenshot_1.jpg',10,9,50);
            $this->Image('./files/1.jpg',10,7,189 );
            $this->Image('./files/1.jpg',10,23,189  );

            $this->SetFont('Arial','B',13);
            $this->Cell(30);
            $this->Cell(120,10,'Gestion Eventos',0,0,'C');
            $this->SetFont('Arial','',9);
            $this->Cell(50,10,'Fecha:  '.date('Y-d-m').' ',0,0,'C');
            $this->Ln(5);
            $this->SetFont('Arial','B',10);
            $this->Cell(30);            
            $this->Cell(120,10,'Listado Empleado',0,0,'C');
            $this->Ln(20);
       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }


}

/* End of file Empleado.php */
/* Location: ./application/libraries/Empleado.php */
