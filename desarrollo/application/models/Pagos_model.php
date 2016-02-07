<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

class Pagos_model extends CI_Model {
    var $column = array('Fecha','Descripcion','Monto','Hora');
    var $where = 'caja_pagos.Empleado_idEmpleado = empleado.idEmpleado ';
    var $order = array('Fecha' => 'desc');
     const Group_By = 'empleado.Nombres,empleado.Apellidos';
    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_PAGOS = 'caja_pagos';

    const EMPLEADO  = 'empleado';
    /**
	* [__construct description]
	*/
	public function __construct()
	{
		parent::__construct();

	}
    /**
     * [_get_datatables_query buscar datos en a tabla agos mas orden dec]
     * @return [type] [strng]
     */
    private function _get_datatables_query()
    {
        $this->db->from(self::TABLE_PAGOS);
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
    /**
     * [get_pagos traer los datos de la tabla pagos con un limite]
     * @return [type] [string]
     */
        function get_pagos()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    /**
     * [count_filtro Contar cantidad de datos filtrados]
     * @return [type] [Enteros]
     */
    function count_filtro()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }
    /**
     * [count_todas Contar todos los datos de la tabla pagos]
     * @return [type] [Enteros]
     */
    public function count_todas()
    {
        $this->db->from(self::TABLE_PAGOS);
        return $this->db->count_all_results();
    }

    /**
     * [busqueda_empleao description]
     * @param  [type] $datos [description]
     * @return [type]        [description]
     */
    public function busqueda_empleao($datos)
    {
        $data = $this->db->query("select idEmpleado, Nombres from empleado where Nombres like '%$datos%' ");
        //formateo los datos en una matriz
        foreach ($data->result() as $row)
        {
            # code...
            $arr['query'] = $datos;
            $arr['suggestions'][] = array(
                'value' =>$row->Nombres,
                'data' =>$row->idEmpleado
        );
        }
        //minimo php 5.2
        echo json_encode($arr);

    }

    /**
     * [add_caja description]
     * @param [type] $data [description]
     */
    function add_pagos($data)
    {
        $this->db->insert('caja_pagos',$data);
    }

    /**
     * [update description]
     * @param  [type] $where [description]
     * @param  [type] $data  [description]
     * @return [type]        [description]
     */
    public function update($where, $data)
    {
        $this->db->update(self::TABLE_PAGOS, $data, $where);
        return $this->db->affected_rows();
    }

    /**
     * [delete_by_id description]
     * @param  [type] $idCliente [description]
     * @return [type]            [description]
     */
    public function delete_by_id($id)
    {
        $this->db->where('idCaja_Pagos', $id);
        $this->db->delete(self::TABLE_PAGOS);
    }

    /**
     * [get_by_id description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    public function get_by_id($id)
    {
        $id_resultado  = $this->  Empleado_idEmpleado($id);
        if ($id_resultado === '0') {
        $this->db->select('caja_pagos.idCaja_Pagos,caja_pagos.Descripcion,caja_pagos.Monto,caja_pagos.Tipos_Pagos,caja_pagos.Empleado_idEmpleado');
        $this->db->from(self::TABLE_PAGOS);
        $this->db->where('caja_pagos.idCaja_Pagos',$id);
        $query = $this->db->get();
        return $query->row();
        } else {
         $this->db->select('empleado.idEmpleado,caja_pagos.idCaja_Pagos,caja_pagos.Descripcion,caja_pagos.Monto,caja_pagos.Tipos_Pagos,caja_pagos.Empleado_idEmpleado,empleado.Nombres');
        $this->db->from(self::TABLE_PAGOS);
        $this->db->from(self::EMPLEADO);
        $this->db->where($this->where);
        $this->db->where('caja_pagos.idCaja_Pagos',$id);
        $query = $this->db->get();
        return $query->row();
        }
    }

    /**
     * Description
     * @param type $id 
     * @return type
     */
        function Empleado_idEmpleado($id)
    {
        $this->db->select('Empleado_idEmpleado');
        $this->db->where('idCaja_Pagos', $id);
        $query = $this->db->get(self::TABLE_PAGOS);
            foreach($query->result_array() as $d)
        {
            return( $d['Empleado_idEmpleado']);
        }
    }

}


/* End of file Pagos_model.php */
/* Location: ./application/models/Pagos_model.php */