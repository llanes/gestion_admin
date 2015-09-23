<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Login extends CI_Controller {

	public function __construct()
	{
		parent::__construct();

		$this->load->model('Login_model', 'login');
	}

	public function index()
	{
		
	}

}

/* End of file login.php */
/* Location: ./application/controllers/login.php */