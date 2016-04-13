<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Agenda extends CI_Controller 
{

	public function __construct()
	{
		parent::__construct();
		//Load Dependencies
		$this->load->model('Agenda_model');
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
					'titulo2'=> 'Listados',//mi titulo 
					'titulo1'=> 'Agenda de Eventos',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Agenda',//mi tit-ulo 
			);
			$this->parser->parse('Agenda/agenda_vista.php',$data, FALSE);	
			$this->load->view('Agenda/script_agenda.php',$data, FALSE);
	}

	/**
	* [ajax_list description]
	* @return [type] [description]
	*/
	public function ajax_list()
	{
		if ($this->input->is_ajax_request()) {
			// $this->output->enable_profiler(TRUE);
			$this->Agenda_model->get_agenda();
		} else {
			show_404();
		}


	}


	public function ver_modal($id = 0)
	{
			$this->Agenda_model->ver_modal($id);
	}

	//Delete one item
	public function delete( $id = NULL )
	{

	}
}

/* End of file Agenda.php */
/* Location: ./application/controllers/Agenda.php */
