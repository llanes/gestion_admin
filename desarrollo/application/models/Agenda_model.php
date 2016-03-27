<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Agenda_model extends CI_Model
{
	var $where = 'Arquiler_Presupuesto = 1';
	const TABLA = 'presupuesto_arquiler pre';

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



	public function get_agenda()
	{
		$this->db->select('pre.Nombre_servicio as title, pre.Fecha_Devolucion as end, pre.Fecha_Pre_Arqui as start , cl.Nombres as body ,pre.idArquiler as id, pre.Monto_Alquiler_Presupuesto as class');
		$this->db->from(self::TABLA);
		$this->db->join('cliente cl', 'pre.Cliente_idCliente = cl.idCliente', 'INNER');
		$this->db->where($this->where);
		$query = $this->db->get();
		
		if ($query->num_rows() > 0) {
			$i = 0;
			foreach ($query->result() as $row)
			{	

					$datos[$i]  = array(
					'id'     =>$row->id,
					'title'  =>$row->title,
					'body'   =>$row->body ,
					'url'    =>site_url('index.php/Agenda/ver_modal/'.$row->id),
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


}


/* End of file Agenda_model.php */
/* Location: ./application/models/Agenda_model.php */