<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<center><h1>USUARIOS</h1></center>
			<div id="tabs">
			 	<ul>
			 		<li><a href="#tabs-2" >Insertar Usuarios</a></li>
			 		<li><a href="#tabs-1" >Buscar Usuarios</a></li>
			 		
			 	</ul>
			 	
			 	<div id="tabs-2">
			 		<form action="<?php echo site_url('usuarios/validarInsercion') ?>" method="post" class="well" id="InsertEstudiante">
			 			<div id="mensaje">

			 					<?php if(isset($mensaje)){echo $mensaje;} ?>
						 		<?php echo validation_errors(); ?>
						  		
			 			</div>
			 			<h2 align="center">Registrar un Usuario</h2>
			 			<br>
			 			<center>
			 			<input type="text" name="nombre" id="Unombre" placeholder="Nombre" class="span4" value="<?php echo set_value('nombre'); ?>">
						</center>
						<input type="text" name="usuario" id="Uusuario" placeholder="Usuario" class="span4" value="<?php echo set_value('usuario'); ?>">

						<input type="password" name="clave" id="Uclave" class="span4" placeholder="Contraseña" class="span4" value="<?php echo set_value('clave'); ?>" style="text-align: center;">
						
						<input type="text" name="rango" id="Urango"  placeholder="Rango" class="span4" value="<?php echo set_value('rango'); ?>" >
							 
					
						<br>
						<input type="submit" value="Insertar" id="Uinsertar" class="btn">
						<input type="button" value="Limpiar" id="Ulimpiar" class="btn">
						<input type="button" value="Buscar Rangos" id="RBuscar" class="btn">
			 		</form>
			 	</div>
			 	<div id="tabs-1">
			 		<form action="" method="post" class="well">
			 			<h2 align="center">Buscar Por Nombre y Codigo</h2>
			 			<br>
			 			<center>
			 			<input type="text" name="id" id="idU" placeholder="Id">
			 			</center>
			 		
			 			<input type="text" name="nombre" id="nombreU" placeholder="Nombre" class="span4">
						<input type="text" name="usuario" id="usuarioU" placeholder="Usuario" class="span4">
						<input type="password" name="clave" id="claveU" class="span4" placeholder="Contraseña" style="text-align: center;">
						<br>
						<input type="button" value="Buscar" id="buscarU" class="btn">
						<input type="button" value="Limpiar" id="limpiar" class="btn">
						
			 		</form>
			 	</div>
			 		<div id="contador" style="text-align: center;">
						Numero de Registros:<strong id="filas"></strong>

					</div>
			 	<table class="table table-striped">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>Id</th>
								<th>Nombre</th>
								<th>Usuaruario</th>
								<th>Rango</th>
								<th>Acciones</th>
								</tr>
								</thead>
								<tbody id="datosUsuarios">
								

								</tbody>
    			</table>
			</div><!-- tabs -->

				
		</section>
	</div>
</div><!-- row fluid -->
<!-- dialogo para editar los usuarios  -->
<div class="Dialogeditar" style="display:none">
	<h1 align="center">Editar  Usuario</h1>
	<hr>
	<form action=""  id="modify" class="" method="post">
		<div style="width:450px;height:100px">
				<div style="float:right;width:200px">
					
					Usuario:
					<input type="text" id="UDusuario" value="" >	
					Nombre:
					<input type="text" id="UDnombre" value="" >
							
					<br>
					<br>
					<div>
						<input type="button" id="modificar" value="Modificar" class="btn">
						<input type="button" id="cancelar" value="Cancelar" class="btn">
					</div> 

				</div >
				<div style="float:left;width:230px">
					Id:
					<input type="text" id="UDid" value=""  >

					Contraseña:
					<input type="password" id="UDclave" value="" style="text-align: center;">

					Rango:
					<input type="text" id="UDrango" value="" >
				
				</div>
		</div>
		
	</form>
</div>			
<!-- dialogo para buscar los rangos  -->
<div id="rangos" style="display:none" >
						<center><h1>Buscar un Rango</h1></center>
						<br>
						<input type="text" name="nombre" id="id" placeholder="Identificación">
						<input type="text" name="nombre" id="nombreR" placeholder="Nombre">
						
						<br>
						<input type="button" value="Buscar" id="Busqueda" class="btn">
					
						<br><br>
					<div id="contador" style="text-align: center;">
						Numero de Registros:<strong id="Filas"></strong>

					</div>
						    <table class="table ">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>id</th>
								<th>Nombre</th>
								</tr>

								</thead>
								<tbody id="datosrangos">
									
								</tbody>
    						</table>
    						<hr>
					
						<input type="button" value="Cancelar" id="cerrar" class="btn">
					</div> 	
