<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Llegadas_tarde extends CI_Controller {

	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Bogota");
		$this->load->model('ingresos');
		$this->load->model('estudiantes');
		$this->load->library('email','','correo');
	}
	//vallida el codigo del estudiante para hacer el registro de llegada tarde
	public function validarEstudiante ()
	{	
		$estudiante = $this->input->post('codigo');
		$observaciones = $this->input->post('observaciones');
		$respuesta = $this->estudiantes->consultar($estudiante,null,null,null);
		if($respuesta)
		{
			$this->registrar($estudiante,$observaciones);
		}else
		{
			echo "El Estudiante No esta Registrado";
		}
	}
	// registra las llegadas tarede
	public function registrar($Estudiante,$Observaciones)
	{
		
		$estudiante = $Estudiante;
		$observaciones = $Observaciones;
		$usuarios = $this->session->userdata('id');
		$fecha = date('Y-m-d');
		$hora = date('h:i:s');
		$respuesta = $this->ingresos->insertar($usuarios,$estudiante,$observaciones,$fecha,$hora);

		if($respuesta)
		{

			echo "El Registro se Inserto Correctamente <br>";

		  $this->correo->from('info@santamaria.com', 'Santa Maria de la Paz');
		  $this->correo->to('jdavidg.e@hotmail.com');
		  $this->correo->subject('Andres Lopez Llego tarde');
		  $this->correo->message('<h1>Su hijo llego tarde</h1> <br> Fecha:'.$fecha.'<br>'.'Hora'.$hora);
		if($this->correo->send())
		  {
		   echo 'Correo enviado al acudiente';
		  }

		  else
		  {
		   echo "No se envio el Correo al acudiente <br>";
		  }
		}else
		{
			echo "Error al Insertar el Registro";
		}
	}
	//busca a el estudiante por distintos valores 
	public function buscarEstudiante ()

	{
		$nombres = $this->input->post('nombres');
		$apellidos = $this->input->post('apellidos');
		$grupo = $this->input->post('grupo');
		$datos =  $this->estudiantes->consultar(null,$nombres,$apellidos,$grupo);
		$url = site_url('llegadas_tarde/enviarCodigo/')."/";
		if($datos)
		{
			foreach ($datos as $row) {
				$url = site_url('llegadas_tarde/enviarCodigo/')."/".$row->codigo;
				echo '<tr>';
				
				echo '<td><a href="'.$url.'"  class="es" >'.$row->codigo.'</a></td>';
				echo '<td><a href="'.$url.'"  class="es" >'.$row->nombres.'</a></td>';
				echo '<td><a href="'.$url.'" class="es" >'.$row->apellidos.'</a></td>';
				echo '<td><a href="'.$url.'"  class="es" >'.$row->grd_13.'</a></td>';
				echo '</tr>';
			}
		}else
		{
			echo "<td colspan='4'>No se Encuentra Ningun Estudiante</td>";
		}
	}	
	//enviar el codigo del estudiante al formulario para hacer el registro
	public function enviarCodigo ($codigo)
	{
		$data['codigo']=$codigo;
		$data['titulo'] = "regitrar";
		$this->load->view('includes/cabezera',$data);
		$this->load->view('llegadas_tarde/registrar', $data);
		$this->load->view('includes/pie');
	}
}/* End of file llegadas_tarde.php */
/* Location: ./application/controllers/llegadas_tarde.php */

