<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Reportes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Carga  Dependencies
		$this->load->model('Reportes_model');
	}
	public function reporte_uno()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Reportes | Alquler/Presupuesto',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Alquler/Presupuesto',//mi titulo 
					'titulo5'=> 'Alquler/Presupuesto',//mi titulo 
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Reportes/al_pre.php',$data, FALSE);
	}

	function generar_al_pre()
	{
			$inicio = $this->security->xss_clean( $this->input->post('inicio',FALSE));
			$fin    = $this->security->xss_clean( $this->input->post('fin',FALSE));
			$rango  = $this->security->xss_clean( $this->input->post('rango',FALSE));
			$id     = $this->security->xss_clean( $this->input->post('versus',FALSE));
			if ($id == 1) {
				$nombre = 'Lista de Alquiler Contado';
			} if ($id == 3) {
				$nombre = 'Lista de Alquiler a Credito';
			} if ($id == 2) {
				$nombre = 'Lista de Presupuesto';
			} 
			// Se carga la libreria fpdf
        	$this->load->library('pdf');

			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->octener_reporte_uno($id,$rango,$inicio = NULL,$fin = NULL);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Pdf();
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle($nombre);
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
						$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
						$this->pdf->Cell(20,7,'Alquiler:','TBL',0,'C','1');
						$this->pdf->Cell(40,7,'Nombre servicio','TB',0,'L','1');
						$this->pdf->Cell(35,7,'Entrega','TB',0,'L','1');
						$this->pdf->Cell(35,7,'Devolucion','TB',0,'C','1');
						$this->pdf->Cell(25,7,'Monto','TB',0,'L','1');
						$this->pdf->Cell(25,7,'Monto Iva','TB BR',0,'L','1');
						$this->pdf->Ln(7);

						// La variable $x se utiliza para mostrar un número consecutivo
						$x = 1;
						foreach ($reporte_uno as $item) {
						// se imprime el numero actual y despues se incrementa el valor de $x en uno
						$this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
						// Se imprimen los datos de cada cliente
						$this->pdf->Cell(20,5,$item->Num_arquiler,'BL',0,'C',0);
						$this->pdf->Cell(40,5,$item->Nombre_servicio,'B',0,'L',0);
						$this->pdf->Cell(35,5,$item->Fecha_Pre_Arqui,'B',0,'L',0);
						$this->pdf->Cell(35,5,$item->Fecha_Devolucion,'B',0,'C',0);
						$this->pdf->Cell(25,5,$item->Monto_Alquiler_Presupuesto,'B',0,'L',0);
						$this->pdf->Cell(25,5,$item->Monto_total_iva,'BR',0,'C',0);
						//Se agrega un salto de linea
						$this->pdf->Ln(5);
						}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => $nombre,
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}



			} else {
				if ($inicio == "" && $fin == "") {
					$data = 'Campos vacios';
					echo   json_encode($data);
				}else {
					if ($inicio == "" && $fin !== "" || $inicio !== "" && $fin == "") {
						$data ='Completa algunos campos';
						echo   json_encode($data);
					} else {

						// // Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->octener_reporte_uno2($id,$inicio,$fin);
						if( !empty( $reporte_uno ) ){
						// $this->output->enable_propdfr(TRUE);
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Pdf();
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle("Lista de Alquiler");
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
						$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
						$this->pdf->Cell(20,7,'Alquiler:','TBL',0,'C','1');
						$this->pdf->Cell(40,7,'Nombre servicio','TB',0,'L','1');
						$this->pdf->Cell(35,7,'Entrega','TB',0,'L','1');
						$this->pdf->Cell(35,7,'Devolucion','TB',0,'C','1');
						$this->pdf->Cell(25,7,'Monto','TB',0,'L','1');
						$this->pdf->Cell(25,7,'Monto Iva','TB BR',0,'L','1');
						$this->pdf->Ln(7);

						// La variable $x se utiliza para mostrar un número consecutivo
						$x = 1;
						foreach ($reporte_uno as $item) {
						// se imprime el numero actual y despues se incrementa el valor de $x en uno
						$this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
						// Se imprimen los datos de cada cliente
						$this->pdf->Cell(20,5,$item->Num_arquiler,'BL',0,'C',0);
						$this->pdf->Cell(40,5,$item->Nombre_servicio,'B',0,'L',0);
						$this->pdf->Cell(35,5,$item->Fecha_Pre_Arqui,'B',0,'L',0);
						$this->pdf->Cell(35,5,$item->Fecha_Devolucion,'B',0,'C',0);
						$this->pdf->Cell(25,5,$item->Monto_Alquiler_Presupuesto,'B',0,'L',0);
						$this->pdf->Cell(25,5,$item->Monto_total_iva,'BR',0,'C',0);
						//Se agrega un salto de linea
						$this->pdf->Ln(5);
						}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => $nombre,
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
					}
				}
			}
	}
	public function reporte_dos()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Reportes | Pagos y Cobros',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Pagos y Cobros',//mi titulo 
					'titulo5'=> 'Pagos y Cobros',//mi titulo 
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Reportes/pagos_cobros.php',$data, FALSE);
	}

	function generar_pagos()
	{
			$inicio = $this->security->xss_clean( $this->input->post('inicio_dos',FALSE));
			$fin    = $this->security->xss_clean( $this->input->post('fin_dos',FALSE));
			$rango  = $this->security->xss_clean( $this->input->post('rango_dos',FALSE));
			$id     = $this->security->xss_clean( $this->input->post('selecciona',FALSE));
			$tipos     = $this->security->xss_clean( $this->input->post('tipopago',FALSE));

			switch ($id) {
				case 1:
					$nombre = 'Lista de Pagos';
					break;
				case 2:
					$nombre = 'Lista de Cobros';
					break;
				default:
					// code...
					break;
			}
			if ($tipos == '') {
				$TIPOS = 'Tipos';
			}else{
				$TIPOS = $tipos;
			}
			// Se carga la libreria fpdf
			$this->load->library('pagos');
			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->octener_reporte_dos($id,$rango,$tipos);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Pagos();
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle($nombre , $tipos);
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
						if ($tipos == 'Pagos de Empleado') {
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Tipo','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Empleado','TBL',0,'L','1');
								$this->pdf->Cell(45,7,'Monto','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Fecha Hora','TBL BR',0,'L','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(45,5,$item->Tipos_Pagos,'BL',0,'C',0);
								$this->pdf->Cell(45,5,$item->Nombres.' '.$item->Apellidos,'BL',0,'L',0);
								$this->pdf->Cell(45,5,$item->Monto,'BL',0,'C',0);
								$this->pdf->Cell(45,5,$item->Fecha.' '.$item->Hora,'BL BB BR ',0,'C',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
						}
						} else {
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Tipo','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Descriccion','TBL',0,'L','1');
								$this->pdf->Cell(45,7,'Monto','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Fecha Hora','TBL BR',0,'L','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(45,5,$item->Tipos_Pagos,'BL',0,'C',0);
								$this->pdf->Cell(45,5,$item->Descripcion,'BL',0,'L',0);
								$this->pdf->Cell(45,5,$item->Monto,'BL',0,'C',0);
								$this->pdf->Cell(45,5,$item->Fecha.' '.$item->Hora,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
						}
						
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => $nombre,
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}



			} else {
				if ($inicio == "" && $fin == "") {
					$data = 'Campos vacios';
					echo   json_encode($data);
				}else {
					if ($inicio == "" && $fin !== "" || $inicio !== "" && $fin == "") {
						$data ='Completa algunos campos';
						echo   json_encode($data);
					} else {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->octener_reporte_dos2($inicio,$fin,$tipos);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Pagos();
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle($nombre , $tipos);
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
						if ($tipos == 'Pagos de Empleado') {
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Tipo','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Empleado','TBL',0,'L','1');
								$this->pdf->Cell(45,7,'Monto','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Fecha Hora','TBL BR',0,'L','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(45,5,$item->Tipos_Pagos,'BL',0,'C',0);
								$this->pdf->Cell(45,5,$item->Nombres.' '.$item->Apellidos,'BL',0,'L',0);
								$this->pdf->Cell(45,5,$item->Monto,'BL',0,'C',0);
								$this->pdf->Cell(45,5,$item->Fecha.' '.$item->Hora,'BL BB BR ',0,'C',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
						}
						} else {
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Tipo','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Descriccion','TBL',0,'L','1');
								$this->pdf->Cell(45,7,'Monto','TBL',0,'C','1');
								$this->pdf->Cell(45,7,'Fecha Hora','TBL BR',0,'L','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(45,5,$item->Tipos_Pagos,'BL',0,'C',0);
								$this->pdf->Cell(45,5,$item->Descripcion,'BL',0,'L',0);
								$this->pdf->Cell(45,5,$item->Monto,'BL',0,'C',0);
								$this->pdf->Cell(45,5,$item->Fecha.' '.$item->Hora,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}

						}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => $nombre,
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
					}
				}
			}
	}

	function generar_cobros()
	{
			$inicio = $this->security->xss_clean( $this->input->post('inicio_dos',FALSE));
			$fin    = $this->security->xss_clean( $this->input->post('fin_dos',FALSE));
			$rango  = $this->security->xss_clean( $this->input->post('rango_dos',FALSE));
			$id     = $this->security->xss_clean( $this->input->post('selecciona',FALSE));

			switch ($id) {
				case 1:
					$nombre = 'Lista de Pagos';
					break;
				case 2:
					$nombre = 'Lista de Cobros';
					break;
				default:
					// code...
					break;
			}
			// Se carga la libreria fpdf
			$this->load->library('cobros');
			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->cobros_reporte($rango);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Cobros();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle($nombre);
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(20,7,'Cuota N.','TBL',0,'C','1');
								$this->pdf->Cell(20,7,'N. Recibo','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Cliente','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Descriccion','TBL',0,'L','1');
								$this->pdf->Cell(30,7,'Monto','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Fecha de Cobro','TBL BR',0,'L','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL BR',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(20,5,$item->Num_cuota,'BL',0,'C',0);
								$this->pdf->Cell(20,5,$item->Num_Recibo,'BL',0,'C',0);
								$this->pdf->Cell(40,5,$item->Nombres.' '.$item->Apellidos,'BL',0,'C',0);
								$this->pdf->Cell(40,5,$item->Descripcion,'BL',0,'L',0);
								$this->pdf->Cell(30,5,$item->Monto,'BL',0,'C',0);
								$this->pdf->Cell(30,5,$item->Fecha_Pago,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => $nombre,
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}



			} else {
				if ($inicio == "" && $fin == "") {
					$data = 'Campos vacios';
					echo   json_encode($data);
				}else {
					if ($inicio == "" && $fin !== "" || $inicio !== "" && $fin == "") {
						$data ='Completa algunos campos';
						echo   json_encode($data);
					} else {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->cobros_reporte2($inicio,$fin);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Cobros();
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle($nombre);
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(20,7,'Cuota N.','TBL',0,'C','1');
								$this->pdf->Cell(20,7,'N. Recibo','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Cliente','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Descriccion','TBL',0,'L','1');
								$this->pdf->Cell(30,7,'Monto','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Fecha de Cobro','TBL BR',0,'L','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL BR',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(20,5,$item->Num_cuota,'BL',0,'C',0);
								$this->pdf->Cell(20,5,$item->Num_Recibo,'BL',0,'C',0);
								$this->pdf->Cell(40,5,$item->Nombres.' '.$item->Apellidos,'BL',0,'C',0);
								$this->pdf->Cell(40,5,$item->Descripcion,'BL',0,'L',0);
								$this->pdf->Cell(30,5,$item->Monto,'BL',0,'C',0);
								$this->pdf->Cell(30,5,$item->Fecha_Pago,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
							}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => $nombre,
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
					}
				}
			}
	}
	public function reporte_tres()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Reportes | Servicios',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Servicios',//mi titulo 
					'titulo5'=> 'Servicios',//mi titulo 
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Reportes/servicio.php',$data, FALSE);
	}

	function generar_servicio()
	{
			$rango  = $this->security->xss_clean( $this->input->post('rango_servicio',FALSE));
			// Se carga la libreria fpdf
			$this->load->library('servicio');
			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->servicio_reporte($rango);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Servicio();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle('Listado de Servicio');
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(20,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(60,7,'Servicio','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Monto Total','TBL',0,'C','1');
								$this->pdf->Cell(80,7,'Descripcion','TBL BR',0,'C','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(20,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(60,5,$item->Servicio,'BL',0,'L',0);
								$this->pdf->Cell(30,5,$item->Monto_total_servicio,'BL',0,'C',0);
								$this->pdf->Cell(80,5,$item->Descripcion,'BB BL BR',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => 'Servicio',
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
			} else
			{
					$data = 'Campos vacios';
					echo   json_encode($data);
			}
	}

	public function reporte_cuatro()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Reportes | Cliente',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Cliente',//mi titulo 
					'titulo5'=> 'Cliente',//mi titulo 
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Reportes/cliente.php',$data, FALSE);
	}

	function generar_cliente()
	{
			$rango  = $this->security->xss_clean( $this->input->post('rango_cliente',FALSE));
			// Se carga la libreria fpdf
			$this->load->library('cliente');
			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->cliente_reporte($rango);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Cliente();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle('Listado de Cliente');
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(8,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Nombres Apellido','TBL',0,'C','1');
								$this->pdf->Cell(55,7,'Direccion','TBL',0,'C','1');
								$this->pdf->Cell(15,7,'C.I/R.U.C','TBL',0,'C','1');
								$this->pdf->Cell(20,7,'Telefono','TBL',0,'C','1');
								$this->pdf->Cell(53,7,'Correo','TBL BR',0,'C','1');
								$this->pdf->Ln(7);
								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $it) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(8,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(40,5,$it->Nombres.' '.$it->Apellidos,'BL',0,'L',0);
								$this->pdf->Cell(55,5,$it->Direccion,'BL',0,'L',0);
								$this->pdf->Cell(15,5,$it->ci_ruc,'BL',0,'L',0);
								$this->pdf->Cell(20,5,$it->Telefono,'BL',0,'L',0);
								$this->pdf->Cell(53,5,$it->Email,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => 'Listado',
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
			} else
			{
					$data = 'Campos vacios';
					echo   json_encode($data);
			}
	}

	public function reporte_cinco()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Reportes | Empleado',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Empleado',//mi titulo 
					'titulo5'=> 'Empleado',//mi titulo 
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Reportes/empleado.php',$data, FALSE);
	}

	function generar_empleado()
	{
			$rango  = $this->security->xss_clean( $this->input->post('rango_empleado',FALSE));
			// Se carga la libreria fpdf
			$this->load->library('empleado');
			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->empleado_reporte($rango);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Empleado();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle('Listado de Empleado');
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(8,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Nombres Apellido','TBL',0,'C','1');
								$this->pdf->Cell(59,7,'Direccion','TBL',0,'C','1');
								$this->pdf->Cell(33,7,'Telefono','TBL',0,'C','1');
								$this->pdf->Cell(25,7,'Sueldo','TBL',0,'C','1');
								$this->pdf->Cell(25,7,'Cargo','TBL BR',0,'C','1');
								$this->pdf->Ln(7);
								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $it) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(8,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(40,5,$it->Nombres.' '.$it->Apellidos,'BL',0,'L',0);
								$this->pdf->Cell(59,5,$it->Direccion,'BL',0,'L',0);
								$this->pdf->Cell(33,5,$it->Telefono,'BL',0,'L',0);
								$this->pdf->Cell(25,5,$it->Sueldo,'BL',0,'L',0);
								$this->pdf->Cell(25,5,$it->Cargo,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => 'Listado',
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
			} else
			{
					$data = 'Campos vacios';
					echo   json_encode($data);
			}
	}

	public function reporte_seis()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Reportes | Articulos',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Articulos',//mi titulo 
					'titulo5'=> 'Articulos',//mi titulo 
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Reportes/articulo.php',$data, FALSE);
	}

	function generar_articulo()
	{
			$rango  = $this->security->xss_clean( $this->input->post('rango_articulo',FALSE));
			$id  = $this->security->xss_clean( $this->input->post('idCategoria',FALSE));
			if ($id == '') {
				$nombre = 'Listado de Articulo';
			} else {
				$nombre = 'Listado de Articulo por Categoria';
			}
			
			// Se carga la libreria fpdf
			$this->load->library('articulo');
			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->articulo_reporte($rango,$id);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Articulo();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle($nombre);
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(20,7,'Codigo','TBL',0,'C','1');
								$this->pdf->Cell(60,7,'Nombre','TBL',0,'C','1');
								$this->pdf->Cell(25,7,'Precio','TBL',0,'C','1');
								$this->pdf->Cell(20,7,'Cantidad','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Categoria','TBL',0,'C','1');
								$this->pdf->Cell(15,7,'Iva','TBL BR',0,'C','1');
								$this->pdf->Ln(7);
								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $it) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(20,5,$it->Codigo,'BL',0,'L',0);
								$this->pdf->Cell(60,5,$it->Nombre,'BL',0,'L',0);
								$this->pdf->Cell(25,5,$it->Precio_Unitario,'BL',0,'L',0);
								$this->pdf->Cell(20,5,$it->Cantidad,'BL',0,'L',0);
								$this->pdf->Cell(40,5,$it->Categoria,'BL',0,'L',0);
								$this->pdf->Cell(15,5,$it->Iva,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => $nombre,
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
			} else
			{
					$data = 'Campos vacios';
					echo   json_encode($data);
			}
	}

	public function reporte_ciete()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Reportes | Stock',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Stock',//mi titulo 
					'titulo5'=> 'Stock',//mi titulo 
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Reportes/stock.php',$data, FALSE);
	}

	function generar_stock()
	{
			$rango  = $this->security->xss_clean( $this->input->post('rango_stock',FALSE));
			$id  =  $this->input->post('limite_stock',FALSE);
			// Se carga la libreria fpdf
			$this->load->library('stock');
			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->stock_reporte($rango,$id);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Stock();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle('Listado de stock');
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 10);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(21,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(56,7,'	Nombre','TBL',0,'C','1');
								$this->pdf->Cell(56,7,'Precio','TBL',0,'C','1');
								$this->pdf->Cell(56,7,'Cantidad','TBL BR',0,'C','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(21,5,$x++,'BL',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(56,5,$item->Nombre,'BL',0,'L',0);
								$this->pdf->Cell(56,5,$item->Precio_Unitario,'BL',0,'C',0);
								$this->pdf->Cell(56,5,$item->Cantidad_stock,'BB BL BR',0,'C',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => 'Listado',
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
			} else
			{
					$data = 'Campos vacios';
					echo   json_encode($data);
			}
	}
	/**
	* [reporte_ocho vista caja]
	* @return [varchar] [return data]
	*/
	public function reporte_ocho()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Reportes | Caja',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Caja',//mi titulo 
					'titulo5'=> 'Caja',//mi titulo 
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Reportes/caja.php',$data, FALSE);
	}

	public function generar_caja()
	{
			$inicio = $this->security->xss_clean( $this->input->post('inicio_caja',FALSE));
			$fin    = $this->security->xss_clean( $this->input->post('fin_caja',FALSE));
			$rango  = $this->security->xss_clean( $this->input->post('rango_caja',FALSE));
			// Se carga la libreria fpdf
			$this->load->library('caja');
			if ($rango != "") {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->caja_reporte($rango);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Caja();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle('Informacion Caja');
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(35,7,'Monto Inicial','TBL',0,'C','1');
								$this->pdf->Cell(35,7,'Monto Final','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Fecha Hora Apertura','TBL',0,'L','1');
								$this->pdf->Cell(40,7,'Fecha Hora Apertura','TBL',0,'L','1');
								$this->pdf->Cell(30,7,'Usuario','TBL BR',0,'L','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL BR',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(35,5,$item->Monto_inicial,'BL',0,'C',0);
								$this->pdf->Cell(35,5,$item->Monto_final,'BL',0,'C',0);
								$this->pdf->Cell(40,5,$item->Fecha_apertura.' '.$item->Hora_apertura,'BL',0,'C',0);
								$this->pdf->Cell(40,5,$item->Fecha_cierre.' '.$item->Hora_cierre,'BL',0,'C',0);
								$this->pdf->Cell(30,5,$item->Usuario,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => 'Informacion de caja',
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}



			} else {
				if ($inicio == "" && $fin == "") {
					$data = 'Campos vacios';
					echo   json_encode($data);
				}else {
					if ($inicio == "" && $fin !== "" || $inicio !== "" && $fin == "") {
						$data ='Completa algunos campos';
						echo   json_encode($data);
					} else {
						// Se obtienen los clientes de la base de datos
						$reporte_uno = $this->Reportes_model->caja_reporte2($inicio,$fin);
						if( !empty( $reporte_uno ) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Caja();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle('Informacion Caja');
						$this->pdf->SetLeftMargin(10);
						$this->pdf->SetRightMargin(10);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(35,7,'Monto Inicial','TBL',0,'C','1');
								$this->pdf->Cell(35,7,'Monto Final','TBL',0,'C','1');
								$this->pdf->Cell(40,7,'Fecha Hora Apertura','TBL',0,'L','1');
								$this->pdf->Cell(40,7,'Fecha Hora Apertura','TBL',0,'L','1');
								$this->pdf->Cell(30,7,'Usuario','TBL BR',0,'L','1');
								$this->pdf->Ln(7);

								// La variable $x se utiliza para mostrar un número consecutivo
								$x = 1;
								foreach ($reporte_uno as $item) {
								// se imprime el numero actual y despues se incrementa el valor de $x en uno
								$this->pdf->Cell(10,5,$x++,'BL BR',0,'C',0);
								// Se imprimen los datos de cada cliente
								$this->pdf->Cell(35,5,$item->Monto_inicial,'BL',0,'C',0);
								$this->pdf->Cell(35,5,$item->Monto_final,'BL',0,'C',0);
								$this->pdf->Cell(40,5,$item->Fecha_apertura.' '.$item->Hora_apertura,'BL',0,'C',0);
								$this->pdf->Cell(40,5,$item->Fecha_cierre.' '.$item->Hora_cierre,'BL',0,'C',0);
								$this->pdf->Cell(30,5,$item->Usuario,'BL BB BR ',0,'L',0);
								//Se agrega un salto de linea
								$this->pdf->Ln(5);
								}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => 'Informacion de caja',
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}
					}
				}
			}
	}

	public function generar_caja_principal()
	{
			$rango  = $this->security->xss_clean( $this->input->post('rango_caja',FALSE));
			// Se carga la libreria fpdf
			$this->load->library('caja_dia');
			if ($rango == 1) {
						$this->load->model('Caja_model');
						$fecha = date("Y-m-d");
						$list = $this->Caja_model->get_caja($fecha);
						$inicial = $this->Caja_model->inicial();
						$recordsFiltered = $this->Caja_model->count_filter($fecha);
						$haber = 0;
						$debe = 0;
						$total = 0;
						$as = '';
						$monto_inicial =  str_replace($this->config->item('caracteres'),"",$inicial);
						if( !empty($list) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Caja_dia();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle('Informacion Caja');
						$this->pdf->SetLeftMargin(15);
						$this->pdf->SetRightMargin(15);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(60,7,'Descripcion','TBL',0,'C','1');
								$this->pdf->Cell(25,7,'Fecha','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Ingresos','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Egresos','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Total','TBL BR',0,'C','1');
								$this->pdf->Ln(7);
					$x = 0;
					foreach ($list as $caja) 
					{
					$resultadohaber = str_replace($this->config->item('caracteres'),"",$caja->haber);
					$resultadodebe  = str_replace($this->config->item('caracteres'),"",$caja->debe);
					$haber          +=$resultadohaber;
					$debe           +=$resultadodebe;
					$x++;
						$this->pdf->Cell(10,5,$x,'BL BR',0,'C',0);
						$this->pdf->Cell(60,5,$caja->descripcion,'BL',0,'L',0);
						$this->pdf->Cell(25,5,$caja->fecha,'BL',0,'C',0);
						$this->pdf->Cell(30,5,$caja->debe,'BL',0,'C',0);
						$this->pdf->Cell(30,5,$caja->haber,'BL',0,'C',0);
						$this->pdf->Cell(30,5,'','BL BB BR ',0,'L',0);
						//Se agrega un salto de linea
							$this->pdf->Ln(5);
						////////////////////////////
						if ($x == $recordsFiltered) {
							if ($haber < $debe) {
								$as = $debe - $haber;
								$total =  number_format($as,0,',','.');
								for ($i = 0; $i <1 ; $i++) {
									$this->pdf->Cell(10,5,'','BL BR',0,'C',0);
									$this->pdf->Cell(60,5,'','BL',0,'L',0);
									$this->pdf->Cell(25,5,'','BL',0,'C',0);
									$this->pdf->Cell(30,5,'','BL',0,'C',0);
									$this->pdf->Cell(30,5,'','BL',0,'C',0);
									$this->pdf->Cell(30,5,$total,'BL BB BR ',0,'L',0);
							}
							} else {
								$as = $haber - $debe;
								$total =  number_format($as,0,',','.');
								for ($i = 0; $i <1 ; $i++) {
									$this->pdf->Cell(10,5,'','BL BR',0,'C',0);
									$this->pdf->Cell(60,5,'','BL',0,'C',0);
									$this->pdf->Cell(25,5,'','BL',0,'C',0);
									$this->pdf->Cell(30,5,'','BL',0,'C',0);
									$this->pdf->Cell(30,5,'','BL',0,'C',0);
									$this->pdf->Cell(30,5,$total,'BL BB BR ',0,'L',0);
								}

							} 
						}else{}
					}
						$this->pdf->Output('pdf.pdf','F');  //save pdf
						$this->pdf->Output('pdf.pdf', 'I'); // show pdf
					} else {
							$data     = array(
							'titulo'  => 'No existen datos de busqueda',
							'titulo2' => 'Informacion de caja',
							'titulo3' => 'No existen datos', );
							$this->parser->parse('Error/error.php', $data, FALSE);
					}
			} else {
						$this->load->model('Caja_model');
						$fecha = date("Y-m-d");
						$list = $this->Caja_model->get_caja($fecha);
						$inicial = $this->Caja_model->inicial();
						$recordsFiltered = $this->Caja_model->count_filter($fecha);
						$haber = 0;
						$debe = 0;
						$total = 0;
						$as = '';
						$monto_inicial =  str_replace($this->config->item('caracteres'),"",$inicial);
						if( !empty($list) ){
						// Creacion del PDF
						/*
						* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
						* heredó todos las variables y métodos de fpdf
						*/
						$this->pdf = new Caja_dia();
						// $this->pdf->Header($nombre);
						// Agregamos una página
						$this->pdf->AddPage();
						// Define el alias para el número de página que se imprimirá en el pie
						$this->pdf->AliasNbPages();

						/* Se define el titulo, márgenes izquierdo, derecho y
						* el color de relleno predeterminado
						*/
						$this->pdf->SetTitle('Informacion Caja');
						$this->pdf->SetLeftMargin(15);
						$this->pdf->SetRightMargin(15);
						$this->pdf->SetFillColor(200,200,200);

						// Se define el formato de fuente: Arial, negritas, tamaño 9
						$this->pdf->SetFont('Arial', 'B', 9);
						/*
						* TITULOS DE COLUMNAS
						*
						* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
						*/
								$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
								$this->pdf->Cell(60,7,'Descripcion','TBL',0,'C','1');
								$this->pdf->Cell(25,7,'Fecha','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Ingresos','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Egresos','TBL',0,'C','1');
								$this->pdf->Cell(30,7,'Total','TBL BR',0,'C','1');
								$this->pdf->Ln(7);
			$x = 0;
			foreach ($list as $caja) {
			$resultadohaber = str_replace($this->config->item('caracteres'),"",$caja->haber);
			$resultadodebe  = str_replace($this->config->item('caracteres'),"",$caja->debe);
			$haber          +=$resultadohaber;
			$debe           +=$resultadodebe;
			$x++;
				$this->pdf->Cell(10,5,$x,'BL BR',0,'C',0);
				$this->pdf->Cell(60,5,$caja->descripcion,'BL',0,'L',0);
				$this->pdf->Cell(25,5,$caja->fecha,'BL',0,'C',0);
				$this->pdf->Cell(30,5,$caja->debe,'BL',0,'C',0);
				$this->pdf->Cell(30,5,$caja->haber,'BL',0,'C',0);
				$this->pdf->Cell(30,5,'','BL BB BR ',0,'L',0);
				//Se agrega un salto de linea
				$this->pdf->Ln(5);
			////////////////////////////
			if ($x == $recordsFiltered) {
				if ($haber < $debe) {
					$as = $debe - $haber;
					$total =  number_format($as,0,',','.');
					$H =  number_format($haber,0,',','.');
					$D =  number_format($debe,0,',','.');
					for ($i = 0; $i <1 ; $i++) {
						$this->pdf->Cell(10,7,'','BL BR',0,'C',0);
						$this->pdf->Cell(60,7,'','BL',0,'C',0);
						$this->pdf->Cell(25,7,'','BL',0,'C',0);
						$this->pdf->Cell(30,7,$D,'BL',0,'C',0);
						$this->pdf->Cell(30,7,$H,'BL',0,'C',0);
						$this->pdf->Cell(30,7,$total,'BL BB BR ',0,'L',0);
				}
				} else {
					$as = $haber - $debe;
					$total =  number_format($as,0,',','.');
					$H =  number_format($haber,0,',','.');
					$D =  number_format($debe,0,',','.');
					for ($i = 0; $i <1 ; $i++) {
						$this->pdf->Cell(10,7,'','BL BR',0,'C',0);
						$this->pdf->Cell(60,7,'','BL',0,'C',0);
						$this->pdf->Cell(25,7,'','BL',0,'C',0);
						$this->pdf->Cell(30,7,$D,'BL',0,'C',0);
						$this->pdf->Cell(30,7,$H,'BL',0,'C',0);
						$this->pdf->Cell(30,7,$total,'BL BB BR ',0,'L',0);
					}

				} 
			}else{}
		}
		if ($monto_inicial < $as) {
			$monto_final =  number_format($as + $monto_inicial,0,',','.');
		} else {
			$monto_final =  number_format($monto_inicial + $as,0,',','.');
		}
		$this->pdf->Ln(13);
		$this->pdf->SetFont('Arial', 'B',10);
		$this->pdf->Cell(50,5,'Monto ingresado:     '.$D.'  Gs.',' ',0,'L',0);
		$this->pdf->Ln(7);
		$this->pdf->Cell(50,5,'Monto Hegresado:    '.$H.'  Gs.',' ',0,'L',0);
		$this->pdf->Ln(7);
		$this->pdf->Cell(50,5,'Monto final:               '.$monto_final.'  Gs.',' ',0,'L',0);
		$this->pdf->Output('pdf.pdf','F');  //save pdf
		$this->pdf->Output('pdf.pdf', 'I'); // show pdf
						} else {
								$data     = array(
								'titulo'  => 'No existen datos de busqueda',
								'titulo2' => 'Informacion de caja',
								'titulo3' => 'No existen datos', );
								$this->parser->parse('Error/error.php', $data, FALSE);
						}


			}
	}


	public function reporte_presipuesro()
	{

			// Se carga la libreria fpdf

			$Fecha_Pre_Arqui            = $this->security->xss_clean( $this->input->post('Fecha_Pre_Arqui'));
			$Monto_Alquiler_Presupuesto =  number_format($this->cart->total(),0,',','.');
			$Fecha_Devolucion           = $this->security->xss_clean( $this->input->post('Fecha_Devolucion'));
			$Nombre_servicio            = $this->security->xss_clean( $this->input->post('Nombres_servicios'));
			$cliente                    = $this->security->xss_clean( $this->input->post('Nombres'));
			$ruc_ci                     = $this->security->xss_clean( $this->input->post('ci_ruc'));
			// Creacion del PDF
			/*
			* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
			* heredó todos las variables y métodos de fpdf
			*/
			$this->load->library('pre');
			$this->pdf = new Pre();
			// $this->pdf->Header($nombre);
			// Agregamos una página
			$this->pdf->AddPage();
			// Define el alias para el número de página que se imprimirá en el pie
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle('Presupuesto');
			$this->pdf->SetLeftMargin(10);
			$this->pdf->SetRightMargin(10);
			$this->pdf->SetFillColor(250,250,250);
			$this->pdf->SetFont('Arial', 'B', 10);

			$this->pdf->Cell(26,10,'Cliente: '.$cliente,'',0,'L','1');
			$this->pdf->Cell(109,10,'','',0,'L','1');
			$this->pdf->Cell(55,10,'C.I/R.U.C:  '.$ruc_ci,'',0,'L','1');
			$this->pdf->Ln(10);

			$this->pdf->Cell(190,10,'Tipo Evento:   '.$Nombre_servicio,'',0,'L','1');
			$this->pdf->Ln(10);

			$this->pdf->Cell(46,10,'Entrega: '.$Fecha_Pre_Arqui,'','',0,'L','1');
			$this->pdf->Cell(90,10,'','',0,'L','1');
			$this->pdf->Cell(54,10,'Devolucion:  '.$Fecha_Devolucion,'',0,'L','1');
			$this->pdf->Ln(10);

			/* Se define el titulo, márgenes izquierdo, derecho y
			* el color de relleno predeterminado
			*/


			$this->pdf->SetFillColor(150,250,150);

			// Se define el formato de fuente: Arial, negritas, tamaño 9
			/*
			* TITULOS DE COLUMNAS
			*
			* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
			*/

		
			$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
			$this->pdf->Cell(30,7,'Cantidad','TBL',0,'C','1');
			$this->pdf->Cell(60,7,'Nombre','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Inpuesto','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Precio','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Subtotal','TBL BR',0,'L','1');
			$this->pdf->Ln(7);
			$i = 0;
			foreach ($this->cart->contents() as $items) {
				foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) {
				$iva =	$option_value;
				}
				// se imprime el numero actual y despues se incrementa el valor de $x en uno
				$this->pdf->Cell(10,6,$i,' ',0,'C',0);
				// Se imprimen los datos de cada cliente
				$this->pdf->Cell(30,6,$items['qty'],'',0,'C',0);
				$this->pdf->Cell(60,6,$items['name'],'',0,'L',0);
				$this->pdf->Cell(30,6,$iva.' %','',0,'C',0);
				$this->pdf->Cell(30,6,number_format($items['price'],0,',','.'),'',0,'C',0);
				$this->pdf->Cell(30,6,number_format($items['subtotal'],0,',','.'),'  ',0,'L',0);
				//Se agrega un salto de linea
				$this->pdf->Ln(6);
				$i++;
			}
		$this->pdf->Ln(6);
		$this->pdf->SetFillColor(0, 27, 0, 1);
		$this->pdf->SetDrawColor(0, 27, 0, 1);
		$this->pdf->SetTextColor(0, 27, 0, 1);
		$this->pdf->SetFont('Arial', 'B',10);
		$this->pdf->Cell(50,5,' Monto Total :     '.$Monto_Alquiler_Presupuesto.'  Gs.',' ',0,'L',0);
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf

	}

	public function factura_pdf($id = '')
	{

			$idArquiler= $this->uri->segment(2);
			$Monto_Alquiler_Presupuesto  = $this->security->xss_clean( $this->input->post('Monto'));
			$this->cart->destroy();
			$this->load->model('Presupuesto_arquiler_model');
			$objeto = $this->Presupuesto_arquiler_model->edit_presupuesto($idArquiler);
			// echo var_dump($objeto);
			// Creacion del PDF
			/*
			* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
			* heredó todos las variables y métodos de fpdf
			*/
			$this->load->library('factura');
			$this->pdf = new Factura();
			// $this->pdf->Header($nombre);
			// Agregamos una página
			$this->pdf->AddPage();
			// Define el alias para el número de página que se imprimirá en el pie
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle('Alquiler');
			$this->pdf->SetLeftMargin(10);
			$this->pdf->SetRightMargin(10);
			$this->pdf->SetFillColor(250,250,250);
			$this->pdf->SetFont('Arial', 'B', 10);
			foreach ($objeto as $alias) {
			$this->pdf->Cell(50,10,'Cliente: '.$alias->Nombres.' '.$alias->Apellidos,'',0,'L','1');
			$this->pdf->Cell(85,10,'','',0,'L','1');
			$this->pdf->Cell(55,10,'C.I/R.U.C:  '.$alias->ci_ruc,'',0,'L','1');
			$this->pdf->Ln(10);

			$this->pdf->Cell(190,10,'Tipo Evento:   '.$alias->Nombre_servicio,'',0,'L','1');
			$this->pdf->Ln(10);

			$this->pdf->Cell(46,10,'Entrega: '.$alias->Fecha_Pre_Arqui,'','',0,'L','1');
			$this->pdf->Cell(90,10,'','',0,'L','1');
			$this->pdf->Cell(54,10,'Devolucion:  '.$alias->Fecha_Devolucion,'',0,'L','1');
			$this->pdf->Ln(10);
			}


			/* Se define el titulo, márgenes izquierdo, derecho y
			* el color de relleno predeterminado*/
			$this->pdf->SetFillColor(150,250,150);

			// Se define el formato de fuente: Arial, negritas, tamaño 9
			/*
			* TITULOS DE COLUMNAS
			*
			* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
			*/
			$this->pdf->Cell(10,7,'#','TBL',0,'C','1');
			$this->pdf->Cell(30,7,'Cantidad','TBL',0,'C','1');
			$this->pdf->Cell(60,7,'Nombre','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Inpuesto','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Precio','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Subtotal','TBL BR',0,'L','1');
			$this->pdf->Ln(7);
			$i = 0;
			foreach ($this->cart->contents() as $items) {
				foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) {
				$iva =	$option_value;
				}
				// se imprime el numero actual y despues se incrementa el valor de $x en uno
				$this->pdf->Cell(10,6,$i,' ',0,'C',0);
				// Se imprimen los datos de cada cliente
				$this->pdf->Cell(30,6,$items['qty'],'',0,'C',0);
				$this->pdf->Cell(60,6,$items['name'],'',0,'L',0);
				$this->pdf->Cell(30,6,$iva.' %','',0,'C',0);
				$this->pdf->Cell(30,6,number_format($items['price'],0,',','.'),'',0,'C',0);
				$this->pdf->Cell(30,6,number_format($items['subtotal'],0,',','.'),'  ',0,'L',0);
				//Se agrega un salto de linea
				$this->pdf->Ln(6);
				$i++;
			}
		$this->pdf->Ln(6);
		$this->pdf->SetFillColor(0, 27, 0, 1);
		$this->pdf->SetDrawColor(0, 27, 0, 1);
		$this->pdf->SetTextColor(0, 27, 0, 1);
		$this->pdf->SetFont('Arial', 'B',10);
		$this->pdf->Cell(50,5,' Monto Total :     '.$Monto_Alquiler_Presupuesto.'  Gs.',' ',0,'L',0);
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf
	}
	public function boleta()
	{
		$id= $this->uri->segment(2);
		if ($id == 2) {
			$nombre = 'Boleta de venta';
		} else {
			$nombre = 'Facrura';
		}
			$id_ = $this->_ultimo_cabecera();
			$this->cart->destroy();
			$this->load->model('Presupuesto_arquiler_model');
			$objeto = $this->Presupuesto_arquiler_model->edit_presupuesto($id_);
			$empleado = $this->Reportes_model->ge_empleado();
			// echo var_dump($objeto);
			// Creacion del PDF
			/*
			* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
			* heredó todos las variables y métodos de fpdf
			*/
			$this->load->library('factura');
			$this->pdf = new Factura();

			// Agregamos una página
			$this->pdf->AddPage();
			// Define el alias para el número de página que se imprimirá en el pie
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle('Alquiler');
						foreach ($empleado as $key ) {
						$this->pdf->SetFont('Arial','B',12);
						$this->pdf->Cell(40,7,$key->Nombre,'',0,'L');
						$this->pdf->SetFont('Arial','B',9);
						$this->pdf->Cell(12);
						$this->pdf->Cell(70,7,'Direccion : '.$key->Direccion ,'',0,'L');

						$this->pdf->SetFont('Arial','B',12);
						$this->pdf->Cell(70,7,'R.U.C : '.$key->R_U_D ,'TL R',0,'C');
						$this->pdf->Ln(7);

						$this->pdf->Cell(52);	
						$this->pdf->SetFont('Arial','B',9);
						$this->pdf->Cell(70,7,'Telefono : '.$key->Telefono ,'',0,'L');

						$this->pdf->SetTextColor(250, 0, 0);
						$this->pdf->SetFont('Arial','B',12);
						$this->pdf->Cell(70,7,$nombre,'L R',0,'C');

						$this->pdf->SetTextColor(0, 0, 0);
						$this->pdf->Ln(7);
						$this->pdf->Cell(52);	
						$this->pdf->SetFont('Arial','B',9);
						$this->pdf->Cell(70,7,'Correo  : '.$key->Email ,'',0,'L');
						$this->pdf->SetFont('Arial','B',12);
						$this->pdf->Cell(70,7,'N. '.$key->Series.'    -     '.'N. '.$key->Timbrado ,'L BR',0,'C');
						}
			$this->pdf->Ln(10);

			$this->pdf->SetLeftMargin(10);
			$this->pdf->SetRightMargin(10);
			$this->pdf->SetFillColor(250,250,250);
			$this->pdf->SetFont('Arial', 'B', 9);
			foreach ($objeto as $alias) {
			$this->pdf->Cell(80,6,'Cliente             : '.$alias->Nombres.' '.$alias->Apellidos,'TL',0,'L');
			if ($alias->Contado_Credito == 2) 
			{
				$this->pdf->Cell(43,6,'Condi. Pago :  Coutas','T',0,'L');
			} ;
			if($alias->Contado_Credito == 1) 
			{
				$this->pdf->Cell(43,6,'Condi. Pago : Contado','T',0,'L');
			};
			

			$this->pdf->Cell(69,6,'C.I/R.U.C:  : '.$alias->ci_ruc,'T R',0,'C');
			$this->pdf->Ln(6);
			$this->pdf->Cell(192,6,'Servicio           : '.$alias->Nombre_servicio,'L R',0,'L');
			$this->pdf->Ln(6);
			$this->pdf->Cell(192,6,'Direccion         : '.$alias->Nombre_servicio,'L R',0,'L');
			$this->pdf->Ln(6);
			$this->pdf->Cell(43,6,'Fecha Emision : '.date('Y-d-m'),'BL ','',0,'L');
			$this->pdf->Cell(80,6,'Entrega  :'.$alias->Fecha_Pre_Arqui,'B',0,'C');
			$this->pdf->Cell(69,6,'Devolucion  :'.$alias->Fecha_Devolucion,'B R',0,'L');
			$this->pdf->Ln(10);



			/* Se define el titulo, márgenes izquierdo, derecho y
			* el color de relleno predeterminado*/
			$this->pdf->SetFillColor(150,250,150);

			// Se define el formato de fuente: Arial, negritas, tamaño 9
			/*
			* TITULOS DE COLUMNAS
			*
			* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
			*/
			$this->pdf->Cell(12,7,'#','TBL',0,'C','1');
			$this->pdf->Cell(30,7,'Cantidad','TBL',0,'C','1');
			$this->pdf->Cell(60,7,'Nombre','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Inpuesto','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Precio','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Subtotal','TBL BR',0,'L','1');
			$this->pdf->Ln(7);
			$i = 0;
			foreach ($this->cart->contents() as $items) {
				foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) {
				$iva =	$option_value;
				}
				// se imprime el numero actual y despues se incrementa el valor de $x en uno
				$this->pdf->Cell(12,6,$i,' ',0,'C',0);
				// Se imprimen los datos de cada cliente
				$this->pdf->Cell(30,6,$items['qty'],'',0,'C',0);
				$this->pdf->Cell(60,6,$items['name'],'',0,'L',0);
				$this->pdf->Cell(30,6,$iva.' %','',0,'C',0);
				$this->pdf->Cell(30,6,number_format($items['price'],0,',','.'),'',0,'C',0);
				$this->pdf->Cell(30,6,number_format($items['subtotal'],0,',','.'),'  ',0,'L',0);
				//Se agrega un salto de linea
				$this->pdf->Ln(6);
				$i++;
			}
		$this->pdf->Ln(6);
		$this->pdf->SetFillColor(0, 27, 0, 1);
		$this->pdf->SetDrawColor(0, 27, 0, 1);
		$this->pdf->SetTextColor(0, 27, 0, 1);
		$this->pdf->SetFont('Arial', 'B',10);
		$this->pdf->Cell(48,5,' Monto Total Iva:     '.number_format($alias->Monto_total_iva,0,',','.').'  Gs.',' ',0,'L',0);
		$this->pdf->Cell(48,5,'',' ',0,'L',0);
		$this->pdf->Cell(48,5,'',' ',0,'L',0);
		$this->pdf->Cell(48,5,' Monto Total :     '.number_format($alias->Monto_Alquiler_Presupuesto,0,',','.').'  Gs.',' ',0,'L',0);
		}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf



	}

