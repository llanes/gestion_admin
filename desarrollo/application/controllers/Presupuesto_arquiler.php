<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto_arquiler extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Presupuesto_arquiler_model");

	}

	public function index()
	{
			
			$this->cart->destroy();
			$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Productos Arquiler',//mi titulo 
					'titulo2'=> 'Administrar Productos Arquiler',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
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


	public function devol_load($value='')
	{
		$this->load->view('Presupuesto_arquiler/cart_devol.php');	// carga todos las url de estilo i js home	
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

						$idStock = $this->security->xss_clean( $this->input->post('idProducto_Servicio'));
						$checkbox            = $this->security->xss_clean( $this->input->post('checkbox'));
						$Precio_Unitario     = $this->security->xss_clean( $this->input->post('Precio_Unitario'));
						$precio              =  $Precio_Unitario - $checkbox;
						$opciones = array();
									if($this->input->post('opciones')) {
									$opciones = $this->input->post('opciones');
								}
						$data = array(
							'id'      => $this->security->xss_clean( $this->input->post('idProducto_Servicio')),
							'qty'     => $this->security->xss_clean( $this->input->post('Cantidad')),
							'price'   => $precio,
							'name'    => $this->security->xss_clean( $this->input->post('Nombre')),
							'options' => $opciones 

						);
						$this->cart->insert($data);
						// $this->Presupuesto_arquiler_model->actualizar_stock($idProducto_Servicio,$cantidad);
						echo json_encode($data);

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
			$Latitud = $this->security->xss_clean( $this->input->post('Latitud'));
			$Longitud = $this->security->xss_clean( $this->input->post('Longitud'));
			$aleatorio = $this->cantida_factura();
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
					if ($Latitud == '-27.22121' &&  $Longitud == '-55.80523'  ) {
						$Geo_posicion = '';
					} else {
								if ($Latitud == '' &&  $Longitud == ''  ) {
									$Geo_posicion = '';
								} else {
									$geodata = array('Latitud' => $Latitud , 'Longitud' => $Longitud  );
									$this->Presupuesto_arquiler_model->add_Geo_posicion($where='',$geodata);
									$Geo_posicion = $this->Geo_posicion();
					}

					}





				if ($id == 2) {
					$data = array(
						'fecha_expedicion'           => $this->security->xss_clean( $this->input->post('fecha_expedicion')),
						'Fecha_Pre_Arqui'            => $this->security->xss_clean( $this->input->post('Fecha_Pre_Arqui')),
						'Monto_Alquiler_Presupuesto' => str_replace($this->config->item('caracteres'),"",$this->cart->total()),
						'Arquiler_Presupuesto'       => 2,
						'Contado_Credito'            => 0,
						'Num_arquiler'               => 0,
						'Fecha_Devolucion'           => $this->security->xss_clean( $this->input->post('Fecha_Devolucion')),
						'Monto_total_iva'            => $this->security->xss_clean( $this->input->post('lesiva')),
						'Nombre_servicio'            => $this->security->xss_clean( $this->input->post('Nombres_servicios')),
						'Direccion_evento'            => $this->security->xss_clean( $this->input->post('Direccion_evento')),
						'Usuario_idUsuario'          => $this->session->userdata('idUsuario'),
						'Cliente_idCliente'          => $this->security->xss_clean( $this->input->post('idCliente')),
						'Entrega'                    => '',
						'Devolucion'                 => '',
						'Caja_idCaja'                 => '',
						'Geo_posicion_idGeo_posicion' => $Geo_posicion,

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
					$controlbutton = $this->security->xss_clean( $this->input->post('controlbutton'));
					$this->load->model("Caja_model");
					$Caja_idCaja  = $this->Caja_model->ultimoCaja();
					$Contado_Credito = $this->input->post('credi_cont');
					$Arquiler_Presupuesto =	1;
					// ''''''''''''''''''''''''''''''''
					$Pre  = $this->security->xss_clean( $this->input->post('Fecha_Pre_Arqui'));
					$Devo = $this->security->xss_clean( $this->input->post('Fecha_Devolucion'));
					$time = date_create($Pre);
					$time1 = date_create($Devo);
					$Pre_Arqui_date = date_format($time, "d-m-Y");
					$Devolucio_date = date_format($time1, "d-m-Y");
					$Pre_Arqui_hr   = date_format($time, "H:i:s");
					$Devolucio_hr   = date_format($time1, "H:i:s");
					$Devolucio = date('H:i:s', strtotime($Pre_Arqui_hr) + 18000); // sumar 5 horas
					if ($Pre_Arqui_date === $Devolucio_date && $Devolucio > $Devolucio_hr) {
						$Fecha_Devolucion = $Pre_Arqui_date.' '.$Devolucio ;
					} else {
						$Fecha_Devolucion = $this->security->xss_clean( $this->input->post('Fecha_Devolucion'));
					}

					$data = array(
						'fecha_expedicion'           => $this->security->xss_clean( $this->input->post('fecha_expedicion')),
						'Fecha_Pre_Arqui'            => $Pre,
						'Monto_Alquiler_Presupuesto' => str_replace($this->config->item('caracteres'),"",$this->cart->total()),
						'Arquiler_Presupuesto'       => $Arquiler_Presupuesto,
						'Contado_Credito'            => $Contado_Credito,
						'Num_arquiler'               => $aleatorio + 1,
						'Fecha_Devolucion'           => $Fecha_Devolucion,
						'Monto_total_iva'            => $this->security->xss_clean( $this->input->post('lesiva')),
						'Nombre_servicio'            => $this->security->xss_clean( $this->input->post('Nombres_servicios')),
						'Direccion_evento'            => $this->security->xss_clean( $this->input->post('Direccion_evento')),
						'Usuario_idUsuario'          => $this->session->userdata('idUsuario'),
						'Cliente_idCliente'          => $this->security->xss_clean( $this->input->post('idCliente')),
						'Entrega'                    => '',
						'Devolucion'                 => '',
						'Caja_idCaja'                => $Caja_idCaja,
						'Geo_posicion_idGeo_posicion' => $Geo_posicion,
						);
								if ($controlbutton == 0) {
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
															$Fecha_Ven = date('d-m-Y',strtotime("+$j month")) ; // suma 1 mes
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
								} else {
									$this->Presupuesto_arquiler_model->set_presupuesto($data,$controlbutton );
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
														'Presupuesto_Arquiler_idArquiler'       => $controlbutton,
														'Producto_Servicio_idProducto_Servicio' => $items['id'],
													);
													$this->Presupuesto_arquiler_model->add_presupuesto_detalle($_data);
												$i++;
												}
												if ($Contado_Credito == 2) {
													$this->Presupuesto_arquiler_model->delete_credito($controlbutton);
													$cantidad_cuota = $this->input->post('cuota');
													$cantidad = $this->input->post('cuota');
													$importe = $this->cart->total() / $cantidad_cuota;
													for ($j = 1; $j <= $cantidad; $j++) {
															$Fecha_Ven = date('d-m-Y',strtotime("+$j month")) ; // suma 1 mes
															$_data                     = array(
															'Num_Recibo'                      => $aleatorio + $j,
															'Importe'                         => str_replace($this->config->item('caracteres'),"",$importe),
															'Fecha_Ven'                       => $Fecha_Ven,
															'Fecha_Pago'                      => '',
															'Estado_Pago'                     => '2',
															'Num_cuota'                       => $j,
															'Presupuesto_Arquiler_idArquiler' => $controlbutton,
															'Cliente_idCliente'               => $this->security->xss_clean( $this->input->post('idCliente')),
															);
													$this->Presupuesto_arquiler_model->add_credito($_data);
													}
												}
											$this->cart->destroy();
											echo json_encode($data);
								}
			
				}
			}

		} else {
			show_404();
		}
	}
	public function Geo_posicion($value='')
	{
		$this->db->select_max('idGeo_posicion', 'idGeo_posicion');
		$query = $this->db->get('geo_posicion');
		foreach($query->result_array() as $d)
		{
			return( $d['idGeo_posicion']);
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

	public function cantida_factura()
	{
		$this->db->where('Arquiler_Presupuesto', 1 );
		return $this->db->count_all_results('presupuesto_arquiler');
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
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Listados Presupuesto',//mi titulo 
					'titulo5'=> 'Productos Arquiler',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),

			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Presupuesto_arquiler/listado_presupuesto.php',$data, FALSE);	// carga todos las url de estilo i js home	
	}
	public function ajax_list_presupuesto()
	{	
		$list = $this->Presupuesto_arquiler_model->get_presupuesto($id = '');
		 // $this->output->enable_profiler(TRUE);
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
						"recordsTotal" => $this->Presupuesto_arquiler_model->count_todas($id = ''),
						"recordsFiltered" => $this->Presupuesto_arquiler_model->count_filtro($id = ''),
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

	public function ajax_edit_($idArquiler)
	{
		if ($this->input->is_ajax_request()) {
			$this->cart->destroy();
			$data = $this->Presupuesto_arquiler_model->ajax_edit_($idArquiler);
			echo json_encode($data);
		}
	}
	public function edit_presupuesto($idArquiler)
	{
			$this->cart->destroy();
			$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Productos Arquiler',//mi titulo 
					'titulo2'=> 'Administrar Productos Arquiler',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Productos Arquiler',//mi titulo 
					'formulario'=> $this->Presupuesto_arquiler_model->edit_presupuesto($idArquiler),//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
			);
			 // $this->output->enable_profiler(true);
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
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Listados Alquiler',//mi titulo 
					'titulo5'=> 'Productos Arquiler',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Presupuesto_arquiler/listado_alqui.php',$data, FALSE);	
	}
	public function ajax_list_alquiler()
	{
		$list = $this->Presupuesto_arquiler_model->get_alquiler($id = '');
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
                           <a class ="btn  btn-default" href="javascript:void(0);" title="Devolucion"	onclick="devolucion('."'".$alquiler->idArquiler."'".')">
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
				<button type="submit" formtarget="_blank" id="target" class="btn btn-success btn-xs "><i class="fa fa-download"></i> PDF</button>
				<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_presupuesto('."'".$alquiler->idArquiler."'".')">
				<i class="fa fa-trash-o "></i></a>
				</div>';
			} else {
				$row[]   = '<div class="pull-right hidden-phone">
				<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_presupuesto('."'".$alquiler->idArquiler."'".')">
				<i class="fa fa-pencil"></i></a>
				<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_presupuesto('."'".$alquiler->idArquiler."'".')">
				<i class="fa fa-trash-o "></i></a>
				</div>';
			}
			

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Presupuesto_arquiler_model->count_alquiler($id = ''),
						"recordsFiltered" => $this->Presupuesto_arquiler_model->count_filter($id = ''),
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
		echo json_encode(array("status" => TRUE));
		// $this->output->enable_profiler(true);
	}

	public function recibir($value='')
	{
		$data = $this->input->post();
		$data2 = $this->cart->update($data);
		$idArquiler = $this->input->post('id');
		$cliente = $this->input->post('cliente');
		$this->Presupuesto_arquiler_model->recibir($idArquiler,$cliente );
		echo json_encode(array("status" => TRUE));
	}

	public function recibir_cobrar()
	{
		$data = $this->input->post();
		$data2 = $this->cart->update($data);
		$idArquiler = $this->input->post('id');
		$cliente = $this->input->post('cliente');
		$data = $this->Presupuesto_arquiler_model->recibir_cobrar($idArquiler,$cliente );
		echo json_encode($data);
	}
	public function load()
	{
	$this->load->view('Presupuesto_arquiler/load.php');	// carga todos las url de estilo i js home	
	}
	public function mapaload($idGeo_posicion)
	{
		if ($idGeo_posicion == '0') {
			$this->load->view('Presupuesto_arquiler/mapa.php');	// carga todos las url de estilo i js home	
		} else {
			$this->db->select('*');
			$this->db->where('idGeo_posicion', $idGeo_posicion);
			$query = $this->db->get('geo_posicion');
			$data = array('formulario1' => $query->result());
			$this->parser->parse('Presupuesto_arquiler/mapa_edit.php',$data, FALSE);	// carga todos las url de estilo i js home	

		}

	
	}
	public function verificar_item($value='')
	{
		$Fecha_Pre_Arqui  = $this->security->xss_clean( $this->input->post('Fecha_Pre_Arqui'));
		$Fecha_Devolucion = $this->security->xss_clean( $this->input->post('Fecha_Devolucion'));
		$Devolucio_date = '31/03/2016';
		$Pre_Arqui_hr   = '9:39';
		$Devolucio_hr   = '9:39';
		$datalista = array();
		$i = 1;
			foreach ($this->cart->contents() as $items) {
			$data = '';
			$Cantidad   = $items['qty'];
			$idProducto = $items['id'];
			$name =  $items['name'];


			
				$query = $this->db->select('
						ps.Nombre,da.Cantidad,pr.Arquiler_Presupuesto,pr.Fecha_Pre_Arqui,pr.Fecha_Devolucion,st.Cantidad_stock,
						st.Producto_Servicio_idProducto_Servicio as stock_idproduct,
						da.Producto_Servicio_idProducto_Servicio as detalle_idstock,
						Presupuesto_Arquiler_idArquiler')
						->from('producto_servicio ps,stock st,presupuesto_arquiler pr')
						->join('detalle_arquiler da', 'st.idStock = da.Producto_Servicio_idProducto_Servicio', 'INNER')
						->where('pr.idArquiler = da.Presupuesto_Arquiler_idArquiler')
						->where('st.Producto_Servicio_idProducto_Servicio = ps.idProducto_Servicio')
						->where('pr.Fecha_Devolucion >=',$Fecha_Pre_Arqui)
						// ->where("pr.Fecha_Devolucion >= '$Fecha_Pre_Arqui'")
						->where('da.Producto_Servicio_idProducto_Servicio',$idProducto )
						->where('pr.Arquiler_Presupuesto',1 )
					->get();
					$this->output->enable_profiler(true);
					if ($query->num_rows() == '') {
					$consul = $this->db->select('Cantidad_stock')
							->where('idStock',$idProducto )
							->get('stock');
							foreach ($consul->result() as $key => $value) {
								if ($Cantidad > $value->Cantidad_stock) {
									$data=
									'<tr ><td><h5>'.$name.'&nbsp;&nbsp;stock &nbsp;&nbsp;<span class="label  label-info">'.$value->Cantidad_stock.'</span></h5></td>
									<td><h5>&nbsp;&nbsp; Disponibli para alquilar &nbsp;&nbsp;<span class="label label-danger">'.$value->Cantidad_stock.'</span></h5></td></tr>
									';
								} 
							}

					} else {
							foreach ($query->result() as $row)
							{
								$fecha1 = $row->Fecha_Pre_Arqui;
								$fecha2 =  $row->Fecha_Devolucion;
								$result = $row->Cantidad_stock - $row->Cantidad;
								if ($Cantidad > $result and $Cantidad > $row->Cantidad_stock) {
									$data=
									'<tr ><td><h5>'.$name.'&nbsp;&nbsp; Disponible stock. &nbsp;&nbsp;<span class="label  label-info">'.$row->Cantidad_stock.'</span></h5></td>
									<td><h5>&nbsp;&nbsp; Disponibli para alquilar &nbsp;&nbsp;<span class="label label-danger">'.$result.'</span></h5></td></tr>
									';
								}
								if ($Cantidad > $result and $Cantidad < $row->Cantidad_stock) {
									$data=
									'<tr ><td><h5>'.$name.'&nbsp;&nbsp; Disponible <span class="label label-danger">'.$result.'</span>
									&nbsp;&nbsp; Alquilado <span class="label label-danger">'.$row->Cantidad.'</span></h5></td>
									<td><h5>
									&nbsp;&nbsp;Disponible desde &nbsp;&nbsp; '.$fecha2.'</h5></td></tr>
									';
								}
								if ($result == 0) {
									$data=
									'<tr ><td><h5>'.$name.'&nbsp;&nbsp; Disponible <span class="label label-danger">'.$result.'</span>
									&nbsp;&nbsp; Alquilado <span class="label label-danger">'.$row->Cantidad.'</span></h5></td>
									<td><h5>
									&nbsp;&nbsp;Disponible desde &nbsp;&nbsp; '.$fecha2.'</h5></td></tr>
									';
								}


							}
					}
				if ($data != '')
				{
					$datalista[] = array('res' => $data);
				}

			$i++;
			}
			if ($datalista != []) {
				echo json_encode($datalista);
			} else {
				echo json_encode('complte');
			}
			exit;

	}



}

/* End of file productos.php */
/* Location: ./application/controllers/Productos/productos.php */