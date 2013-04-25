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
						<input type="button" value="Buscar Estudiante" id="" class="btn Ebuscar">

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
						<input type="button" value="Buscar Estudiante" id="" class="btn Ebuscar">
			 		</form>
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




<script type="text/javascript">
$(function() {
	//activa las pestañas del Estudiantes
	$("#tabs").tabs();

	$('#estudiantes').dialog({
		autoOpen: false,
		title:"Buscar un Estudiante",
		height: 470,
		width: 680,
		modal: true

	});

	$(".Ebuscar").click(function () {
		$("#estudiantes").dialog('open');
	});

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
		   	$('#datosEstudiantes').html(data);
		  });

	});
	//envia el codigo del estudinate en la lista a el campo para hacer el registro
	$(document).delegate(".es","click",function() {
		$("#Aestudiante").val($(this).attr('codigo'));
		$("#Ecodigo").val($(this).attr('codigo'));
		
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

	$("#buscarA").click(function() {

		var codigo = $("#Ecodigo").val();
		var id = $("#Aidentificacion").val();

		$.post("<?php echo site_url('acudientes/buscarAcudiente') ?>", {id:id,codigo:codigo},
		  function(data){
		  	$('#datosAcudientes').html(data);
		  });
	})
})

</script>