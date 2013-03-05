<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes extends CI_Model {

	public function consultar ($codigo,$nombres,$apellidos,$grupo)
	{
		$this->db->select('*');
		$this->db->from('estudiantes');
		if(!empty($codigo))
		{
			$this->db->where('codigo', $codigo);
		}
		if(!empty($grupo))
		{
			$this->db->like('grd_13', $grupo);
		}
		if(!empty($nombres))
		{
			$this->db->like('nombres', $nombres);
		}
		if(!empty($apellidos))
		{
			$this->db->like('apellidos', $apellidos);
		}
		
		$resul = $this->db->get();
		if($resul->num_rows > 0){ 
			$resultados = $resul->result();
			return $resultados;
		}else
		{
			return false;
		}
	}
	

}

/* End of file estudiantes.php */
/* Location: ./application/models/estudiantes.php */