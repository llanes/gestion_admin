<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Empresa extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		$this->load->model("Empresa_model");
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
					'titulo1'=> 'Mantenimiento | Empresas',//mi titulo 
					'titulo2'=> 'Administrar Empresa',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Empresa',//mi titulo 
					'titulo5'=> 'Empresa',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
			);
			//redirecionamos a la vista o llamamos a la vista index
			
			$this->parser->parse('Empresa/empresa_vista.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Empresa/script.php', $data, FALSE);
	}
		public function ajax_list()
	{
		if ($this->input->is_ajax_request()) {
				$list = $this->Empresa_model->get_empresa();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $empresa) {
			$no++;
				$row   = array();
				$row[] = $empresa->Nombre;
				$row[] = $empresa->Direccion;
				$row[] = $empresa->Telefono;
				$row[] = $empresa->Email;
					$row[] = '';
			//add html for action
			$row[] = '<div class="pull-right hidden-phone">
			<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_person('."'".$empresa->idEmpresa."'".')">
			<i class="fa fa-pencil-square"></i></a>
			<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_person('."'".$empresa->idEmpresa."'".')">
			<i class="fa fa-trash-o"></i></a></div>';

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Empresa_model->count_todas(),
						"recordsFiltered" => $this->Empresa_model->count_filtro(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
		} else {
			show_404();
		}
		
	}
	public function ajax_edit($idEmpresa)
	{
		if ($this->input->is_ajax_request()) {
			$data = $this->Empresa_model->get_by_id($idEmpresa);
			echo json_encode($data);
		} else {
			show_404();
		}
		
	}

	public function ajax_add()
	{
				if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('*','');
				if ($this->form_validation->run('registro_empresa') == FALSE)
				{
						$data = array(
							'Nombre'         => form_error('Nombre'),
							'Direccion'      => form_error('Direccion'),
							'Telefono'       => form_error('Telefono'),
							'Email'          => form_error('Email'),
							'R_U_C'          => form_error('R_U_C'),
							'Timbrado' => form_error('Timbrado'),
							'Series'         => form_error('Series'),
							'res'            => 'error');
					echo json_encode($data);		
				}else{
					$Geo_posicion_idGeo_posicion = 1;
					$data                         = array(
					'Nombre'                     => $this->security->xss_clean( $this->input->post('Nombre',FALSE)),
					'Descripcion'                   => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
					'Direccion'                   => $this->security->xss_clean( $this->input->post('Direccion',FALSE)),
					'Telefono'                   => $this->security->xss_clean( $this->input->post('Telefono',FALSE)),
					'Email'                    => $this->security->xss_clean( $this->input->post('Email',FALSE)),
					'R_U_D'                       => $this->security->xss_clean( $this->input->post('R_U_C',FALSE)),
					'Timbrado'                       => $this->security->xss_clean( $this->input->post('Timbrado',FALSE)),
					'Series'                       => $this->security->xss_clean( $this->input->post('Series',FALSE)),
					'Geo_posicion_idGeo_posicion' => $this->security->xss_clean( $Geo_posicion_idGeo_posicion)
					);
					$insert = $this->Empresa_model->save($data);
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
				if ($this->form_validation->run('ajax_update_empresa') == FALSE)
				{
						$data = array(
							'Nombre'         => form_error('Nombre'),
							'Descripcion'    => form_error('Descripcion'),
							'Direccion'      => form_error('Direccion'),
							'Telefono'       => form_error('Telefono'),
							'Email'          => form_error('Email'),
							'R_U_C'          => form_error('R_U_C'),
							'Timbrado' => form_error('Timbrado'),
							'Series'         => form_error('Series'),
							'res'            => 'error');
					echo json_encode($data);		
				}else{
					$Geo_posicion_idGeo_posicion = 1;
					$data                         = array(
					'Nombre'                     => $this->security->xss_clean( $this->input->post('Nombre',FALSE)),
					'Descripcion'                   => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
					'Direccion'                   => $this->security->xss_clean( $this->input->post('Direccion',FALSE)),
					'Telefono'                   => $this->security->xss_clean( $this->input->post('Telefono',FALSE)),
					'Email'                    => $this->security->xss_clean( $this->input->post('Email',FALSE)),
					'R_U_D'                       => $this->security->xss_clean( $this->input->post('R_U_C',FALSE)),
					'Timbrado'                       => $this->security->xss_clean( $this->input->post('Timbrado',FALSE)),
					'Series'                       => $this->security->xss_clean( $this->input->post('Series',FALSE)),
					'Geo_posicion_idGeo_posicion' => $this->security->xss_clean( $Geo_posicion_idGeo_posicion)
					);

					$this->Empresa_model->update(array('idEmpresa' => $this->input->post('idEmpresa')), $data);

					echo json_encode(array("status" => TRUE));
				}
        }else{
			show_404();
		}
	}
	public function ajax_delete($idEmpresa)
	{
		$this->Empresa_model->delete_by_id($idEmpresa);
		echo json_encode(array("status" => TRUE));
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
/* Location: ./application/controllers/Empresa/cliente.php */