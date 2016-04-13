<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_cliente extends CI_Controller {
	public function __construct()
	{
		parent::__construct();

		//Load Dependencies
		$this->load->dbforge();	
		$this->load->model("Presupuesto_arquiler_model");
		$this->load->model('Home_client_model');
		if(!$this->session->userdata('idUsuario')) {
			redirect('index.php/Login');
		}else {
				if ($this->session->userdata('Permiso_idPermiso')==='2'){
				}else {
					redirect('index.php/Home_admin');
				}
		}

	}

	// List all your items
	public function index()
	{

		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'=> 'Inicio',//mi titulo 
					"usuario" => $this->session->userdata('usuario')
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_cliente/head.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->parser->parse('Home_cliente/header_inicio.php',$data, FALSE); // esta seria la barra de navegacion horizontal
			$this->parser->parse('Home_cliente/footer.php',$data, FALSE); // este seria todo el contenido central
			$this->load->view('Home_cliente/pie_js.php'); // pie con los js
			$this->load->view('Home_cliente/scrip_agenda.php',$data, FALSE);
	}

	public	function servicios()
	{
		$page = ($this->uri->segment(3)) ? $this->uri->segment(3) : 0;
        if(!is_numeric($page)){$page = 0;}
		///////////////////////////////////////////////////////////////////
		///////////////////////////paginando//////////////////////////////
		$filter=$this->input->post('filter'); 	
		$config                    = array();
		$config['base_url']        = site_url().'index.php/pag';
		$config['total_rows']      =  $this->db->get('categoria')->num_rows();
		$config['per_page']        = 8;
		$config['uri_segment']     = 3;
		$this->pagination->initialize($config);
		// $this->output->enable_profiler(TRUE);	
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'=> 'servicio',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
					'pagination' => $this->pagination->create_links(),
					'formulario' =>  $this->Presupuesto_arquiler_model->getCategoria($config["per_page"], $page),
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_cliente/head.php',$data, FALSE);	// carga todos las url de estilo i js home	
			// $this->parser->parse('Home_cliente/header_inicio.php',$data, FALSE); // esta seria la barra de navegacion horizontal
			$this->parser->parse('Home_cliente/servicios.php',$data, FALSE); // este seria todo el contenido central
			$this->parser->parse('Home_cliente/footer.php',$data, FALSE); // este seria todo el contenido central
			$this->load->view('Home_cliente/pie_js.php'); // pie con los js
	}


	public function presupuesto()
	{
		// $query2 = $this->db->get('categoria')->result();
		//  $this->output->enable_profiler(TRUE);
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'=> 'Presupuesto',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_cliente/head.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->parser->parse('Home_cliente/Presupuesto/presupuesto_vista.php',$data, FALSE); // este seria todo el contenido central
			$this->parser->parse('Home_cliente/footer.php',$data, FALSE); // este seria todo el contenido central
			$this->load->view('Home_cliente/pie_js.php'); // pie con los js
			$this->parser->parse('Home_cliente/Presupuesto/script.php',$data, FALSE); // este seria todo el contenido centr
	}

	public function Precios($value='')
	{
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo'=> 'Precios',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
					'form' =>  $this->db->get('categoria')->result(),
			);
			//redirecionamos a la vista o llamamos a la vista index
			$this->parser->parse('Home_cliente/head.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->parser->parse('Home_cliente/precios.php',$data, FALSE); // este seria todo el contenido central
			$this->parser->parse('Home_cliente/footer.php',$data, FALSE); // este seria todo el contenido central
			$this->load->view('Home_cliente/pie_js.php'); // pie con los js
	}
		public function lista_precio()
	{
		$page = $this->uri->segment(3);
        if(!is_numeric($page)){$page = 0;}
		///////////////////////////////////////////////////////////////////
		///////////////////////////paginando//////////////////////////////
		$value='';
		$filter=$this->input->post('filter');
		$config                    = array();
		$config['base_url']        = site_url().'index.php/Home_cliente/lista_precio';
		$config['total_rows']      = $this->db->count_all_results('producto_servicio');
		$config['per_page']        = 18;
		$config['uri_segment']     = 3;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['lista_precio'] = $this->Home_client_model->get_pr_ser($config["per_page"], $page,$value);
		 // $this->output->enable_profiler(TRUE);
		$this->load->view('Home_cliente/precio_load.php', $data, FALSE);
	}
	public function lista_pr_categ()
	{
		$value = $this->uri->segment(3);
		$page = $this->uri->segment(4);
		echo $page;
        if(!is_numeric($page)){$page = 0;}
		///////////////////////////////////////////////////////////////////
		///////////////////////////paginando//////////////////////////////
		$filter=$this->input->post('filter');
		$config                    = array();
		$config['base_url']        = site_url().'index.php/Home_cliente/lista_pr_categ/'.$value;
		$config['total_rows']      = $this->Home_client_model->lista_pr_categ($value);
		$config['per_page']        = 18;
		$config['uri_segment']     = 4;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['lista_precio'] = $this->Home_client_model->get_pr_ser($config["per_page"], $page,$value);
		 // $this->output->enable_profiler(TRUE);
		$this->load->view('Home_cliente/precio_load.php', $data, FALSE);
	}

	public function precio_fillter()
	{
		$filter = $this->uri->segment(3);
		$page = $this->uri->segment(4);
        if(!is_numeric($page)){$page = 0;}
		///////////////////////////////////////////////////////////////////
		///////////////////////////paginando//////////////////////////////
		$config                    = array();
		$config['base_url']        = site_url().'index.php/Home_cliente/precio_fillter/'.$filter;
		$config['total_rows']      = $this->Home_client_model->lista_pr_fillter($filter);
		$config['per_page']        = 18;
		$config['uri_segment']     = 3;
		$this->pagination->initialize($config);
		$data['pagination'] = $this->pagination->create_links();
		$data['lista_precio'] = $this->Home_client_model->get_pr_fillter($config["per_page"], $page,$filter);
		 // $this->output->enable_profiler(TRUE);
		$this->load->view('Home_cliente/precio_load.php', $data, FALSE);
	}

	public function ajax_list()
	{
		if ($this->input->is_ajax_request()) {
				$list = $this->Home_client_model->get_pre();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $precio) {
			$no++;
				$row   = array();
				
				$row[] = '
				<div class="col-md-12">
                      <div class="row product-list">
                          <div class="col-md-4">
                              <section class="panel">
                                  <div class="panel-body text-center">
                                      <h4>
                                          <a href="#" class="pro-title">
                                              '.$precio->Nombre.'
                                          </a>
                                      </h4>
                                      <p class="price">₲.&nbsp;'.number_format($precio->Precio_Unitario,0,'.','.').'</p>
                                  </div>
                              </section>
                          </div>
                     </div>
                  </div> 
				';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Home_client_model->count_todas_pre(),
						"recordsFiltered" => $this->Home_client_model->count_filtro_pre(),
						"data" => $data,
				);
		//output to json format
		// $this->output->enable_profiler(TRUE);
		echo json_encode($output);
		} else {
			show_404();
		}
		
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
						$idProducto_Servicio = $this->security->xss_clean( $this->input->post('idProducto_Servicio'));
						$Precio_Unitario     = $this->security->xss_clean( $this->input->post('Precio_Unitario'));
						$opciones = array();
									if($this->input->post('opciones')) {
									$opciones = $this->input->post('opciones');
								}
						$data = array(
							'id'      => $idProducto_Servicio,
							'qty'     => $cantidad,
							'price'   => $Precio_Unitario,
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
		public function ajax_list_presupuesto()
	{

		$id = $this->session->userdata('Cliente_idCliente');
		$list = $this->Presupuesto_arquiler_model->get_presupuesto($id);
		// $this->output->enable_profiler(TRUE);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $lista) {
			$no++;
			$row     = array();
			$row[]   = $lista->Nombre_servicio;
			$row[]   = number_format($lista->Monto_Alquiler_Presupuesto,0,'.','.').'&nbsp;₲.';
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
						"recordsTotal" => $this->Presupuesto_arquiler_model->count_todas($id),
						"recordsFiltered" => $this->Presupuesto_arquiler_model->count_filtro($id),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function add_presupuesto()
	{
		if ($this->input->is_ajax_request()) {
			$aleatorio = $this->ultimo_cabecera();
			$this->form_validation->set_error_delimiters('*','');
			if ($this->form_validation->run('add_presupuesto') == FALSE) {
					$data = array(
						'idCliente'         => form_error('idCliente'),
						'Fecha_Pre_Arqui'   => form_error('Fecha_Pre_Arqui'),
						'Fecha_Devolucion'  => form_error('Fecha_Devolucion'),
						'Nombres_servicios' => form_error('Nombres_servicios'),
						'res'               => 'error');
			} else {
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
						'Direccion_evento'            => $this->security->xss_clean( $this->input->post('Direccion_evento')),
						'Usuario_idUsuario'          => '',
						'Cliente_idCliente'          => $this->security->xss_clean( $this->input->post('idCliente')),
						'Entrega'                    => '',
						'Devolucion'                 => '',
						'Caja_idCaja'                 => '',
						'Geo_posicion_idGeo_posicion' => '',

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
			}

		} else {
			show_404();
		}
	}

	
	public function update()
	{
		if ($this->input->is_ajax_request()) {
			$id = $this->security->xss_clean( $this->input->post('idArquiler'));
			$this->form_validation->set_error_delimiters('*','');
			$aleatorio = $this->ultimo_cabecera();
			if ($this->form_validation->run('add_presupuesto') == FALSE) {
					$data = array(
						'idCliente'         => form_error('idCliente'),
						'Fecha_Pre_Arqui'   => form_error('Fecha_Pre_Arqui'),
						'Fecha_Devolucion'  => form_error('Fecha_Devolucion'),
						'Nombres_servicios' => form_error('Nombres_servicios'),
						'res'               => 'error');
			} else {
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
						'Direccion_evento'            => $this->security->xss_clean( $this->input->post('Direccion_evento')),
						'Usuario_idUsuario'          => '',
						'Cliente_idCliente'          => $this->security->xss_clean( $this->input->post('idCliente')),
						'Entrega'                    => '',
						'Devolucion'                 => '',
						'Caja_idCaja'                 => '',	
						);
							$this->db->where('idArquiler', $id);
							$this->db->update('presupuesto_arquiler',$data );
							$this->db->where('Presupuesto_Arquiler_idArquiler', $id);
							$this->db->delete('detalle_arquiler');
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
								'Presupuesto_Arquiler_idArquiler'       =>  $id,
								'Producto_Servicio_idProducto_Servicio' => $items['id'],
							);
							$this->db->insert('detalle_arquiler', $_data);
						$i++;
						}
					$this->cart->destroy();
	
					echo json_encode($data);
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
	public function edit_presupuesto($idArquiler)
	{
		$this->cart->destroy();
		$this->Presupuesto_arquiler_model->edit_presupuesto($idArquiler);
		$this->db->select('*');
		$this->db->where('idArquiler',$idArquiler);
		$query = $this->db->get('presupuesto_arquiler');
		$data =  $query->row();
		echo json_encode($data);
	}

	public function loader_presu()
	{
		if ($this->input->is_ajax_request()) {
			$query = $this->Presupuesto_arquiler_model->get_empre_client();
			// $this->output->enable_profiler(TRUE);
			$data = array(
				'formulario' => $query, 
				);
			$this->parser->parse('Home_cliente/Presupuesto/cart_get.php',$data,false);
			$this->load->view('Home_cliente/Presupuesto/refresh.php');	
		} else {
				show_404();
		}

	}
		public function loader_update()
	{
		if ($this->input->is_ajax_request()) {
			$query = $this->Presupuesto_arquiler_model->get_empre_client();
			// $this->output->enable_profiler(TRUE);
			$data = array(
				'formulario' => $query, 
				);
			$this->parser->parse('Home_cliente/Presupuesto/cart_act.php',$data,false);
			$this->load->view('Home_cliente/Presupuesto/refresh.php');	
		} else {
				show_404();
		}

	}
	public function table_()
	{
		if ($this->input->is_ajax_request()) {
			$this->load->view('Home_cliente/Presupuesto/load.php');	
			$this->load->view('Home_cliente/Presupuesto/refresh_.php');	
		} else {
				show_404();
		}

	}

	public function delete_item($rowid)
	{
		if ($this->input->is_ajax_request()) {
		$this->cart->remove($rowid);
        }else{
			show_404();
		}
	}
	public function refresh()
	{
	$this->load->view('Home_cliente/Presupuesto/refresh.php');	// carga todos las url de estilo i js home	
	}

	public function categoria()
	{
					$search = strip_tags(trim($_GET['q'])); 
					$this->db->select('idCategoria,Categoria');
					$this->db->from('categoria');
					$this->db->like('Categoria', $search);
					$query = $this->db->get();
					$data = $query->result_array();
					// $this->output->enable_profiler(TRUE);
					echo json_encode($data);
	}

	public function categoria_articulo($Value)
	{
					$this->db->select('idProducto_Servicio,Nombre,Precio_Unitario');
					$this->db->from('producto_servicio');
					$this->db->where('Categoria_idCategoria', $Value);
					$query = $this->db->get();
					$this->dbforge->drop_table('temp',TRUE);
					if ($query->num_rows()> 0) {
						//creacion de tabla temporal si no existe , de existeir no hace nada
						$consulta="
							CREATE TABLE IF NOT EXISTS `servicio_arquiler`.`temp` (
							`idtemp` INT NOT NULL AUTO_INCREMENT COMMENT '',
							`idProducto_Servicio` INT(11) COMMENT '',
							`Nombre` VARCHAR(45) NULL COMMENT '',
							`Precio_Unitario` VARCHAR(45) NULL COMMENT '',
							PRIMARY KEY (`idtemp`)  COMMENT '')
							";
						$this->db->query($consulta);
					foreach ($query->result() as $value) {
						$data = array(
							'idProducto_Servicio' =>$value->idProducto_Servicio , 
							'Nombre' =>$value->Nombre,
							'Precio_Unitario'=>$value->Precio_Unitario);
						$this->db->insert('temp',$data);
					}

					} else {
						# code...
					}

	}
	public function get_articulo()
	{
					$search = strip_tags(trim($_GET['p'])); 
					$this->db->select('*');
					$this->db->from('temp');
					$this->db->like('Nombre', $search);
					$query = $this->db->get();
					$data = $query->result_array();
					echo json_encode($data);
					// $this->output->enable_profiler(TRUE);

	}

	public function get_articulo_($Value)
	{
					$this->db->select('*');
					$this->db->from('producto_servicio');
					$this->db->where('idProducto_Servicio', $Value);
					$query = $this->db->get();
					$data =  $query->row();
					echo json_encode($data);
					// $this->output->enable_profiler(TRUE);

	}
	public function trunk()
	{
		$this->cart->destroy();
		$this->dbforge->drop_table('IF EXISTS','temp');
	}
	public function listar_articulo($valu)
	{
		if ($this->input->is_ajax_request()) {
					$this->db->select('*');
					$this->db->from('producto_servicio');
					$this->db->where('Categoria_idCategoria', $valu);
					$query = $this->db->get();
					$data = $query->result_array();
					echo json_encode($data);
					// $this->output->enable_profiler(TRUE);
		} else {
			show_404();
		}

	}

	public function agenda_ajax_list()
	{
		if ($this->input->is_ajax_request()) {
			// $this->output->enable_profiler(TRUE);
			$id = $this->session->userdata('Cliente_idCliente');
			$this->Home_client_model->get_agenda($id );
		} else {
			show_404();
		}
	}

	public function ver_modal($id = 0)
	{
		if ($this->input->is_ajax_request()) {
			
			$this->Home_client_model->ver_modal($id);
		} else {
			show_404();
		}

	}

	public function listado_alquiler_ajax()
	{

		$id = $this->session->userdata('Cliente_idCliente');
		$list = $this->Presupuesto_arquiler_model->get_alquiler($id);
		// $this->output->enable_profiler(TRUE);
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $lista) {
			$no++;
			$row     = array();
			$row[]   = $lista->Nombre_servicio;
			$row[]   = number_format($lista->Monto_Alquiler_Presupuesto,0,'.','.').'&nbsp;₲.';
			$row[]   = '<div>
			<a class="btn btn-success btn-xs" href="javascript:void(0);" title="Edit" onclick="details_al('."'".$lista->idArquiler."'".')">
			<label class="label label-success "></label>Ver </a></div>' ;
			$data[] = $row;

		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Presupuesto_arquiler_model->count_alquiler($id),
						"recordsFiltered" => $this->Presupuesto_arquiler_model->count_filter($id),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}

	public function ajax_edit($idArquiler)
	{	
		if ($this->input->is_ajax_request()) {
				$this->cart->destroy();
				$data = $this->Presupuesto_arquiler_model->edit_presupuesto($idArquiler);
				echo json_encode($data);
				// $this->output->enable_profiler(true);
		} else {
			# code...
		}

	}

}

/* End of file Home_cliente.php */
/* Location: ./application/controllers/Home_cliente.php */
