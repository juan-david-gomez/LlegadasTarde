<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<center><h1>Estudiantes</h1></center>
			<div id="tabs">
			 	<ul>
			 		<li><a href="#tabs-2" >Insertar Estudiantes</a></li>
			 		<li><a href="#tabs-1" >Buscar Estudinates</a></li>
			 		
			 	</ul>
			 	
			 	<div id="tabs-2">
			 		<form action="<?php echo site_url('acudiantes/validar') ?>" method="post" class="well" id="InsertEstudiante">
			 			<div id="mensaje">

			 					<?php if(isset($mensaje)){echo $mensaje;} ?>
						 		<?php echo validation_errors(); ?>
						  		
			 			</div>
			 			<h2 align="center">Registrar un Estudiante</h2>
			 			<br>
			 			
			 			<input type="text" name="Codigo" id="Ecodigo" placeholder="Codigo" class="span6" value="<?php echo set_value('Codigo'); ?>">
			 			
			 			<input type="text" name="nombre" id="Enombre" placeholder="Nombre" class="span6" value="<?php echo set_value('nombre'); ?>">

						<input type="text" name="apellido" id="Eapellido" placeholder="Apellido" class="span4" value="<?php echo set_value('apellido'); ?>">

						<input type="text" name="grupo" id="Egrupo" class="span4" placeholder="Grupo" class="span4" value="<?php echo set_value('grupo'); ?>">
						
						<select name="sexo" id="Esexo"  class="span4" >
							<option value="M">Masculino</option>
							<option value="F">Femenino</option>
						</select>
						<br>
						<input type="submit" value="Insertar" id="Einsertar" class="btn">
						<input type="button" value="Limpiar" id="Elimpiar" class="btn">
			 		</form>
			 	</div>
			 	<div id="tabs-1">
			 		<form action="" method="post" class="well">
			 			<h2 align="center">Buscar Por Nombre y Codigo</h2>
			 			<br>
			 			<center>
			 			<input type="text" name="Codigo" id="codigoE" placeholder="Codigo">
			 			</center>
			 		
			 			<input type="text" name="nombre" id="nombreE" placeholder="Nombre" class="span4">
						<input type="text" name="apellido" id="apellidoE" placeholder="Apellido" class="span4">
						<input type="text" name="grupo" id="grupoE" class="span4" placeholder="Grupo">
						<br>
						<input type="button" value="Buscar" id="buscarE" class="btn">
						<input type="button" value="Limpiar" id="limpiar" class="btn">
			 		</form>
			 	</div>
			 	<div id="contador" style="text-align: center;">
					Numero de Registros:<strong id="filas"></strong>
				</div>
			 	<table class="table table-striped">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>Codigo</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Grupo</th>
								<th>Acciones</th>
								</tr>
								</thead>
								<tbody id="datosEstudiantes">
								

								</tbody>
    			</table>
			</div><!-- tabs -->

				
		</section>
	</div>
</div><!-- row fluid -->
<!-- dialogo para editar los estudiantes  -->
<div class="Dialogeditar" style="display:none">
	<h1 align="center">Editar  Estudiantes</h1>
	<hr>
	<form action=""  id="modify" class="" method="post">
		<div style="width:450px;height:100px">
				<div style="float:right;width:200px">
					
					Grupo:
					<input type="text" id="EDgrupo" value="" >	
					Nombre:
					<input type="text" id="EDnombre" value="" >
							
					<br>
					<br>
					<div>
						<input type="button" id="modificar" value="Modificar" class="btn">
						<input type="button" id="cancelar" value="Cancelar" class="btn">
					</div> 

				</div >
				<div style="float:left;width:230px">
					Codigo:
					<input type="text" id="EDcodigo" value=""  >

					Apellido:
					<input type="text" id="EDapellido" value="" >

					Sexo:
					<select name="sexo" id="EDsexo"  class="span3" >
							<option value="M">Masculino</option>
							<option value="F">Femenino</option>
						</select>
				
				</div>
		</div>
		
	</form>
</div>				
<script type="text/javascript">
$(function() {
	//activa las pestañas del Estudiantes
	$("#tabs").tabs();
	//dialogo para editar estudiantes
	$('.Dialogeditar').dialog({
				autoOpen: false,
				height: 351,
				title:"Modificar un estudiante",
				width: 543,
				modal: true,
	});
	//Boton cancelar del dialogo para editar
	$("#cancelar").click(function() {
			
		  $('.Dialogeditar').dialog('close'); 

	});

	//Bonton buscar el cual trae los resultados de la base de datos
	$("#modificar").click(function() {	
		var codigo = $("#EDcodigo").val();
		var nombre = $("#EDnombre").val();
		var apellido = $("#EDapellido").val();
		var grupo = $("#EDgrupo").val();
		var sexo = $("#EDgrupo").val();
		
		$.post("<?php echo site_url('estudiantes/modificar') ?>", {codigo:codigo, nombre:nombre, apellido: apellido,grupo:grupo,sexo:sexo},
			  function(data){
		   	alert(data);
		   		
		});
		$('.Dialogeditar').dialog('close');
	})

	//Bonton buscar el cual trae los resultados de la base de datos
	$("#buscarE").click(function() {	
		var codigo = $("#codigoE").val();
		var nombre = $("#nombreE").val();
		var apellido = $("#apellidoE").val();
		var grupo = $("#grupoE").val();
	
		$.post("<?php echo site_url('estudiantes/buscarEstudiante') ?>", {codigo:codigo, nombre: nombre, apellido: apellido,grupo:grupo},
			  function(data){
			  	
		   	$('#datosEstudiantes').html(data.resultados);
		   	$("#filas").html(data.filas);
		   	
		},"json");
	})
	//boton de borrar en las acciones dle registros
	$(document).delegate('.borrar',"click",function () {

			var codigo = $(this).attr('id');
			
			var res = confirm('Esta seguro Que dese eliminar el Registros ?');
			if (res ==  true)
			{
				
			$.post("<?php echo site_url('estudiantes/eliminar') ?>",
				{
				  codigo: codigo
				},
			  function(data){
		  		//alert(data); 

			  });
				var id = "."+codigo;
			
				$(id).hide();
			}else
			{
				
			}
			return false;
		});
	//boton de editar en las acciones del registros
	$(document).delegate('.editar',"click",function () {
			var id = $(this).attr('id');
			var codigo = $("."+id+"  .codigo").html();
			var nombre = $("."+id+"  .nombre").html();
			var apellido = $("."+id+"  .apellido").html();
			var grupo = $("."+id+"  .grupo").html();
			var sexo = $("."+id+"  .sexo").html();

			
			$("#EDcodigo").val(codigo);
			$("#EDnombre").val(nombre);
			$("#EDapellido").val(apellido);
			$("#EDgrupo").val(grupo);
			$("#EDsexo").val(sexo);
			
			//alert($("#Ecodigo").val()+$("#Enombre").val());
		
			//abre el dialogo de editar
			$('.Dialogeditar').dialog('open');
			return false;
		})
	// funcionalidad del boton limpiar del cuadro de busqueda de estudiantes
		$("#limpiar").click(function() {
			$('#codigoE').val("");
			$('#nombreE').val("");
			$('#apellidoE').val("");
			$('#grupoE').val("");
			});
		// funcionalidad del boton limpiar del cuadro de insercion de estudiantes
		$("#Elimpiar").click(function() {
			$('#Ecodigo').val("");
			$('#Enombre').val("");
			$('#Eapellido').val("");
			$('#Egrupo').val("");
			});
		
})//fin function principal

</script>