<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rango_funciones extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
		$this->load->model('rango_funcion');
	}

	public function permisos()
	{
		$idRango = $this->input->post('idRango');
		$datos = $this->rango_funcion->consultarPermisos($idRango);
		$resultados['resultados'] = "";

		// extraigo de la session el id del usuario activo
		$idusuario = $this->session->userdata('id');
		//busco el rango con ese id
		$datosPermiso = $this->usuario->consultar($idusuario,"","","","");
		
		if ($datosPermiso) 
		{
			foreach ($datosPermiso[0] as $row) 
			{
				//extraigo el rango y lo guardo
				$rango = $row->rango;
			}
		}
		//guardo el id de esta funcion
		// $idfuncion = 1;
		//compruevo si este ranog tiene dicho permiso
		// $permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		$permiso = true;

		if ($permiso) {
			
			if($datos)
			{
				foreach ($datos[0] as $row) {
					$info = "nombre='".$row->nombre."'
						 	 permiso='".$row->permiso."'
						 	 codigo='".$row->id."'
						 	 href='#' ";
					$resultados['resultados'] .= '<tr>';
					
					$resultados['resultados'] .= '<td><a '.$info.'  class="es" >'.$row->id.'</a></td>';
					$resultados['resultados'] .= '<td><a '.$info.'  class="es" >'.$row->nombre.'</a></td>';
					if ($row->permiso == 1 ) {
						
						$checkbox = 'checked';
					}else
					{
						$checkbox = '';
					}
					$resultados['resultados'] .= '<td><center><input rango="'.$datos[2].'" class="editar" id="'.$row->id.'" type="checkbox" '.$checkbox.' ></center></td>';
					
					$resultados['resultados'] .= '</tr>';
				}
			$resultados['filas'] = $datos[1];
			
			}else
			{
				$resultados['resultados'] = "<td colspan='4'>No se Encuentra Ningun Estudiante</td>";
				$resultados['filas'] = 0;
			}
					
		}else
		{
			$resultados['resultados'] = "<td colspan='4'>Usted no tiene permiso para esta acción</td>";
				$resultados['filas'] = 0;
		}

		
		echo json_encode($resultados) ;	

	}	

	public function agregarQuitarPermiso()
	{
		$idFuncion = $this->input->post('idFuncion');
		$idRango = $this->input->post('idRango');
		$estado = $this->input->post('estado');
		


		// extraigo de la session el id del usuario activo
		$idusuario = $this->session->userdata('id');
		//busco el rango con ese id
		$datos = $this->usuario->consultar($idusuario,"","","","");
		
		if ($datos) 
		{
			foreach ($datos[0] as $row) 
			{
				//extraigo el rango y lo guardo
				$rango = $row->rango;
			}
		}
		//guardo el id de esta funcion
		// $idfuncion = 1;
		//compruevo si este ranog tiene dicho permiso
		// $permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		$permiso = true;
		if ($permiso) {
			
			if ($estado == "true") {
				$respuesta = $this->rango_funcion->insertar($idRango,$idFuncion);
				if($respuesta)
				{

					$resultados['resultados'] = "¡Felicidades! El permiso se agrego fue exitosamente ".$estado;

				}else
				{
					$resultados['resultados'] = "¡Lo Siento!  Erro al agregar el permiso";
				}
				

				
			}else
			{
				$respuesta = $this->rango_funcion->eliminar($idRango,$idFuncion);
				if($respuesta)
				{

					$resultados['resultados'] = "¡Felicidades! El permiso se quito exitosamente ".$estado;

				}else
				{
					$resultados['resultados'] = "¡Lo Siento!  Erro al quitar el permiso";
				}	

			}


		}else
		{
			$resultados['resultados'] = "<td colspan='4'>Usted no tiene permiso para esta acción</td>";
				$resultados['filas'] = 0;
		}

		
		echo json_encode($resultados) ;	

	}

}

/* End of file rango_funciones.php */
/* Location: ./application/controllers/rango_funciones.php

pero entonces se hace el listado de todas las funciones y mirar la existencia de esas
funciones en la tabla funcion_rango dependeindo de su existencia o no activar o desactivar el checkbox y 
despues si se activa el checkbox hacer el insert con el id de esa funcion
 - Listado de funciones filtrado por perfil y que el filtro solo muestre marcada las funciones que posea
 - filtros para busquedas Perfil-Funciones-
	- consulta 
	select f.nombre,
	if ((select count(*) from funcion_rango fr where fr.rango = 1 and fr.funcion = f.id)>= 1,"si","no") as permiso
	from funciones f;
 */