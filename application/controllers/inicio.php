<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Inicio extends CI_Controller {
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Bogota");
		
	}

	public function index()
	{

		

		 if ($this->session->userdata('id'))
		 {
		 	$data['titulo'] = "Inicio";
		 	$this->load->view('includes/cabezera',$data);
			$this->load->view('inicial');
			$this->load->view('includes/pie');
		 }else
		 {
		 	redirect('usuarios');
		 }
		
	}
	public function abrir ($pagina)
	{
		 if ($this->session->userdata('id'))
		 {
		 	$data['titulo'] = $pagina;
		 	$this->load->view('includes/cabezera',$data);
			$this->load->view("llegadas_tarde/".$pagina);
			$this->load->view('includes/pie');
		 }else
		 {
		 	redirect('usuarios');

		 }
	}

}

/* End of file inicio.php */
/* Location: ./application/controllers/usuarios/inicio.php */