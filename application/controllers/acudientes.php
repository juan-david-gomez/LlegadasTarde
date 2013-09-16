
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acudientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('acudiente');
		$this->load->model('estudiante');
		$this->load->model('usuario');
		$this->load->model('rango_funcion');
	}

	public function validar()
	{
		$estudiante = $this->input->post('estudiante');
		$id = $this->input->post('id');
		$apellido = $this->input->post('apellido');
		$nombre = $this->input->post('nombre');
		$email = $this->input->post('email');

		//carga la libreria de validacion de formularios
		$this->load->library('form_validation');

		//pone los el contenedor del mensaje en este caso un div de error
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><p>', '</p></div>'); 

		$this->form_validation->set_rules('estudiante', 'Codigo del Estudiante', 'required|numeric');
		$this->form_validation->set_rules('id', 'Identificacion', 'required|numeric');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('email', 'Email', 'required|valid_email');

		$this->form_validation->set_message('required','El Campo %s es Obligatorio');
		$this->form_validation->set_message('valid_email','El Campo %s Tiene un Email invalido');
		$this->form_validation->set_message('numeric','El Campo %s deve ser Numerico');
			
		if ($this->form_validation->run() == FALSE)
        {


        	$data['titulo'] = "acudiente";
		 	$this->load->view('includes/cabezera',$data);
			$this->load->view("llegadas_tarde/acudientes");
			$this->load->view('includes/pie');

        }
        else
        {

        	if ($this->estudiante->consultar($estudiante,"","","")) 
        	{	
        		$mensaje = $this->insertar($estudiante,$nombre,$apellido,$id,$email);
        	}else
        	{
        		$mensaje = "<div class='alert alert-error' >
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Error!</strong> El Codigo del estudiante No existe</p>
				    </div>";
        	}
        		$data['titulo'] = "acudiente";
        		$data['mensaje'] = $mensaje;
			 	$this->load->view('includes/cabezera',$data);
				$this->load->view("llegadas_tarde/acudientes");
				$this->load->view('includes/pie');

            
        }
	}

	public function insertar($estudiante,$nombre,$apellido,$id,$email)
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
		$idfuncion = 9;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		
		if ($permiso)
		{
			
			$respuesta = $this->acudiente->insertar($estudiante,$nombre,$apellido,$id,$email);
			if ($respuesta == null) {

				return "<div class='alert alert-success' >
					    <a class='close' data-dismiss='alert'>×</a>
					    <p class='alert-heading'><strong>Felicidades!</strong>  El Acudiante fue insertado Correctamente</p>
					    </div>";
			}else if ($respuesta != null)
			{
				return "<div class='alert alert-error' >
					    <a class='close' data-dismiss='alert'>×</a>
					    <p class='alert-heading'><strong>Lo Siento!</strong>  El Acudiante no fue insertado Correctamente : ".$respuesta['error']."</p>
					    </div>";
			}

		}else
		{
			return "<div class='alert alert-error' >
					    <a class='close' data-dismiss='alert'>×</a>
					    <p class='alert-heading'><strong>Lo Siento!</strong> Este usuario no tiene permiso para esta acción</p>
					    </div>";
		}

		


		
	}

	public function buscarAcudiente ()
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
		$idfuncion = 10;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		
		if ($permiso)
		{
			$id = $this->input->post('id');
			$estudiante = $this->input->post('codigo');
			
			
			
			$datos =  $this->acudiente->consutar($id,$estudiante,null,null,null);

			$respuesta['resultados']="";
			if($datos)
			{
				foreach ($datos[0] as $row) {
					$info = "id='".$row->id."'
							 estudiante='".$row->estudiante."' 
							 nombre='".$row->nombre."'
							 apellido='".$row->apellido."'
							 email='".$row->email."' 
							 nombres='".$row->nombres."' 
							 apellidos='".$row->apellidos."'
							 grupo='".$row->grd_13."' 
							 href='#' ";

					$respuesta['resultados'] .= '<tr class="'.$row->id.'">';
					
					$respuesta['resultados'] .= '<td><a '.$info.'  class="id" >'.$row->id.'</a></td>';
					$respuesta['resultados'] .= '<td><a '.$info.'  class="nombre" >'.$row->nombre.'</a></td>';
					$respuesta['resultados'] .= '<td><a '.$info.' class="apellido" >'.$row->apellido.'</a></td>';
					$respuesta['resultados'] .= '<td><a '.$info.'  class="email" >'.$row->email.'</a></td>';
					$respuesta['resultados'] .= '<th>
							<center>
							<a class="borrar" href="" title="Borrar" id="'.$row->id.'" >'.img('img/eliminar.png').'</a>
							<a href=""  id="'.$row->id.'" title="Editar" class="editar" >'.img('img/editar.png').'</a>
							</center>
						  </th>';
					$respuesta['resultados'] .= '</tr>';
					$respuesta['filas'] = $datos[1];
				}
			}else
			{
				$respuesta['resultados'] = "<center><td colspan='4'>No se Encuentra Ningun Acudiante</td></center>";
				$respuesta['filas'] = 0;
			}

		}else
		{
			$respuesta['resultados'] = "<center><td colspan='4'>Este usuario no tiene permiso para esta acción</td></center>";
			$respuesta['filas'] = 0;
		}

		echo json_encode($respuesta);
			
	}
	public function modificar()
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
		$idfuncion = 11;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		
		if ($permiso)
		{
			$estudiante = $this->input->post('estudiante');
			$id = $this->input->post('id');
			$apellido = $this->input->post('apellido');
			$nombre = $this->input->post('nombre');
			$email = $this->input->post('email');

			$respuesta = $this->acudiente->editar($estudiante,$nombre,$apellido,$id,$email);
			
			
			if ($respuesta)
			{
				$respuesta['mensaje'] = "Registro actualizado Correctamente";
				$respuesta['validar'] = "si";
			}else
			{
				$respuesta['mensaje'] = "No se pudo actualizar el registro";
				$respuesta['validar'] = "no";
			}
			
		}else
		{
				$respuesta['mensaje'] = "Este usuario no tiene permiso para esta acción";
				$respuesta['validar'] = "no";
		}

		echo json_encode($respuesta);


	}

	public function eliminar()
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
		$idfuncion = 12;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		
		if ($permiso)
		{
			$id = $this->input->post('id');
			if ($this->acudiente->borrar($id))
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
}

/* End of file acudientes.php */
/* Location: ./application/controllers/acudientes.php */

/* End of file acudientes.php */
/* Location: ./application/controllers/acudientes.php */