<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Servicios_model");
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('index.php/Home','refresh');
			}
	}

	public function index()
	{
		// $this->output->enable_profiler(true);
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Servicios',//mi titulo 
					'titulo2'=> 'Administrar Servicios',//mi titulo 
					'titulo3'=> 'Inicio',//mi titulo 
					'titulo4'=> 'Servicios',//mi titulo 
					'titulo5'=> 'Servicios',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
					// 'formulario' =>  $this->db->get('cliente')->result_array(),
			);
			//redirecionamos a la vista o llamamos a la vista index
			
			$this->parser->parse('Servicios/servicios_vista.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Servicios/script.php', $data, FALSE);
	}
		public function ajax_list()
	{
		$list = $this->Servicios_model->get_servicios();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $servi) {
			$no++;
			$row     = array();
			$row[]   = '<a href="javascript:void(0);" title="Edit" onclick="ver_articulos('."'".$servi->idServicio."'".')">
			<i class ="fa fa-plus-square"></i></a>' ;
			$row[]   = $servi->Servicio;
			$row[]   = $servi->Descripcion;
			$row[]   = number_format($servi->Monto_total_servicio,0,'.',',');
			//add html for action
			$row[]   = '<div class="pull-right hidden-phone">
			<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_servicios('."'".$servi->idServicio."'".')">
			<i class="fa fa-pencil"></i></a>
			<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_servicios('."'".$servi->idServicio."'".')">
			<i class="fa fa-trash-o "></i></a></div>';
			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Servicios_model->count_todas(),
						"recordsFiltered" => $this->Servicios_model->count_filtro(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit($idServicio)
	{
		$data = $this->Servicios_model->getarticulo_by_id($idServicio);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
			if ($this->form_validation->run('agregar_servicio') === False)
			{
				$data             = array(
				'servicio'          => form_error('servicio'),
				'Descripcion'          => form_error('Descripcion'),
				'res'             => 'error');
				echo json_encode($data);
		}else{
			$Monto_total_servicio =  str_replace($this->config->item('caracteres'),"",$this->cart->total());
			$_data = array(
				'Servicio'    => $this->security->xss_clean( $this->input->post('servicio')),
				'Monto_total_servicio' => $Monto_total_servicio,
				'Descripcion' => $this->security->xss_clean( $this->input->post('Descripcion')),

			);
			$this->Servicios_model->add_servicio($_data);
			$i = 1;
			foreach ($this->cart->contents() as $items) {
				$data = array(
					'Costo'                                 => $items['price'],
					'Cantidad_detalle'                      => $items['qty'],
					'Producto_Servicio_idProducto_Servicio' => $items['id'],
					'Servicio_idServicio'                   => $this->ultimo_servicio(),
				);
				$this->Servicios_model->add_detalle($data);
			$i++;
			}
			//REEDIRECCIONAR
			$this->cart->destroy();
			echo json_encode($data);

			}
        }else{
			show_404();
		}
	}
		public function ultimo_servicio()
	{
		$query = $this->db->query('SELECT MAX(idServicio) as idServicio from servicio');
			foreach($query->result_array() as $d)
			{
				return( $d['idServicio']);
			}
	}
	public function ajax_edit2($idServicio)
	{   $this->cart->destroy();
		$data = $this->Servicios_model->edit_servicio($idServicio);
		$_data = $this->Servicios_model->edit_detalle($idServicio);
		echo json_encode($data);
	}

	public function ajax_update()
{
		if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
			if ($this->form_validation->run('actualizar_servicio') === False)
			{
				$data             = array(
				'servicio'          => form_error('servicio'),
				'Descripcion'          => form_error('Descripcion'),
				'res'             => 'error');
				echo json_encode($data);
		}else{
			$idServicio = $this->security->xss_clean( $this->input->post('idServicio'));
			$Monto_total_servicio =  str_replace($this->config->item('caracteres'),"",$this->cart->total());
			$_data = array(
				'Servicio'    => $this->security->xss_clean( $this->input->post('servicio')),
				'Monto_total_servicio' => $Monto_total_servicio,
				'Descripcion' => $this->security->xss_clean( $this->input->post('Descripcion')),

			);
			$this->Servicios_model->actualizar_servicio($_data,$idServicio);
			$i = 1;
			foreach ($this->cart->contents() as $items) {
				$data = array(
					'Costo'                                 => $items['price'],
					'Cantidad_detalle'                              => $items['qty'],
					'Producto_Servicio_idProducto_Servicio' => $items['id'],
					'Servicio_idServicio'                   => $idServicio,
				);
				$this->Servicios_model->add_detalle($data);
			$i++;
			}
			//REEDIRECCIONAR
			$this->cart->destroy();
			echo json_encode($data);

			}
        }else{
			show_404();
		}
	}
	public function ajax_delete($idServicio)
	{
		$this->Servicios_model->delete_by_id($idServicio);
		echo json_encode(array("status" => TRUE));
	}
		// comprovar si existe nobre de usuario para registro cliente
	function check_User($user_id)
	{

	if ($this->Logeo_model->check_User($user_id)) {
			$this->form_validation->set_message('check_User', "$user_id no Disponible");
			return FALSE;
        }
        else
        {
            return TRUE;
        }
	}
	// comprovar si existe nobre de usuario para registro cliente
	function check_email($Email)
	{

	if ($this->Logeo_model->check_email($Email)) {
			$this->form_validation->set_message('check_email', "$Email ya esta registrado ");
			return FALSE;
        }
        else
        {
            return TRUE;
        }
	}
				// busqueda autocompletar
	public function busqueda_Categoria()
	{
		// resivimos los datos del input a traves de la uri, por segment
		$datos= $this->uri->segment(4);
		$this->Servicios_model->busqueda_Categoria($datos);

	}
		public function agregar_carrito()
	{
		$this->form_validation->set_error_delimiters('','');
		if ($this->form_validation->run('agregar_carrito_serv') === False)
			{
				$data             = array(
				'id_articulo'          => form_error('id_articulo'),
				'cantidad'          => form_error('cantidad'),
				'res'             => 'error');
				echo json_encode($data);
		}else{
				$data = array(
							'id'      => $this->security->xss_clean( $this->input->post('id_articulo')),
							'qty'     => $this->security->xss_clean( $this->input->post('cantidad')),
							'price'   => $this->security->xss_clean( $this->input->post('precio_articulo')),
							'name'    => $this->security->xss_clean( $this->input->post('nombre_articulo'))
						);
						$this->cart->insert($data); 
			echo json_encode($data);

		}
	}
	public function loader()
	{
	$this->load->view('Servicios/cart.php');	// carga todos las url de estilo i js home
	// $this->load->view('Servicios/script.php');
	}
	public function reser($value='')
	{
			$this->cart->destroy();
	}
	public function delete_item($rowid)
	{
		if ($this->input->is_ajax_request()) {
		$this->cart->remove($rowid);
		echo json_encode(array("status" => TRUE));
        }else{
			show_404();
		}
	}


}

/* End of file productos.php */
/* Location: ./application/controllers/Productos/productos.php */