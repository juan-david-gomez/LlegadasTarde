<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Usuario extends CI_Model {


	public function entrar ($usuario,$clave)
	{
		$this->db-> select('*');
	    $this->db-> from('usuarios');
		$this->db-> where('usuario', $usuario);
		$this->db->where('clave', $clave);
		$this -> db -> limit(1);
		$query = $this->db->get();
	if($query->num_rows() == 1)
	   {

	   		
			return $query->result();
	     
	   }
	   else
	   {
	     return false;
	   }		

	}
	
	public function insertar($nombre,$usuario,$clave,$rango)
	{
		$datos = array(
			
			'nombre' =>	$nombre,
			'usuario' => $usuario,
			'clave' => $clave,
			'rango' => $rango
			);
		if($this->db->insert('usuarios', $datos))
		{
			return true;
		}else
		{
			return false;
		}
	}


	public function consultar($id,$nombre,$usuario,$clave,$rango)
	{
		$this->db->select('*');
		$this->db->from('usuarios');
		if(!empty($id))
		{
			$this->db->where('id', $id);
		}
		if(!empty($nombre))
		{
			$this->db->like('nombre', $nombre);
		}
		if(!empty($usuario))
		{
			$this->db->like('usuario', $usuario);
		}
		if(!empty($clave))
		{
			$this->db->where('clave', $clave);
		}
		if(!empty($rango))
		{
			$this->db->where('rango', $rango);
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

			
	public function borrar($id)	
	{
		$this->db->where('id', $id);
		if($this->db->delete('usuarios'))
		{
			return true;
		}else
		{
			return false;
		}
	}

	public function editar($id,$nombre,$usuario,$clave,$rango)
	{
		$object = array('nombre' => $nombre,'usuario' => $usuario,'clave' => $clave,'rango' => $rango );
		$this->db->where('id', $id);
		if($this->db->update('usuarios', $object))
		{
			return true;
		}else
		{
			return false;
		}
	}
}

/* End of file usuarios.php */
/* Location: ./application/models/usuarios.php */