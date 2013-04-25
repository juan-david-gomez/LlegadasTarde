
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Acudientes extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		$this->load->model('acudiente');
		$this->load->model('estudiante');
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
	}

	public function buscarAcudiente ()

	{
		$id = $this->input->post('id');
		$estudiante = $this->input->post('codigo');
		
		
		
		$datos =  $this->acudiente->consutar($id,$estudiante,null,null,null);

		
		if($datos)
		{
			foreach ($datos as $row) {
				$info = "id='".$row->id."'
						 estudiante='".$row->estudiante."' 
						 nombre='".$row->nombre."'
						 apellido='".$row->apellido."' 
						 email='".$row->email."'' 
						 href='#' ";

				echo '<tr class="'.$row->id.'">';
				
				echo '<td><a '.$info.'  class="id" >'.$row->id.'</a></td>';
				echo '<td><a '.$info.'  class="nombre" >'.$row->nombre.'</a></td>';
				echo '<td><a '.$info.' class="apellido" >'.$row->apellido.'</a></td>';
				echo '<td><a '.$info.'  class="email" >'.$row->email.'</a></td>';
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
			echo "<center><td colspan='4'>No se Encuentra Ningun Acudiante</td></center>";
		}
			
	}
}

/* End of file acudientes.php */
/* Location: ./application/controllers/acudientes.php */

/* End of file acudientes.php */
/* Location: ./application/controllers/acudientes.php */