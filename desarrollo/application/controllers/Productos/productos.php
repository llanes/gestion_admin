<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Productos extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Productos_Model");
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('/Home');
		}
	}

	public function index()
	{
		// $this->output->enable_profiler(true);
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Productos',//mi titulo 
					'titulo2'=> 'Administrar Productos',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Productos',//mi titulo 
					'titulo5'=> 'Productos',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
					// 'formulario' =>  $this->db->get('cliente')->result_array(),
			);
			//redirecionamos a la vista o llamamos a la vista index
			
			$this->parser->parse('Productos/productos_vista.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Productos/script.php', $data, FALSE);
	}
		public function ajax_list()
	{
		$list = $this->Productos_Model->get_cliente();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $producto_servicio) {
			$no++;
			$row = array();
			$row[] = '<a href="javascript:void()" title="Edit" onclick="ver_mas('."'".$producto_servicio->idProducto_Servicio."'".')">
			<i class="fa fa-plus-square"></i></a>' ;
			$row[] = $producto_servicio->Codigo;
			$row[] = $producto_servicio->Nombre;
			$row[] = $producto_servicio->Precio_Unitario;
			$row[] = $producto_servicio->Cantidad;
			$row[] = $producto_servicio->Categoria;

			// $row[] = $producto_servicio->Password;

			//add html for action
			$row[] = '<div class="btn-group">
			<a class="btn btn-success btn-sm" href="javascript:void()" title="Edit" onclick="edit_producto('."'".$producto_servicio->idProducto_Servicio."'".')">
			<i class="fa fa-pencil-square"></i></a>
			<a class="btn btn-sm btn-danger" href="javascript:void()" title="Hapus" onclick="delete_producto('."'".$producto_servicio->idProducto_Servicio."'".')">
			<i class="fa fa-trash-o"></i></a>
			</div>';

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Productos_Model->count_todas(),
						"recordsFiltered" => $this->Productos_Model->count_filtro(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit($idProducto_Servicio)
	{
		$data = $this->Productos_Model->get_by_id($idProducto_Servicio);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
				if ($this->form_validation->run('add_productos') == FALSE)
				{
						$data = array(
								'Codigo'          => form_error('Codigo'),
								'Nombre'          => form_error('Nombre'),
								'Descripcion'     => form_error('Descripcion'),
								'Precio_Unitario' => form_error('Precio_Unitario'),
								'Cantidad'        => form_error('Cantidad'),
								'Descuento'       => form_error('Descuento'),
								'Iva'             => form_error('Iva'),
								'Img'             => form_error('Img'),
								'idCategoria'     => form_error('idCategoria'),
								'res'             => 'error');
					echo json_encode($data);		
				}else{
					$id_producto = $this->Productos_Model->count_todas();
					$code = $id_producto + 10000;
					$data                         = array(
					'Codigo'                => $this->security->xss_clean( $this->input->post('Codigo',FALSE)),
					'Nombre'                => $this->security->xss_clean( $this->input->post('Nombre',FALSE)),
					'Codigo_Barra'          => $code,
					'Descripcion'           => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
					'Precio_Unitario'           => $this->security->xss_clean( $this->input->post('Precio_Unitario',FALSE)),
					'Cantidad'              => $this->security->xss_clean( $this->input->post('Cantidad',FALSE)),
					'Descuento'              => $this->security->xss_clean( $this->input->post('Descuento',FALSE)),
					'Iva'                   => $this->security->xss_clean( $this->input->post('Iva',FALSE)),
					'Img'                   => $this->security->xss_clean( $this->input->post('Img',FALSE)),
					'Categoria_idCategoria' => $this->security->xss_clean( $this->input->post('idCategoria',FALSE))
					);
					$insert = $this->Productos_Model->save($data);
					echo json_encode(array("status" => TRUE));
				}
        }else{
			show_404();
		}
	}

	public function ajax_update()
	{
				if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
				if ($this->form_validation->run('update_productos') == FALSE)
				{
						$data = array(
								'Codigo'          => form_error('Codigo'),
								'Nombre'          => form_error('Nombre'),
								'Descripcion'     => form_error('Descripcion'),
								'Precio_Unitario' => form_error('Precio_Unitario'),
								'Cantidad'        => form_error('Cantidad'),
								'Descuento'       => form_error('Descuento'),
								'Iva'             => form_error('Iva'),
								'Img'             => form_error('Img'),
								'idCategoria'     => form_error('idCategoria'),
								'res'             => 'error');
					echo json_encode($data);		
				}else{
					$data                         = array(
					'Codigo'                => $this->security->xss_clean( $this->input->post('Codigo',FALSE)),
					'Nombre'                => $this->security->xss_clean( $this->input->post('Nombre',FALSE)),
					'Codigo_Barra'          => $this->security->xss_clean( $this->input->post('Codigo_Barra',FALSE)),
					'Descripcion'           => $this->security->xss_clean( $this->input->post('Descripcion',FALSE)),
					'Precio_Unitario'           => $this->security->xss_clean( $this->input->post('Precio_Unitario',FALSE)),
					'Cantidad'              => $this->security->xss_clean( $this->input->post('Cantidad',FALSE)),
					'Descuento'              => $this->security->xss_clean( $this->input->post('Descuento',FALSE)),
					'Iva'                   => $this->security->xss_clean( $this->input->post('Iva',FALSE)),
					'Img'                   => $this->security->xss_clean( $this->input->post('Img',FALSE)),
					'Categoria_idCategoria' => $this->security->xss_clean( $this->input->post('idCategoria',FALSE))
					);
					$this->Productos_Model->update(array('idProducto_Servicio' => $this->input->post('idProducto_Servicio')), $data);
					echo json_encode(array("status" => TRUE));
				}
        }else{
			show_404();
		}
	}
	public function ajax_delete($idProducto_Servicio)
	{
		$this->Productos_Model->delete_by_id($idProducto_Servicio);
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
		$this->Productos_Model->busqueda_Categoria($datos);

	}

}

/* End of file productos.php */
/* Location: ./application/controllers/Productos/productos.php */