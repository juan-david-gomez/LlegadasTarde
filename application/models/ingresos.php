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

	public function consutar($id,$usuario,$nombres,$apellidos,$grd_13,$observaciones,$fecha,$hora,$fechaI,$fechaF,$codigo)
	{

		$this->db->select('id,codigo,nombres,apellidos,grd_13,fecha,hora,observaciones');
		$this->db->from('estudiantes');
		$this->db->from('ingresos');
		$where = "codigo = estudiante";
		$this->db->where($where);
		
		if(!empty($id))
		{
			$this->db->where('id', $id);
		}
		if(!empty($codigo))
		{
			$this->db->where('codigo', $codigo);
		}
		if(!empty($usuario))
		{
			$this->db->where('usuario', $usuario);
		}
		if(!empty($nombres))
		{
			$this->db->like('nombres', $nombres);
		}
		if(!empty($apellidos))
		{
			$this->db->like('apellidos', $apellidos);
		}
		if(!empty($grd_13))
		{
			$this->db->like('grd_13', $grd_13);
		}
		if(!empty($observaciones))
		{
			$this->db->like('observaciones', $observaciones);
		}
		if(!empty($fecha))
		{
			$this->db->where('fecha', $fecha);
		}
		if(!empty($hora))
		{
			$this->db->where('hora', $hora);
		}
		if(!empty($fechaI) and !empty($fechaF))
		{
			$this->db->where('fecha >=', $fechaI);
			$this->db->where('fecha <=', $fechaF);
		}
		$result = $this->db->get();
		if ($result->num_rows > 0) {
			$resultados = $result->result();
			return $resultados;
		}else
		{
			return false;
		}
	}
	public function eliminar($id)		
	{
		if ($this->db->delete('ingresos', array('id' => $id))) {
			return true;
		}else
		{
			return false;
		}
	}
	public function actualizar($id,$estudiante,$observaciones)
	{
		
		$data = array(
               'estudiante' => $estudiante,
               'observaciones' => ''.$observaciones.'',
            );

		$this->db->where('id', $id);
		if($this->db->update('ingresos', $data))
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