/**
 * { function_description }
 *
 * @return     <type>  ( description_of_the_return_value )
 */


	public function recibo($id_)
	{
		$this->output->enable_profiler(TRUE);
			$idArquiler= $this->uri->segment(2);
			$nombre = 'Recibo N:'.'000'.$idArquiler;
			$this->cart->destroy();
			$this->load->model('Presupuesto_arquiler_model');
			$objeto = $this->Presupuesto_arquiler_model->perdidasrecibo($idArquiler);
			$empleado = $this->Reportes_model->ge_empleado();
			// echo var_dump($objeto);
			// Creacion del PDF
			/*
			* Se crea un objeto de la clase Pdf, recuerda que la clase Pdf
			* heredó todos las variables y métodos de fpdf
			*/
			$this->load->library('factura');
			$this->pdf = new Factura();

			// Agregamos una página
			$this->pdf->AddPage();
			// Define el alias para el número de página que se imprimirá en el pie
			$this->pdf->AliasNbPages();
			$this->pdf->SetTitle('Alquiler');
						foreach ($empleado as $key ) {
						$this->pdf->SetFont('Arial','B',12);
						$this->pdf->Cell(40,7,$key->Nombre,'',0,'L');
						$this->pdf->SetFont('Arial','B',9);
						$this->pdf->Cell(12);
						$this->pdf->Cell(70,7,'Direccion : '.$key->Direccion ,'',0,'L');

						$this->pdf->SetFont('Arial','B',12);
						$this->pdf->Cell(70,7,' ' ,'TL R',0,'C');
						$this->pdf->Ln(7);

						$this->pdf->Cell(52);	
						$this->pdf->SetFont('Arial','B',9);
						$this->pdf->Cell(70,7,'Telefono : '.$key->Telefono ,'',0,'L');

						$this->pdf->SetTextColor(250, 0, 0);
						$this->pdf->SetFont('Arial','B',12);
						$this->pdf->Cell(70,7,$nombre,'L R',0,'C');

						$this->pdf->SetTextColor(0, 0, 0);
						$this->pdf->Ln(7);
						$this->pdf->Cell(52);	
						$this->pdf->SetFont('Arial','B',9);
						$this->pdf->Cell(70,7,'Correo  : '.$key->Email ,'',0,'L');
						$this->pdf->SetFont('Arial','B',12);
						$this->pdf->Cell(70,7,'    '.' ','L BR',0,'C');
						}
			$this->pdf->Ln(10);

			$this->pdf->SetLeftMargin(10);
			$this->pdf->SetRightMargin(10);
			$this->pdf->SetFillColor(250,250,250);
			$this->pdf->SetFont('Arial', 'B', 9);
			foreach ($objeto as $alias) {

			$this->pdf->Cell(80,6,'Cliente             : '.$alias->Nombres.' '.$alias->Apellidos,'TL',0,'L');
			$this->pdf->Cell(43,6,'Pago : Contado','T',0,'L');
			$this->pdf->Cell(69,6,'C.I/R.U.C:  : '.$alias->ci_ruc,'T R',0,'C');
			$this->pdf->Ln(6);
			$this->pdf->Cell(192,6,'','L R',0,'L');
			$this->pdf->Ln(6);
			$this->pdf->Cell(192,6,'Direccion         : ','L R',0,'L');
			$this->pdf->Ln(6);
			$this->pdf->Cell(43,6,'Fecha Emision : '.date('Y-d-m'),'BL ','',0,'L');
			$this->pdf->Cell(80,6,'','B',0,'C');
			$this->pdf->Cell(69,6,'','B R',0,'L');
			$this->pdf->Ln(10);
			/* Se define el titulo, márgenes izquierdo, derecho y
			* el color de relleno predeterminado*/
			$this->pdf->SetFillColor(150,250,150);

			// Se define el formato de fuente: Arial, negritas, tamaño 9
			/*
			* TITULOS DE COLUMNAS
			*
			* $this->pdf->Cell(Ancho, Alto,texto,borde,posición,alineación,relleno);
			*/
			$this->pdf->Cell(12,7,'#','TBL',0,'C','1');
			$this->pdf->Cell(30,7,'Can. Perdida','TBL',0,'C','1');
			$this->pdf->Cell(90,7,'Nombre','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Precio Perdida','TBL',0,'L','1');
			$this->pdf->Cell(30,7,'Subtotal','TBL BR',0,'L','1');
			$this->pdf->Ln(7);
			$i = 0;
			foreach ($this->cart->contents() as $items) {
				foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) {
				$iva =	$option_value;
				}
				// se imprime el numero actual y despues se incrementa el valor de $x en uno
				$this->pdf->Cell(12,6,$i,' ',0,'C',0);
				// Se imprimen los datos de cada cliente
				$this->pdf->Cell(30,6,$items['qty'],'',0,'C',0);
				$this->pdf->Cell(90,6,$items['name'],'',0,'L',0);
				$this->pdf->Cell(30,6,number_format($items['price'],0,',','.'),'',0,'C',0);
				$this->pdf->Cell(30,6,number_format($items['subtotal'],0,',','.'),'  ',0,'L',0);
				//Se agrega un salto de linea
				$this->pdf->Ln(6);
				$i++;
			}
				$this->pdf->Ln(6);
				$this->pdf->SetFillColor(0, 27, 0, 1);
				$this->pdf->SetDrawColor(0, 27, 0, 1);
				$this->pdf->SetTextColor(0, 27, 0, 1);
				$this->pdf->SetFont('Arial', 'B',10);
				$this->pdf->Cell(48,5,'',' ',0,'L',0);
				$this->pdf->Cell(48,5,'',' ',0,'L',0);
				$this->pdf->Cell(30,5,'',' ',0,'L',0);
				$this->pdf->Cell(30,5,' Monto Total a Pagar:     '.number_format($this->cart->total(),0,',','.').'  Gs.',' ',0,'L',0);
		}
							$this->pdf->Output('pdf.pdf','F');  //save pdf
							$this->pdf->Output('pdf.pdf', 'I'); // show pdf



	}

















	private function _ultimo_cabecera()
	{
		$query = $this->db->query('SELECT MAX(idArquiler) as idArquiler from presupuesto_arquiler');
			foreach($query->result_array() as $d)
			{
				return( $d['idArquiler']);
			}
	}

}

/* End of pdf Reportes.php */
/* Location: ./application/controllers/Reportes.php */
