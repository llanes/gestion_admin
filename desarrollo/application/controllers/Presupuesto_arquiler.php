<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto_arquiler extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model("Presupuesto_arquiler_model");
		if($this->session->userdata('Permiso_idPermiso')!='1') { // si la seccion no existe me quedo en el homo
			redirect('/');
		}
	}

	public function index()
	{
		// $this->output->enable_profiler(true);
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
			$this->load->view('Presupuesto_arquiler/script.php', $data, FALSE);
	}
	public function loader()
	{
	$this->load->view('Presupuesto_arquiler/cart_get.php');	// carga todos las url de estilo i js home	
	}
	public function agregar_carrito()
	{
				if ($this->input->is_ajax_request()) {
				$this->form_validation->set_error_delimiters('*','');
				if ($this->form_validation->run('agregar_carrito') == FALSE)
				{
						$data = array(
							'producto'   => form_error('idProducto_Servicio'),
							'Cantidad'   => form_error('Cantidad'),
							'Precio_Unitario'   => form_error('Precio_Unitario'),
							'Nombre'   => form_error('Nombre'),
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
						$opciones = array();
									if($this->input->post('opciones')) {
									$opciones = $this->input->post('opciones');
								}
						$data = array(
							'id'      => $idProducto_Servicio,
							'qty'     => $cantidad,
							'price'   => $this->security->xss_clean( $this->input->post('Precio_Unitario')),
							'name'    => $this->security->xss_clean( $this->input->post('Nombre')),
							'options' => $opciones 

						);
						$this->cart->insert($data);
						$this->Presupuesto_arquiler_model->actualizar_stock($idProducto_Servicio,$cantidad);
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
						$i = 1;
							foreach ($this->cart->contents() as $items) {
								$rowid_item = $items['rowid'];
								if ($rowid_item === $rowid) {
									$idProducto_Servicio = $items['id'];
									$cantidad = $items['qty'];
									$this->Presupuesto_arquiler_model->update_stock($idProducto_Servicio,$cantidad);
								}
						$i++;
							}
		$this->cart->remove($rowid);
        }else{
			show_404();
		}
	}
	public function add_mass()
	{
		$id= $this->uri->segment(4);
		$data = array(
							'id'      => $id,
							'qty'     => 'ee',
							'price'   => '33',
							'name'    => 'fff',
							'options' => 'dddd'
			);
		echo json_encode($data);

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


}

/* End of file productos.php */
/* Location: ./application/controllers/Productos/productos.php */