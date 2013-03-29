<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Estudiantes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Bogota");
		$this->load->model('estudiante');
			
	}
	
	public function buscarEstudiante ()

	{
		$codigo = $this->input->post('codigo');
		$nombres = $this->input->post('nombre');
		$apellidos = $this->input->post('apellido');
		$grupo = $this->input->post('grupo');
		$datos =  $this->estudiante->consultar($codigo,$nombres,$apellidos,$grupo);

		
		if($datos)
		{
			foreach ($datos as $row) {
				$info = "nombre='".$row->nombres."' apellidos='".$row->apellidos."' grupo='".$row->grd_13."' codigo='".$row->codigo."' sexo='".$row->sexo."'' href='#' ";
				echo '<tr class="'.$row->codigo.'">';
				
				echo '<td><a '.$info.'  class="codigo" >'.$row->codigo.'</a></td>';
				echo '<td><a '.$info.'  class="nombre" >'.$row->nombres.'</a></td>';
				echo '<td><a '.$info.' class="apellido" >'.$row->apellidos.'</a></td>';
				echo '<td><a '.$info.'  class="grupo" >'.$row->grd_13.'</a></td>';
				echo '<td style="display:none"><a '.$info.'  class="sexo" >'.$row->sexo.'</a></td>';
				echo '<th>
						<center>
						<a class="borrar" href="" title="Borrar" id="'.$row->codigo.'" >'.img('img/eliminar.png').'</a>
						<a href=""  id="'.$row->codigo.'" title="Editar" class="editar" >'.img('img/editar.png').'</a>
						</center>
					  </th>';
				echo '</tr>';
			}
		}else
		{
			echo "<center><td colspan='4'>No se Encuentra Ningun Estudiante</td></center>";
		}
			
	}

	public function modificar()
	{
		$codigo = $this->input->post('codigo');
		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido');
		$grupo = $this->input->post('grupo');
		$sexo = $this->input->post('sexo');

		$respuesta = $this->estudiante->editar($codigo,$nombre,$apellido,$grupo,$sexo);
		if ($respuesta) {

			echo "Datos Actualizados";
		}else
		{
			echo "No se Pudieron Actualizar los Datos";
		}


	}

	public function validar()
	{
		$codigo = $this->input->post('Codigo');
		$nombre = $this->input->post('nombre');
		$apellido = $this->input->post('apellido');
		$grupo = $this->input->post('grupo');
		$sexo = $this->input->post('sexo');

		//carga la libreria de validacion de formularios
		$this->load->library('form_validation');

		//pone los el contenedor del mensaje en este caso un div de error
		$this->form_validation->set_error_delimiters('<div class="alert alert-error"><a class="close" data-dismiss="alert">×</a><p>', '</p></div>'); 

		$this->form_validation->set_rules('Codigo', 'Codigo', 'required|numeric');
		$this->form_validation->set_rules('nombre', 'Nombre', 'required');
		$this->form_validation->set_rules('apellido', 'Apellido', 'required');
		$this->form_validation->set_rules('grupo', 'Grupo', 'required|max_length[3]');

		$this->form_validation->set_message('required','El Campo %s es Obligatorio');
		$this->form_validation->set_message('numeric','El Campo %s deve ser Numerico');
	

		$this->form_validation->set_message('max_length','El Campo %s debe tener menos de 3 caracteres');

		if ($this->form_validation->run() == FALSE)
        {


        	$data['titulo'] = "estudiantes";
		 	$this->load->view('includes/cabezera',$data);
			$this->load->view("llegadas_tarde/estudiantes");
			$this->load->view('includes/pie');

        }
        else
        {
            $mensaje = $this->insertar($codigo,$nombre,$apellido,$grupo,$sexo);
           	$data['titulo'] = "estudiantes";
           	$data['mensaje'] = $mensaje;
		 	$this->load->view('includes/cabezera',$data);
			$this->load->view("llegadas_tarde/estudiantes");
			$this->load->view('includes/pie');
        }
	}

	public function insertar($codigo,$nombre,$apellido,$grupo,$sexo)
	{
		
		$respuesta = $this->estudiante->insertar($codigo,$nombre,$apellido,$grupo,$sexo);
		if ($respuesta == null) {

			return "<div class='alert alert-success' >
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Felicidades!</strong>  El Estudiante fue insertado Correctamente</p>
				    </div>";
		}else if ($respuesta != null)
		{
				return "<div class='alert alert-error' >
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Lo Siento!</strong>  El Estudiante no fue insertado Correctamente : ".$respuesta['error']."</p>
				    </div>";
		}
	}
	public function eliminar()
	{
		$id = $this->input->post('codigo');
		if ($this->estudiante->borrar($id))
		{
			echo "Registro Eliminado Correctamente";
		}else
		{
			echo "El Registro No se Pudo Insertar";
		}
	}
}

/* End of file estudiantes.php */
/* Location: ./application/controllers/estudiantes.php */