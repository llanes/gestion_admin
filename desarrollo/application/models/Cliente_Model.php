<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Cliente_model extends CI_Model {
	var $table = 'cliente';
	var $user = 'usuario';
	var $where = 'usuario.Cliente_idCliente = cliente.idCliente and usuario.Permiso_idPermiso = 2';	
	var $column = array('Nombres','Apellidos','Direccion','Telefono','Email');
	var $order = array('idCliente' => 'desc');

	public function __construct()
	{
		parent::__construct();
		//Haga su magia aquí
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->from($this->user);
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
		$this->db->from($this->user);
		$this->db->where($this->where);
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->from($this->user);
		$this->db->where($this->where);
		$this->db->where('idCliente',$id);
		$query = $this->db->get();

		return $query->row();
	}

	public function save($data)
	{
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}
	public function save2($data)
	{
		$this->db->insert($this->user, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function update2($idCliente, $data)
	{	
		$this->db->where('Empleado_idEmpleado', $idCliente);
		$this->db->where('Permiso_idPermiso = 2');
		$this->db->update($this->user, $data);
		return $this->db->affected_rows();
	}

	public function delete_by_id($idCliente)
	{
		$this->db->where('idCliente', $idCliente);
		$this->db->delete($this->table);
		$this->db->where('usuario.Empleado_idEmpleado',$idCliente);
		$this->db->delete($this->user);
	}

}

/* End of file marca_Model.php */
/* Location: ./application/models/marca_Model.php */