<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto_arquiler extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Presupuesto_arquiler_model");
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('index.php/Home','refresh');
		}
	}

	public function index()
	{
			
			$this->cart->destroy();
			$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Productos Arquiler',//mi titulo 
					'titulo2'=> 'Administrar Productos Arquiler',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Productos Arquiler',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
					'formula' => $this->db->get('empresa')->result_array(),
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Presupuesto_arquiler/presupuesto_arquiler_vista.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Presupuesto_arquiler/cart_get.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Presupuesto_arquiler/footer.php', $data, FALSE);
			$this->load->view('Presupuesto_arquiler/script.php', $data, FALSE);

	}
	public function loader()
	{
	$this->load->view('Presupuesto_arquiler/cart_get.php');	// carga todos las url de estilo i js home	
	}
	/**
	* [agregar_carrito description]
	* @return [type] [description]
	*/
	public function agregar_carrito()
	{
				if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('*','');
				if ($this->form_validation->run('agregar_carrito') == FALSE)
				{
						$data = array(
							'idProducto_Servicio'   => form_error('idProducto_Servicio'),
							'Cantidad'   => form_error('Cantidad'),
							'res'		=> 'error');
					echo json_encode($data);
				}else{
					$cantidad = $this->security->xss_clean( $this->input->post('Cantidad'));
					$Cantidad_stock = $this->input->post('stock');
					if ($cantidad >= $Cantidad_stock) {
						$data = array(
							'cantidad'     => $cantidad,
							'Cantidad_stock'     => $Cantidad_stock,
							'res'		=> 'crrito');
						echo json_encode($data);
					}else {
						$idProducto_Servicio = $this->security->xss_clean( $this->input->post('idProducto_Servicio'));
						$checkbox            = $this->security->xss_clean( $this->input->post('checkbox'));
						$Precio_Unitario     = $this->security->xss_clean( $this->input->post('Precio_Unitario'));
						$precio              =  $Precio_Unitario - $checkbox;
						$opciones = array();
									if($this->input->post('opciones')) {
									$opciones = $this->input->post('opciones');
								}
						$data = array(
							'id'      => $idProducto_Servicio,
							'qty'     => $cantidad,
							'price'   => $precio,
							'name'    => $this->security->xss_clean( $this->input->post('Nombre')),
							'options' => $opciones 

						);
						$this->cart->insert($data);
						// $this->Presupuesto_arquiler_model->actualizar_stock($idProducto_Servicio,$cantidad);
						echo json_encode($data);
					}

				}
        }else{
			show_404();
		}
	}
	/**
	* [update_carrito description]
	* @return [type] [description]
	*/
	public function update_carrito()
	{
		$data = $this->input->post();
		$this->cart->update($data);
		redirect('index.php/Home_admin','refresh');
	}
	/**
	* [delete_carrito description]
	* @return [type] [description]
	*/
	public function delete_carrito()
	{
		$this->cart->destroy();
		redirect('index.php/Home_admin','refresh');
	}
	public function delete_item($rowid)
	{
		if ($this->input->is_ajax_request()) {
		$this->cart->remove($rowid);
        }else{
			show_404();
		}
	}
	public function add_presupuesto($id)
	{
		if ($this->input->is_ajax_request()) {
			$aleatorio = $this->ultimo_cabecera();
			$this->form_validation->set_error_delimiters('*','');
			if ($this->form_validation->run('add_presupuesto') == FALSE) {
					$data = array(
						'idCliente'         => form_error('idCliente'),
						'ci_ruc'            => form_error('ci_ruc'),
						'Fecha_Pre_Arqui'   => form_error('Fecha_Pre_Arqui'),
						'Fecha_Devolucion'  => form_error('Fecha_Devolucion'),
						'Nombres_servicios' => form_error('Nombres_servicios'),
						'res'               => 'error');
			} else {
				if ($id == 2) {
					$data = array(
						'fecha_expedicion'           => $this->security->xss_clean( $this->input->post('fecha_expedicion')),
						'Fecha_Pre_Arqui'            => $this->security->xss_clean( $this->input->post('Fecha_Pre_Arqui')),
						'Monto_Alquiler_Presupuesto' => str_replace($this->config->item('caracteres'),"",$this->cart->total()),
						'Arquiler_Presupuesto'       => 2,
						'Contado_Credito'            => 0,
						'Num_arquiler'               => $aleatorio + 1,
						'Fecha_Devolucion'           => $this->security->xss_clean( $this->input->post('Fecha_Devolucion')),
						'Monto_total_iva'            => $this->security->xss_clean( $this->input->post('lesiva')),
						'Nombre_servicio'            => $this->security->xss_clean( $this->input->post('Nombres_servicios')),
						'Usuario_idUsuario'          => $this->session->userdata('idUsuario'),
						'Cliente_idCliente'          => $this->security->xss_clean( $this->input->post('idCliente')),
						'Entrega'                    => '',
						'Devolucion'                 => '',

						);
					$this->Presupuesto_arquiler_model->add_presupuesto($data);
						$i = 1;
						foreach ($this->cart->contents() as $items) {
									foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) {
										$iva =	$option_value;
									}
							$_data = array(
								'Cantidad'                              => $items['qty'],
								'Descripcion'                           => '',
								'Precio'                                => str_replace($this->config->item('caracteres'),"",$items['price']),
								'Iva'                                   => $iva,
								'Presupuesto_Arquiler_idArquiler'       => $this->ultimo_cabecera(),
								'Producto_Servicio_idProducto_Servicio' => $items['id'],
							);
					$this->Presupuesto_arquiler_model->add_presupuesto_detalle($_data);
						$i++;
						}
					$this->cart->destroy();
					echo json_encode($data);
				} else {
					$Contado_Credito = $this->input->post('credi_cont');
					if ($Contado_Credito == 2) {
						$Arquiler_Presupuesto = 0;
					} else {
						$Arquiler_Presupuesto =	1;
					}
					$data = array(
						'fecha_expedicion'           => $this->security->xss_clean( $this->input->post('fecha_expedicion')),
						'Fecha_Pre_Arqui'            => $this->security->xss_clean( $this->input->post('Fecha_Pre_Arqui')),
						'Monto_Alquiler_Presupuesto' => str_replace($this->config->item('caracteres'),"",$this->cart->total()),
						'Arquiler_Presupuesto'       => $Arquiler_Presupuesto,
						'Contado_Credito'            => $Contado_Credito,
						'Num_arquiler'               => $aleatorio + 1,
						'Fecha_Devolucion'           => $this->security->xss_clean( $this->input->post('Fecha_Devolucion')),
						'Monto_total_iva'            => $this->security->xss_clean( $this->input->post('lesiva')),
						'Nombre_servicio'            => $this->security->xss_clean( $this->input->post('Nombres_servicios')),
						'Usuario_idUsuario'          => $this->session->userdata('idUsuario'),
						'Cliente_idCliente'          => $this->security->xss_clean( $this->input->post('idCliente')),
						'Entrega'                    => '',
						'Devolucion'                 => '',
						);
						$this->Presupuesto_arquiler_model->add_presupuesto($data);
						$id = $this->Presupuesto_arquiler_model->serie();
						$serie = $id + 1;
						$this->Presupuesto_arquiler_model->add_serie($serie);
						$i = 1;
						foreach ($this->cart->contents() as $items) {
									foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) {
										$iva =	$option_value;
									}
							$_data = array(
								'Cantidad'                              => $items['qty'],
								'Descripcion'                           => '',
								'Precio'                                => str_replace($this->config->item('caracteres'),"",$items['price']),
								'Iva'                                   => $iva,
								'Presupuesto_Arquiler_idArquiler'       => $this->ultimo_cabecera(),
								'Producto_Servicio_idProducto_Servicio' => $items['id'],
							);
							$this->Presupuesto_arquiler_model->add_presupuesto_detalle($_data);
						$i++;
						}
						if ($Contado_Credito == 2) {
							$cantidad_cuota = $this->input->post('cuota');
							$cantidad = $this->input->post('cuota');
							$importe = $this->cart->total() / $cantidad_cuota;
							for ($j = 1; $j <= $cantidad; $j++) {
									$Fecha_Ven = date('Y-m-d',strtotime("+$j month")) ; // suma 1 mes
									$_data                     = array(
									'Num_Recibo'                      => $aleatorio + $j,
									'Importe'                         => str_replace($this->config->item('caracteres'),"",$importe),
									'Fecha_Ven'                       => $Fecha_Ven,
									'Fecha_Pago'                      => '',
									'Estado_Pago'                     => '2',
									'Num_cuota'                       => $j,
									'Presupuesto_Arquiler_idArquiler' => $this->ultimo_cabecera(),
									'Cliente_idCliente'               => $this->security->xss_clean( $this->input->post('idCliente')),
									);
							$this->Presupuesto_arquiler_model->add_credito($_data);
							}
						}
					$this->cart->destroy();
					echo json_encode($data);
				}
			}

		} else {
			show_404();
		}
	}
	// Ultima cabecera
	public function ultimo_cabecera()
	{
		$query = $this->db->query('SELECT MAX(idArquiler) as idArquiler from presupuesto_arquiler');
			foreach($query->result_array() as $d)
			{
				return( $d['idArquiler']);
			}
	}
	// ultimo servicio
	public function ultimo_servicio_dos()
	{
		$query = $this->db->query("SELECT MAX(idServicio) as idServicio from servicio where Estado = 2");
			foreach($query->result_array() as $d)
			{
				return( $d['idServicio']);
			}
	}
	public function ultimo_servicio_cero()
	{
		$query = $this->db->query("SELECT MAX(idServicio) as idServicio from servicio where Estado = 0");
			foreach($query->result_array() as $d)
			{
				return( $d['idServicio']);
			}
	}

	// busqueda autocompletar
	public function busqueda_cliente()
	{
		// resivimos los datos del input a traves de la uri, por segment
		$datos= $this->uri->segment(4);
		$this->Presupuesto_arquiler_model->busqueda_cliente($datos);
	}
	public function busqueda_cliente2()
	{
		// resivimos los datos del input a traves de la uri, por segment
		$datos= $this->uri->segment(4);
		$this->Presupuesto_arquiler_model->busqueda_cliente2($datos);
	}
	public function busqueda_producto()
	{
		// resivimos los datos del input a traves de la uri, por segment
		$datos= $this->uri->segment(4);
		$this->Presupuesto_arquiler_model->busqueda_producto($datos);
	}
	public function busqueda_servicio()
	{
		// resivimos los datos del input a traves de la uri, por segment
		$datos= $this->uri->segment(4);
		$this->Presupuesto_arquiler_model->busqueda_servicio($datos);
	}
	public function recorrer_servicios($id)
	{
		$this->cart->destroy();
		$this->Presupuesto_arquiler_model->recorrer_servicios($id);
	}
	public function listados_presupuesto()
	{
			$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Listados Presupuesto',//mi titulo 
					'titulo2'=> 'Presupuesto ',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Listados Presupuesto',//mi titulo 
					'titulo5'=> 'Productos Arquiler',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),

			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Presupuesto_arquiler/listado_presupuesto.php',$data, FALSE);	// carga todos las url de estilo i js home	
	}
	public function ajax_list_presupuesto()
	{
		$list = $this->Presupuesto_arquiler_model->get_presupuesto();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $lista) {
			$no++;
			$row     = array();
			$row[]   = $lista->Nombre_servicio;
			$row[]   = $lista->Nombres.'  '.$lista->Apellidos;
			$row[]   = $lista->Monto_Alquiler_Presupuesto;
			$row[]   = $lista->fecha_expedicion;
			$row[]   = '<div>
			<a class="btn btn-success btn-xs" href="javascript:void(0);" title="Edit" onclick="ver_detalles('."'".$lista->idArquiler."'".')">
			<label class="label label-success "></label>Ver </a></div>' ;
			//add html for action
			$row[]   = '<div class="pull-right hidden-phone">
			<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_presupuesto('."'".$lista->idArquiler."'".')">
			<i class="fa fa-pencil"></i></a>
			<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_presupuesto('."'".$lista->idArquiler."'".')">
			<i class="fa fa-trash-o "></i></a></div>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Presupuesto_arquiler_model->count_todas(),
						"recordsFiltered" => $this->Presupuesto_arquiler_model->count_filtro(),
						"data" => $data,
				);
		//output to json format
		
		echo json_encode($output);
	}
	public function ajax_edit($idArquiler)
	{	$this->cart->destroy();
		$data = $this->Presupuesto_arquiler_model->edit_presupuesto($idArquiler);
		echo json_encode($data);
		// $this->output->enable_profiler(true);
	}
	public function edit_presupuesto($idArquiler)
	{
			$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Productos Arquiler',//mi titulo 
					'titulo2'=> 'Administrar Productos Arquiler',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Productos Arquiler',//mi titulo 
					'formulario'=> $this->Presupuesto_arquiler_model->edit_presupuesto($idArquiler),//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
					'formula' => $this->db->get('empresa')->result_array(),
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Presupuesto_arquiler/presupuesto_arquiler_edit.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Presupuesto_arquiler/cart_get.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Presupuesto_arquiler/footer.php', $data, FALSE);
			$this->load->view('Presupuesto_arquiler/script.php', $data, FALSE);
			// $this->output->enable_profiler(true);
	}
	public function delete_presupuesto($idArquiler)
	{
		$this->Presupuesto_arquiler_model->delete_presupuesto($idArquiler);
		echo json_encode(array("status" => TRUE));
	}
	/////////////////listados_alquiler////////////////////////
	public function listados_alquiler()
	{
			$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Listados Alquiler',//mi titulo 
					'titulo2'=> 'Presupuesto ',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Listados Alquiler',//mi titulo 
					'titulo5'=> 'Productos Arquiler',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Presupuesto_arquiler/listado_alqui.php',$data, FALSE);	
	}
	public function ajax_list_alquiler()
	{
		$list = $this->Presupuesto_arquiler_model->get_alquiler();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $alquiler) {
			$no++;
			$row     = array();
			$row[]   = $alquiler->Nombre_servicio;
			$row[]   = $alquiler->Nombres.'  '.$alquiler->Apellidos;
			$row[]   = $alquiler->Monto_Alquiler_Presupuesto;
			if ($alquiler->Entrega != 1) {
				$row[] ='<div class="btn-group btn-group-xs" tabindex="0">
									<a class ="btn  active btn-danger" ><i class="fa fa-times"></i> no</a>
									<a class ="btn  btn-default" href="javascript:void(0);" title="Edit"	onclick="entregar('."'".$alquiler->idArquiler."'".','."'".$alquiler->Entrega."'".')">
									<i class="fa fa-check"></i>Entregar</a>
						</div>';
			} else if ($alquiler->Entrega != 0) {
				$row[] ='<div class="btn-group btn-group-xs" tabindex="0">
								<a class="btn   btn-default" href="javascript:void(0);" title="Edit"	onclick="entrega_pndnt('."'".$alquiler->idArquiler."'".','."'".$alquiler->Entrega."'".')">
								<i class="fa fa-times"></i> no</a>
								<a class="btn   active btn-success"><i class="fa fa-check"></i>Entregado</a> 
						</div>';
			} else {

			}
			if ($alquiler->Devolucion != 1) {
				if ($alquiler->Entrega != 1) {
						$row[] ='<div class="btn-group btn-group-xs" tabindex="0">
									<a class="btn  active btn-danger"><i class="fa fa-times"></i> no</a>
                           <a class ="btn  btn-default" href="javascript:void(0);" title="Devolucion"	>
									<i class="fa fa-check"></i>Recibir</a>
						</div>';
				} else {
						$row[] ='<div class="btn-group btn-group-xs" tabindex="0">
									<a class="btn  active btn-danger"><i class="fa fa-times"></i> no</a>
                           <a class ="btn  btn-default" href="javascript:void(0);" title="Devolucion"	onclick="devolucion('."'".$alquiler->idArquiler."'".','."'".$alquiler->Devolucion."'".')">
									<i class="fa fa-check"></i>Recibir</a>
						</div>';
				}

			} else if ($alquiler->Devolucion != 0) {
				$row[] ='<div class="btn-group btn-group-xs" tabindex="0">
								<a class="btn   btn-default" href="javascript:void(0);" title="Cancelar Devolucion"	onclick="cancel_devolu('."'".$alquiler->idArquiler."'".','."'".$alquiler->Devolucion."'".')">
								<i class="fa fa-times"></i> no</a>
								<a class="btn  active btn-success"><i class="fa fa-check"></i>Recibido</a> 
						</div>';
			} else {

			}
			$row[]   = '<div class="btn-group btn-group-xs" tabindex="0">
			<a class="btn btn-info " href="javascript:void(0);" title="Edit" onclick="details_al('."'".$alquiler->idArquiler."'".')">
	   	<i class="fa fa-plus-square"></i></a></div>' ;
			//add html for action
			if ($alquiler->Devolucion == 1 || $alquiler->Entrega == 1) {
				$row[]   = '<div class="pull-right hidden-phone">
				<form class="form-horizontal" method="post" name="formulario" id="formulario" target="myIframe"  action='.'factura_pdf/'."".$alquiler->idArquiler."".' >
				<input type="hidden" name="Monto" value='."'".$alquiler->Monto_Alquiler_Presupuesto."'".'>
				<button type="submit" formtarget="_blank" id="target" class="btn btn-success btn-xs "><i class="fa fa-download"></i> PDF</button>
				<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_presupuesto('."'".$alquiler->idArquiler."'".')">
				<i class="fa fa-trash-o "></i></a>
				</FORM>
				</div>';
			} else {
				$row[]   = '<div class="pull-right hidden-phone">
				<form class="form-horizontal" method="post" name="formulario" id="formulario" target="myIframe"  action='.'factura_pdf/'."".$alquiler->idArquiler."".' >
				<input type="hidden" name="Monto" value='."'".$alquiler->Monto_Alquiler_Presupuesto."'".'>
				<button type="submit" formtarget="_blank" id="target" class="btn btn-success btn-xs "><i class="fa fa-download"></i> PDF</button>
				<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_presupuesto('."'".$alquiler->idArquiler."'".')">
				<i class="fa fa-pencil"></i></a>
				<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_presupuesto('."'".$alquiler->idArquiler."'".')">
				<i class="fa fa-trash-o "></i></a>
				</FORM>
				</div>';
			}
			

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Presupuesto_arquiler_model->count_alquiler(),
						"recordsFiltered" => $this->Presupuesto_arquiler_model->count_filter(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
		// $this->output->enable_profiler(true);
	}
	public function entrega()
	{
		$idArquiler = $this->input->post('id');
		$entrega   = $this->input->post('si_no');
		$this->Presupuesto_arquiler_model->update_entrega($idArquiler,$entrega);
		echo json_encode(array("status" => TRUE));
		// $this->output->enable_profiler(true);
	}
		public function devolucion()
	{
		$idArquiler = $this->input->post('id');
		$devolucion   = $this->input->post('si_no');
		$this->Presupuesto_arquiler_model->update_devolucion($idArquiler,$devolucion);
		// echo json_encode(array("status" => TRUE));
		$this->output->enable_profiler(true);
	}
	public function load()
	{
	$this->load->view('Presupuesto_arquiler/load.php');	// carga todos las url de estilo i js home	
	}



}

/* End of file productos.php */
/* Location: ./application/controllers/Productos/productos.php */