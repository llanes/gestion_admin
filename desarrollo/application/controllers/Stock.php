<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Stock extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Stock_model");
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('index.php/Home','refresh');
		}
	}

	public function index()
	{
		// $this->output->enable_profiler(true);
		$data = array //arreglo para mandar datos a la vista
			(
					'titulo1'=> 'Mantenimiento | Stock',//mi titulo 
					'titulo2'=> 'Administrar Stock',//mi titulo 
					'titulo3'=> 'Home',//mi titulo 
					'titulo4'=> 'Stock',//mi titulo 
					'titulo5'=> 'Stock',//mi titulo 
					"usuario" => $this->session->userdata('usuario'),
					// 'formulario' =>  $this->db->get('cliente')->result_array(),
			);
			//redirecionamos a la vista o llamamos a la vista index
			
			$this->parser->parse('Stock/stock_vista.php',$data, FALSE);	// carga todos las url de estilo i js home	
			$this->load->view('Stock/script_stock.php', $data, FALSE);
	}
		public function ajax_list()
	{
		$list = $this->Stock_model->get_stock();
		$data = array();
		$no = $_POST['start'];
		foreach ($list as $stock) {
			$no++;
			$row = array();
			$row[] = $stock->Nombre;
			$row[] = $stock->Precio_Unitario;
			if ($stock->Cantidad_stock < 11) {
				$row[] ='<span class="badge bg-red">'.$stock->Cantidad_stock.'</span>';
			} else if($stock->Cantidad_stock > 50) {
				$row[] ='<span class="badge bg-green">'.$stock->Cantidad_stock.'</span>';
			} else if ($stock->Cantidad_stock < 50) {
				$row[] ='<span class="badge bg-blue">'.$stock->Cantidad_stock.'</span>';
			} else {

			}
			//add html for action
			$row[] = '<div class="pull-right hidden-phone">
			<a class="btn btn-primary btn-xs" href="javascript:void(0);" title="Edit" onclick="edit_stock('."'".$stock->idStock."'".')">
			<i class="fa fa-pencil-square"></i></a>
			<a class="btn btn-danger btn-xs" href="javascript:void(0);" title="Hapus" onclick="delete_stock('."'".$stock->idStock."'".')">
			<i class="fa fa-trash-o"></i></a>			</div>';

			$data[] = $row;
		}
		$output = array(
						"draw" => $_POST['draw'],
						"recordsTotal" => $this->Stock_model->count_todas(),
						"recordsFiltered" => $this->Stock_model->count_filtro(),
						"data" => $data,
				);
		//output to json format
		echo json_encode($output);
	}
	public function ajax_edit($idStock)
	{
		$data = $this->Stock_model->get_by_id($idStock);
		echo json_encode($data);
	}

	public function ajax_add()
	{
		if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('<i class="fa fa-exclamation-triangle"></i>   ','');
				if ($this->form_validation->run('add_stock') == FALSE)
				{
					$data                 = array(
					'Cantidad_stock'            => form_error('Cantidad_stock'),
					'idProducto_Servicio' => form_error('idProducto_Servicio'),
					'res'                 => 'error');
					echo json_encode($data);
				}else{
					$data                                   = array(
					'Cantidad_stock'                              => $this->security->xss_clean( $this->input->post('Cantidad_stock',FALSE)),
					'Producto_Servicio_idProducto_Servicio' => $this->security->xss_clean( $this->input->post('idProducto_Servicio',FALSE)),
					);
					$insert = $this->Stock_model->save($data);
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
				if ($this->form_validation->run('update_stock') == FALSE)
				{
					$data                 = array(
					'Cantidad_stock'            => form_error('Cantidad_stock'),
					'idProducto_Servicio' => form_error('idProducto_Servicio'),
					'res'                 => 'error');
					echo json_encode($data);
				}else{
					$data                                   = array(
					'Cantidad_stock'                        => $this->security->xss_clean( $this->input->post('Cantidad_stock',FALSE)),
					'Producto_Servicio_idProducto_Servicio' => $this->security->xss_clean( $this->input->post('idProducto_Servicio',FALSE)),
					);
					$this->Stock_model->update(array('idStock' => $this->input->post('idStock')), $data);
					echo json_encode(array("status" => TRUE));
				}
        }else{
			show_404();
		}
	}
	public function ajax_delete($idStock)
	{
		$this->Stock_model->delete_by_id($idStock);
		echo json_encode(array("status" => TRUE));
	}
		// comprovar si existe nobre de usuario para registro cliente
	function check_servicio($idProducto_Servicio)
	{

	if ($this->Stock_model->check_servicio($idProducto_Servicio)) {
			$this->form_validation->set_message('check_servicio', "Producto Ya esta en stock");
			return FALSE;
        }
        else
        {
            return TRUE;
        }
	}
	function check_cantidad($Cantidad_stock)
	{
		if ($this->Stock_model->check_cantidad($Cantidad_stock)) {

			return TRUE;
        }
        else
        {
			$this->form_validation->set_message('check_cantidad', "El stock es mayor a lo disponible");
            return FALSE;
        }
	}
	// busqueda autocompletar
	public function busqueda_producto_servicio()
	{
		// resivimos los datos del input a traves de la uri, por segment
		$datos= $this->uri->segment(4);
		$this->Stock_model->busqueda_producto_servicio($datos);

	}

}

/* End of file Stock.php */
/* Location: ./application/controllers/Productos/productos.php */
