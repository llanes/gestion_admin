<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_admin extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		// control de acceso sin login
		// si no esta logueado redirije a login
		if ($this->session->userdata('Permiso_idPermiso')!='1'){
			redirect('Home');
			} else{
			}
	}

	public function index()
	{

		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'      => 'Sietema | Administrativa',//mi titulo 
					"usuario"     => $this->session->userdata('usuario'),
					'num_cliente' => $this->db->get('cliente')->num_rows(),
					'num_empleado' => $this->db->get('empleado')->num_rows(),
					'num_productos' => $this->db->get('producto_servicio')->num_rows(),

			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_admin/head.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->parser->parse('Home_admin/header.php',$data, FALSE); // esta seria la barra de navegacion horizontal
			$this->parser->parse('Home_admin/aside.php',$data, FALSE);
			$this->parser->parse('Home_admin/section.php',$data, FALSE); // este seria todo el contenido central
			$this->parser->parse('Home_admin/footer.php',$data, FALSE); // este seria todo el contenido central
			$this->parser->parse('Home_admin/sidebar.php',$data, FALSE); // este seria todo el contenido central
			$this->load->view('Home_admin/pie_js.php'); // pie con los js
			$this->load->view('Home_admin/script.php'); // pie con los js

	}

}

/* End of file home_cliente.php */
/* Location: ./application/controllers/home_cliente.php */