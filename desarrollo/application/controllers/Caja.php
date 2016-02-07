<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caja extends CI_Controller {
	public function __construct(){
		parent::__construct();
		$this->load->model("Caja_model");
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('index.php/Home','refresh');
		}
	}
	public function index(){
		if($this->input->is_ajax_request()){

			$fecha = date("Y-m-d");
		$inicio_caja  = $this->Caja_model->inicio_caja($fecha);
			if ($inicio_caja == 1 || $inicio_caja == '') {
					$inicial = $this->Caja_model->monto_final();
					$monto_inicial =  str_replace($this->config->item('caracteres'),"",$inicial);
					 // $this->output->enable_profiler(true);		
					$data     = array //arreglo para mandar datos a la vista
					(
						'titulo1' => 'Caja | Movimiento',//mi titulo 
						'titulo2' => 'Administrar ',//mi titulo 
						'titulo3' => 'Home',//mi titulo 
						'titulo4' => 'Caja',//mi titulo 
						'monto_inicio' => $monto_inicial,//mi titulo 
						"usuario" => $this->session->userdata('usuario'),
					);
				//redirecionamos a la vista o llamamos a la vista index
				$this->parser->parse('Caja/caja_vista.php',$data, FALSE);
				$this->load->view('Caja/script_caja.php', $data, FALSE);
			}else{
					// $this->output->enable_profiler(true);
					$data     = array //arreglo para mandar datos a la vista
					(
						'titulo1' => 'Caja | Movimiento',//mi titulo 
						'titulo2' => 'Administrar ',//mi titulo 
						'titulo3' => 'Home',//mi titulo 
						'titulo4' => 'Caja',//mi titulo 
						'titulo5' => 'Caja',//mi titulo 
						"usuario" => $this->session->userdata('usuario'),
					);
				//redirecionamos a la vista o llamamos a la vista index
				$this->parser->parse('Caja/caja_vista1.php',$data, FALSE);
				$this->load->view('Caja/script_caja.php', $data, FALSE);

			}
		}else{
			show_404();
		}
	}
   public function abrir_Cerrar_Caja($id)
    {
		if($this->input->is_ajax_request()){
			 $hora = strftime( "%H:%M", time() );
			$fecha = date("Y-m-d");
			$impor           = $this->security->xss_clean( $this->input->post('Importe'));
			$Importe         =  str_replace($this->config->item('caracteres'),"",$impor);
			if ($id == 1) {
				$data               = array(
				'Monto_inicial'     => $Importe,
				'Monto_final'       => '',
				'Fecha_apertura'    =>  $fecha ,
				'Hora_apertura'     =>  $hora ,
				'Fecha_cierre'      => '',
				'Hora_cierre'       => '',
				'Apertura'          => $id,
				'Cierre'            => '',
				'Usuario_idUsuario' => $this->session->userdata('idUsuario')
				);
				$data1           = $this->Caja_model->add_caja($data);
			echo json_encode($data1);
			};
			if ($id == 0) {
				$data               = array(
				'Monto_final'       => $Importe,
				'Fecha_cierre'      => $fecha ,
				'Hora_cierre'       => $hora,
				'Cierre'            => '1',
				'Usuario_idUsuario' => $this->session->userdata('idUsuario'),
				);
				$data1           = $this->Caja_model->add_set_caja($data);
			echo json_encode($data1);
			};


		}else{
			show_404();
		}
    }
	public function ajax_list()
	{
		$fecha = date("Y-m-d");
		$list = $this->Caja_model->get_caja($fecha);
		// echo json_encode($list);
		$recordsFiltered = $this->Caja_model->count_filter($fecha);
		$inicial = $this->Caja_model->inicial();
		$data = array();
		$haber = 0;
		$debe = 0;
		$total = 0;
		$as = '';
		$monto_inicial =  str_replace($this->config->item('caracteres'),"",$inicial);
		$no = $_POST['start'];
		foreach ($list as $caja) {
			$resultadohaber = str_replace($this->config->item('caracteres'),"",$caja->haber);
			$resultadodebe  = str_replace($this->config->item('caracteres'),"",$caja->debe);
			$haber          +=$resultadohaber;
			$debe           +=$resultadodebe;
			$no++;
			$row     = array();
			$row[] = '<p style="text-align:left"><strong>'.$caja->descripcion .'</strong></p>';
			$row[] = '<p style="text-align:left"><strong>'.$caja->fecha.'</strong></p>';
			$row[] = '<p style="text-align:center"><strong>'.$caja->debe.'</strong></p>';
			$row[] = '<p style="text-align:center"><strong>'.$caja->haber.'</strong></p>';
			$row[] = null;
			$data[] = $row;
			////////////////////////////
			if ($no == $recordsFiltered) {
				if ($haber < $debe) {
					$as = $debe - $haber;
					$total =  number_format($as,0,',','.');
					for ($i = 0; $i <1 ; $i++) {
					$row     = array();
					$row[] = null;
					$row[] = null;
					$row[] = null;
					$row[] = null;
					$row[] = '<p style="text-align:right" class="text-danger total_debe_haber"><big>'.$total.' ₲.</big></p>';
					$data[] = $row;
				}
				} else {
					$as = $haber - $debe;
					$total =  number_format($as,0,',','.');
					for ($i = 0; $i <1 ; $i++) {
						$row     = array();
						$row[] = null;
						$row[] = null;
						$row[] = null;
						$row[] = null;
						$row[] = '<p style="text-align:right" class="text-danger total_debe_haber"><big>'.$total.'&nbsp;₲. </big></p>';
						$data[] = $row;
					}

				} 
			}else{}
		}
		if ($monto_inicial < $as) {
			$monto_final =  number_format($as + $monto_inicial,0,',','.');
		} else {
			$monto_final =  number_format($monto_inicial + $as,0,',','.');
		}
		$output = array(
				"draw" => $_POST['draw'],
				"recordsTotal" => $this->Caja_model->count_filter($fecha),
				"recordsFiltered" => $this->Caja_model->count_todas($fecha),
				"data" => $data,
				"Importe" => $monto_final,
		);
			//output to json format
			echo json_encode($output);
			// $this->output->enable_profiler(true);

		
	}

}

/* End of file Caja.php */
/* Location: ./application/controllers/Caja.php */