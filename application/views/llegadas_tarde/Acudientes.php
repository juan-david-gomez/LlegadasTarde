<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<center><h1>Acudientes</h1></center>
			<div id="tabs">
			 	<ul>
			 		<li><a href="#tabs-1" >Insertar Acudiente</a></li>
			 		<li><a href="#tabs-2" >Buscar Acudiente</a></li>
			 		

			 	</ul>
			 	<div id="tabs-1">
			 		<form action="<?php echo site_url('acudientes/validar') ?>" method="post" class="well" id="InsertAcudiente">
			 			<div id="mensaje">

			 					<?php if(isset($mensaje)){echo $mensaje;} ?>
						 		<?php echo validation_errors(); ?>
						  		
			 			</div>
			 			<h2 align="center">Registrar un Acudiente</h2>
			 			<br>
			 			
			 				<center>
			 			<input type="text" name="estudiante" id="Aestudiante" placeholder="Codigo Estudiante" class = "span5" value="<?php echo set_value('estudiante'); ?>">

			 			<input type="text" name="id" id="Aid" placeholder="Identificacion Acudiente" class="span5" value="<?php echo set_value('id'); ?>">
			 			</center>
			 			
			 			<input type="text" name="nombre" id="Anombre" placeholder="Nombre" class="span4" value="<?php echo set_value('nombre'); ?>">

						<input type="text" name="apellido" id="Aapellido" placeholder="Apellido" class="span4" value="<?php echo set_value('apellido'); ?>">

						<input type="text" name="email" id="Aemail" class="span4" placeholder="Email" value="<?php echo set_value('email'); ?>">
					
						<br>
						<input type="submit" value="Insertar" id="Einsertar" class="btn">
						<input type="button" value="Limpiar" id="Elimpiar" class="btn">
						<input type="button" value="Buscar Estudiante" id="1" class="btn Ebuscar">

			 		</form>
					
			 	</div>
			 	<div id="tabs-2">
			 		<form action="" method="post" class="well">
			 			<h2 align="center">Buscar Estudiante o Acudiente</h2>
			 			<br>
			 			<center>
			 			
			 			<input type="text" name="estudiante" id="Ecodigo" placeholder="Codigo Estudiante" class = "span5">
			 			

			 			<input type="text" name="id" id="Aidentificacion" placeholder="Identificacion Acudiente" class="span5">
			 			</center>
			 			
						<br>
						<input type="button" value="Buscar" id="buscarA" class="btn">
						<input type="button" value="Limpiar" id="limpiarA" class="btn">
						<input type="button" value="Buscar Estudiante" id="2" class="btn Ebuscar">
			 		</form>
			 	</div>
			 		<div id="contador" style="text-align: center;">
						Numero de Registros:<strong id="filas"></strong>

					</div>
			 	<table class="table table-striped">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>Identificacion</th>
								<th>Nombre</th>
								<th>Apellido</th>
								<th>Email</th>
								<th>Acciones</th>
								</tr>
								</thead>
								<tbody id="datosAcudientes">
								

								</tbody>
    			</table>
			</div><!-- tabs -->

				
		</section>
	</div>
</div>


<!-- Dialogo para Buscar Estudiante  -->

					<div id="estudiantes" style="display:none" >
						<center><h1>Buscar un Estudiante</h1></center>
						<br>
						<input type="text" name="nombre" id="nombreE" placeholder="Nombre">
						

						<input type="text" name="apellido" id="apellidoE" placeholder="Apellido">
						
						
						<input type="text" name="grupo" id="grupoE" class="span2" placeholder="Grupo">
						<br>
						<input type="button" value="Buscar" id="Busqueda" class="btn">
						<input type="button" value="Limpiar" id="Limpiar" class="btn">
						<br><br>
					<div id="contador" style="text-align: center;">
						Numero de Registros:<strong id="Filas"></strong>

					</div>
						    <table class="table ">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>Codigo</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Grupo</th>
								</tr>

								</thead>
								<tbody id="datosEstudiantes">
									
								</tbody>
    						</table>
    						<hr>
					
						<input type="button" value="Cancelar" id="cerrar" class="btn">
					</div> 


