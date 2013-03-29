<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Usuarios extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('usuario');
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
		$this->form_validation->set_rules('usuario', 'Usuario', 'required|min_length[3]|max_length[12]|xss_clean');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required');
		$this->form_validation->set_message('required','El Campo %s es Obligatorio');
		$this->form_validation->set_message('min_length','El Campo %s debe tener mas de 5 caracteres');
		$this->form_validation->set_message('max_length','El Campo %s debe tener menos de 12 caracteres');
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
				    	'id' => $row->id ,
				    	'nombre' =>$row->nombre ,
				    	'usuario' => $row->usuario  
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

		$this->form_validation->set_rules('usuario', 'Usuario', 'required|max_length[12]|xss_clean');
		$this->form_validation->set_rules('clave', 'Contraseña', 'required|xss_clean');

		$this->form_validation->set_rules('rango', 'Rango', 'required|numeric');



		$this->form_validation->set_message('required','El Campo %s es Obligatorio');

		$this->form_validation->set_message('max_length','El Campo %s debe tener menos de 12 caracteres');

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
	}

	public function buscarUsuario ()

	{
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');
		$usuario = $this->input->post('usuario');
		$clave = $this->input->post('clave');
		$rango = $this->input->post('rango');
		
		$datos =  $this->usuario->consultar($id,$nombre,$usuario,$clave,$rango);

		
		if($datos)
		{
			foreach ($datos as $row) {
				$info = "id ='".$row->id."' usuario='".$row->usuario."' clave='".$row->clave."' nombre='".$row->nombre."' rango='".$row->rango."'' href='#' ";
				echo '<tr class="'.$row->id.'">';
				
				echo '<td><a '.$info.'  class="id" >'.$row->id.'</a></td>';
				echo '<td><a '.$info.'  class="nombre" >'.$row->nombre.'</a></td>';
				echo '<td><a '.$info.' class="usuario" >'.$row->usuario.'</a></td>';
				echo '<td><a '.$info.'  class="rango" >'.$row->rango.'</a></td>';
				echo '<td style="display:none"><a '.$info.'  class="clave" >'.$row->clave.'</a></td>';
				echo '<th>
						<center>
						<a class="borrar" href="" title="Borrar" id="'.$row->id.'" >'.img('img/eliminar.png').'</a>
						<a href=""  id="'.$row->id.'" title="Editar" class="editar" >'.img('img/editar.png').'</a>
						</center>
					  </th>';
				echo '</tr>';
			}
		}else
		{
			echo "<center><td colspan='4'>No se Encuentra Ningun Usuario</td></center>";
		}
			
	}

	public function eliminar()
	{
		$id = $this->input->post('id');
		if ($this->usuario->borrar($id))
		{
			echo "Registro Eliminado Correctamente";
		}else
		{
			echo "El Registro No se Pudo Insertar";
		}
	}

	public function modificar()
	{
		$id = $this->input->post('id');
		$nombre = $this->input->post('nombre');
		$usuario = $this->input->post('usuario');
		$clave = $this->input->post('clave');
		$rango = $this->input->post('rango');

		$respuesta = $this->usuario->editar($id,$nombre,$usuario,$clave,$rango);
		if ($respuesta) {

			echo "Datos Actualizados";
		}else
		{
			echo "No se Pudieron Actualizar los Datos";
		}


	}

}/* End of file login.php */

/* Location: ./application/controllers/usuarios/login.php */