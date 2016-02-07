<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cobros extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('Cobros_model');
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
		redirect('index.php/Home','refresh');
		}

	}

	/**
	* [index description]
	* @return [type] [description]
	*/
	public function index()
	{
			$data = array
			(
					'titulo1'=> 'Mantenimiento | Cobros',//mi titulo 
					'titulo2'=> 'Administrar Cobros',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Cobros',//mi tit-ulo 
			);
			$this->parser->parse('Pagos_cobros/cobros_vista.php',$data, FALSE);	
			$this->load->view('Pagos_cobros/script_cobros.php',$data, FALSE);
	}

	/**
	* [ajax_Cobranzas description]
	* @return [type] [description]
	*/
	public function ajax_Cobranzas()
	{
		$list = $this->Cobros_model->get_cobranzas();
		// $this->output->enable_profiler(true);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cobranzas) {
			$no++;
			$row = array();
			$row[] = '<i style="text-align:left"><strong>'.$cobranzas->Num_cuota.'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'.$cobranzas->Nombres.'</strong>
			&nbsp;&nbsp;&nbsp;'.$cobranzas->Apellidos.'</p>';
			$row[] = '<i style="text-align:left"><strong>'. number_format($cobranzas->monto_totales,0,',','.').'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'. number_format($cobranzas->inporte_total,0,',','.').'</strong></i>';
			//add html for action
			$row[] = '<div style="text-align:center">
			<a class="btn btn-primary btn-sm" href="javascript:void(0);" title="Listar" onclick="listar_creditos('."'".$cobranzas->idCliente."'".')">
			<i class="fa fa-list-ol"></i> Listar</a>
			</div>';

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Cobros_model->count_todas_cobranzas(),
						"recordsFiltered" => $this->Cobros_model->count_filtro_cobranzas(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	/**
	* [ajax_Cobrados description]
	* @return [type] [description]
	*/
	public function ajax_Cobrados()
	{
		$list = $this->Cobros_model->get_Cobrados();
		// $this->output->enable_profiler(true);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $Cobrados) {
			$no++;
			$row = array();
			$row[] = '<i style="text-align:left"><strong>'.$Cobrados->Num_cuota.'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'.$Cobrados->Num_Recibo.'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'.$Cobrados->Nombres.'</strong>
			&nbsp;&nbsp;&nbsp;'.$Cobrados->Apellidos.'</p>';
			$row[] = '<i style="text-align:left"><strong>'. number_format($Cobrados->impor,0,',','.').'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'.$Cobrados->Fecha_Pago.'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'.$Cobrados->Fecha_Ven.'</strong></i>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Cobros_model->count_todas_Cobrados(),
						"recordsFiltered" => $this->Cobros_model->count_filtro_Cobrados(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	/**
	* [ajax_Cobrados description]
	* @return [type] [description]
	*/
	public function listar_creditos($idCliente)
	{
		$list = $this->Cobros_model->get_listar($idCliente);
		// $this->output->enable_profiler(true);
		$data = array();
		$fecha = date("Y-m-d");
		$no = $_POST['start'];
		foreach ($list as $lista_cobar) {
				$no++;
				$row = array();
				$row[] = '<i style="text-align:left"><strong>'.$lista_cobar->Num_cuota.'</strong></i>';
				$row[] = '<i style="text-align:left"><strong>'.$lista_cobar->Num_Recibo.'</strong></i>';
				$row[] = '<i style="text-align:left"><strong>'.$lista_cobar->Nombres.'</strong>
				&nbsp;&nbsp;&nbsp;'.$lista_cobar->Apellidos.'</p>';
				$row[] = '<i style="text-align:left"><strong>'. number_format($lista_cobar->impor,0,',','.').'</strong></i>';
				if ($lista_cobar->Fecha_Ven > $fecha) {
					$row[] = '<i class="badge bg-green" style="text-align:left"><strong>'.$lista_cobar->Fecha_Ven.'</strong></i>';
				} else {
					$row[] = '<i class="badge bg-red" style="text-align:left"><strong>'.$lista_cobar->Fecha_Ven.'</strong></i>';
				}
				//add html for action
				$row[] = '<div style="text-align:center">
				<a id="Atras" class="btn btn-sm btn-danger" href="javascript:void(0);" title="atras" onclick="atras()">
				<i class="fa fa-reply"></i> Atras</a>
				<a class="btn btn-success btn-sm" href="javascript:void(0);" title="Cobrar" onclick="item_cobrar('."'".$lista_cobar->idCredito."'".')">
				<i class="fa fa-external-link"></i> Cobrar</a>
				</div>';
				$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Cobros_model->todas_cobar($idCliente),
						"recordsFiltered" => $this->Cobros_model->filtro_cobar($idCliente),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	/**
	* [ajax_add description]
	* @return [type] [description]
	*/
	public function cobrar_credito()
	{
		if ($this->input->is_ajax_request()) {
				$hora = date("H:i:s");
				$fecha = date("Y-m-d");
				$this->form_validation->set_error_delimiters('*','');
				if ($this->form_validation->run('cobrar_credito') == FALSE)
				{
					$data         = array(
					'Descripcion' => form_error('Descripcion'),
					'res'         => 'error');
					echo json_encode($data);
				}else{

					$idCredito = $this->security->xss_clean( $this->input->post('idCredito',FALSE));
					$Estado_Pago = $this->security->xss_clean( $this->input->post('Estado_Pago',FALSE));
					$ultimo = $this->ultimoCaja();
					$data                         = array(
						'Descripcion' => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
						'Monto'       => $this->security->xss_clean( $this->input->post('Importe',FALSE)),
						'Fecha'       => $fecha,
						'Hora'        => $hora,
						'Tipos_Cobros' => 'Cobros',
						'Credito_idCredito'  =>  $idCredito,
						'Caja_idCaja' => $ultimo,

						);
					$this->Cobros_model->cobrar_credito($data,$Estado_Pago,$idCredito,$fecha);
					echo json_encode(array("status" => TRUE));
				}
        }else{
			show_404();
		}
	}
	public function item_cobrar($idCredito)
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->Cobros_model->get_by_id($idCredito);
			echo json_encode($data);
			// $this->output->enable_profiler(TRUE);
		} else {
			show_404();
		}
	}

	/**
	* [ultimoCaja description]
	* @return [type] [description]
	*/
	public function ultimoCaja()
	{
		$query = $this->db->query('SELECT MAX(idCaja) as idCaja from caja');
		foreach($query->result_array() as $d)
	{
			return( $d['idCaja']);
		}
	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Cobros.php */
/* Location: ./application/controllers/Cobros.php */
