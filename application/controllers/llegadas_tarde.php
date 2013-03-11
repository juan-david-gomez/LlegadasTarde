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
		$respuesta = $this->estudiantes->consultar($estudiante,null,null,null);
		if($respuesta)
		{
			foreach ($respuesta as $respuesta) {

				
					$NomEstudiante = $respuesta->nombres;
					$ApeEstudiante = $respuesta->apellidos;
					$GrupEstudiante = $respuesta->grd_13;
				}

			$xml = "<xml version=\"1.0\" encoding=\"utf-8\">
					<estudiante>
					<nombre>$NomEstudiante</nombre>
					<apellido>$ApeEstudiante</apellido>
					<grupo>$GrupEstudiante</grupo>
					<existencia>si</existencia>
					</estudiante>
					</xml>";
			echo $xml;
		
			
			//$this->registrar($estudiante);
		}else 
		{
			$xml = "<xml version=\"1.0\" encoding=\"utf-8\">
					<estudiante>
					<nombre>El Estudiante no Existe</nombre>
					<apellido>El Estudiante no Existe</apellido>
					<grupo>El Estudiante no Existe</grupo>
					<existencia>no</existencia>
					</estudiante>
					</xml>";
			
			echo $xml;
		}
	}
	// registra las llegadas tarede
	public function registrar()
	{
		$Estudiante = $this->input->post('codigo');
		$validacion = $this->input->post('validar');

		if ($validacion == "true")
		{ 
			$estudiante = $Estudiante;
			$usuarios = $this->session->userdata('id');
			$fecha = date('Y-m-d');
			$hora = date('h:i:s');
			$respuesta = $this->ingresos->insertar($usuarios,$estudiante,"",$fecha,$hora);

			if($respuesta)
			{

				echo "<div class='alert alert-success' >
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Felicidades!</strong>  El registro fue exitoso</p>
				    </div>";

			  $this->correo->from('info@santamaria.com', 'Santa Maria de la Paz');
			  $this->correo->to('jdavidg.e@hotmail.com');
			  $this->correo->subject('Andres Lopez Llego tarde');
			  $this->correo->message('<h1>Su hijo llego tarde</h1> <br> Fecha:'.$fecha.'<br>'.'Hora'.$hora);
			// if($this->correo->send())
			//   {
			//   	echo 'Correo enviado al acudiente';
			//   }
			//   else
			//   {
			//    	echo "No se envio el Correo al acudiente ";
			//   }

			}else
			{
				echo "<div class='alert alert-error'>
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Lo Siento</strong>  Erro al Hacer el Registro</p>
				    </div>";
			}
		}else
		{
			echo "<div class='alert alert-error' >
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Lo Siento</strong>  El Estudiante no ha sido Validado</p>
				    </div>";
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

	//buscar ingresos
	public function buscarIngresos()
	{

		
		$usuario = $this->input->post('usuario');
		$nombres = $this->input->post('nombres');
		$apellidos = $this->input->post('apellidos');
		$grd_13 = $this->input->post('grd_13');
		$observaciones = $this->input->post('observaciones');
		$fecha = $this->input->post('fecha');
		$hora = $this->input->post('hora');
		$fechaI = $this->input->post('fechaI');
		$fechaF = $this->input->post('fechaF');

		$datos =  $this->ingresos->consutar(null,$usuario,$nombres,$apellidos,$grd_13,$observaciones,$fecha,$hora,$fechaI,$fechaF);
		
		if($datos)
		{
			foreach ($datos as $row) {
				
				echo '<tr>';
				
				echo '<td>'.$row->codigo.'</td>';
				echo '<td>'.$row->nombres.'</td>';
				echo '<td>'.$row->apellidos.'</td>';
				echo '<td>'.$row->grd_13.'</td>';
				echo '<td>'.$row->fecha.'</td>';
				echo '<td>'.$row->hora.'</td>';
				echo '<th>
						<a href="#" title="" class="borrar">Borrar</a>
						<a href="#" title="" class="editar">Ver</a>
					  </th>';
				echo '</tr>';
			}
		}else
		{
			echo "<td colspan='7'>No se Encuentra Ningun Registro</td>";
		}
	}
}/* End of file llegadas_tarde.php */
/* Location: ./application/controllers/llegadas_tarde.php */