<script type="text/javascript">
$(function() {
	var idbotonRango;
	//activa las pestañas del Estudiantes
	$("#tabs").tabs();
	
	//dialogo para editar estudiantes
	$('.Dialogeditar').dialog({
				autoOpen: false,
				height: 351,
				title:"Modificar un estudiante",
				width: 543,
				modal: true
	});

	//define cuadro de dialogo para busqueda de estudiantes
	$('#rangos').dialog({
		autoOpen: false,
		title:"Buscar un rangos",
		height: 450,
		width: 500,
		modal: true                                      

	});
	//envia los datos para buscar los rangos
	$('#Busqueda').click(function () {
		var id = $('#id').val();
		
		var nombre = $('#nombreR').val();
				
		$.post("<?php echo site_url('usuarios/buscarRango') ?>", { nombres: nombre, id: id},
		  function(data){
			
		   	$('#datosrangos').html(data.resultados);
		   	$("#Filas").html(data.filas);
		  },"json");

	});
	//envia el codigo del estudinate en la lista a el campo para hacer el registro
	$(document).delegate(".es","click",function() {

		var id = $(this).attr('id');
	
		$("#Urango").val(id);
		
		
		
		
		$('#rangos').dialog('close');
		return false;
	});

	$("#RBuscar").click(function () {
		$("#rangos").dialog('open');
				
	});
	

	//Boton cancelar del dialogo para editar
	$("#cancelar").click(function() {
			
		  $('.Dialogeditar').dialog('close'); 

	});

	//Bonton buscar el cual trae los resultados de la base de datos
	$("#modificar").click(function() {	
		var id = $("#UDid").val();
		var nombre = $("#UDnombre").val();
		var usuario = $("#UDusuario").val();
		var clave = $("#UDclave").val();
		var rango = $("#UDrango").val();
		
		$.post("<?php echo site_url('usuarios/modificar') ?>", {id:id, nombre:nombre, usuario: usuario,clave:clave,rango:rango},
			  function(data){
		   	alert(data.mensaje);
		   		
		},"json");
		$('.Dialogeditar').dialog('close');
	})

	//Bonton buscar el cual trae los resultados de la base de datos
	$("#buscarU").click(function() {	
		var id = $("#idU").val();
		var nombre = $("#nombreU").val();
		var usuario = $("#usuarioU").val();
		var clave = $("#claveU").val();
		//var rango = $("#rangoU").val();
		var rango = "";
	
		$.post("<?php echo site_url('usuarios/buscarUsuario') ?>", {id:id, nombre: nombre, usuario: usuario, clave:clave,rango:rango },
			  function(data){
			  
		   	$('#datosUsuarios').html(data.respuesta);
		   	$("#filas").html(data.filas);
		   	
		},"json");
	})

	

	//boton de borrar en las acciones dle registros
	$(document).delegate('.borrar',"click",function () {

			var iden = $(this).attr('id');
			
			var res = confirm('Esta seguro Que dese eliminar el Registros ?');
			if (res ==  true)
			{
				
			$.post("<?php echo site_url('usuarios/eliminar') ?>",
				{
				  id: iden
				},
			  function(data){
		  		alert(data.mensaje); 
		  		resEliminacion = data.respuesta;
				
				if (resEliminacion == "true") 
				{
					$('.'+iden).hide();
				}
			  }, "json");
			}
			return false;
		});
	//boton de editar en las acciones del registros
	$(document).delegate('.editar',"click",function () {
			var id = $(this).attr('id');
			var nombre = $("."+id+"  .nombre").html();
			var usuario = $("."+id+"  .usuario").html();
			var clave = $("."+id+"  .clave").html();
			var rango = $("."+id+"  .rango").html();

			
			$("#UDid").val(id);
			$("#UDnombre").val(nombre);
			$("#UDusuario").val(usuario);
			$("#UDclave").val(clave);
			$("#UDrango").val(rango);
			
			
		
			//abre el dialogo de editar
			$('.Dialogeditar').dialog('open');
			return false;
		})
	// funcionalidad del boton limpiar del cuadro de busqueda de estudiantes
		$("#limpiar").click(function() {
			$('#idU').val("");
			$('#nombreU').val("");
			$('#usuarioU').val("");
			$('#claveU').val("");
			
			});
		// funcionalidad del boton limpiar del cuadro de insercion de estudiantes
		$("#Ulimpiar").click(function() {
			$('#Uid').val("");
			$('#Unombre').val("");
			$('#Uusuario').val("");
			$('#Uclave').val("");
			$('#Urango').val("");
			});

		
})//fin function principal

</script>