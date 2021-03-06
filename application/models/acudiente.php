<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acudiente extends CI_Model {

	public function consutar($id,$estudiante,$nombre,$apellido,$email)  
	{

		$this->db->select('*');
		$this->db->from('acudientes');
		$this->db->from('estudiantes');
		$where = "codigo = estudiante";
		$this->db->where($where);
		
		if(!empty($id))
		{
			$this->db->where('id', $id);
		}
		if(!empty($estudiante))
		{
			$this->db->where('estudiante', $estudiante);
		}
		if(!empty($nombre))
		{
			$this->db->where('nombre', $nombre);
		}
		if(!empty($apellido))
		{
			$this->db->like('apellido', $apellido);
		}
		if(!empty($email))
		{
			$this->db->like('email', $email);
		}
		
		
		$result = $this->db->get();	
		$filas = $result->num_rows;
		if ($filas > 0)
		 {
			$resultados[0] = $result->result();
			$resultados[1] = $filas;
			return $resultados;
		}else
		{
			return false;
		}
	}

	public function insertar($estudiante,$nombre,$apellido,$id,$email)
	{
		$datos = array(
			
			'id' =>	$id,
			'estudiante' => $estudiante,
			'nombre' => $nombre,
			'apellido' => $apellido,
			'email' => $email
			);

		if($this->db->insert('acudientes', $datos))
		{
			
		}else
		{
			if($data['error'] = $this->db->_error_message())
			{
				return $data;
			}

		}
	}

	public function editar($estudiante,$nombre,$apellido,$id,$email)
	{
		$datos = array(
			'estudiante' => $estudiante,
			'nombre' => $nombre,
			'apellido' => $apellido,
			'email' => $email
			);
		$this->db->where('id', $id);
		if($this->db->update('acudientes', $datos))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function borrar($id)	
	{
		$this->db->where('id', $id);
		if($this->db->delete('acudientes'))
		{
			return true;
		}else
		{
			return false;
		}
	}
}

/* End of file acudientes.php */
/* Location: ./application/models/acudientes.php */
