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

	public function consutar($id,$usuario,$estudiante,$observaciones,$fecha,$hora)
	{
		$query = "SELECT * FROM ingresos ";
		
		if(!empty($id))
		{
			$query .= "WHERE id =".$id;
		}
		if(!empty($usuario))
		{
			$query .= "WHERE usuario =".$usuario;
		}
		if(!empty($estudiante))
		{

		}
		if(!empty($observaciones))
		{

		}
		if(!empty($fecha))
		{

		}
		if(!empty($hora))
		{

		}
	}
}

/* End of file ingresos.php */
/* Location: ./application/models/ingresos.php */