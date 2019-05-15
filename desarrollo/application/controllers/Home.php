<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if(!$this->session->userdata('idUsuario')) { // si la seccion no existe me quedo en el homo

		} else {
			redirect('index.php/Gestion');
		}
	}

	public function index()
	{

		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'=> 'Inicio',//mi titulo 
					"usuario" => $this->session->userdata('usuario')
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_cliente/head.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->parser->parse('Home_cliente/header.php',$data, FALSE); // esta seria la barra de navegacion horizontal
			$this->parser->parse('Home_cliente/section.php',$data, FALSE); // este seria todo el contenido central
			$this->parser->parse('Home_cliente/footer.php',$data, FALSE); // este seria todo el contenido central
			$this->load->view('Home_cliente/pie_js.php'); // pie con los js
	}

}

/* End of file home_cliente.php */
/* Location: ./application/controllers/home_cliente.php */