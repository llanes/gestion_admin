<?php
if (!defined('BASEPATH')) exit('No direct script access allowed');

class Cobros_model extends CI_Model {
    VAR $column = array('Fecha_Ven','Nombres','Apellidos');
    var $order = array('Fecha_Ven' => 'desc');
    const WHERE = 'Estado_Pago = 2';
    const WHE_RE = 'Estado_Pago = 1';
    const Group_By = 'cl.Nombres,cl.Apellidos';
    const SELECT_COBRANZAS =
    'COUNT(cr.Num_cuota ) as Num_cuota,
    sum(cr.Importe) as monto_totales,
    cr.Cliente_idCliente as idCliente,
    sum(cr.Importe) as inporte_total,
    cr.Fecha_Ven,
    cr.Fecha_Pago,
    cr.Estado_Pago,
    cl.Nombres,
    cl.Apellidos'
    ;
    const SELECT =
    'cr.idCredito,
    cr.Cliente_idCliente as idCliente,
    cr.Importe as impor,
    cr.Num_Recibo,
    cr.Num_cuota,
    cr.Fecha_Ven,
    cr.Fecha_Pago,
    cr.Estado_Pago,
    cl.Nombres,
    cl.Apellidos'
    ;
    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    const TABLE_COBROS = 'credito cr';

	/**
	* [__construct description]
	*/
	public function __construct()
	{
		parent::__construct();

	}
    /**
     * [_get_datatables_cobranzas buscar datos en a tabla agos mas orden dec]
     * @return [type] [strng]
     */
    private function _get_datatables_cobranzas()
    {
        $this->db->select(self::SELECT_COBRANZAS);
        $this->db->from(self::TABLE_COBROS);
        $this->db->where(self::WHERE);
        $this->db->join('cliente cl', 'cr.Cliente_idCliente = cl.idCliente', 'INNER');
        $this->db->group_by(self::Group_By);
        $i = 0;

        foreach ($this->column as $item)
        {
            if($_POST['search']['value'])
                ($i===0) ?
            $this->db->like($item, $_POST['search']['value']) : 
            $this->db->or_like($item, $_POST['search']['value']);
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
     * [get_cobranzas description]
     * @return [type] [description]
     */
    function get_cobranzas()
    {
        $this->_get_datatables_cobranzas();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    /**
     * [count_filtro_cobranzas description]
     * @return [type] [description]
     */
    function count_filtro_cobranzas()
    {
        $this->_get_datatables_cobranzas();
        $query = $this->db->get();
        return $query->num_rows();
    }

    /**
     * [count_todas_cobranzas description]
     * @return [type] [description]
     */
    function count_todas_cobranzas()
    {
        $this->db->select(self::SELECT_COBRANZAS);
        $this->db->from(self::TABLE_COBROS);
        $this->db->join('cliente cl', 'cr.Cliente_idCliente = cl.idCliente', 'INNER');
        $this->db->where(self::WHERE);
        $this->db->group_by(self::Group_By);
        return $this->db->count_all_results();
    }

    //////////////////////Listados cobranzas////////////////////////////
    /**
     * [_get_datatables_Cobrados description]
     * @return [type] [description]
     */
    private function _get_datatables_Cobrados()
    {
        $this->db->select(self::SELECT);
        $this->db->from(self::TABLE_COBROS);
        $this->db->where(self::WHE_RE);
        $this->db->join('cliente cl', 'cr.Cliente_idCliente = cl.idCliente', 'INNER');
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

    function get_Cobrados()
    {
        $this->_get_datatables_Cobrados();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtro_Cobrados()
    {
        $this->_get_datatables_Cobrados();
        $query = $this->db->get();
        return $query->num_rows();
    }

    function count_todas_Cobrados()
    {
        $Value = 2;
        $this->db->select(self::SELECT);
        $this->db->from(self::TABLE_COBROS);
        $this->db->join('cliente cl', 'cr.Cliente_idCliente = cl.idCliente', 'INNER');
        $this->db->where(self::WHE_RE);

        return $this->db->count_all_results();
    }

    //////////////////////Listados cobranzas////////////////////////////

    /**
     * [_get_datatables_cobar description]
     * @return [type] [description]
     */
    private function _get_datatables_cobar($idCliente)
    {
        $i = 0;
        $this->db->select(self::SELECT);
        $this->db->from(self::TABLE_COBROS);
        $this->db->where(self::WHERE);
        $this->db->where('idCliente',  $idCliente);
        $this->db->join('cliente cl', 'cr.Cliente_idCliente = cl.idCliente', 'INNER');
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
     * [get_listar description]
     * @param  [type] $idCliente [description]
     * @return [type]            [description]
     */
    function get_listar($idCliente)
    {
        $this->_get_datatables_cobar($idCliente);
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }
    /**
     * [filtro_cobar description]
     * @param  [type] $idCliente [description]
     * @return [type]            [description]
     */
    function filtro_cobar($idCliente)
    {
        $this->_get_datatables_cobar($idCliente);
        $query = $this->db->get();
        return $query->num_rows();
    }
    /**
     * [count_cobar description]
     * @param  [type] $idCliente [description]
     * @return [type]            [description]
     */
    function todas_cobar($idCliente)
    {
        $Value = 2;
        $this->db->select(self::SELECT);
        $this->db->from(self::TABLE_COBROS);
        $this->db->join('cliente cl', 'cr.Cliente_idCliente = cl.idCliente', 'INNER');
        $this->db->where(self::WHERE);
        $this->db->where('idCliente', $idCliente);
        return $this->db->count_all_results();
    }

    /**
     * [get_by_id description]
     * @param  [type] $id [description]
     * @return [type]     [description]
     */
    function get_by_id($id)
    {
        $this->db->select(self::SELECT);
        $this->db->from(self::TABLE_COBROS);
        $this->db->join('cliente cl', 'cr.Cliente_idCliente = cl.idCliente', 'INNER');
        $this->db->where('idCredito',$id);
        $query = $this->db->get();

        return $query->row();
    }


    function cobrar_credito($data,$Estado_Pago,$idCredito,$fecha)
    {
        //Estado_Pago 1 = pagado
        //Estado_Pago 2 = no pagado
            if ($Estado_Pago == 2) {
            $this->db->set('Estado_Pago', 1);
            $this->db->set('Fecha_Pago',$fecha);
            $this->db->where('idCredito', $idCredito);
            $this->db->update('credito');
            $this->db->insert('caja_cobros',$data);
            return $this->db->affected_rows();
        } else if ($entrega == 1) {
            $this->db->set('Estado_Pago', 2);
            $this->db->set('Fecha_Pago',$fecha);
            $this->db->where('idCredito', $idCredito);
            $this->db->update('credito');
            return $this->db->affected_rows();
            return $this->db->affected_rows();
        }
    }

}

/* End of file Cobros_model.php */
/* Location: ./application/models/Cobros_model.php */
