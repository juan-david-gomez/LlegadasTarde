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
	

}

/* End of file usuarios.php */
/* Location: ./application/models/usuarios.php */