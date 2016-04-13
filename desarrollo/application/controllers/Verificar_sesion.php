<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Verificar_sesion extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('index.php/Home','refresh');
		}

	}

	// List all your items
	public function index( $offset = 0 )
	{
		if ($this->input->is_ajax_request()) {
			if (!$this->session->userdata('idUsuario')) {
				echo json_encode('correcto');
			} else {
				echo json_encode('correcto');
			}
		} else {
			$this->load->view('Error/404.php', FALSE);
		}
	}

}

/* End of file Verificar_sesion.php */
/* Location: ./application/controllers/Verificar_sesion.php */
