<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Empleado_model");
		$this->load->model('Logeo_model');
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('/Home');
		}
	}

	public function index()
	{
		// $this->output->enable_profiler(true);
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Empleados',//mi titulo 
					'titulo2'=> 'Administrar Empleado',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Empleados',//mi titulo 
					'titulo5'=> 'Empleados',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),

			);
			//redirecionamos a la vista o llamamos a la vista index
			
			$this->parser->parse('Empleado/empleado_vista.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Empleado/script.php', $data, FALSE);
	}
	public function ajax_list()
	{ 
		// $this->output->enable_profiler(true);
		$list = $this->Empleado_model->get_empleado();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $empleado) {
			$no++;
			$row = array();
			$row[] = $empleado->Nombres;
			$row[] = $empleado->Apellidos;
			$row[] = $empleado->Direccion;
			$row[] = $empleado->Telefono;
			$row[] = $empleado->Sueldo;
			$row[] = $empleado->Cargo;
			// $row[] = $empleado->Password;

			//add html for action
			$row[] = '<div class="pull-right hidden-phone">
			<a class="btn btn-primary btn-xs" href="javascript:void()" title="Edit" onclick="edit_person('."'".$empleado->idEmpleado."'".')">
			<i class="fa fa-pencil-square"></i></a>
			<a class="btn btn-danger btn-xs" href="javascript:void()" title="Hapus" onclick="delete_person('."'".$empleado->idEmpleado."'".')">
			<i class="fa fa-trash-o"></i></a></div>';

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Empleado_model->count_todas(),
						"recordsFiltered" => $this->Empleado_model->count_filtro(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit($idEmpleado)
	{
		$data = $this->Empleado_model->get_by_id($idEmpleado);
		echo json_encode($data);
	}

	public function ajax_add()
	{
				if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
				if ($this->form_validation->run('registro_empleado') == FALSE)
				{
						$data = array(
							'Nombres'   => form_error('Nombres'),
							'Apellidos'   => form_error('Apellidos'),
							'Direccion'   => form_error('Direccion'),
							'Telefono'   => form_error('Telefono'),
							'Sueldo'   => form_error('Sueldo'),
							'Cargo'   => form_error('Cargo'),
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
					'Telefono'                    => $this->security->xss_clean( $this->input->post('Telefono',FALSE)),
					'Sueldo'                       => $this->security->xss_clean( $this->input->post('Sueldo',FALSE)),
					'Cargo'                       => $this->security->xss_clean( $this->input->post('Cargo',FALSE)),
					'Geo_posicion_idGeo_posicion' => $this->security->xss_clean( $Geo_posicion_idGeo_posicion)
					);
					$insert = $this->Empleado_model->save($data);
					$Empleado_idEmpleado = $this->	ultimoempleado();
					$Permiso_idPermiso   = 1;
					$data                = array(
					'usuario'             => $this->security->xss_clean($this->input->post('usuario',FALSE)),
					'password'            => $this->security->xss_clean($this->input->post('password',FALSE)),
					'Empleado_idEmpleado' => $this->security->xss_clean($Empleado_idEmpleado),
					'Permiso_idPermiso'   =>$this->security->xss_clean($Permiso_idPermiso),
					);
					$insert = $this->Empleado_model->save2($data);
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
				if ($this->form_validation->run('ajax_update_empleado') == FALSE)
				{
						$data = array(
							'Nombres'   => form_error('Nombres'),
							'Apellidos'   => form_error('Apellidos'),
							'Direccion'   => form_error('Direccion'),
							'Telefono'   => form_error('Telefono'),
							'Sueldo'   => form_error('Sueldo'),
							'Cargo'   => form_error('Cargo'),
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
					'Telefono'                    => $this->security->xss_clean( $this->input->post('Telefono',FALSE)),
					'Sueldo'                       => $this->security->xss_clean( $this->input->post('Sueldo',FALSE)),
					'Cargo'                       => $this->security->xss_clean( $this->input->post('Cargo',FALSE)),
					'Geo_posicion_idGeo_posicion' => $this->security->xss_clean( $Geo_posicion_idGeo_posicion)
					);
					$this->Empleado_model->update(array('idEmpleado' => $this->input->post('idEmpleado')), $data);
					$Permiso_idPermiso   = 1;
					$data                = array(
					'usuario'             => $this->security->xss_clean($this->input->post('usuario',FALSE)),
					'password'            => $this->security->xss_clean($this->input->post('password',FALSE)),
					'Empleado_idEmpleado' => $this->security->xss_clean($this->input->post('idEmpleado',FALSE)),
					'Permiso_idPermiso'   =>$this->security->xss_clean($Permiso_idPermiso),
					);
					$idEmpleado = $this->security->xss_clean($this->input->post('idEmpleado',FALSE));
					$this->Empleado_model->update2($idEmpleado,$data);
					echo json_encode(array("status" => TRUE));
				}
        }else{
			show_404();
		}
	}
	public function ajax_delete($idEmpleado)
	{
		$this->Empleado_model->delete_by_id($idEmpleado);
		echo json_encode(array("status" => TRUE));
	}
		//funcion ultimo empleado para guardar el Empleado_idEmpleado
	function ultimoempleado()
	{
		$query = $this->db->query('SELECT MAX(idEmpleado) as idEmpleado from empleado');
		foreach($query->result_array() as $d)
	{
			return( $d['idEmpleado']);
		}
	}
		// comprovar si existe nobre de usuario para registro empleado
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

}

/* End of file empleado.php */
/* Location: ./application/controllers/empleado/empleado.php */