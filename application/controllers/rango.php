
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Rango extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('rangos');
		$this->load->model('rango_funcion');
		$this->load->model('usuario');
	}

	public function index()
	{
		
	}
	public function validar()
	{
		$codigo = $this->input->post('id');
		$nombre = $this->input->post('nombre');
	

		//carga la libreria de validacion de formularios
		$this->load->library('form_validation');

		//pone los el contenedor del mensaje en este caso un div de error
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><p>', '</p></div>'); 

		$this->form_validation->set_rules('id', 'Identificación', 'required|numeric');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');


		$this->form_validation->set_message('required','El Campo %s es Obligatorio');
		$this->form_validation->set_message('numeric','El Campo %s deve ser Numerico');
	

	

		if ($this->form_validation->run() == FALSE)
        {


        	$data['titulo'] = "rangos";
		 	$this->load->view('includes/cabezera',$data);
			$this->load->view("llegadas_tarde/rangos");
			$this->load->view('includes/pie');

        }
        else
        {
            $mensaje = $this->insertar($codigo,$nombre);
           	$data['titulo'] = "rangos";
           	$data['mensaje'] = $mensaje;
		 	$this->load->view('includes/cabezera',$data);
			$this->load->view("llegadas_tarde/rangos");
			$this->load->view('includes/pie');
        }
	}


	public function insertar($codigo,$nombre)
	{
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
		$idfuncion = 17;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		
		if ($permiso)
		{
			$respuesta = $this->rangos->insertar($codigo,$nombre);
			if ($respuesta == null) {

				return "<div class='alert alert-success' >
					    <a class='close' data-dismiss='alert'>×</a>
					    <p class='alert-heading'><strong>Felicidades!</strong>  El Rango fue insertado Correctamente</p>
					    </div>";
			}else if ($respuesta != null)
			{
					return "<div class='alert alert-error' >
					    <a class='close' data-dismiss='alert'>×</a>
					    <p class='alert-heading'><strong>Lo Siento!</strong>  El Rango no fue insertado Correctamente : ".$respuesta['error']."</p>
					    </div>";
			}
		}else
		{
			return "<div class='alert alert-error' >
					    <a class='close' data-dismiss='alert'>×</a>
					    <p class='alert-heading'><strong>Lo Siento!</strong>  Este Usuario no tiene permiso para esta acción</p>
					    </div>";
		}	
		
	}
	
	public function buscarRango ()

	{

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
		 $idfuncion = 18;
		// //compruebo si este rango tiene dicho permiso
		 $permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
	
		
		if ($permiso)
		{
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');

			$datos =  $this->rangos->consultar($id,$nombre);

			
			if($datos)
			{
				$resultados['resultados'] = "";	
				foreach ($datos[0] as $row) {
					$info = "nombre='".$row->nombre."' codigo='".$row->id."' href='#' ";
					$resultados['resultados'] .= '<tr class="'.$row->id.'">';
					
					$resultados['resultados'] .= '<td><a '.$info.'  class="id" >'.$row->id.'</a></td>';
					$resultados['resultados'] .= '<td><a '.$info.'  class="nombre" >'.$row->nombre.'</a></td>';
					$resultados['resultados'] .= '<th>
													<center>
													<a class="borrar" href="" title="Borrar" id="'.$row->id.'" >'.img('img/eliminar.png').'</a>
													<a href=""  id="'.$row->id.'" title="Editar" class="editar" >'.img('img/editar.png').'</a>
													</center>
												  </th>';
					$resultados['resultados'] .= '</tr>';
				}
			}else
			{
				$resultados['resultados'] = "<center><td colspan='4'>No se Encuentra Ningun rango</td></center>";
			}
			$resultados['filas'] = $datos[1];
		}else
		{
			$resultados['resultados'] = "<center><td colspan='4'>Lo siento este usuario no tiene permisos para esta acción </td></center>";	
			$resultados['filas'] = 0;
		}

		echo json_encode($resultados);
			
	}

	public function modificar()
	{
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
		 $idfuncion = 19;
		// //compruebo si este rango tiene dicho permiso
		 $permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		
		if ($permiso)
		{
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');


			$respuesta = $this->rangos->editar($id,$nombre);
			if ($respuesta) {

				echo "Datos Actualizados";
			}else
			{
				echo "No se Pudieron Actualizar los Datos";
			}
		}else
		{
			echo "este usuario no tiene permisos para esta acción";
		}
	}

	public function eliminar()
	{
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
		$idfuncion = 20;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		if ($permiso)
		{
			$id = $this->input->post('codigo');
			if ($this->rangos->borrar($id))
			{
				$respuesta["mensaje"] = "Registro Eliminado Correctamente";
				$respuesta["respuesta"] = "true";

			}else
			{
				$respuesta["mensaje"] = "El Registro No se Pudo Insertar";
				$respuesta["respuesta"] = "false";
			}
		}else
		{
			$respuesta["mensaje"] = "Este usuario no tiene permiso para esta acción";
			$respuesta["respuesta"] = "false";
		}
			echo json_encode($respuesta);
		

	}

	public function jsonRangos()
	{
		// extraigo de la session el id del usuario activo
		
			// $id = $this->input->post('id');
			// $nombre = $this->input->post('nombre');

			// $datos =  $this->rangos->consultar($id,$nombre);	
			$nombre 
			$resultados['resultados'] = ""
			
			// if($datos)
			// {
			// 	$resultados['resultados'] = "";	
			// 	foreach ($datos[0] as $row) {
					
			// 	}
			// }else
			// {
			// 	$resultados['resultados'] = "";
			// }
			// $resultados['filas'] = $datos[1];
				

		echo json_encode($resultados);
	}
}

/* End of file rango.php */
/* Location: ./application/controllers/rango.php */