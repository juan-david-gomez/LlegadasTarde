<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Llegadas_tarde extends CI_Controller {
	
	
	
	public function __construct()
	{
		parent::__construct();
		date_default_timezone_set("America/Bogota");
		$this->load->model('ingresos');
		$this->load->model('estudiante');
		$this->load->model('acudiente');
		$this->load->library('email','','correo');
	
	}
	
	//vallida el codigo del estudiante para hacer el registro de llegada tarde
	public function validarEstudiante ()
	{	
		
		$estudiante = $this->input->post('codigo');
		$respuesta = $this->estudiante->consultar($estudiante,null,null,null);
		$respuestaAcudiente = $this->acudiente->consutar(null,$estudiante,null,null,null) ;
		if($respuesta)
		{
			foreach ($respuesta as $respuesta) 
			{
				$NomEstudiante = $respuesta->nombres;
				$ApeEstudiante = $respuesta->apellidos;
				$GrupEstudiante = $respuesta->grd_13;
			}
			$xmlE = "<estudiante>
						<nombre>$NomEstudiante</nombre>
						<apellido>$ApeEstudiante</apellido>
						<grupo>$GrupEstudiante</grupo>
						<existencia>si</existencia>
					</estudiante>";
		}else 
		{
			$xmlE = "<estudiante>
						<nombre>El Estudiante no Existe</nombre>
						<apellido>El Estudiante no Existe</apellido>
						<grupo>El Estudiante no Existe</grupo>
						<existencia>no</existencia>
					</estudiante>";
			
			
		}

		if ($respuestaAcudiente) 
			{
				foreach ($respuestaAcudiente as $respuestaAcudiente) 
				{
				$idAcudiente = $respuestaAcudiente->id;
				$nombreAcudiente = $respuestaAcudiente->nombre;
				$apellidoAcudiente = $respuestaAcudiente->apellido;
				$emailAcudiente = $respuestaAcudiente->email;
				}
			$xmlA = "<acudiente>
						<nombre>$nombreAcudiente</nombre>
						<apellido>$apellidoAcudiente</apellido>
						<email>$emailAcudiente</email>
						<existencia>si</existencia>
					</acudiente>";
			}else
			{
			$xmlA = "<acudiente>
						<nombre>Acudiente no Registrado</nombre>
						<apellido>Acudiente no Registrado</apellido>
						<email>Acudiente no Registrado</email>
						<existencia>no</existencia>
					</acudiente>";
			}


		$xml = "<xml version=\"1.0\" encoding=\"utf-8\">
					$xmlA
					$xmlE
				</xml>";
		echo $xml;
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

				$mensaje = $this->enviarCorreo($estudiante);

				echo "<div class='alert alert-success' >
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Felicidades!</strong>  El registro fue exitoso | ".$mensaje."</p>
				    </div>";

			

			}else
			{
				$mensaje = $this->enviarCorreo($estudiante);
				echo "<div class='alert alert-error'>
				    <a class='close' data-dismiss='alert'>×</a>
				    <p class='alert-heading'><strong>Lo Siento</strong>  Erro al Hacer el Registro|".$mensaje."</p>
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
		$datos =  $this->estudiante->consultar(null,$nombres,$apellidos,$grupo);

		
		if($datos)
		{
			foreach ($datos as $row) {
				$info = "nombre='".$row->nombres."'
					 	 apellido='".$row->apellidos."'
					 	 grupo='".$row->grd_13."'
					 	 codigo='".$row->codigo."'
					 	 href='#' ";
				echo '<tr>';
				
				echo '<td><a '.$info.'  class="es" >'.$row->codigo.'</a></td>';
				echo '<td><a '.$info.'  class="es" >'.$row->nombres.'</a></td>';
				echo '<td><a '.$info.' class="es" >'.$row->apellidos.'</a></td>';
				echo '<td><a '.$info.'  class="es" >'.$row->grd_13.'</a></td>';
				echo '</tr>';
			}
		}else
		{
			echo "<td colspan='4'>No se Encuentra Ningun Estudiante</td>";
		}
			
	}	

	//buscar ingresos
	public function buscarIngresos()
	{
		$id =  $this->input->post('id');
		$usuario = $this->input->post('usuario');
		$nombres = $this->input->post('nombres');
		$apellidos = $this->input->post('apellidos');
		$grd_13 = $this->input->post('grd_13');
		$observaciones = $this->input->post('observaciones');
		$fecha = $this->input->post('fecha');
		$hora = $this->input->post('hora');
		$fechaI = $this->input->post('fechaI');
		$fechaF = $this->input->post('fechaF');

		$datos =  $this->ingresos->consutar($id,$usuario,$nombres,$apellidos,$grd_13,$observaciones,$fecha,$hora,$fechaI,$fechaF,"");
		
		if($datos)
		{
			foreach ($datos as $row) {
				
				echo '<tr class="'.$row->id.'">';
				
				echo '<td class="codigo">'.$row->codigo.'</td>';
				echo '<td class="nombre">'.$row->nombres.'</td>';
				echo '<td class="apellido">'.$row->apellidos.'</td>';
				echo '<td class="grupo">'.$row->grd_13.'</td>';
				echo '<td class="fecha">'.$row->fecha.'</td>';
				echo '<td class="hora">'.$row->hora.'</td>';
				echo '<td style="display:none" class="observaciones">'.$row->observaciones.'</td>';
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
			echo "<td colspan='7'>No se Encuentra Ningun Registro</td>";
		}
	}
	public function eliminar()
	{
		$id = $this->input->post('id');
		if ($this->ingresos->eliminar($id))
		{
			echo "Registro Eliminado Correctamente";
		}else
		{
			echo "El Registro No se Pudo Insertar";
		}
	}
	public function editar()	
	{
		$id = $this->input->post('id');
		$estudiante = $this->input->post('estudiante');
		$observaciones = $this->input->post('observaciones');
		$resul = $this->ingresos->actualizar($id,$estudiante,$observaciones);
		
		if ($resul)
		{
			echo "si";
		}else
		{
			echo "no";
		}
	}
	public function enviarCorreo($estudiante)
	{
		 $respuestaAcudiente = $this->acudiente->consutar(null,$estudiante,null,null,null);
		 if ($respuestaAcudiente) 
		 {
		 	foreach ($respuestaAcudiente as $acudiente) {
		 		$correo = $acudiente->email;
		 	}
		 }
		 $datos =  $this->ingresos->consutar(null,null,null,null,null,null,null,null,null,null,$estudiante);
		if($datos)
		{
			foreach ($datos as $row) {
								
				$codigo = $row->codigo;
				$nombre = $row->nombres;
				$apellido = $row->apellidos;
				$grupo = $row->grd_13;
				$fecha = $row->fecha;
				$hora = $row->hora;
				$observaciones = $row->observaciones;
			}
			 $mensaje = "<h1>Colegio VID</h1>
			 			<h4>Se Informa que el estudiante ah Llegado Tarde</h4> 
			 			<p>Codigo: ".$codigo."</p>
			 			<p>Nombre: ".$nombre." ".$apellido."</p>
			 			<p>Grupo: ".$grupo."</p>
			 			<p>Fecha: ".$fecha."</p>
			 			<p>Hora: ".$hora."</p>";

			  $this->correo->from('info@santamaria.com', 'colegio VID');
			  $this->correo->to($correo);
			  $this->correo->subject('Colegio VID');
			  $this->correo->message($mensaje);
			if($this->correo->send())
			  {
			  	return 'Correo enviado al acudiente';
			  }
			  else
			  {
			   	return "No se envio el Correo al acudiente ";
			  }
		
		}
			 
	}
}/* End of file llegadas_tarde.php */
/* Location: ./application/controllers/llegadas_tarde.php */

