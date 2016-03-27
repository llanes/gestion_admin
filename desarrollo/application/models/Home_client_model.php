<?php defined('BASEPATH') OR exit('No direct script access allowed');

class Home_client_model extends CI_Model {
    var $column = array('idProducto_Servicio','Nombre','Precio_Unitario','Codigo');
    var $order = array('idProducto_Servicio' => 'desc');
    var $where = '(Arquiler_Presupuesto = 1) OR (Arquiler_Presupuesto = 0)';
    const TABLA = 'presupuesto_arquiler pre';
    const TABLE_P_S = 'producto_servicio';

    public function __construct()
    {
      parent::__construct();
      date_default_timezone_set("America/Asuncion"); 

    }

    /**
    * [_formatDate formatea una fecha a microtime para añadir al evento tipo 1401517498985]
    * @param  [type] $date [datatime]
    * @return [type]       [strtotime]
    */
    private function _formatDate($date)
    {
      return strtotime(substr($date, 6, 4)."-".substr($date, 3, 2)."-".substr($date, 0, 2)." " .substr($date, 10, 6)) * 1000;
    }

      public function get_agenda($id)
  {
    $this->db->select('pre.Nombre_servicio as title, pre.Fecha_Devolucion as end, pre.Fecha_Pre_Arqui as start , cl.Nombres as body ,pre.idArquiler as id, pre.Monto_Alquiler_Presupuesto as class');
    $this->db->from(self::TABLA);
    $this->db->join('cliente cl', 'pre.Cliente_idCliente = cl.idCliente', 'INNER');
    $this->db->where($this->where);
    $this->db->where('Cliente_idCliente', $id, FALSE);
    $query = $this->db->get();
    
    if ($query->num_rows() > 0) {
      $i = 0;
      foreach ($query->result() as $row)
      { 

          $datos[$i]  = array(
          'id'     =>$row->id,
          'title'  =>$row->title,
          'body'   =>$row->body ,
          'url'    =>site_url('index.php/Home_cliente/ver_modal/'.$row->id),
          'class'  =>$row->class,
          'start'  =>$this->_formatDate($row->start),
          'end'    =>$this->_formatDate($row->end),
          'inicio' =>$row->start,
          'final'  =>$row->end,

          );
        $i ++;
      }
      echo json_encode(array('success' => 1, 'result' => $datos));
      exit;
    }
    return object();
  }


    public function ver_modal($id)
  {
    $idCliente = $this->session->userdata('Cliente_idCliente');
    $this->db->select('
      pre.idArquiler,
      pre.Nombre_servicio as Evento, 
      pre.Fecha_Devolucion as devolucion, 
      pre.Fecha_Pre_Arqui as inicio , 
      cl.Nombres ,
      cl.Apellidos ,
      pre.idArquiler as id, 
      pre.Monto_Alquiler_Presupuesto as monto');
    $this->db->from(self::TABLA);
    $this->db->join('cliente cl', 'pre.Cliente_idCliente = cl.idCliente', 'INNER');
    $this->db->where('idArquiler', $id);
    $this->db->where('Cliente_idCliente',  $idCliente, FALSE);
    $query = $this->db->get();
    if ($query->num_rows() > 0) {
      foreach ($query->result() as $row)
      {
          $datos  = '
        <table class="table table-bordered table-hover">
                  <tbody>
                     <tr id="transparente">
                        <td >
                          <a> Nombre Evento </a>
                        </td>
                        <td>
              '.$row->Evento.'
                        </td>
                      </tr>
                      <tr id="transparente">
                        <td >
                          <a> Cliente </a>
                        </td>
                        <td>
              '.$row->Nombres.'  '.$row->Apellidos.'
                        </td>
                          </tr>
                      <tr id="transparente">
                        <td >
                          <a> Monto Alquiler </a>
                        </td>
                        <td>
              '.$row->monto.'
                        </td>
                          </tr>


                     </tr>
                  </tbody>
                </table>
          ';
      }
      echo  $datos;
      exit;
    }
    return object();
  }


    /**
     * @name string TABLE_NAME Holds the name of the table in use by this model
     */
    private function _get_datatables_query()
    {
        $this->db->from(self::TABLE_P_S);

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

    function get_pre()
    {
        $this->_get_datatables_query();
        if($_POST['length'] != -1)
        $this->db->limit($_POST['length'], $_POST['start']);
        $query = $this->db->get();
        return $query->result();
    }

    function count_filtro_pre()
    {
        $this->_get_datatables_query();
        $query = $this->db->get();
        return $query->num_rows();
    }

    public function count_todas_pre()
    {
        $this->db->from(self::TABLE_P_S);
        return $this->db->count_all_results();
    }
    function get_pr_ser($limit, $start,$id)
     {
        if ($id == '') {
          $this->db->limit($limit, $start);
          $query = $this->db->get(self::TABLE_P_S);
          return $query->result();
        } else {
          $this->db->limit($limit, $start);
          $this->db->where('Categoria_idCategoria', $id);
          $query = $this->db->get(self::TABLE_P_S);
          return $query->result();
        }

     }
     public function lista_pr_categ($id)
     {
         $this->db->where('Categoria_idCategoria', $id);
          $this->db->from(self::TABLE_P_S);
        return $this->db->count_all_results();
     }
     public function lista_pr_fillter($filter='')
     {
      $this->db->like('Nombre',$filter);
      $this->db->from(self::TABLE_P_S);
      return $this->db->count_all_results();
     }
     public function get_pr_fillter($limit, $start,$filter='')
     {
      $this->db->limit($limit, $start);
      $this->db->like('Nombre',$filter);
      $query = $this->db->get(self::TABLE_P_S);
      return $query->result();
     }

}

/* End of file Home_client_model.php */
/* Location: ./application/models/Home_client_model.php */
