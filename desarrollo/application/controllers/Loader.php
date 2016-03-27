<?php
defined('BASEPATH') OR exit('No direct script access allowed');

class Loader extends CI_Controller {

public function __construct()
{
	parent::__construct();
	//Do your magic here
}

public function index()
{
$this->load->view('Error/404.php', $data, FALSE);
}

















}

/* End of file Loader.php */
/* Location: ./application/controllers/Loader.php */