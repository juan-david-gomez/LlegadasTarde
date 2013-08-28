<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rango_funcion extends CI_Model {

	public function consultar($id,$rango,$funcion)
	{
		$this->db->select('*');
		$this->db->from('funcion_rango');

		if (!empty($id)) {	
			$this->db->where('id', $id);
		}
		if (!empty($rango)) {	
			$this->db->where('rango', $rango);
		}
		if (!empty($funcion)) {	
			$this->db->where('funcion', $funcion);
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

	 public function validarFuncion($rango,$idfuncion)
	 {
	 	
	 
	 		//ahora buscaremos la funcion solicitada entre la que posee el rango
			$funcionesRangos = $this->consultar("",$rango,$idfuncion);
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

/* End of file rango_funcion.php */
/* Location: ./application/models/rango_funcion.php */