<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Caja_Model extends CI_Model {

	public $variable;

	public function __construct()
	{
		parent::__construct();
	}
	function abrir_Cerrar_Caja($data)
	{
		$this->db->select("caja.cierre as cierre");
		$this->db->where('Fecha',$unix);
		$this->db->from('caja');
		$query = $this->db->get();
		return $query->result_array();
	} 
	// inicio control de caja
		function inicio_caja($unix)
	{
		$id  = $this->ultimoCaja();
			$this->db->select("Cierre");
			$this->db->where('idCaja',$id);
			$this->db->where('Fecha_apertura',$unix);
			$this->db->from('caja');
			$query = $this->db->get();
			foreach($query->result_array() as $d)
			{
				return( $d['Cierre']);
			}
	}
	// consulta para vista caja
		// inicio control de caja
	function vista($unix)
	{	$id  = $this->ultimoCaja();
		$this->db->select("*");
		$this->db->where('id_caja',$id);
		$this->db->where('Fecha_apertura',$unix);
		$this->db->from('caja');
		$query = $this->db->get();
		return $query->result_array();
	}
	// ultimo id caja
	function ultimoCaja()
	{
		$this->db->select_max('idCaja', 'idCaja');
		$query = $this->db->get('caja');
		foreach($query->result_array() as $d)
	{
			return( $d['idCaja']);
		}
	}
	// ultima fecha
	function ultimofecha()
	{
		$this->db->select_max('id_caja', 'id_caja');
		$this->db->select('caja.Fecha_apertura as fecha');
		$query = $this->db->get('caja');
		foreach($query->result_array() as $d)
	{
			return( $d['fecha']);
		}
	}
	 function monto_final()
	{
		$id  = $this->	ultimoCaja();
		$this->db->select('Monto_final');
		$this->db->where('idCaja', $id);
		$query = $this->db->get('caja');
		foreach($query->result_array() as $d)
		{
			return( $d['Monto_final']);
		}
	}
	function inicial()
	{
		$id  = $this->	ultimoCaja();
		$this->db->select('Monto_inicial');
		$this->db->where('idCaja', $id);
		$query = $this->db->get('caja');
		foreach($query->result_array() as $d)
		{
			return( $d['Monto_inicial']);
		}

	}

	//	Insertar caja apertura
	function add_caja($data)
	{
		$this->db->insert('caja',$data);
	}

	function add_set_caja($data)
	{		$id  = $this->ultimoCaja();
			$this->db->set($data, FALSE);
			$this->db->where('idCaja', $id);
			$this->db->update('caja');
			return $this->db->affected_rows();
	}





	function get_caja($unix)
	{
		$consult="
		(SELECT fecha_expedicion as fecha, Nombre_servicio as descripcion, Monto_Alquiler_Presupuesto as debe, Null as haber from presupuesto_arquiler
		WHERE fecha_expedicion ='".$unix."' AND Arquiler_Presupuesto = 1)
		UNION ALL
		(SELECT Fecha as fecha_pago, Descripcion as descripcion, Null as debe, Monto as haber from caja_pagos
		WHERE Fecha ='".$unix."')
		UNION ALL
		(SELECT Fecha as fecha_cobro, Descripcion as descripcion, Monto as debe, Null as haber from caja_cobros
		WHERE Fecha ='".$unix."')

		";

		$query = $this->db->query($consult);
		return $query->result();
	}
	function count_filter($unix)
	{
		$consult="
		(SELECT fecha_expedicion as fecha, Nombre_servicio as descripcion, Monto_Alquiler_Presupuesto as debe, Null as haber from presupuesto_arquiler
		WHERE fecha_expedicion ='".$unix."' AND Arquiler_Presupuesto = 1 )
		UNION ALL
		(SELECT Fecha as fecha_pago, Descripcion as descripcion, Null as debe, Monto as haber from caja_pagos
		WHERE Fecha ='".$unix."')
		UNION ALL
		(SELECT Fecha as fecha_cobro, Descripcion as descripcion, Monto as debe, Null as haber from caja_cobros
		WHERE Fecha ='".$unix."')

		";

		$query = $this->db->query($consult);
		return $query->num_rows();
	}
	public function count_todas($unix)
	{
		$consult="
		(SELECT fecha_expedicion as fecha, Nombre_servicio as descripcion, Monto_Alquiler_Presupuesto as debe, Null as haber from presupuesto_arquiler
		WHERE fecha_expedicion ='".$unix."' AND Arquiler_Presupuesto = 1)
		UNION ALL
		(SELECT Fecha as fecha_pago, Descripcion as descripcion, Null as debe, Monto as haber from caja_pagos
		WHERE Fecha ='".$unix."')
		UNION ALL
		(SELECT Fecha as fecha_cobro, Descripcion as descripcion, Monto as debe, Null as haber from caja_cobros
		WHERE Fecha ='".$unix."')

		";
		$query = $this->db->query($consult);
		return $this->db->count_all_results();
	}








































	//	Insertar pago_agua apertura
		function add_pagos_servicios($data)
	{

		$this->db->insert('caja_pago_detalle',$data);

	}
	function get_haber($unix)
	{
		$this->db->select("caja_pago_detalle.descripcion,caja_pago_detalle.fecha,caja_pago_detalle.hora,caja_pago_detalle.monto as haber");
		$this->db->from('caja_pago_detalle');
		$this->db->where('caja_pago_detalle.fecha',$unix);
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_debe($unix)
	{
		$this->db->select("caja_cobro_detalle.descripcion,caja_cobro_detalle.fecha,caja_cobro_detalle.hora,caja_cobro_detalle.monto as debe");
		$this->db->from('caja_cobro_detalle');
		$this->db->where('caja_cobro_detalle.fecha',$unix);
		$query = $this->db->get();
		return $query->result_array();
	}
	function get_facturas($unix)
	{
		$this->db->select("detalle.precio as total_factura,factura.num_factura as num_factura, factura.fecha as fecha");
		$this->db->from('detalle,factura');
		$this->db->where('detalle.id_factura = factura.id_factura');
		$this->db->where('factura.fecha',$unix);
		$query = $this->db->get();
		if ($query->num_rows()> 0) {
			$this->db->select("sum(detalle.precio) as total_factura,factura.num_factura as num_factura, factura.fecha as fecha");
			$this->db->from('detalle,factura');
			$this->db->where('detalle.id_factura = factura.id_factura');
			$query1 = $this->db->get();
			return $query1->result_array();
		}else{
			return $query->result_array();

		}
	}
	public function lista_pagados($limit, $start , $unix)
	{
			$this->db->where('fecha', $unix);
			$query = $this->db->get('caja_pago_detalle', $limit, $start);
			return $query->result_array();
	}
	public function lista_pagados1($unix)
	{
			$this->db->where('fecha', $unix);
			$query = $this->db->get('caja_pago_detalle');
			return $query->num_rows();
	}
	// editar pagados de servicio
	public function edit_pagos($id)
	{
		$this->db->where('id_caja_pago', $id);
		$query = $this->db->get('caja_pago_detalle');
					//VALIDAR 
		if ($query->num_rows() > 0) {
			return $query->result();
		}else{
			return false;
		}
	}
	public function save_edit_pagos($_data,$id)
	{
		$this->db->where('id_caja_pago', $id);
		$this->db->update('caja_pago_detalle', $_data);
	}
	public function delete_pagos($id)
	{
		$this->db->where('id_caja_pago', $id);
		$this->db->delete('caja_pago_detalle');
	}
	////////////////////////////////////////////////////
	////////////////cobros de creditos/////////////////
	///////////////////////////////////////////////////
	public function listar_credito($limit, $start) {
			$this->db->limit($limit, $start);
			$Value = 0;
			$this->db->select('COUNT(num_cuota ) as num_cuota,sum(credito.importe) as monto_totales, cliente.id_cliente,sum(importe) as inporte_total,fecha_venc,fecha_pago,pago,nombre,apellido');
			$this->db->from('credito, cliente, factura');
			$this->db->where('credito.id_cliente = cliente.id_cliente');
			$this->db->where('credito.id_factura = factura.id_factura');
			$this->db->where('pago', $Value);
			$this->db->group_by('cliente.id_cliente');
			$query = $this->db->get('');
			return $query->result_array();
	}
	public function listar_credito33($limit, $start) {
			$this->db->limit($limit, $start);
			$Value = 1;
			$this->db->select('credito.id_credito as id_credito,credito.id_cliente as id_cliente, credito.id_factura as id,
			credito.importe as inporte,credito.fecha_venc as fecha_venc,credito.pago as pago, credito.num_recibo as num_recibo,
			credito.fecha_pago as fecha_pago, credito.num_cuota as num_cuota,cliente.nombre as nombre, cliente.apellido as apellido,
			factura.num_factura as num_factura, factura.tipo_venta as tipo_venta');
			$this->db->from('credito, cliente, factura');
			$this->db->where('credito.id_cliente = cliente.id_cliente');
			$this->db->where('credito.id_factura = factura.id_factura');
			$this->db->where('pago', $Value);
			$query = $this->db->get('');
			return $query->result_array();
	}
	////////////////////////////////////////////////
	///////listadps pagados////////////////////////
	public function listar_credito2() {
			$Value = 0;
			$this->db->select('COUNT(num_cuota ) as num_cuota,sum(credito.importe) as monto_totales, cliente.id_cliente,sum(importe) as inporte_total,fecha_venc,fecha_pago,pago,nombre,apellido');
			$this->db->from('credito, cliente,factura');
			$this->db->where('credito.id_cliente = cliente.id_cliente');
			$this->db->where('pago', $Value);
			$this->db->group_by('cliente.id_cliente');
			$query = $this->db->get('');
			return $query->num_rows();
	}

	public function listar_credito3() {
			$id = 1;
			$this->db->select('*');
			$this->db->from('credito');
			$this->db->where('pago', $id);
			$query = $this->db->get('');
			return $query->num_rows();
	}
	// traer datos de credito referente al id para pagar
		public function estado($id) {
			$pago = 0;
			$this->db->select('credito.id_credito as id_credito,credito.id_cliente as id_cliente, credito.id_factura as id,
			credito.importe as importe,credito.fecha_venc as fecha_venc,credito.pago as pago, credito.num_recibo as num_recibo,
			credito.fecha_pago as fecha_pago, credito.num_cuota as num_cuota,cliente.nombre as nombre, cliente.apellido as apellido,
			factura.num_factura as num_factura, factura.tipo_venta as tipo_venta');
			$this->db->from('credito, cliente, factura');
			$this->db->where('credito.id_cliente = cliente.id_cliente');
			$this->db->where('credito.id_factura = factura.id_factura');
			$this->db->where('credito.id_cliente', $id);
			$this->db->where('pago', $pago);
			$query = $this->db->get('');
				return $query->num_rows();
		}
			// traer datos de credito referente al id para pagar
		public function estado2($id) {
			$pago = 0;
			$this->db->select('credito.id_credito as id_credito,credito.id_cliente as id_cliente, credito.id_factura as id,
			credito.importe as importe,credito.fecha_venc as fecha_venc,credito.pago as pago, credito.num_recibo as num_recibo,
			credito.fecha_pago as fecha_pago, credito.num_cuota as num_cuota,cliente.nombre as nombre, cliente.apellido as apellido,
			factura.num_factura as num_factura, factura.tipo_venta as tipo_venta');
			$this->db->from('credito, cliente, factura');
			$this->db->where('credito.id_cliente = cliente.id_cliente');
			$this->db->where('credito.id_factura = factura.id_factura');
			$this->db->where('credito.id_cliente', $id);
			$this->db->where('pago', $pago);
			$query = $this->db->get('');
			return $query->result_array();
		}
	// trar datos de  de credito referente al numero de recibo
	public function cobros($id)
	{
			$this->db->select('credito.id_credito as id_credito,credito.id_cliente as id_cliente, credito.id_factura as id,
			credito.importe as importe,credito.fecha_venc as fecha_venc,credito.pago as pago, credito.num_recibo as num_recibo,
			credito.fecha_pago as fecha_pago, credito.num_cuota as num_cuota,cliente.nombre as nombre, cliente.apellido as apellido,
			factura.num_factura as num_factura, factura.tipo_venta as tipo_venta');
			$this->db->from('credito, cliente, factura');
			$this->db->where('credito.id_cliente = cliente.id_cliente');
			$this->db->where('credito.id_factura = factura.id_factura');
			$this->db->where('credito.id_credito', $id);
			$query = $this->db->get('');
			return $query->result_array();
	}
		// agregar cobros cuota
	public function add_cobros_cuota($data)
	{
		$this->db->insert('caja_cobro_detalle',$data);
	}
		// actualizar credito
		public function update_credito($_data,$id)
	{
		$this->db->where('id_credito',$id);
		$this->db->update('credito',$_data);
	}


}

/* End of file caja_model.php */
/* Location: ./application/models/caja_model.php */