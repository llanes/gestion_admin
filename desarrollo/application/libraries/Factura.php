<?php
defined('BASEPATH') OR exit('No direct script access allowed');
    // Incluimos el archivo fpdf
    // $this->load->add_package_path('/third_party/fpdf/fpdf.php', FALSE);
    require_once APPPATH."/third_party/fpdf/fpdf.php";
    //Extendemos la clase Pdf de la clase fpdf para que herede todas sus variables y funciones
    class Factura extends FPDF{
        public function __construct() {
            parent::__construct();
        }
        // El encabezado del PDF
        public function Header(){
            $this->Image('./files/Screenshot_1.jpg',10,18,50);
            // $this->Image('./files/1.jpg',10,5,189 );
            // $this->Image('./files/1.jpg',10,32,189  );



       }
       // El pie del pdf
       public function Footer(){
           $this->SetY(-15);
           $this->SetFont('Arial','I',8);
           $this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
      }


}

/* End of file Factura.php */
/* Location: ./application/libraries/Factura.php */
