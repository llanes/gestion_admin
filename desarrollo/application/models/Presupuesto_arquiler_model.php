<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto_arquiler_model extends CI_Model {
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
	// buscar cliente
	function busqueda_cliente($datos)
    {
		$this->db->select('*');
		$this->db->from('cliente');
		$this->db->where("Nombres like '%$datos%'");
		$query = $this->db->get();
		//formateo los datos en una matriz
		foreach ($query->result() as $row)
		{
			# code...
			$arr['query'] = $datos;
			$arr['suggestions'][] = array(
				'value' =>$row->Nombres,
				'ci_ruc' =>$row->ci_ruc,
				'data' =>$row->idCliente
		);
	}
			//minimo php 5.2
		echo json_encode($arr);
    }
    	// buscar cliente
	function busqueda_cliente2($datos)
    {
		$this->db->select('*');
		$this->db->from('cliente');
		$this->db->where("ci_ruc like '%$datos%'");
		$query = $this->db->get();
		//formateo los datos en una matriz
		foreach ($query->result() as $row)
		{
			# code...
			$arr['query'] = $datos;
			$arr['suggestions'][] = array(
				'value' =>$row->ci_ruc,
				'Nombres' =>$row->Nombres,
				'data' =>$row->idCliente
		);
	}
			//minimo php 5.2
		echo json_encode($arr);
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
			//minimo php 5.2
		echo json_encode($arr);
    }
    public function actualizar_stock($idProducto_Servicio,$cantidad)
    {
    $this->db->select("Cantidad_stock -'$cantidad' as total");
    $this->db->where('Producto_Servicio_idProducto_Servicio', $idProducto_Servicio);
	$query = $this->db->get('stock');
		foreach ($query->result() as $row) {
			$data = array('Cantidad_stock' => $row->total, 'Producto_Servicio_idProducto_Servicio' => $idProducto_Servicio);
			$this->db->where('Producto_Servicio_idProducto_Servicio', $idProducto_Servicio);
			$this->db->update('stock', $data);
			return $this->db->affected_rows();
		};
    }
    public function update_stock($idProducto_Servicio,$cantidad)
    {
    $this->db->select("Cantidad_stock +'$cantidad' as total");
    $this->db->where('Producto_Servicio_idProducto_Servicio', $idProducto_Servicio);
	$query = $this->db->get('stock');
		foreach ($query->result() as $row) {
			$data = array('Cantidad_stock' => $row->total, 'Producto_Servicio_idProducto_Servicio' => $idProducto_Servicio);
			$this->db->where('Producto_Servicio_idProducto_Servicio', $idProducto_Servicio);
			$this->db->update('stock', $data);
			return $this->db->affected_rows();
			echo json_encode($data);
		};
    }
    public function octener_serie()
    {
		$this->db->select_max('idArquiler');
		$query = $this->db->get('presupuesto_arquiler');
		foreach ($query->result() as $row) {
			$idArquiler = $row->idArquiler;
			$num = 1;
			$series = 0;
			$total = 001;
			if ($idArquiler === '') {
				 echo $series = $total;
			}else {
                echo $series = $idArquiler + $total;
              
			}
		};
		
    }

}

/* End of file marca_Model.php */
/* Location: ./application/models/marca_Model.php */