<!-- dialogo para editar los acudiantes  -->

	<div id="DilogoEditar" style="display:none" >
						<center><h1>Editar Acudientes</h1></center>
						<div style="height:301px;width:470px">
							<div style="float:left;">
								<h4>Estudiante</h4>
								<label><strong>Codigo</strong></label>
								<input type="text" id="Ecodigos" readonly="readonly">
								<label><strong>Nombre</strong></label>
								<input type="text" id="Enombre" readonly="readonly">
								<label><strong>Apellido</strong></label>
								<input type="text" id="Eapellidos" readonly="readonly">
								<label><strong>Grupo</strong></label>
								<input type="text" id="Egrupo" readonly="readonly">
							</div>
							<div style="float:right;width:200px">
								<h4>Acudiente</h4>
								<label><strong>Id</strong></label>
								<input type="text" id="DialogId" readonly="readonly"
								<label><strong>Nombre</strong></label>
								<input type="text" id="DialogNombre">  					
								<label><strong>Apellido</strong></label>
								<input type="text" id="DialogApellido">
								<label><strong>Email</strong></label>
								<input type="text" id="DialogEmail">
							</div>
						</div>
						<hr>
						<input type="button" value="Editar" id="editar" class="btn">
						<input type="button" value="Cancelar" id="cancelar" class="btn">
						<input type="button" value="Buscar Estudiante" id="3" class="btn Ebuscar">
					</div> 


