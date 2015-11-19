
<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Servicios_model extends CI_Model {
	var $table = 'servicio';
	var $table2 = 'detalle_servicio,producto_servicio';
	var $column = array('Servicio','Monto_total_servicio','Descripcion');
	var $order = array('idServicio' => 'desc');

	public function __construct()
	{
		parent::__construct();
		//Haga su magia aquí
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$i = 0;

		foreach ($this->column as $item)
		{
			if($_POST['search']['value'])
				($i===0) ? $this->db->like($item, $_POST['search']['value']) : $this->db->or_like($item, $_POST['search']['value']);
			$column[$i] = $item;
			$i++;
		}

		if(isset($_POST['order']))
		{
			$this->db->order_by($column[$_POST['order']['0']['column']], $_POST['order']['0']['dir']);
		}
		else if(isset($this->order))
		{
			$order = $this->order;
			$this->db->order_by(key($order), $order[key($order)]);
		}
	}

	function get_servicios()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}

	function count_filtro()
	{
		$this->_get_datatables_query();
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_todas()
	{
		$this->db->from($this->table);
		return $this->db->count_all_results();
	}

	public function get_by_id($idServicio)
	{
		$this->db->from($this->table);
		$this->db->where('idServicio',$idServicio);
		$query = $this->db->get();

		return $query->row();
	}
	function add_servicio($_data)
	{
		$this->db->insert('servicio', $_data);
		return $this->db->insert_id();
	}
	function add_detalle($data)
	{
		$this->db->insert('detalle_servicio', $data);
			return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($idServicio)
	{
		$this->db->where('idServicio', $idServicio);
		$this->db->delete($this->table);
		$this->db->where('Servicio_idServicio', $idServicio);
		$this->db->delete('detalle_servicio');

	}
	// buscaer articulo
	function busqueda_producto($datos)
    {
		$this->db->select('*');
		$this->db->from('producto_servicio,stock');
		$this->db->where("stock.Producto_Servicio_idProducto_Servicio = producto_servicio.idProducto_Servicio AND Nombre like '%$datos%'");
		$query = $this->db->get();
		//formateo los datos en una matriz
		foreach ($query->result() as $row)
		{
			# code...
			$arr['query'] = $datos;
			$arr['suggestions'][] = array(
				'value' =>$row->Nombre,
				'Cantidad_stock' =>$row->Cantidad_stock,
				'Precio_Unitario' =>$row->Precio_Unitario,
				'data' =>$row->idProducto_Servicio
		);
	}

	}
	public function getarticulo_by_id($idServicio)
	{
		$this->db->select('*');
		$this->db->from($this->table2);
		$this->db->where('detalle_servicio.Producto_Servicio_idProducto_Servicio = producto_servicio.idProducto_Servicio');
		$this->db->where('detalle_servicio.Servicio_idServicio',$idServicio);
		$query = $this->db->get();
		return $query->result_array();
	}
		function edit_servicio ($idServicio)
	{
			$this->db->select('*');
			$this->db->where('idServicio',$idServicio);
			$this->db->from('servicio');
			$query = $this->db->get();//mi consulta sql
			return $query->row();

	}
		   function edit_detalle($idServicio)
    {
          $this->db->select('*');
          $this->db->from('detalle_servicio, producto_servicio');
          $this->db->where('detalle_servicio.Producto_Servicio_idProducto_Servicio = producto_servicio.idProducto_Servicio');
          $this->db->where('detalle_servicio.Servicio_idServicio',$idServicio);
          $query = $this->db->get();
		//formateo los datos en una matriz
		foreach ($query->result_array() as $items)
		{
				$data = array(
							'id'      =>$items['Producto_Servicio_idProducto_Servicio'],
							'qty'     => $items['Cantidad'],
							'price'   => $items['Costo'],
							'name'    => $items['Nombre']
						);
						$this->cart->insert($data); 
		// echo json_encode($data);
	}
	}
	function actualizar_servicio($_data,$idServicio)
    {
		$this->db->where('idServicio',$idServicio);
		$this->db->update('servicio',$_data);
		$this->db->where('detalle_servicio.Servicio_idServicio',$idServicio);
		$this->db->delete('detalle_servicio');

    }
    

}

/* End of file marca_Model.php */
/* Location: ./application/models/marca_Model.php */