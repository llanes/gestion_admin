<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Presupuesto_arquiler_model extends CI_Model {
	var $table = 'presupuesto_arquiler pa';
	var $pa = 'presupuesto_arquiler';
	var $da = 'detalle_arquiler';
	var $select = 'pa.Monto_Alquiler_Presupuesto,pa.Arquiler_Presupuesto ,pa.idArquiler ,pa.fecha_expedicion ,pa.Nombre_servicio ,pa.Entrega ,pa.Devolucion ,c.idCliente ,c.Nombres,c.Apellidos  ';
	var $where = 'Arquiler_Presupuesto = 2';
	var $where2 = '(Arquiler_Presupuesto = 1) OR (Arquiler_Presupuesto = 0)';
	var $column = array('Entrega','Devolucion','Monto_Alquiler_Presupuesto','idArquiler','fecha_expedicion','Nombre_servicio','idCliente','Nombres');
	var $order = array('Entrega  ,Devolucion' => 'desc');

	public function __construct()
	{
		parent::__construct();
		//Haga su magia aquí
		$this->load->database();
	}
	private function _get_datatables_query($id)
	{
		if ($id == '') {
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
		} else {
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->where('Cliente_idCliente', $id, FALSE);
		$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');

		}
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

	function get_presupuesto($id)
	{
		$this->_get_datatables_query($id);
		if($_POST['length'] != -1)
		$this->db->where($this->where);
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
	function count_filtro($id)
	{
		$this->_get_datatables_query($id);
		$this->db->where($this->where);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_todas($id)
	{
		if ($id == '') {
			$this->db->select($this->select);
			$this->db->from($this->table);
			$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
			$this->db->where($this->where);
			return $this->db->count_all_results();
		} else {
			$this->db->select($this->select);
			$this->db->from($this->table);
			$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
			$this->db->where('Cliente_idCliente', $id, FALSE);
			$this->db->where($this->where);
			return $this->db->count_all_results();
		}

	}
	///////////////////////////////////////////////////////
		private function _get_datatables_query2($id)
	{
		if ($id == '') {
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
		} else {
		$this->db->select($this->select);
		$this->db->where('Cliente_idCliente', $id, FALSE);
		$this->db->from($this->table);
		$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
		}

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
	function get_alquiler($id)
	{
		$this->_get_datatables_query2($id);
		if($_POST['length'] != -1)
		$this->db->where($this->where2);
		$this->db->order_by('fecha_expedicion', 'desc');
		$this->db->order_by('Entrega,Devolucion', 'desc');
		$this->db->limit($_POST['length'], $_POST['start']);
		$query = $this->db->get();
		return $query->result();
	}
		function count_filter($id)
	{
		$this->_get_datatables_query2($id);
		$this->db->where($this->where2);
		$query = $this->db->get();
		return $query->num_rows();
	}

	public function count_alquiler($id)
	{
	if ($id == '')
	{
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
		$this->db->where($this->where2);
		$this->db->order_by('fecha_expedicion', 'desc');
		$this->db->order_by('Entrega,Devolucion', 'desc');
		return $this->db->count_all_results();
	}else {
		$this->db->select($this->select);
		$this->db->from($this->table);
		$this->db->join('cliente c', 'pa.Cliente_idCliente = c.idCliente', 'INNER');
		$this->db->where('Cliente_idCliente', $id, FALSE);
		$this->db->where($this->where2);
		$this->db->order_by('fecha_expedicion', 'desc');
		$this->db->order_by('Entrega,Devolucion', 'desc');
		return $this->db->count_all_results();
	}

	}
	public function update_entrega($idArquiler,$entrega)
	{
		if ($entrega == 0) {
			$this->db->set('Entrega', 1);
			$this->db->where('idArquiler', $idArquiler);
			$this->db->update($this->table);
			return $this->db->affected_rows();
		} else if ($entrega == 1) {
			$this->db->set('Entrega', 0);
			$this->db->set('Devolucion', 0);
			$this->db->where('idArquiler', $idArquiler);
			$this->db->update($this->table);
			return $this->db->affected_rows();
		}

	}
	public function update_devolucion($idArquiler,$devolucion)
	{
		if ($devolucion == 0) {
			$this->db->set('Devolucion', 1);
			$this->db->where('idArquiler', $idArquiler);
			$this->db->update($this->table);
			return $this->db->affected_rows();
		} else if ($devolucion == 1) {
			$this->db->set('Devolucion', 0);
			$this->db->where('idArquiler', $idArquiler);
			$this->db->update($this->table);
			return $this->db->affected_rows();
		}

	}

	/////////////fin alquier/////////////////
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

	public function set_presupuesto($data='',$idArquiler='')
	{

		$this->db->set($data, FALSE);
		$this->db->where('idArquiler', $idArquiler);
		$this->db->update($this->table);
		$this->db->where('Presupuesto_Arquiler_idArquiler', $idArquiler);
		$this->db->delete($this->da);

	}

	public function delete_credito($idArquiler)
	{
		$this->db->where('Presupuesto_Arquiler_idArquiler', $idArquiler);
		$this->db->delete('credito');
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
	public function serie()
	{
		$this->db->select('Series', FALSE);
		$query = $this->db->get('empresa');
		foreach($query->result_array() as $d)
		{
			return( $d['Series']);
		}
	}

	public function add_serie($serie)
	{
		$this->db->set('Series', $serie);
		$this->db->update('empresa');
	}
	public function add_credito($_data)
	{
		$this->db->insert('credito',$_data);
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
				'data' =>$row->idCliente,
				'Direccion' =>$row->Direccion
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
				'data' =>$row->idCliente,
				'Direccion' =>$row->Direccion
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
				'data' =>$row->idStock
		);
	}
			//minimo php 5.2
		echo json_encode($arr);
    }
        // buscaer servicios
	function busqueda_servicio($datos)
    {
		$query = $this->db->query("select * from servicio where Servicio like '%$datos%' ");
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
    public function recorrer_servicios($id)    {
		$this->db->select('*');
		$this->db->from('detalle_servicio, stock,producto_servicio');
		$this->db->where("producto_servicio.idProducto_Servicio = stock.Producto_Servicio_idProducto_Servicio");
		$this->db->where("producto_servicio.idProducto_Servicio = detalle_servicio.Producto_Servicio_idProducto_Servicio");
		$this->db->where('detalle_servicio.Servicio_idServicio', $id);
		$query = $this->db->get();
		foreach ($query->result() as $row)
		{
					$opciones =  array('Importe' => 10);

				$data = array(
							'id'      =>$row->idStock,
							'qty'     =>$row->Cantidad_detalle,
							'price'   =>$row->Costo,
							'name'    =>$row->Nombre,
							'options' => $opciones
						);
						$this->cart->insert($data); 
		echo json_encode($data);
	}
    }
		public function edit_presupuesto($idArquiler)
	{   
		$this->db->select('ps.Nombre,ps.Precio_Unitario,da.Cantidad, da.Iva,st.idStock, st.Producto_Servicio_idProducto_Servicio as stock_idproduct,da.Producto_Servicio_idProducto_Servicio as detalle_idstock, Presupuesto_Arquiler_idArquiler');
		$this->db->from('producto_servicio ps,stock st');
		$this->db->join('detalle_arquiler da', 'st.idStock = da.Producto_Servicio_idProducto_Servicio', 'INNER');
		$this->db->where('st.Producto_Servicio_idProducto_Servicio = ps.idProducto_Servicio');
		$this->db->where('Presupuesto_Arquiler_idArquiler',$idArquiler);
		$query1 = $this->db->get();
		foreach ($query1->result_array() as $items)
		{
					$opciones =  array('Importe' => $items['Iva']);
				$data = array(
							'id'      => $items['idStock'],
							'qty'     => $items['Cantidad'],
							'price'   => $items['Precio_Unitario'],
							'name'    => $items['Nombre'],
							'options' => $opciones
						);
						$this->cart->insert($data); 
		}
		$this->db->select('*');
		$this->db->from('cliente cl,empresa');
		$this->db->join('presupuesto_arquiler pr', 'cl.idCliente = pr.Cliente_idCliente ', 'INNER');
		$this->db->where('idArquiler',$idArquiler);
		$query = $this->db->get();
		return $query->result();

	}

	public function get_empre_client()
	{
		$id = $this->session->userdata('Cliente_idCliente');
		$this->db->select('cliente.idCliente,cliente.Nombres,cliente.Apellidos,cliente.Direccion,cliente.Telefono as cl_telefono,cliente.Email as cl_correo,
							empresa.idEmpresa,empresa.Nombre,empresa.Direccion as em_direcc,empresa.Descripcion,empresa.Telefono,empresa.Email,' );
		$this->db->from('cliente,empresa');
		$this->db->where('cliente.idCliente', $id);
		 $query = $this->db->get();
		return $query->result_array();
	}

	     function getCategoria($limit, $start)
     {
         	$this->db->select('*');
          $this->db->limit($limit, $start);
          $query = $this->db->get('categoria');
          return $query->result_array();
     }

     public function add_Geo_posicion($where='',$_data='')
     {
		if ($where == '') {
			$this->db->insert('geo_posicion',$_data);
			return $this->db->insert_id();
		} else {
			
		}
     }


}

/* End of file marca_Model.php */
/* Location: ./application/models/marca_Model.php */
