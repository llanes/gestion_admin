<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Pagos extends CI_Controller {
	/**
	 * [__construct description]
	 */
	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model("Pagos_model");
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('index.php/Home','refresh');
		}

	}

	public function index()
	{
		if ($this->input->is_ajax_request()) {
			$data = array
			(
					'titulo1'=> 'Mantenimiento | Pagos',//mi titulo 
					'titulo2'=> 'Administrar Pagos',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Pagos',//mi titulo 
			);
			$this->parser->parse('Pagos_cobros/pagos_vista.php',$data, FALSE);	
			$this->load->view('Pagos_cobros/script_pagos.php', $data, FALSE);
		} else {
			show_404();
		}

	}

		/**
	* [ajax_list description]
	* @return [type] [description]
	*/
	public function ajax_list()
	{
		$list = $this->Pagos_model->get_pagos();
		// $this->output->enable_profiler(true);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $pagos) {
			$no++;
			$row = array();
			$row[] = '<i style="text-align:left"><strong>'.$pagos->Descripcion.'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'.$pagos->Tipos_Pagos.'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'.$pagos->Monto.'</strong></i>';
			$row[] = '<i style="text-align:left"><strong>'.$pagos->Fecha.'</strong>
			&nbsp;&nbsp;&nbsp;'.$pagos->Hora.'</i>';
			//add html for action
			$row[] = '<div class="pull-right hidden-phone">
			<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_pagos('."'".$pagos->idCaja_Pagos."'".')">
			<i class="fa fa-pencil-square"></i></a>
			<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_pagos('."'".$pagos->idCaja_Pagos."'".')">
			<i class="fa fa-trash-o"></i></a></div>';

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Pagos_model->count_todas(),
						"recordsFiltered" => $this->Pagos_model->count_filtro(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	/**
	* [busqueda_empleao description]
	* @return [type] [description]
	*/
	public function busqueda_empleao()
	{
		// resivimos los datos del input a traves de la uri, por segment
		$datos= $this->uri->segment(4);
		$this->Pagos_model->busqueda_empleao($datos);

	}

	/**
	* [ajax_add description]
	* @return [type] [description]
	*/
	public function ajax_add()
	{
				if ($this->input->is_ajax_request()) {
				$hora = date("H:i:s");
				$fecha = date("Y-m-d");
				$this->form_validation->set_error_delimiters('*','');
				$idEmpleado = $this->security->xss_clean( $this->input->post('idEmpleado',FALSE));
				switch ($idEmpleado) {
					case '1':
						if ($this->form_validation->run('registro_pagos_1') == FALSE)
						{
							$data         = array(
							'Descripcion' => form_error('Descripcion'),
							'Monto'       => form_error('Monto'),
							'Tipos_Pagos' => form_error('Tipos_Pagos'),
							'idEmpleado'  => form_error('idEmpleado'),
							'res'         => 'error');
							echo json_encode($data);
						}else{

							$ultimo = $this->ultimoCaja();
							$Tipos_Pagos = $this->security->xss_clean( $this->input->post('Tipos_Pagos',FALSE));
							switch ($Tipos_Pagos) {
								case '1':
									$tipos    =  'Pagos de Empleado';
									$empleado =	$idEmpleado;
									break;
								case '2':
									$tipos    =  'Pago de Agua';
									$empleado = '';
									break;
								case '3':
									$tipos    =  'Pago de Luz';
									$empleado = '';
									break;
								case '4':
									$tipos    =  'Extras';
									$empleado = '';
									break;
							}
							$data                         = array(
								'Descripcion' => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
								'Monto'       => $this->security->xss_clean( $this->input->post('Monto',FALSE)),
								'Fecha'       => $fecha,
								'Hora'        => $hora,
								'Tipos_Pagos' => $tipos,
								'Caja_idCaja' => $ultimo,
								'Empleado_idEmpleado'  =>  $empleado
								);
							$insert = $this->Pagos_model->add_pagos($data);
							echo json_encode(array("status" => TRUE));
				}
						break;
					default:
					if ($this->form_validation->run('registro_pagos') == FALSE)
					{
										$data         = array(
										'Descripcion' => form_error('Descripcion'),
										'Monto'       => form_error('Monto'),
										'Tipos_Pagos' => form_error('Tipos_Pagos'),
										'res'         => 'error');
										echo json_encode($data);
					}else{
							$ultimo = $this->ultimoCaja();
							$Tipos_Pagos = $this->security->xss_clean( $this->input->post('Tipos_Pagos',FALSE));
							switch ($Tipos_Pagos) {
								case '1':
									$tipos    =  'Pagos de Empleado';
									$empleado =	$idEmpleado;
									break;
								case '2':
									$tipos    =  'Pago de Agua';
									$empleado = '';
									break;
								case '3':
									$tipos    =  'Pago de Luz';
									$empleado = '';
									break;
								case '4':
									$tipos    =  'Extras';
									$empleado = '';
									break;
							}
							$data                         = array(
								'Descripcion' => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
								'Monto'       => $this->security->xss_clean( $this->input->post('Monto',FALSE)),
								'Fecha'       => $fecha,
								'Hora'        => $hora,
								'Tipos_Pagos' => $tipos,
								'Caja_idCaja' => $ultimo,
								'Empleado_idEmpleado'  =>  $empleado
								);
							$insert = $this->Pagos_model->add_pagos($data);
							echo json_encode(array("status" => TRUE));
					}
						break;
				}

        }else{
			show_404();
		}
	}

	/**
	 * [ajax_update description]
	 * @return [type] [description]
	 */
	public function ajax_update()
	{
				if ($this->input->is_ajax_request()) {
				$hora  = date("H:i:s");
				$fecha = date("Y-m-d");
				$this->form_validation->set_error_delimiters('*','');
				$idEmpleado = $this->security->xss_clean( $this->input->post('idEmpleado',FALSE));
				switch ($idEmpleado) {
					case '1':
						if ($this->form_validation->run('registro_pagos_1') == FALSE)
						{
							$data         = array(
							'Descripcion' => form_error('Descripcion'),
							'Monto'       => form_error('Monto'),
							'Tipos_Pagos' => form_error('Tipos_Pagos'),
							'idEmpleado'  => form_error('idEmpleado'),
							'res'         => 'error');
							echo json_encode($data);
						}else{
							$ultimo = $this->ultimoCaja();
							$Tipos_Pagos = $this->security->xss_clean( $this->input->post('Tipos_Pagos',FALSE));
							switch ($Tipos_Pagos) {
								case '1':
									$tipos    =  'Pagos de Empleado';
									$empleado =	$idEmpleado;
									break;
								case '2':
									$tipos    =  'Pago de Agua';
									$empleado = '';
									break;
								case '3':
									$tipos    =  'Pago de Luz';
									$empleado = '';
									break;
								case '4':
									$tipos    =  'Extras';
									$empleado = '';
									break;
							}
							$data                         = array(
								'Descripcion' => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
								'Monto'       => $this->security->xss_clean( $this->input->post('Monto',FALSE)),
								'Fecha'       => $fecha,
								'Hora'        => $hora,
								'Tipos_Pagos' => $tipos,
								'Caja_idCaja' => $ultimo,
								'Empleado_idEmpleado'  =>  $empleado
								);
					$this->Pagos_model->update(array('idCaja_Pagos' => $this->input->post('idCaja_Pagos')), $data);
					echo json_encode(array("status" => TRUE));
				}
						break;
					default:
					if ($this->form_validation->run('registro_pagos') == FALSE)
					{
										$data         = array(
										'Descripcion' => form_error('Descripcion'),
										'Monto'       => form_error('Monto'),
										'Tipos_Pagos' => form_error('Tipos_Pagos'),
										'res'         => 'error');
										echo json_encode($data);
					}else{
							$ultimo = $this->ultimoCaja();
							$Tipos_Pagos = $this->security->xss_clean( $this->input->post('Tipos_Pagos',FALSE));
							switch ($Tipos_Pagos) {
								case '1':
									$tipos    =  'Pagos de Empleado';
									$empleado =	$idEmpleado;
									break;
								case '2':
									$tipos    =  'Pago de Agua';
									$empleado = '';
									break;
								case '3':
									$tipos    =  'Pago de Luz';
									$empleado = '';
									break;
								case '4':
									$tipos    =  'Extras';
									$empleado = '';
									break;
							}
							$data                         = array(
								'Descripcion' => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
								'Monto'       => $this->security->xss_clean( $this->input->post('Monto',FALSE)),
								'Fecha'       => $fecha,
								'Hora'        => $hora,
								'Tipos_Pagos' => $tipos,
								'Caja_idCaja' => $ultimo,
								'Empleado_idEmpleado'  =>  $empleado
								);
					$this->Pagos_model->update(array('idCaja_Pagos' => $this->input->post('idCaja_Pagos')), $data);
					echo json_encode(array("status" => TRUE));
					}
						break;
				}

        }else{
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

	/**
	* [ajax_edit description]
	* @param  [type] $id [description]
	* @return [type]     [description]
	*/
	public function ajax_edit($id)
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->Pagos_model->get_by_id($id);
			echo json_encode($data);
			// $this->output->enable_profiler(true);
		} else {
			show_404();
		}

	}

	/**
	* [ajax_delete description]
	* @param  [type] $idCliente [description]
	* @return [type]            [description]
	*/
	public function ajax_delete($id)
	{
		$this->Pagos_model->delete_by_id($id);
		echo json_encode(array("status" => TRUE));
	}
}

/* End of file Pagos.php */
/* Location: ./application/controllers/Pagos.php */
