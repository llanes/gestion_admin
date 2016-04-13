<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Empleado_model extends CI_Model {
	var $table = 'empleado';
	var $where = 'usuario.Permiso_idPermiso = 1';

	var $column = array('Nombres','Apellidos','Direccion','Telefono','Sueldo','Cargo');
	var $order = array('idEmpleado' => 'desc');

	public function __construct()
	{
		parent::__construct();
		//Haga su magia aquí
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->from($this->table);
		$this->db->join('usuario', 'empleado.idEmpleado = usuario.Empleado_idEmpleado', 'INNER');
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

	function get_empleado()
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
		$this->db->join('usuario', 'empleado.idEmpleado = usuario.Empleado_idEmpleado', 'INNER');
		$this->db->where($this->where);	
		return $this->db->count_all_results();
	}

	public function get_by_id($id)
	{
		$this->db->from($this->table);
		$this->db->where($this->where);
		$this->db->where('idEmpleado',$id);
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
		$this->db->insert($this->table, $data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}
	public function update2($idEmpleado, $data)
	{
		$this->db->where('Empleado_idEmpleado', $idEmpleado);
		$this->db->where('Permiso_idPermiso = 1');
		$this->db->update('usuario', $data);
		return $this->db->affected_rows();
	}

	public function delete_by_id($idEmpleado)
	{
		$this->db->where('idEmpleado', $idEmpleado);
		$this->db->delete('empleado');
		$this->db->where('usuario.Empleado_idEmpleado',$idEmpleado);
		$this->db->where('Permiso_idPermiso = 1');
		$this->db->delete('usuario');
	}

}

/* End of file marca_Model.php */
/* Location: ./application/models/marca_Model.php */