<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Productos_Model extends CI_Model {
	var $table = 'producto_servicio';
	var $categoria = 'categoria';
	var $where = 'producto_servicio.Categoria_idCategoria = categoria.idCategoria';
	var $column = array('Codigo','Nombre','Precio_Unitario','Cantidad','Categoria');
	var $order = array('idProducto_Servicio' => 'desc');

	public function __construct()
	{
		parent::__construct();
		//Haga su magia aquí
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->from($this->categoria);
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

	function get_cliente()
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
		$this->db->from($this->categoria);
		$this->db->where($this->where);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->from($this->categoria);
		$this->db->where($this->where);
		$this->db->where('idProducto_Servicio',$id);
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

	public function delete_by_id($idProducto_Servicio)
	{
		$this->db->where('idProducto_Servicio', $idProducto_Servicio);
		$this->db->delete($this->table);
	}
	    function busqueda_Categoria($datos)
    {
		$data = $this->db->query("select idCategoria, Categoria from categoria where Categoria like '%$datos%' ");
		//formateo los datos en una matriz
		foreach ($data->result() as $row)
		{
			# code...
			$arr['query'] = $datos;
			$arr['suggestions'][] = array(
				'value' =>$row->Categoria,
				'data' =>$row->idCategoria
		);
	}
			//minimo php 5.2
		echo json_encode($arr);
    }

}

/* End of file marca_Model.php */
/* Location: ./application/models/marca_Model.php */