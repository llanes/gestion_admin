<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Logeo_model extends CI_Model {

	public function __construct()
	{
		parent::__construct();
		//Do your magic here
	}

public function logeo($Usuario ,$Password)
	{
			$this->db->select('*');// selecionar todo
            $this->db->from('usuario'); // de la tabla Usuario
			$this->db->where('Usuario',$Usuario);// donde el nombre de usuario sea igual 
			$this->db->where('Password',$Password);// el pass igual
			return $this->db->get()->row();

			// if($consulta->num_rows > 0){
			// 	$consulta = $consulta->row();
			// 	return $consulta;
			// } else{
			// }// $resultado = $consulta->row();
			// // return $resultado;
	}
	//cheque si existe el usuario
	public	function check_nombre($usuario)
	{
		# code...
		$this->db->select('Usuario');
		$this->db->where('Usuario',$usuario);
		$consulta = $this->db->get('usuario');
		if ($consulta->num_rows()> 0) {
			# code...
			return true;
		}

	}
	//cheque si existe el usuario para registro
	public	function check_User($user_id)
	{
		# code...
		$this->db->select('Usuario');
		$this->db->where('Usuario',$user_id);
		$consulta = $this->db->get('usuario');
		if ($consulta->num_rows()> 0) {
			# code...
			return true;
		}

	}
	//cheque si existe el email para su posterior registro
	public	function check_email($Email)
	{
		# code...
		$this->db->select('Email');
		$this->db->where('Email',$Email);
		$consulta = $this->db->get('Cliente');
		if ($consulta->num_rows()> 0) {
			# code...
			return true;
		}

	}
	//chequea si existe el pass
	public	function check_pass($password)
	{
		# code...
		$this->db->select('Password');
		$this->db->where('Password',$password);
		$consulta = $this->db->get('usuario');
		if ($consulta->num_rows()> 0) {
			# code...
			return true;
		}

	}
	// agregar cliente
	public function add_cliente($data)
	{
		$this->db->insert('cliente', $data);
	}
	// agregra usuario
	public function add_user($_data)
	{
		$this->db->insert('usuario', $data);
	}
}

/* End of file logeo_model.php */
/* Location: ./application/models/logeo_model.php */