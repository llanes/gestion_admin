<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// Cargamos las librerias, model, helper;
		$this->load->model("Logeo_model");
	}
		public function index()
	{
		if(!$this->session->userdata('idUsuario')) {
			$this->inicio();
		}else{
			if ($this->session->userdata('Permiso_idPermiso')==='1'){
			redirect('index.php/Home_admin');
			} else{
			redirect('Home_cliente');
			}


		}
	}
	public function inicio()
	{

		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'=> 'Login',//mi titulo
					"usuario" => $this->session->userdata('usuario')
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_cliente/head.php',$data, FALSE);	// carga todos las url de estilo i js home
			// $this->parser->parse('Home_cliente/header.php',$data, FALSE); // esta seria la barra de navegacion horizontal
			$this->parser->parse('Login/section_login.php',$data, FALSE); // este seria todo el contenido central
			// $this->parser->parse('Home_cliente/footer.php',$data, FALSE); // este seria todo el contenido central
			// $this->load->view('Home_cliente/pie_js.php'); // pie con los js
	}
	// Funcion de logeo
	public function logeo()
	{
		if($this->input->is_ajax_request()){
				// la validacion esta en el la carpeta config
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
				if ($this->form_validation->run('Login_validation') == FALSE)
				{
						$data = array(
							'usuario'   => form_error('usuario'),
							'password'  => form_error('password'),
							'res'		=> 'error');

				}else{
					$Usuario = $this->security->xss_clean(strip_tags( $this->input->post('usuario')));
					$Password  = $this->security->xss_clean(strip_tags( $this->input->post('password')));					// conecion con el modelo
					$fila = $this->Logeo_model->logeo($Usuario, $Password);
						if ($fila != null) {
							$data = array(
										'idUsuario' => $fila->idUsuario,
										'Usuario' => $fila->Usuario,
										'Empleado_idEmpleado' => $fila->Empleado_idEmpleado,
										'Permiso_idPermiso' => $fila->Permiso_idPermiso
										);
									$this->session->set_userdata($data);
									// redirect('index.php/Login/login','refresh');
						}else{
							// redirect('index.php/Login/login','refresh');
						}
				}
			echo json_encode($data);
		}else{
			show_404();
		}
	}
	// cerrar seccion
	public function logout()
	{
		$this->session->sess_destroy();
		redirect('index.php/Home','refresh');
	}
	public function registro()
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'=> 'Registro de Cliente',//mi titulo 
					"usuario" => $this->session->userdata('usuario')
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_cliente/head.php',$data, FALSE);	// carga todos las url de estilo i js home	
			// $this->parser->parse('Home_cliente/header.php',$data, FALSE); // esta seria la barra de navegacion horizontal
			$this->parser->parse('Login/registro.php',$data, FALSE); // este seria todo el contenido central
			// $this->parser->parse('Home_cliente/footer.php',$data, FALSE); // este seria todo el contenido central
			// $this->load->view('Home_cliente/pie_js.php'); // pie con los js
	}
	public function registro_add()
	{
		if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
				if ($this->form_validation->run('registro_cliente') == FALSE)
				{
						$data = array(
							'Nombres'   => form_error('Nombres'),
							'Direccion'   => form_error('Direccion'),
							'Telefono'   => form_error('Telefono'),
							'Email'   => form_error('Email'),
							'usuario'   => form_error('usuario'),
							'password'  => form_error('password'),
							'passconf'  => form_error('passconf'),
							'res'		=> 'error');

				}else{
					$Geo_posicion_idGeo_posicion = 1;
					$data                         = array(
					'Nombres'                     => $this->security->xss_clean( $this->input->post('Nombres',FALSE)),
					'Apellidos'                   => $this->security->xss_clean( $this->input->post('Apellidos',FALSE)),
					'Direccion'                   => $this->security->xss_clean( $this->input->post('Direccion',FALSE)),
					'Telefono'                    => $this->security->xss_clean( $this->input->post('Telefono',FALSE)),
					'Email'                       => $this->security->xss_clean( $this->input->post('Email',FALSE)),
					'Geo_posicion_idGeo_posicion' => $this->security->xss_clean( $Geo_posicion_idGeo_posicion)
					);
						$this->Logeo_model->add_cliente($data);
						$Empleado_idEmpleado = $this->	ultimoCliente();
						$Permiso_idPermiso   = 2;
					$data                = array(
					'usuario'             => $this->security->xss_clean($this->input->post('usuario',FALSE)),
					'password'            => $this->security->xss_clean($this->input->post('password',FALSE)),
					'Empleado_idEmpleado' => $this->security->xss_clean($Empleado_idEmpleado),
					'Permiso_idPermiso'   =>$this->security->xss_clean($Permiso_idPermiso),
					);
						$this->Logeo_model->add_user($data);
				}
           echo json_encode($data);
        }else{
			show_404();
		}
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

	// calback usuario chequo si el usuario ingresado para logearse es vlido
	function check_nombre($usuario)
	{

	if ($this->Logeo_model->check_nombre($usuario)) {
			return TRUE;
        }
        else
        {
              $this->form_validation->set_message('check_nombre', 'Nombre Incorrecto');
            return FALSE;
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

	// calback password chequo si el password ingresado para logearse es vlido
	function check_pass($password)
	{
	if ($this->Logeo_model->check_pass($password)) {
			return TRUE;
		}else {
		$this->form_validation->set_message('check_pass', 'Contraseña Incorrecta');
		return FALSE;}

	}


}

/* End of file login.php */
/* Location: ./application/controllers/login.php */