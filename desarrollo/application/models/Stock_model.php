<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Stock_model extends CI_Model {
	var $table = 'stock';
	var $producto_servicio = 'producto_servicio';
	var $where = 'stock.Producto_Servicio_idProducto_Servicio = producto_servicio.idProducto_Servicio';
	var $column = array('Nombre','Precio_Unitario','Cantidad_stock');
	var $order = array('idStock' => 'desc');

	public function __construct()
	{
		parent::__construct();
		//Haga su magia aquí
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->from($this->producto_servicio);
		$i = 0;

		foreach ($this->column as $item)
		{
			$this->db->where($this->where);
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

	function get_stock()
	{
		$this->_get_datatables_query();
		if($_POST['length'] != -1)
		$this->db->where($this->where);
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
		$this->db->from($this->producto_servicio);
		$this->db->where($this->where);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->from($this->producto_servicio);
		$this->db->where($this->where);
		$this->db->where('idStock',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_by_id($idStock)
	{
		$this->db->where('idStock', $idStock);
		$this->db->delete($this->table);
	}
	    function busqueda_producto_servicio($datos)
    {
		$data = $this->db->query("select idProducto_Servicio,Nombre,Cantidad from producto_servicio where Nombre like '%$datos%' ");
		//formateo los datos en una matriz
		foreach ($data->result() as $row)
		{
			# code...
			$arr['query'] = $datos;
			$arr['suggestions'][] = array(
				'value' =>$row->Nombre,
				'data' =>$row->idProducto_Servicio,
				'Cantidad' =>$row->Cantidad
		);
	}
			//minimo php 5.2
		echo json_encode($arr);
    }
	//cheque si existe el usuario para registro
	public	function check_servicio($idProducto_Servicio)
	{
		# code...
		$this->db->select('Producto_Servicio_idProducto_Servicio');
		$this->db->where('Producto_Servicio_idProducto_Servicio',$idProducto_Servicio);
		$consulta = $this->db->get('stock');
		if ($consulta->num_rows()> 0) {
			# code...
			return true;
		}

	}
		public	function check_cantidad($Cantidad_stock)
	{
		# code...
		$this->db->select('Cantidad');
		$this->db->where('Cantidad >=',$Cantidad_stock);
		$consulta = $this->db->get('producto_servicio');
		if ($consulta->num_rows()> 0) {
			# code...
			return TRUE;
		}

	}

}

/* End of file marca_Model.php */
/* Location: ./application/models/marca_Model.php */