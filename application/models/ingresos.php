<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ingresos extends CI_Model {

	public function insertar($usuarios,$estudiante,$observaciones,$fecha,$hora)
	{
		$data = array(

		   'usuario' => $usuarios ,
		   'estudiante' => $estudiante ,
		   'observaciones' => $observaciones,
		   'fecha' => $fecha ,
		   'hora' => $hora
		);
	
		if($this->db->insert('ingresos', $data))
		{
			return true;

		}else
		{
			return false;
		}

	}


}

/* End of file ingresos.php */
/* Location: ./application/models/ingresos.php */