<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rango_funciones extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
		$this->load->model('rango_funcion');
	}

	public function index()
	{
		

	}

}

/* End of file rango_funciones.php */
/* Location: ./application/controllers/rango_funciones.php */