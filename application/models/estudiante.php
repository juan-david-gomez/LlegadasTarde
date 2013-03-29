<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiante extends CI_Model {

	public function consultar($codigo,$nombres,$apellidos,$grupo)
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

		

		if( $resul->num_rows > 0){ 
			$resultados = $resul->result();
			
			return $resultados;
		}else
		{
			return false;
		}
	}
	
	public function editar($codigo,$nombres,$apellido,$grupo,$sexo)
	{
		$object = array('nombres' => $nombres,'apellidos' => $apellido,'grd_13' => $grupo,'sexo' => $sexo );
		$this->db->where('codigo', $codigo);
		if($this->db->update('estudiantes', $object))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function borrar($codigo)	
	{
		$this->db->where('codigo', $codigo);
		if($this->db->delete('estudiantes'))
		{
			return true;
		}else
		{
			return false;
		}
	}



	public function insertar($codigo,$nombre,$apellido,$grupo,$sexo)
	{
		$object = array('codigo' => $codigo ,'nombres'  => $nombre,'apellidos'  => $apellido,'grd_13'  => $grupo,'sexo'  => $sexo);


		

		if($this->db->insert('estudiantes', $object))
		{
			
		}else
		{
			if($data['error'] = $this->db->_error_message())
			{
				return $data;
			}

		}
	}
}/* End of file estudiantes.php */
/* Location: ./application/models/estudiantes.php */

