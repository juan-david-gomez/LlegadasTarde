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
	 public function validarFuncion($idUsuario,$idFuncion)
	 {
	 	//se hace la consulta del ide del usuario para extraer si rango
	 	$usuarios = $this->usuario->consultar($idUsuario,"","","","");
	 	if ($usuarios)
	 	 {
	 		foreach ($usuarios[0] as $row) 
	 		{
	 			 $rango = $row->rango;
	 		}
	 		//ahora buscaremos la funcion solicitada entre la que posee el rango
			$funcionesRangos = $this->rango_funcion->consultar("",$rango,$idFuncion);
	 		if ($funcionesRangos)
	 		{  
	 			// si devolvio valores extraemos el nombre de diha funcion
	 			
		 		return true;
		 	}else
	 		{
	 			return false;
	 		}
	 		

	 	 }

	 	
	 		




	 }

}

/* End of file rango_funciones.php */
/* Location: ./application/controllers/rango_funciones.php */