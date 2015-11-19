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
		// $this->output->enable_profiler(true);
			// $this->cart->destroy();
			$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Productos Arquiler',//mi titulo 
					'titulo2'=> 'Administrar Productos Arquiler',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Productos Arquiler',//mi titulo 
					'titulo5'=> 'Productos Arquiler',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
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
	public function update_carrito()
	{
		$data = $this->input->post();
  		$this->cart->update($data);
		redirect('index.php/Home_admin','refresh');
	}
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
				$this->form_validation->set_error_delimiters('*','');
				if ($this->form_validation->run('add_presupuesto') == FALSE)
				{
					$data = array(
						'idCliente'         => form_error('idCliente'),
						'ci_ruc'            => form_error('ci_ruc'),
						'Fecha_Pre_Arqui'   => form_error('Fecha_Pre_Arqui'),
						'Fecha_Devolucion'  => form_error('Fecha_Devolucion'),
						'Nombres_servicios' => form_error('Nombres_servicios'),
						'res'               => 'error');
			} else {
					$data = array(
						'fecha_expedicion'			 => $this->security->xss_clean( $this->input->post('fecha_expedicion')),
						'Fecha_Pre_Arqui'            => $this->security->xss_clean( $this->input->post('Fecha_Pre_Arqui')),
						'Monto_Alquiler_Presupuesto' => $this->cart->total(),
						'Arquiler_Presupuesto'       => $id,
						'Contado_Credito'            => 0,
						'Num_arquiler'               => 001,
						'Fecha_Devolucion'           => $this->security->xss_clean( $this->input->post('Fecha_Devolucion')),
						'Monto_total_iva'            => $this->security->xss_clean( $this->input->post('lesiva')),
						'Nombre_servicio'            => $this->security->xss_clean( $this->input->post('Nombres_servicios')),
						'Usuario_idUsuario'          => $this->session->userdata('idUsuario'),
						'Cliente_idCliente'          => $this->security->xss_clean( $this->input->post('idCliente')),
						);
					$this->Presupuesto_arquiler_model->add_presupuesto($data);
						$i = 1;
						foreach ($this->cart->contents() as $items) {
									foreach ($this->cart->product_options($items['rowid']) as $option_name => $option_value) {
										$iva =	$option_value;
									}
							$data = array(
								'Cantidad'                              => $items['qty'],
								'Descripcion'                           => '',
								'Precio'                                => $items['price'],
								'Iva'                                   => $iva,
								'Presupuesto_Arquiler_idArquiler'       => $this->ultimo_cabecera(),
								'Producto_Servicio_idProducto_Servicio' => $items['id'],
							);
					$this->Presupuesto_arquiler_model->add_presupuesto_detalle($data);
						$i++;
						}
				}
				$this->cart->destroy();
				echo json_encode($data);	
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
			$row[]   = number_format($lista->Monto_Alquiler_Presupuesto,0,',','.');
			$row[]   = $lista->fecha_expedicion;
			$row[]   = '<div>
			<a class="btn btn-success btn-xs" href="javascript:void(0);" title="Edit" onclick="ver_detalles('."'".$lista->idArquiler."'".')">
			<label class="label label-success "></label>Ver Detalles</a></div>' ;
			//add html for action
			$row[]   = '<div class="pull-right hidden-phone">
			<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_servicios('."'".$lista->idArquiler."'".')">
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
	{
		$data = $this->Presupuesto_arquiler_model->getarticulo_by_id($idArquiler);
		echo json_encode($data);
	}
	public function delete_presupuesto($idArquiler)
	{
		$this->Presupuesto_arquiler_model->delete_presupuesto($idArquiler);
		echo json_encode(array("status" => TRUE));
	}



}

/* End of file productos.php */
/* Location: ./application/controllers/Productos/productos.php */