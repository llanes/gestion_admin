<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Reportes_model extends CI_Model {
	var $where = 'caja_pagos.Empleado_idEmpleado = empleado.idEmpleado ';
		public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Asuncion");

	}
    const ALQUILER_PRESUPUESTO = 'presupuesto_arquiler';
    const PAGOS = 'caja_pagos,empleado';
    const COBROS_CREDITO = 'caja_cobros';
    const SOLOPAGO ='caja_pagos';

    /**
     * [octener_reporte_uno description]
     * @param  [type] $id    [description]
     * @param  [type] $rango [description]
     * @return [type]        [description]
     */
    public function octener_reporte_uno($id,$rango) 
    {
		// obtendo el where de _select_octener 
		$data = $this->_select_octener($id);
		$array = $this->_rango_alquiler_presu($rango);
			$this->db->select('*');
			$this->db->where($array);
			$this->db->where($data);
			$query = $this->db->get(self::ALQUILER_PRESUPUESTO);
			return $query->result();
    }

    /**
     * [octener_reporte_uno2 description]
     * @param  [type] $id     [description]
     * @param  [type] $inicio [description]
     * @param  [type] $fin    [description]
     * @return [type]         [description]
     */
    public function octener_reporte_uno2($id,$inicio,$fin) 
    {
		// obtendo el where de $this->_select_octener 
		$data = $this->_select_octener ($id);
		$array = array('fecha_expedicion >=' => $inicio ,'fecha_expedicion <=' => $fin);
			$this->db->select('*');
			$this->db->where($array);
			$this->db->where($data);
			$query = $this->db->get(self::ALQUILER_PRESUPUESTO);
			return $query->result();
    }

    /**
     * [octener_reporte_dos description]
     * @param  [string] $id    [description]
     * @param  [string] $rango [description]
     * @param  [string] $tipos [description]
     * @return [array]        [description]
     */
    public function octener_reporte_dos($id,$rango,$tipos)
    {
		$array = $this->_rango($rango);
		return $data = $this->tipos($tipos,$array);
    }

    /**
     * [tipos description]
     * @param  [type] $tipos [description]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    private function tipos($tipos,$array)
    {
		switch ($tipos) {
			case '':
					$this->db->select('*');
					$this->db->where($array);
					$query = $this->db->get(self::SOLOPAGO);
					return $query->result();
				break;
			case 'Pagos de Empleado':
					$data = array('Tipos_Pagos' => 'Pagos de Empleado');
					$this->db->select('*');
					$this->db->where($array);
					$this->db->where($data);
					$this->db->where('caja_pagos.Empleado_idEmpleado = empleado.idEmpleado');
					$query = $this->db->get(self::PAGOS);
					return $query->result();
				break;
			default:
					$data = array('Tipos_Pagos' => $tipos);
					$this->db->select('*');
					$this->db->where($array);
					$this->db->where($data);
					$query = $this->db->get(self::SOLOPAGO);
					return $query->result();

				break;
		}
    }

    /**
     * [octener_reporte_dos2 description]
     * @param  [type] $inicio [description]
     * @param  [type] $fin    [description]
     * @param  [type] $tipos  [description]
     * @return [type]         [description]
     */
    public function octener_reporte_dos2($inicio,$fin,$tipos) 
    {
			$array = array('Fecha >=' => $inicio ,'Fecha <=' => $fin);
			return $data = $this->tipos($tipos,$array);
    }

    /**
     * [cobros_reporte description]
     * @param  [type] $rango [description]
     * @return [type]        [description]
     */
     public function cobros_reporte($rango)
    {
		$array = $this->_rango($rango);
		return $data = $this->octener_cobros($array);
    }

    /**
     * [cobros_reporte2 description]
     * @param  [type] $inicio [description]
     * @param  [type] $fin    [description]
     * @return [type]         [description]
     */
    public function cobros_reporte2($inicio,$fin)
    {
		$array = array('Fecha >=' => $inicio ,'Fecha <=' => $fin);
		return $data = $this->octener_cobros($array);
    }

    /**
     * [octener_cobros description]
     * @param  [type] $array [description]
     * @return [type]        [description]
     */
    public function octener_cobros($array)
    {
					$this->db->select('
						credito.Num_cuota as Num_cuota,
						cliente.Nombres as Nombres,
						cliente.Apellidos as Apellidos,
						caja_cobros.Descripcion as Descripcion,
						caja_cobros.Monto as Monto,
						credito.Fecha_Pago as Fecha_Pago,
						credito.Num_Recibo as Num_Recibo');
					$this->db->where($array);
					$this->db->join('credito', 'caja_cobros.Credito_idCredito =credito.idCredito', 'INNER');
					$this->db->join('cliente', 'credito.Cliente_idCliente =cliente.idCliente', 'INNER');
					$query = $this->db->get(self::COBROS_CREDITO);
					return $query->result();
    }

    /**
     * [servicio_reporte description]
     * @param  [type] $rango [description]
     * @return [type]        [description]
     */
    public function servicio_reporte($rango)
    {
		if ($rango == 5) {
			$query = $this->db->get('servicio');  // Produces: SELECT * FROM mytable
			return  $query->result();
		} else {
			$limit=$rango;
			$query = $this->db->get('servicio',$limit );  // Produces: SELECT * FROM mytable
			return  $query->result();
		}
    }

    /**
     * [cliente_reporte description]
     * @param  [type] $rango [description]
     * @return [type]        [description]
     */
	public function cliente_reporte($rango)
    {
		if ($rango == 5) {
			$query = $this->db->get('cliente');  // Produces: SELECT * FROM mytable
			return  $query->result();
		} else {
			$limit=$rango;
			$query = $this->db->get('cliente',$limit );  // Produces: SELECT * FROM mytable
			return  $query->result();
		}
    }

    /**
     * [empleado_reporte description]
     * @param  [type] $rango [description]
     * @return [type]        [description]
     */
    public function empleado_reporte($rango)
    {
		if ($rango == 5) {
			$query = $this->db->get('empleado');  // Produces: SELECT * FROM mytable
			return  $query->result();
		} else {
			$limit=$rango;
			$query = $this->db->get('empleado',$limit );  // Produces: SELECT * FROM mytable
			return  $query->result();
		}
    }

    /**
     * [articulo_reporte description]
     * @param  [type] $rango [description]
     * @param  [type] $id    [description]
     * @return [type]        [description]
     */
    public function articulo_reporte($rango,$id)
    {
		switch ($rango) {
			case 5:
				if ($id == '') {
						$this->db->select('*');
						$this->db->join('categoria', 'producto_servicio.Categoria_idCategoria =categoria.idCategoria', 'INNER');
						$query = $this->db->get('producto_servicio');  // Produces: SELECT * FROM mytable
						return  $query->result();
				} else {
						$this->db->select('*');
						$this->db->where('producto_servicio.Categoria_idCategoria', $id);
						$this->db->join('categoria', 'producto_servicio.Categoria_idCategoria =categoria.idCategoria', 'INNER');
						$query = $this->db->get('producto_servicio');  // Produces: SELECT * FROM mytable
						return  $query->result();
				}
				break;
			case 10 || 50 || 100 || 500:
				$limit=$rango;
				if ($id == '') {
						$this->db->select('*');
						$this->db->join('categoria', 'producto_servicio.Categoria_idCategoria =categoria.idCategoria', 'INNER');
						$query = $this->db->get('producto_servicio',$limit);  // Produces: SELECT * FROM mytable
						return  $query->result();
				} else {
						$this->db->select('*');
						$this->db->where('producto_servicio.Categoria_idCategoria', $id);
						$this->db->join('categoria', 'producto_servicio.Categoria_idCategoria =categoria.idCategoria', 'INNER');
						$query = $this->db->get('producto_servicio',$limit);  // Produces: SELECT * FROM mytable
						return  $query->result();
				}
			break;
			default:
				// code...
				break;
		}
    }

    public function stock_reporte($rango,$id)
    {
		switch ($rango) {
			case 5:
				if ($id == 5) {
						$this->db->select('Nombre,Precio_Unitario,Cantidad_stock');
						$this->db->from('stock,producto_servicio');
						$this->db->where('producto_servicio.idProducto_Servicio = stock.Producto_Servicio_idProducto_Servicio');
						$query = $this->db->get();  // Produces: SELECT * FROM mytable
						return  $query->result();
				} else {
						$array =  $this->_id($id);
						$this->db->select('Nombre,Precio_Unitario,Cantidad_stock');
						$this->db->from('stock,producto_servicio');
						$this->db->where('producto_servicio.idProducto_Servicio = stock.Producto_Servicio_idProducto_Servicio');
						$this->db->where($array);
						$query = $this->db->get();  // Produces: SELECT * FROM mytable
						return  $query->result();
				}
				break;
			case 10 || 50 || 100 || 500:
				$limit=$rango;
				if ($id == 5) {
						$limit=$rango;
						$this->db->select('Nombre,Precio_Unitario,Cantidad_stock');
						$this->db->from('stock,producto_servicio');
						$this->db->where('producto_servicio.idProducto_Servicio = stock.Producto_Servicio_idProducto_Servicio');
						$this->db->limit($limit);
						$query = $this->db->get();  // Produces: SELECT * FROM mytable
						return  $query->result();
				} else {
						$array =  $this->_id($id);
						$this->db->select('Nombre,Precio_Unitario,Cantidad_stock');
						$this->db->from('stock,producto_servicio');
						$this->db->where('producto_servicio.idProducto_Servicio = stock.Producto_Servicio_idProducto_Servicio');
						$this->db->where($array);
						$this->db->limit($limit);
						$query = $this->db->get();  // Produces: SELECT * FROM mytable
						return  $query->result();
				}
			break;
			default:
				// code...
				break;
		}
    }

    public function caja_reporte($rango)
    {
		$array = $this->_rango_caja($rango);
		return $data = $this->octener_caja($array);
    }

    public function caja_reporte2($inicio,$fin)
    {
		$array = array('Fecha_apertura >=' => $inicio ,'Fecha_cierre <=' => $fin,'Cierre' => 1, 'Apertura' => 1);
		return $data = $this->octener_caja($array);
    }

    public function octener_caja($array)
    {
    	$this->db->select('*', FALSE);
		$this->db->where($array, FALSE);
		$this->db->join('usuario', 'caja.Usuario_idUsuario =usuario.idUsuario', 'INNER');
		$query = $this->db->get('caja');
		return  $query->result();
    }

    public function generar_factura($id)
    {
    	
    }















	//////////////////////////////////////////////////////////
	//////////////////////////////////////////////////////////
	/////////////funciones privadas///////////////////////////
	//////////////////////////////////////////////////////////

     private function _rango_alquiler_presu($rango)
    {
		switch ($rango)
		{
			case 1:
				// rango es igual a hoy
				$fecha = date("Y-m-d");
				$array = array('fecha_expedicion' => $fecha);
				return $array;
				break;
			case 2:
				// rango es igual a ayer
				$fecha = $this->_suma_resta_Fechas('-1 day');
				$array = array('fecha_expedicion' => $fecha);
				return $array;
				break;
			case 3:
				// ultimos siete dis para ello debeos de octener el inicio i enfinal
				$final = date("Y-m-d");
				$inicio = $this->_suma_resta_Fechas('-7 day');
				$array = array('fecha_expedicion >=' => $inicio ,'fecha_expedicion <=' => $final);
				return $array;
				break;
			case 4:
				// ultimos mes para ello debemos de tener un inicio i final
				$final =  $this->_ultimo_dia();
				$inicio = $this->_primer_dia();
				$array = array('fecha_expedicion >=' => $inicio ,'fecha_expedicion <=' => $final);
				return $array;
				break;
			case 5:
				$array = array('fecha_expedicion >' => '2000-01-01');
				return $array;
				break;
			default:
				break;
		}
    }


    private function _rango($rango)
    {
		switch ($rango)
		{
			case 1:
				// rango es igual a hoy
				$fecha = date("Y-m-d");
				$array = array('Fecha' => $fecha);
				return $array;
				break;
			case 2:
				// rango es igual a ayer
				$fecha = $this->_suma_resta_Fechas('-1 day');
				$array = array('Fecha' => $fecha);
				return $array;
				break;
			case 3:
				// ultimos siete dis para ello debeos de octener el inicio i enfinal
				$final = date("Y-m-d");
				$inicio = $this->_suma_resta_Fechas('-7 day');
				$array = array('Fecha >=' => $inicio ,'Fecha <=' => $final);
				return $array;
				break;
			case 4:
				// ultimos mes para ello debemos de tener un inicio i final
				$final =  $this->_ultimo_dia();
				$inicio = $this->_primer_dia();
				$array = array('Fecha >=' => $inicio ,'Fecha <=' => $final);
				return $array;
				break;
			case 5:
				$array = array('Fecha >' => '2000-01-01');
				return $array;
				break;
			default:
				break;
		}
    }

      private function _rango_caja($rango)
    {
		switch ($rango)
		{
			case 1:
				// rango es igual a hoy
				$fecha = date("Y-m-d");
				$array = array('Fecha_cierre' => $fecha , 'Cierre' => 1, 'Apertura' => 1);
				return $array;
				break;
			case 2:
				// rango es igual a ayer
				$fecha = $this->_suma_resta_Fechas('-1 day');
				$array = array('Fecha_cierre' => $fecha,'Cierre' => 1, 'Apertura' => 1);
				return $array;
				break;
			case 3:
				// ultimos siete dis para ello debeos de octener el inicio i enfinal
				$final = date("Y-m-d");
				$inicio = $this->_suma_resta_Fechas('-7 day');
				$array = array('Fecha_apertura >=' => $inicio ,'Fecha_cierre <=' => $final,'Cierre' => 1, 'Apertura' => 1);
				return $array;
				break;
			case 4:
				// ultimos mes para ello debemos de tener un inicio i final
				$final =  $this->_ultimo_dia();
				$inicio = $this->_primer_dia();
				$array = array('Fecha_apertura >=' => $inicio ,'Fecha_cierre <=' => $final,'Cierre' => 1, 'Apertura' => 1		);
				return $array;
				break;
			case 5:
				$array = array('Fecha_cierre >' => '2000-01-01');
				return $array;
				break;
			default:
				break;
		}
    }


	private function _id($id)
	{
		switch ($id) {
			case 10:
				$data = array('Cantidad_stock <' => 10);
				return $data;
				break;
			case 50:
				$data = array('Cantidad_stock <' => 50);
				return $data;
				break;
			case 100:
				$data = array('Cantidad_stock <' => 100);
				return $data;
				break;
			default:
				// code...
				break;
		}
	}
    /**
     * [_select_octener  octengo  un array de _select_octener ]
     * @param  varchar $id [es un id numerico]
     * @return array  $data   [retorna un array]
     */
    private function _select_octener($id)
    {
		switch ($id) 
		{
			case 1:
				$data = array('Arquiler_Presupuesto' => '1');
				return $data;
				break;
			case 2:
				$data = array('Arquiler_Presupuesto' => '2');
				return $data;
				break;
			case 3:
				$data = array('Arquiler_Presupuesto' => '0', 'Contado_Credito' => '2');
				return $data;
				break;

			default:
			// code...
			break;
		}
    }


    /**
	* [_suma_resta_Fechas description]
	* @param  varchar  $suma           [numero de resta o suma dia o semana o mes]
	* @param  boolean $fechaInicial    [Fecha actual]
	* @return date     $nuevaFecha         [retorna nuva fecha]
     */
    private function _suma_resta_Fechas ($suma,$fechaInicial = false)
	{
		$fecha = !empty($fechaInicial) ? $fechaInicial : date('Y-m-d'); 
		$nuevaFecha = strtotime ($suma , strtotime ( $fecha ) ) ;
		$nuevaFecha = date ( 'Y-m-d' , $nuevaFecha );
		return $nuevaFecha;
	}

	/** Mes Actual último día **/
	private function _ultimo_dia () { 
	$month = date('m');
	$year = date('Y');
	$day = date("d", mktime(0,0,0, $month+1, 0, $year));

	return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
	}

	/** Mes actual primer día **/
	private function _primer_dia() {
	$month = date('m');
	$year = date('Y');
	return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
	}

}
/* End of file Reportes_model.php */
/* Location: ./application/models/Reportes_model.php */