<script type="text/javascript">
$(function() {

	//variable global para identificar el boton del cual se llama ala busqueda de estudiantes
	var idBotonEstudiantes;

	//activa las pestañas del Estudiantes
	$("#tabs").tabs();

	//define cuadro de dialogo para busqueda de estudiantes
	$('#estudiantes').dialog({
		autoOpen: false,
		title:"Buscar un Estudiante",
		height: 470,
		width: 680,
		modal: true

	});

	//define cuadro de dialogo para la edicion de acudientes
	$('#DilogoEditar').dialog({
		autoOpen: false,
		height: 500,
		title:"Editar Acudiente",
		width: 520,
		modal: true,
		

	});

	//boton cancelar de cuadro de dialogo de edicion de acudientes
	$("#cancelar").click(function  () {
		$("#DilogoEditar").dialog('close');
	});

	//clase que llama al cuadro de dialogo para buscar estudiantes 
	$(".Ebuscar").click(function () {
		$("#estudiantes").dialog('open');
		//se toma el id del boton y se envia el valor a la variable global para identificar el boton
		var id = $(this).attr('id');
		
		idBotonEstudiantes = id;
	});

	//boton cerrar de el cuadro de dialogo de buscar estudiantes
	$('#cerrar').click(function(){
		$('#estudiantes').dialog('close');
	});
	//envia los datos de de la busqueda de los estudiantes
	$('#Busqueda').click(function () {
		var nombres = $('#nombreE').val();
		
		var apellidos = $('#apellidoE').val();
		
		var grupo = $('#grupoE').val();
		
		$.post("<?php echo site_url('llegadas_tarde/buscarEstudiante') ?>", { nombres: nombres, apellidos: apellidos,grupo:grupo},
		  function(data){
		   	$('#datosEstudiantes').html(data.resultados);
		   	$("#Filas").html(data.filas);
		  },"json");

	});
	//envia el codigo del estudinate en la lista a el campo para hacer el registro
	$(document).delegate(".es","click",function() {

		var Codigo = $(this).attr('codigo');
		var nombre = $(this).attr('nombre');
		var apellido = $(this).attr('apellido');
		var grupo = $(this).attr('grupo');

		if (idBotonEstudiantes == 1) 
		{
			$("#Aestudiante").val(Codigo);
		}else if (idBotonEstudiantes == 2) 
		{
			$("#Ecodigo").val(Codigo);
		}else if (idBotonEstudiantes == 3) 
		{
			$("#Ecodigos").val(Codigo);
			$("#Enombre").val(nombre);
			$("#Eapellidos").val(apellido);
			$("#Egrupo").val(grupo);
		};
		
		
		
		$('#estudiantes').dialog('close');
		return false;
	});
	// funcionalidad del boton Elimpiar del cuadro de busqueda de acudientes
	$("#Limpiar").click(function() {
		$('#nombreE').val("");
		
		$('#apellidoE').val("");
		
		$('#grupoE').val("");
	});

	$("#Elimpiar").click(function() {
		$('#Aestudiante').val("");
		
		$('#Anombre').val("");
		$('#Aapellido').val("");
		$('#Aid').val("");
		$('#Aemail').val("");
	});

	$("#limpiarA").click(function() {
		$('#Ecodigo').val("");
		
		
		$('#Aidentificacion').val("");
		
	});

	//boton buscar acudiantes
	$("#buscarA").click(function() {

		var codigo = $("#Ecodigo").val();
		var id = $("#Aidentificacion").val();

		$.post("<?php echo site_url('acudientes/buscarAcudiente') ?>", {id:id,codigo:codigo},
		  function(data){
		  	
		  	$('#datosAcudientes').html(data.resultados);
		  	$("#filas").html(data.filas);
		  },"json");
	})

	//boton de editar en las acciones del registros
	$(document).delegate('.editar',"click",function () {
			//datos Acudientes
			var id = $(this).attr('id');
			var codigo = $("."+id+"  .id").html();
			var nombre = $("."+id+"  .nombre").html();
			var apellido = $("."+id+"  .apellido").html();
			var email = $("."+id+"  .email").html();
			
			//datos estudiante
			var estudiante = $("."+id+"  .id").attr('estudiante');
			var nombres = $("."+id+"  .id").attr('nombres');
			var apellidos = $("."+id+"  .id").attr('apellidos');
			var grupo = $("."+id+"  .id").attr('grupo');
			
			$("#DialogId").val(codigo);
			$("#DialogNombre").val(nombre);
			$("#DialogApellido").val(apellido);
			$("#DialogEmail").val(email);

			$("#Ecodigos").val(estudiante);
			$("#Enombre").val(nombres);
			$("#Eapellidos").val(apellidos);
			$("#Egrupo").val(grupo);
			
		
			//abre el dialogo de editar
			$('#DilogoEditar').dialog('open');
		
			return false;
		})

	//boton del cuadro de edicion de acudientes Boton Editar
	$('#editar').click(function () {
			var estudiante = $("#Ecodigos").val();
			var id = $("#DialogId").val();
			var nombre = $("#DialogNombre").val();
			var apellido = $("#DialogApellido").val();
			var email = $("#DialogEmail").val();
				
			$.post("<?php echo site_url('acudientes/modificar') ?>",{
				  estudiante:estudiante,
				  id: id,
				  apellido:apellido,
				  nombre:nombre,
				  email:email
				},
			  function(data){
			  	
		  		if (data.validar == "si") {

		  			$("."+id+"  .id").html(id);
					$("."+id+"  .nombre").html(nombre);
					$("."+id+"  .apellido").html(apellido);
					$("."+id+"  .email").html(email);
					
		  		}
		  			alert(data.mensaje);
			  }, "json");
			$("#DilogoEditar").dialog('close');
			return false;
		});

		//boton para eliminar acudiantes 
		$(document).delegate('.borrar',"click",function () {

			var id = $(this).attr('id');

			var res = confirm('Esta seguro Que dese eliminar el Registros ?');
			if (res ==  true)
			{
				
			$.post("<?php echo site_url('acudientes/eliminar') ?>",
				{
				  id: id
				},
			 	  function(data){
		  		alert(data.mensaje); 
		  		resEliminacion = data.respuesta;
				
				if (resEliminacion == "true") 
				{
					$('.'+id).hide();
				}
			  }, "json");
			}
			return false;
			
		});
})

</script>