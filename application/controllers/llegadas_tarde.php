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
			foreach ($respuesta[0] as $respuesta) 
			{
				$NomEstudiante = $respuesta->nombres;
				$ApeEstudiante = $respuesta->apellidos;
				$GrupEstudiante = $respuesta->grd_13;
			}
			$Destudiante['nombre'] = $NomEstudiante;
			$Destudiante['apellido'] =$ApeEstudiante;
			$Destudiante['grupo'] =$GrupEstudiante;
			$Destudiante['existencia'] ="si";
			
		}else 
		{
			$Destudiante['nombre'] = "El estudiante no Existe";
			$Destudiante['apellido'] ="El estudiante no Existe";
			$Destudiante['grupo'] ="El estudiante no Existe";
			$Destudiante['existencia'] ="no";
			
			
		}

		if ($respuestaAcudiente) 
			{
				foreach ($respuestaAcudiente[0] as $respuestaAcudiente) 
				{
				$idAcudiente = $respuestaAcudiente->id;
				$nombreAcudiente = $respuestaAcudiente->nombre;
				$apellidoAcudiente = $respuestaAcudiente->apellido;
				$emailAcudiente = $respuestaAcudiente->email;
				}

				$Dacudiente['nombre'] = $nombreAcudiente;
				$Dacudiente['apellido'] =$apellidoAcudiente;
				$Dacudiente['email'] =$emailAcudiente;
				$Dacudiente['existencia'] ="si";
			
			}else
			{
				$Dacudiente['nombre'] = "Acudiente no Registrado";
				$Dacudiente['apellido'] ="Acudiente no Registrado";
				$Dacudiente['email'] ="Acudiente no Registrado";
				$Dacudiente['existencia'] ="no";
		
			}

			$AcudienteEstudiante['acudiente'] = $Dacudiente;
			$AcudienteEstudiante['estudiante'] = $Destudiante;

			echo json_encode($AcudienteEstudiante);
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
		$resultados['resultados'] = "";
		
		if($datos)
		{
			foreach ($datos[0] as $row) {
				$info = "nombre='".$row->nombres."'
					 	 apellido='".$row->apellidos."'
					 	 grupo='".$row->grd_13."'
					 	 codigo='".$row->codigo."'
					 	 href='#' ";
				$resultados['resultados'] .= '<tr>';
				
				$resultados['resultados'] .= '<td><a '.$info.'  class="es" >'.$row->codigo.'</a></td>';
				$resultados['resultados'] .= '<td><a '.$info.'  class="es" >'.$row->nombres.'</a></td>';
				$resultados['resultados'] .= '<td><a '.$info.' class="es" >'.$row->apellidos.'</a></td>';
				$resultados['resultados'] .= '<td><a '.$info.'  class="es" >'.$row->grd_13.'</a></td>';
				$resultados['resultados'] .= '</tr>';
			}
		$resultados['filas'] = $datos[1];
		
		}else
		{
			$resultados['resultados'] = "<td colspan='4'>No se Encuentra Ningun Estudiante</td>";
			$resultados['filas'] = $datos[1];
		}
		echo json_encode($resultados) ;	
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
		$codigo = $this->input->post('codigo');

		$datos =  $this->ingresos->consutar($id,$usuario,$nombres,$apellidos,$grd_13,$observaciones,$fecha,$hora,$fechaI,$fechaF,$codigo);
		
		if($datos)
		{
			$resultados['resultados'] = "";
			foreach ($datos[0] as $row) {
				
				$resultados['resultados'] .= '<tr class="'.$row->id.'">';
				
				$resultados['resultados'] .= '<td class="codigo">'.$row->codigo.' </td>';
				$resultados['resultados'] .= '<td class="nombre">'.$row->nombres.'</td>';
				$resultados['resultados'] .= '<td class="apellido">'.$row->apellidos.'</td>';
				$resultados['resultados'] .= '<td class="grupo">'.$row->grd_13.'</td>';
				$resultados['resultados'] .= '<td class="fecha">'.$row->fecha.'</td>';
				$resultados['resultados'] .= '<td class="hora">'.$row->hora.'</td>';
				$resultados['resultados'] .= '<td style="display:none" class="observaciones">'.$row->observaciones.'</td>';
				$resultados['resultados'] .= '<th>
						<center>
						<a class="borrar" href="" title="Borrar" id="'.$row->id.'" >'.img('img/eliminar.png').'</a>
						<a href=""  id="'.$row->id.'" title="Editar" class="editar" >'.img('img/editar.png').'</a>
						</center>
					  </th>';
				$resultados['resultados'] .= '</tr>';

				
			}
			$resultados['filas'] = $datos[1];
			
		}else
		{ 
			 $resultados['resultados']=  "<td colspan='7'>No se Encuentra Ningun Registro</td>";
			 $resultados['filas'] = 0;
		}

		echo json_encode($resultados);
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
		 	foreach ($respuestaAcudiente[0] as $acudiente) {
		 		$correo = $acudiente->email;
		 	}
		 }
		 $datos =  $this->ingresos->consutar(null,null,null,null,null,null,null,null,null,null,$estudiante);
		if($datos)
		{
			foreach ($datos[0] as $row) {
								
				$codigo = $row->codigo;
				$nombre = $row->nombres;
				$apellido = $row->apellidos;
				$grupo = $row->grd_13;
				$fecha = $row->fecha;
				$hora = $row->hora;
				$observaciones = $row->observaciones;
			}
			$datosEmail = array('codigo' => $codigo,
								'nombre' =>$nombre,
								'apellido' => $apellido,
								'grupo' => $grupo,
								'fecha' => $fecha,
								'hora' => $hora );

			 $mensaje = $this->load->view('includes/email', $datosEmail, true);

			  $this->correo->from('info@santamaria.com', 'Colegio VID');
			  $this->correo->to($correo);
			  $this->correo->subject('Llegada Tarde');
			  $this->correo->message($mensaje);
			if($this->correo->send())
			  {
			  	return 'Correo enviado al acudiente';
			  }
			  else
			  {
			  	 $error =  $this->correo->print_debugger();
			   	return "No se envio el Correo al acudiente ".$error;
			  }
		
		}
			 
	}
}/* End of file llegadas_tarde.php */
/* Location: ./application/controllers/llegadas_tarde.php */

