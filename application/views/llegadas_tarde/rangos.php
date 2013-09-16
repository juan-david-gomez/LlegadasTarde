<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<center><h1>Estudiantes</h1></center>
			<div id="tabs">
			 	<ul>
			 		<li><a href="#tabs-2" >Insertar Rangos</a></li>
			 		<li><a href="#tabs-1" >Buscar Rangos</a></li>
			 		
			 	</ul>
			 	
			 	<div id="tabs-2">
			 		<form action="<?php echo site_url('rango/validar') ?>" method="post" class="well" id="InsertEstudiante">
			 			<div id="mensaje">

			 					<?php if(isset($mensaje)){echo $mensaje;} ?>
						 		<?php echo validation_errors(); ?>
						  		
			 			</div>
			 			<h2 align="center">Registrar un Rango</h2>
			 			<br>
			 			
			 			<input type="text" name="id" id="Eid" placeholder="Identificación" class="span6" value="<?php echo set_value('id'); ?>">
			 			
			 			<input type="text" name="nombre" id="Enombre" placeholder="Nombre" class="span6" value="<?php echo set_value('nombre'); ?>">
						<br>
						<input type="submit" value="Insertar" id="Einsertar" class="btn">
						<input type="button" value="Limpiar" id="Elimpiar" class="btn">
			 		</form>
			 	</div>
			 	<div id="tabs-1">
			 		<form action="" method="post" class="well">
			 			<h2 align="center">Buscar Rangos</h2>
			 			<br>
			 			
			 			<input type="text" name="id" id="idR" placeholder="Identificación" class="span6">
			 			
			 		
			 			<input type="text" name="nombre" id="nombreR" placeholder="Nombre" class="span6">

						<br>
						<input type="button" value="Buscar" id="buscarR" class="btn">
						<input type="button" value="Limpiar" id="limpiar" class="btn">
			 		</form>
			 	</div>
			 
			 	<div id="contador" style="text-align: center;">
					Numero de Registros:<strong id="filas"></strong>
				</div>
			 	<table class="table table-striped">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>Identificación</th>
								<th>Nombres</th>
								<th>Acciones</th>
								</tr>
								</thead>
								<tbody id="datosrango">
								

								</tbody>
    			</table>
			</div><!-- tabs -->

				
		</section>
	</div>
</div><!-- row fluid -->
<!-- dialogo para editar los estudiantes  -->
<div class="Dialogeditar" style="display:none">
	<h1 align="center">Editar Rango</h1>
	<hr>
	<form action=""  id="modify" class="" method="post">
		<div style="margin-left:30px;width:200px;height:100px">
				<div style="width:200px">
					
					Identificación:
					<input type="text" id="Rid" value="" readonly="readonly" >	
					Nombre:
					<input type="text" id="Rnombre" value="" >
							
					<br>
					<br>
					<div>
						<input type="button" id="modificar" value="Modificar" class="btn">
						<input type="button" id="cancelar" value="Cancelar" class="btn">
					</div> 

				</div >
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
				width: 300,
				modal: true,
	});
	//Boton cancelar del dialogo para editar
	$("#cancelar").click(function() {
			
		  $('.Dialogeditar').dialog('close'); 

	});

	
	$("#modificar").click(function() {	
		var id = $("#Rid").val();
		var nombre = $("#Rnombre").val();
		
		
		$.post("<?php echo site_url('rango/modificar') ?>", {id:id, nombre:nombre},
			  function(data){
		   	alert(data);
		   		
		});


			 $("."+id+"  .id").html(id);
			 $("."+id+"  .nombre").html(nombre);
		$('.Dialogeditar').dialog('close');
	})

	//Bonton buscar el cual trae los resultados de la base de datos
	$("#buscarR").click(function() {	
		var id = $("#idR").val();
		var nombre = $("#nombreR").val();
	
		$.post("<?php echo site_url('rango/buscarRango') ?>", {id:id, nombre: nombre},
			  function(data){
			  	
		   	$('#datosrango').html(data.resultados);
		   	$("#filas").html(data.filas);
		   	
		},"json");
	})
	//boton de borrar en las acciones dle registros
	$(document).delegate('.borrar',"click",function () {

			var codigo = $(this).attr('id');
			
			var res = confirm('Esta seguro Que dese eliminar el Registros ?');
			if (res ==  true)
			{
				
			$.post("<?php echo site_url('rango/eliminar') ?>",
				{
				  codigo: codigo
				},
			  function(data){
		  		alert(data.mensaje); 
		  		resEliminacion = data.respuesta;
				
				if (resEliminacion == "true") 
				{
					$('.'+codigo).hide();
				}
			  }, "json");
			}
			return false;
		});
	//boton de editar en las acciones del registros
	$(document).delegate('.editar',"click",function () {
			var id = $(this).attr('id');
			var codigo = $("."+id+"  .id").html();
			var nombre = $("."+id+"  .nombre").html();
			
			$("#Rid").val(codigo);
			$("#Rnombre").val(nombre);
		
			
			//alert($("#Ecodigo").val()+$("#Enombre").val());
		
			//abre el dialogo de editar
			$('.Dialogeditar').dialog('open');
			return false;
		})
	// funcionalidad del boton limpiar del cuadro de busqueda de estudiantes
		$("#limpiar").click(function() {
			$('#idR').val("");
			$('#nombreR').val("");
			});
		// funcionalidad del boton limpiar del cuadro de insercion de estudiantes
		$("#Elimpiar").click(function() {
			$('#Eid').val("");
			$('#Enombre').val("");
			});
		
})//fin function principal

</script>