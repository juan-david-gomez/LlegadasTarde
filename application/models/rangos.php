<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rangos extends CI_Model {

	public function consultar($id,$nombre)
	{
		$this->db->select('*');
		$this->db->from('rangos');

		if (!empty($id)) {	
			$this->db->where('id', $id);
		}
		if (!empty($nombre)) {	
			$this->db->like('nombre', $nombre);
		}
			
		$resul = $this->db->get();
		 $filas = $resul->num_rows;
		

		if( $filas > 0){ 
			$resultados[0]= $resul->result();
			$resultados[1] = $filas;
			return $resultados;
		}else
		{
			return false;
		}
	}//fin de consultar

	public function insertar($id,$nombre)
	{
		$object = array('id' => $id ,'nombre'  => $nombre);

		
		

		if($this->db->insert('rangos', $object))
		{
			
		}else
		{
			if($data['error'] = $this->db->_error_message())
			{
				return $data;
			}

		}
	}//fin de insertar

		public function editar($id,$nombres)
	{
		$object = array('nombre' => $nombres);
		$this->db->where('id', $id);
		if($this->db->update('rangos', $object))
		{
			return true;
		}else
		{
			return false;
		}
	}//fin de editar

	public function borrar($id)	
	{
		$this->db->where('id', $id);
		if($this->db->delete('rangos'))
		{
			return true;
		}else
		{
			return false;
		}
	}//fin de borrar

}

/* End of file rangos.php */
/* Location: ./application/models/rangos.php */