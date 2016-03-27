<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Home_admin extends CI_Controller {


	public function __construct()
	{
		parent::__construct();
		$this->load->model("Caja_model");
		// control de acceso sin login
		// si no esta logueado redirije a login
		if ($this->session->userdata('Permiso_idPermiso')!='1'){
			redirect('index.php');
			} else{
			}
	}

	public function index()
	{
		$hora_actual = strftime( "%H:%M:%S", time() );
		$maximo = '20:00:00';
		if ($hora_actual > $maximo ) {
			$verificar_caja = $this->verificar_caja();
			if ($verificar_caja == "abierto") {
				# cerrar caja...
							$fecha = $this->fecha();
							$list = $this->Caja_model->get_caja($fecha);
							// echo json_encode($list);
							$recordsFiltered = $this->Caja_model->count_filter($fecha);
							$monto_inicial  = $this->monto_inicial();
							$data = array();
							$haber = 0;
							$debe = 0;
							$total = 0;
							$as = '';
							$no = '';
							$monto_inicial =  str_replace($this->config->item('caracteres'),"",$monto_inicial);
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
										$total =  number_format($as,0,'.',',');
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
										$as = $debe - $haber;
										$total =  number_format($as,0,'.',',');
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
								$monto_final =  number_format($as + $monto_inicial,0,'.',',');
							} else {
								$monto_final =  number_format($monto_inicial + $as,0,'.',',');
							}
							$Importe         =  str_replace($this->config->item('caracteres'),"",$monto_final);
										$hora = strftime( "%H:%M:%S", time() );
										$data               = array(
											'Monto_final'       => $Importe,
											'Fecha_cierre'      => $fecha ,
											'Hora_cierre'       => $hora,
											'Cierre'            => '1'

											);
										$this->Caja_model->add_set_caja($data);


			} else {
				# true...
			}
			
		} else {
			# true...
		}

		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'      => 'Sietema | Administrativa',//mi titulo 
					"usuario"     => $this->session->userdata('usuario'),
					'num_cliente' => '',
					'num_empleado' => '',
					'num_productos' => '',

			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_admin/head.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->parser->parse('Home_admin/header.php',$data, FALSE); // esta seria la barra de navegacion horizontal
			$this->parser->parse('Home_admin/aside.php',$data, FALSE);
			$this->parser->parse('Home_admin/section.php',$data, FALSE); // este seria todo el contenido central
			$this->parser->parse('Home_admin/footer.php',$data, FALSE); // este seria todo el contenido central
			$this->parser->parse('Home_admin/sidebar.php',$data, FALSE); // este seria todo el contenido central
			$this->load->view('Home_admin/pie_js.php'); // pie con los js
	}

	private function verificar_caja($value='')
	{
			$fecha = $this->fecha();
			$inicio_caja  = $this->Caja_model->inicio_caja($fecha);
			if ($inicio_caja == 1 || $inicio_caja == '') 
			{
				return ('cerrada');

			} 
			else 
			{
				return ('abierto' );

			}

	}

	private	function fecha()
	{
		$this->db->select('caja.Fecha_apertura as fecha');
		$this->db->where("(Cierre = 0) OR (Cierre = '')");
		$query = $this->db->get('caja');
		foreach($query->result_array() as $d)
	{
			return( $d['fecha']);
		}
	}

	private function monto_inicial()
	{
		$this->db->select('Monto_inicial');
		$this->db->where("(Cierre = 0) OR (Cierre = '')");
		$query = $this->db->get('caja');
		foreach($query->result_array() as $d)
		{
			return( $d['Monto_inicial']);
		}
	}
}

/* End of file home_cliente.php */
/* Location: ./application/controllers/home_cliente.php */