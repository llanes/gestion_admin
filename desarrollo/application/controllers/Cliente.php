<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Cliente_model");
		$this->load->model('Logeo_model');
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('/');
		}
	}
	/**
	 * [index description]
	 * @return [type] [description]
	 */
	public function index()
	{
		// $this->output->enable_profiler(true);
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Clientes',//mi titulo 
					'titulo2'=> 'Administrar clientes',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Clientes',//mi titulo 
					'titulo5'=> 'Clientes',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
					'formulario' =>  $this->db->get('cliente')->result_array(),
			);
			//redirecionamos a la vista o llamamos a la vista index
			
			$this->parser->parse('Cliente/cliente_vista.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Cliente/script.php', $data, FALSE);
	}
		public function ajax_list()
	{
		if ($this->input->is_ajax_request()) {
				$list = $this->Cliente_model->get_cliente();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $cliente) {
			$no++;
				$row   = array();
				$row[] = $cliente->Nombres;
				$row[] = $cliente->Apellidos;
				$row[] = $cliente->Direccion;
				$row[] = $cliente->ci_ruc;
				$row[] = $cliente->Telefono;
				$row[] = $cliente->Email;

			//add html for action
			$row[] = '<div class="pull-right hidden-phone">
			<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_person('."'".$cliente->idCliente."'".')">
			<i class="fa fa-pencil-square"></i></a>
			<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_person('."'".$cliente->idCliente."'".')">
			<i class="fa fa-trash-o"></i></a></div>';

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Cliente_model->count_todas(),
						"recordsFiltered" => $this->Cliente_model->count_filtro(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
		} else {
			show_404();
		}
		
	}
	public function ajax_edit($idCliente)
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->Cliente_model->get_by_id($idCliente);
			echo json_encode($data);
		} else {
			show_404();
		}
		
	}

	public function ajax_add()
	{
				if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('*','');
				if ($this->form_validation->run('registro_cliente') == FALSE)
				{
						$data = array(
							'Nombres'   => form_error('Nombres'),
							'Apellidos'   => form_error('Apellidos'),
							'Direccion'   => form_error('Direccion'),
							'ci_ruc'   => form_error('ci_ruc'),
							'Telefono'   => form_error('Telefono'),
							'Email'   => form_error('Email'),
							'usuario'   => form_error('usuario'),
							'password'  => form_error('password'),
							'passconf'  => form_error('passconf'),
							'res'		=> 'error');
					echo json_encode($data);		
				}else{
					$Geo_posicion_idGeo_posicion = 1;
					$data                         = array(
					'Nombres'                     => $this->security->xss_clean( $this->input->post('Nombres',FALSE)),
					'Apellidos'                   => $this->security->xss_clean( $this->input->post('Apellidos',FALSE)),
					'Direccion'                   => $this->security->xss_clean( $this->input->post('Direccion',FALSE)),
					'ci_ruc'                   => $this->security->xss_clean( $this->input->post('ci_ruc',FALSE)),
					'Telefono'                    => $this->security->xss_clean( $this->input->post('Telefono',FALSE)),
					'Email'                       => $this->security->xss_clean( $this->input->post('Email',FALSE)),
					'Geo_posicion_idGeo_posicion' => $this->security->xss_clean( $Geo_posicion_idGeo_posicion)
					);
					$insert = $this->Cliente_model->save($data);
					$Empleado_idEmpleado = $this->	ultimoCliente();
					$Permiso_idPermiso   = 2;
					$data                = array(
					'usuario'             => $this->security->xss_clean($this->input->post('usuario',FALSE)),
					'password'            => $this->security->xss_clean($this->input->post('password',FALSE)),
					'Empleado_idEmpleado' => $this->security->xss_clean($Empleado_idEmpleado),
					'Permiso_idPermiso'   =>$this->security->xss_clean($Permiso_idPermiso),
					);
					$insert = $this->Cliente_model->save2($data);
					echo json_encode(array("status" => TRUE));
				}
        }else{
			show_404();
		}
	}

	public function ajax_update()
	{
				if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
				if ($this->form_validation->run('ajax_update') == FALSE)
				{
						$data = array(
							'Nombres'   => form_error('Nombres'),
							'Apellidos'   => form_error('Apellidos'),
							'Direccion'   => form_error('Direccion'),
							'ci_ruc'   => form_error('ci_ruc'),
							'Telefono'   => form_error('Telefono'),
							'Email'   => form_error('Email'),
							'usuario'   => form_error('usuario'),
							'password'  => form_error('password'),
							'passconf'  => form_error('passconf'),
							'res'		=> 'error');
					echo json_encode($data);		
				}else{
					$Geo_posicion_idGeo_posicion = 1;
					$data                         = array(
					'Nombres'                     => $this->security->xss_clean( $this->input->post('Nombres',FALSE)),
					'Apellidos'                   => $this->security->xss_clean( $this->input->post('Apellidos',FALSE)),
					'Direccion'                   => $this->security->xss_clean( $this->input->post('Direccion',FALSE)),
					'ci_ruc'                      => $this->security->xss_clean( $this->input->post('ci_ruc',FALSE)),
					'Telefono'                    => $this->security->xss_clean( $this->input->post('Telefono',FALSE)),
					'Email'                       => $this->security->xss_clean( $this->input->post('Email',FALSE)),
					'Geo_posicion_idGeo_posicion' => $this->security->xss_clean( $Geo_posicion_idGeo_posicion)
					);
					$this->Cliente_model->update(array('idCliente' => $this->input->post('idCliente')), $data);
					$Permiso_idPermiso   = 2;
					$_data                = array(
					'usuario'             => $this->security->xss_clean($this->input->post('usuario',FALSE)),
					'password'            => $this->security->xss_clean($this->input->post('password',FALSE)),
					'Empleado_idEmpleado' => $this->security->xss_clean($this->input->post('idCliente',FALSE)),
					'Permiso_idPermiso'   =>$this->security->xss_clean($Permiso_idPermiso),
					);
					$idCliente = $this->security->xss_clean($this->input->post('idCliente',FALSE));
					$this->Cliente_model->update2($idCliente,$_data);
					echo json_encode(array("status" => TRUE));
				}
        }else{
			show_404();
		}
	}
	public function ajax_delete($idCliente)
	{
		$this->Cliente_model->delete_by_id($idCliente);
		echo json_encode(array("status" => TRUE));
	}
		//funcion ultimo cliente para guardar el Empleado_idEmpleado
	function ultimoCliente()
	{
		$query = $this->db->query('SELECT MAX(idCliente) as idCliente from cliente');
		foreach($query->result_array() as $d)
	{
			return( $d['idCliente']);
		}
	}
		// comprovar si existe nobre de usuario para registro cliente
	function check_User($user_id)
	{

	if ($this->Logeo_model->check_User($user_id)) {
			$this->form_validation->set_message('check_User', "$user_id no Disponible");
			return FALSE;
        }
        else
        {
            return TRUE;
        }
	}
	// comprovar si existe nobre de usuario para registro cliente
	function check_email($Email)
	{

	if ($this->Logeo_model->check_email($Email)) {
			$this->form_validation->set_message('check_email', "$Email ya esta registrado ");
			return FALSE;
        }
        else
        {
            return TRUE;
        }
	}


}

/* End of file cliente.php */
/* Location: ./application/controllers/Cliente/cliente.php */