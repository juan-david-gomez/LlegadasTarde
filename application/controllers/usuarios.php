<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
		$this->load->model('rangos');
		$this->load->model('rango_funcion');
	}

	public function index()
	{
		if ($this->session->userdata('id'))
		{
			redirect('inicio');
		}else
		{
			$this->load->view('login');
		}
	}

	public function validar()
	{
		$usuario = $this->input->post('usuario');
		$clave = $this->input->post('clave');
		$this->load->library('form_validation');
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><p>', '</p></div>'); 
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[3]|max_length[40]|xss_clean');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required');
		$this->form_validation->set_message('required','El Campo %s es Obligatorio');
		$this->form_validation->set_message('min_length','El Campo %s debe tener mas de 5 caracteres');
		$this->form_validation->set_message('max_length','El Campo %s debe tener menos de 40 caracteres');
		if ($this->form_validation->run() == FALSE)
        {
           $this->load->view('login');
        }
        else
        {
           $this->login($usuario,$clave);
        }
	}

	public function login($usuario,$clave)
	{
		if($datos = $this->usuario->entrar($usuario,$clave))
		{
				foreach ($datos as $row)
				{
				    $session = array
				    (
				    	'id' => $row->id 
				    	
				    );
				    $this->session->set_userdata($session);
				}
			redirect('inicio');
		}else
		{
			$msj['error'] = '<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><p>Usuario o Contraseña Icorrectos</p></div>';
			$this->load->view('login', $msj);
		}
	}
	public function logout()
	{
		 $session = array
				    (
				    	'id' => "" ,
				    	'nombre' =>"",
				    	'usuario' => ""  
				    );
		$this->session->unset_userdata($session);
		redirect('usuarios'); 
	}

	public function validarInsercion ()
	{
		
		$nombre = $this->input->post('nombre');
		$usuario = $this->input->post('usuario');
		$clave = $this->input->post('clave');
		$rango = $this->input->post("rango");

		$this->load->library('form_validation');

		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><p>', '</p></div>'); 

		$this->form_validation->set_rules('nombre', 'Nombre', 'required|xss_clean');

		$this->form_validation->set_rules('usuario', 'Usuario', 'required|max_length[40]|xss_clean');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required|xss_clean');

		$this->form_validation->set_rules('rango', 'Rango', 'required|numeric');



		$this->form_validation->set_message('required','El Campo %s es Obligatorio');

		$this->form_validation->set_message('max_length','El Campo %s debe tener menos de 40 caracteres');

		$this->form_validation->set_message('numeric','El Campo %s debe ser de tipo Numerico');

		if ($this->form_validation->run() == FALSE)
        {
           $data['titulo'] = "Usuarios";
		 	$this->load->view('includes/cabezera',$data);
			$this->load->view("llegadas_tarde/usuarios");
			$this->load->view('includes/pie');
        }
        else
        {
           $mensaje = $this->registrar($nombre,$usuario,$clave,$rango);
           $data['titulo'] = "Usuarios";
           $data['mensaje'] = $mensaje;
		   $this->load->view('includes/cabezera',$data);
		   $this->load->view("llegadas_tarde/usuarios");
		   $this->load->view('includes/pie');
        }
		
	}

	public function registrar($nombre,$usuario,$clave,$rango)
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
		$idfuncion = 13;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		
		if ($permiso)
		{
			$respuesta = $this->usuario->insertar($nombre,$usuario,$clave,$rango);
			if ($respuesta) {

				return "<div class='alert alert-success' >
					    <a class='close' data-dismiss='alert'>×</a>
					    <p class='alert-heading'><strong>Felicidades!</strong>  El Usuario fue Insertado Correctamente</p>
					    </div>";
			}else 
			{
				return "<div class='alert alert-error' >
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Lo Siento!</strong>  El Usuario no fue Insertado Correctamente </p>
					</div>";
			}

		}else
		{
			return "<div class='alert alert-error' >
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Lo Siento!</strong> Este usuario no tiene permiso para esta acción </p>
					</div>";
		}
	}

	public function buscarUsuario ()
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
		$idfuncion = 14;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		
		if ($permiso)
		{
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$usuario = $this->input->post('usuario');
			$clave = $this->input->post('clave');
			$rango = $this->input->post('rango');
			
			$datos =  $this->usuario->consultar($id,$nombre,$usuario,$clave,$rango);
			$respuesta['respuesta'] = "";
			
			if($datos)
			{
				foreach ($datos[0] as $row) {
					$info = "id ='".$row->id."' usuario='".$row->usuario."' clave='".$row->clave."' nombre='".$row->nombre."' rango='".$row->rango."'' href='#' ";
					$respuesta['respuesta'] .=  '<tr class="'.$row->id.'">';
					
					$respuesta['respuesta'] .=  '<td><a '.$info.'  class="id" >'.$row->id.'</a></td>';
					$respuesta['respuesta'] .=  '<td><a '.$info.'  class="nombre" >'.$row->nombre.'</a></td>';
					$respuesta['respuesta'] .=  '<td><a '.$info.' class="usuario" >'.$row->usuario.'</a></td>';
					$respuesta['respuesta'] .=  '<td><a '.$info.'  class="rango" >'.$row->rango.'</a></td>';
					$respuesta['respuesta'] .=  '<td style="display:none"><a '.$info.'  class="clave" >'.$row->clave.'</a></td>';
					$respuesta['respuesta'] .=  '<th>
							<center>
							<a class="borrar" href="" title="Borrar" id="'.$row->id.'" >'.img('img/eliminar.png').'</a>
							<a href=""  id="'.$row->id.'" title="Editar" class="editar" >'.img('img/editar.png').'</a>
							</center>
						  </th>';
					$respuesta['respuesta'] .=  '</tr>';
					$respuesta['filas'] = $datos[1];
				}
			}else
			{
				$respuesta['respuesta'] =  "<center><td colspan='4'>No se Encuentra Ningun Usuario</td></center>";
				$respuesta['filas'] = 0;
			}

		}else
		{
				$respuesta['respuesta'] =  "<center><td colspan='4'>Lo siento este usuario no tienpermiso para esta acción</td></center>";
				$respuesta['filas'] = 0;
		}
		echo  json_encode($respuesta);
			
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
		$idfuncion = 16;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		if ($permiso)
		{
			$id = $this->input->post('id');
			if ($this->usuario->borrar($id))
			{
				$respuesta['mensaje'] = "Registro Eliminado Correctamente";
				$respuesta['respuesta'] = "true";
			}else
			{
				$respuesta['mensaje'] = "El Registro No se Pudo Insertar";
				$respuesta['respuesta'] = "false";

			}

		}else
		{
			$respuesta['mensaje'] = "este usuario no tiene permiso para esta acción";
			$respuesta['respuesta'] = "false";
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
		$idfuncion = 16;
		//compruebo si este rango tiene dicho permiso
		$permiso = $this->rango_funcion->validarFuncion($rango,$idfuncion);
		
		if ($permiso)
		{
			$id = $this->input->post('id');
			$nombre = $this->input->post('nombre');
			$usuario = $this->input->post('usuario');
			$clave = $this->input->post('clave');
			$rango = $this->input->post('rango');

			$respuesta = $this->usuario->editar($id,$nombre,$usuario,$clave,$rango);
			if ($respuesta) {

				$respuesta['mensaje'] = "Datos Actualizados";
			}else
			{
				$respuesta['mensaje'] = "No se Pudieron Actualizar los Datos";
			}

		}else
		{
			$respuesta['mensaje'] = "este usuario no tiene permiso para esta acción";
			
		}

		echo json_encode($respuesta);
	}
	public function usuarioSession()
	{
		$id = $this->session->userdata('id'); 
		if ($id==null) 
		{
			//$respuesta['resultaods'] = "No se ah Iniciado ninguna Sesion";
		}else
		{ 
			$datos =  $this->usuario->consultar($id,"","","","");
			if ($datos)
			{
				foreach ($datos[0] as $row) 
				{
					$respuesta['ide'] =  $row->id;
					$respuesta['nombre'] =  $row->nombre;
					$respuesta['usuario'] =  $row->usuario;
					$respuesta['clave'] =  $row->clave;
					$respuesta['rango'] = $row->rango;
								
				}
				echo json_encode($respuesta);
			}
		}
	}
	public function buscarRango ()
	{

		$id = $this->input->post('id');
		$nombre = $this->input->post('nombres');
		
		$datos =  $this->rangos->consultar($id,$nombre);
		$resultados['resultados'] = "";


		
		if($datos)
		{
			foreach ($datos[0] as $row) {
				$info = "nombre='".$row->nombres."'
					 	 id='".$row->id."'
					 	 href='#' ";
				$resultados['resultados'] .= '<tr>';
				
				$resultados['resultados'] .= '<td><a '.$info.'  class="es" >'.$row->id.'</a></td>';
				$resultados['resultados'] .= '<td><a '.$info.'  class="es" >'.$row->nombres.'</a></td>';
				$resultados['resultados'] .= '</tr>';
			}
		$resultados['filas'] = $datos[1];
		
		}else
		{
			$resultados['resultados'] = "<td colspan='4'>No se Encuentra Ningun Rango</td>";
			$resultados['filas'] = 0;
		}
		echo json_encode($resultados);	
	}	

}/* End of file login.php */

/* Location: ./application/controllers/usuarios/login.php */