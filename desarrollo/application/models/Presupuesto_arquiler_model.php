<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto_arquiler_model extends CI_Model {
	var $table = 'presupuesto_arquiler pa';
	var $pa = 'presupuesto_arquiler';
	var $da = 'detalle_arquiler';
	var $select = 'pa.Monto_Alquiler_Presupuesto,pa.Arquiler_Presupuesto ,pa.idArquiler ,pa.fecha_expedicion ,pa.Nombre_servicio ,c.idCliente ,c.Nombres,c.Apellidos ,u.Usuario ,u.idUsuario ';
	var $where = 'Arquiler_Presupuesto = 2';
	var $column = array('Monto_Alquiler_Presupuesto','idArquiler','fecha_expedicion','Nombre_servicio','idCliente','Nombres','Usuario','idUsuario');
	var $order = array('pa.idArquiler idArquiler' => 'desc');

	public function __construct()
	{
		parent::__construct();
		//Haga su magia aquí
		$this->load->database();
	}
	private function _get_datatables_query()
	{
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
		$this->db->join('usuario u', 'pa.Usuario_idUsuario = u.idUsuario', 'INNER');
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

	function get_presupuesto()
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
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
		$this->db->join('usuario u', 'pa.Usuario_idUsuario = u.idUsuario', 'INNER');
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
	/**
	* [add_presupuesto insercion de cabecera alquiler presupuesto]
	* @param [array] $data [contenido de insercion]
	*/
	public function add_presupuesto($data)
	{
		$this->db->insert($this->pa,$data);
		return $this->db->insert_id();
	}
	/**
	* [add_presupuesto_detalle insercion de detalle de alquiler presupuesto]
	* @param [array] $data [contenido de insercion]
	*/
	public function add_presupuesto_detalle($data)
	{
		$this->db->insert($this->da,$data);
		return $this->db->insert_id();
	}

	public function update($where, $data)
	{
		$this->db->update($this->table, $data, $where);
		return $this->db->affected_rows();
	}

	public function delete_presupuesto($idArquiler)
	{
		$this->db->where('idArquiler', $idArquiler);
		$this->db->delete($this->pa);
		$this->db->where('Presupuesto_Arquiler_idArquiler', $idArquiler);
		$this->db->delete($this->da);

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
				'Descuento' =>$row->Descuento,
				'Precio_Unitario' =>$row->Precio_Unitario,
				'data' =>$row->idProducto_Servicio
		);
	}
			//minimo php 5.2
		echo json_encode($arr);
    }
        // buscaer servicios
	function busqueda_servicio($datos)
    {
		$this->db->select('*');
		$this->db->from('servicio');
		$this->db->where("Servicio like '%$datos%'");
		$query = $this->db->get();
		//formateo los datos en una matriz
		foreach ($query->result() as $row)
		{
			# code...
			$arr['query'] = $datos;
			$arr['suggestions'][] = array(
				'value' =>$row->Servicio,
				'data' =>$row->idServicio
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
    public function recorrer_servicios($id)
    {
		$this->db->select('
			');
		$this->db->select('*');
		$this->db->from('detalle_servicio,producto_servicio');
		$this->db->where("producto_servicio.idProducto_Servicio = detalle_servicio.Producto_Servicio_idProducto_Servicio");
		$this->db->where('detalle_servicio.Servicio_idServicio', $id);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
				$data = array(
							'id'      =>$row->idProducto_Servicio,
							'qty'     =>$row->Cantidad_detalle,
							'price'   =>$row->Costo,
							'name'    =>$row->Nombre,
							'options' => array('Importe' => $row->Iva)
						);
						$this->cart->insert($data); 
		echo json_encode($data);
	}
    }
	public function getarticulo_by_id($idArquiler)
	{
		$this->db->select('da.Presupuesto_Arquiler_idArquiler,da.Cantidad,da.Precio,da.Iva,ps.Nombre');
		$this->db->from('detalle_arquiler da');
		$this->db->join('producto_servicio ps', 'da.Producto_Servicio_idProducto_Servicio = ps.idProducto_Servicio', 'INNER');
		$this->db->where('Presupuesto_Arquiler_idArquiler',$idArquiler);
		$query = $this->db->get();
		return $query->result_array();
	}

}

/* End of file marca_Model.php */
/* Location: ./application/models/marca_Model.php */