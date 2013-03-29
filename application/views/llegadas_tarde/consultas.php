<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			
				<h1 align="center">Consultar</h1>
				
				<div id="tabs">
					<ul>
					<li><a href="#tabs-1">Por Fecha</a></li>
					<li><a href="#tabs-2">Por Estudiante y Rango de Fechas</a></li>
					
					</ul>
				<div id="tabs-1">
					<form action="" class="well" method="post">
					<div class="busquedaF" >
							<center>
								<center><h1>Buscar Por Fecha</h1></center>
								<br>
							<input type="text" name="date" id="fecha"  class="span3 fecha" placeholder="Fecha" >
						
					</center>
					</div>
					</form>
				</div>
				<div id="tabs-2">
					<form action="" class="well" method="post" id="Bestudi">
					<div class="busquedaF" >
							<center><h1>Busqueda por Estudiante</h1></center>
								<br>
								<input type="text" name="nombre" id="nombre"  class="span4"  placeholder="Nombre">
								<input type="text" name="apellido" id="apellido" class="span4"  placeholder="Apellido" >
								<input type="text" name="grupo" id="grupo" class="span4"   placeholder="Grupo">
								<center>
									<input type="text" name="date" id="fechaI" class="span3 fecha" placeholder="Fecha Inicial">
									&nbsp; &nbsp; &nbsp; &nbsp;
									<input type="text" name="date2" id="fechaF"  class="span3 fecha" placeholder="Fecha Final" >
								</center>
								<br>
								<input type="submit" value="Buscar" class="btn">
								<input type="button" value="limpiar" class="btn" id="limpiar">
					</div>
					</form>
				
				</div>
				
				<table class="table table-striped">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>Codigo</th>
								<th>Nombres</th>
								<th>Apellidos</th>
								<th>Grupo</th>
								<th>Fecha</th>
								<th>Hora</th>
								<th>Acciones</th>
								</tr>
								</thead>
								<tbody id="datosIngresos">
								

								</tbody>
    			</table>
				</div>
		</section>
	</div>
</div>
<!-- Dialogo para Buscar Estudiante  -->
<div id="estudiantes" style="display:none" >
						<center><h1>Registrar una Asistencia</h1></center>
						<br>
						<input type="text" name="nombre" id="nombreE" placeholder="Nombre">
						

						<input type="text" name="apellido" id="apellidoE" placeholder="Apellido">
						
						
						<input type="text" name="grupo" id="grupoE" class="span2" placeholder="Grupo">
						<br>
						<input type="button" value="Buscar" id="buscarE" class="btn">
						<input type="button" value="Limpiar" id="limpiar" class="btn">
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
<!-- el cuadro de dialogo para modificar los registros de los estudinates  -->
<div class="Dialogeditar" style="display:none">
	<h1 align="center">Editar Registros de los Estudiantes</h1>
	<hr>
	<form action=""  id="modify" class="" method="post">
	<div style="width:650px;height:340px">
			<div style="float:right;width:200px">
				<h4>Estudiante</h4>
				<input type="hidden" id="Eid" value="" >
			Codigo:
			<input type="text" id="Ecodigo" value="" readonly="readonly" >
			
			Nombre:
			<input type="text" id="Enombre" value="" readonly="readonly" >
			<br>
			Apellido:
			<input type="text" id="Eapellido" value="" readonly="readonly" >
			
			Grupo:
			<input type="text" id="Egrupo" value="" readonly="readonly" >			
			<input type="button" class="bnt" id="buscar" value="Buscar" readonly="readonly" >
		</div >
		<div style="float:left;width:200px">
			<h4>Ingreso</h4>
			Fecha:
			<input type="text" id="Efecha" class="echa" value="" readonly="readonly">
			
			Hora:
			<input type="text" id="Ehora" value="" readonly="readonly" >
			Observaciones
			<br>
			<textarea name="Eobservaciones" style="height:120px" id="Eobservaciones" ></textarea>
		</div>
		</div>
		 <hr>
		<div>
			<input type="submit" id="modificar" value="Modificar" class="btn">
		<input type="button" id="cancelar" value="Cancelar" class="btn">
		</div> 
		
	</form>
</div>
<script type="text/javascript">
	$(document).ready(inicio());
	function inicio () 
	{	
		//activa las pestañas de la ventana de busquedas
		$( "#tabs" ).tabs();
		//dialogo de busqueda de estudiantes
		$('#estudiantes').dialog({
		autoOpen: false,
		title:"Buscar un Estudiante",
		height: 470,
		width: 680,
		modal: true

		});
		//activa el calendario
		$('.fecha').datepicker({
			dateFormat : 'yy-mm-dd',
			changeYear: true,
			monthNames: ['Enero', 'Febrero', 'Marzo', 'Abril', 'Mayo', 'Junio', 'Julio', 'Agosto', 'Septiembre', 'Octubre', 'Noviembre', 'Diciembre'],
			monthNamesShort: ['Ene','Feb','Mar','Abr', 'May','Jun','Jul','Ago','Sep', 'Oct','Nov','Dic'],
			dayNames: ['Domingo', 'Lunes', 'Martes', 'Miércoles', 'Jueves', 'Viernes', 'Sábado'],
	      	dayNamesShort: ['Dom','Lun','Mar','Mié','Juv','Vie','Sáb'],
	     	dayNamesMin: ['Do','Lu','Ma','Mi','Ju','Vi','Sá'],
	     	
		});
		
	
		//declara la ventana de dialogo para editar
			$('.Dialogeditar').dialog({
				autoOpen: false,
				height: 610,
				title:"Modificar una Llegada Tarde",
				width: 710,
				modal: true,
			});
			//boton limpiar del busqueda de estudiantes
			$("#limpiar").click(function() {
				$("#nombre").val("");
				$("#apellido").val("");
				$("#grupo").val("");
				$("#fechaI").val("");
				$("#fechaF").val("");
			})
			// boton para abrir el dialogo de busqueda de estudiantes
			$('#buscar').click(function () {
				$('#estudiantes').dialog('open');
				return false;
			});
			// funcionalidad del boton limpiar del cuadro de busqueda de estudiantes
			$("#limpiar").click(function() {
				$('#nombreE').val("");
				
				$('#apellidoE').val("");
				
				$('#grupoE').val("");
			});
		//envia los datos de de la busqueda de los estudiantes
		$('#buscarE').click(function () {
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
		var codigo = $(this).attr('codigo');
		var nombre = $(this).attr('nombre');
		var apellido = $(this).attr('apellidos');
		var grupo = $(this).attr('grupo');
		$("#Ecodigo").val(codigo);
		$("#Enombre").val(nombre);
		$("#Eapellido").val(apellido);
		$("#Egrupo").val(grupo);
		$('#estudiantes').dialog('close');
		return false;
	});
		//envia los datos de la busqueda por estudiante y deuelve los resultados
		$("#Bestudi").submit(function() {

			var usuario = "";
			var nombres = $("#nombre").val();
			var apellidos = $("#apellido").val();
			var grd_13 = $("#grupo").val();
			var observaciones = "";
			var fecha = "";
			var hora = "";
			var fechaI = $("#fechaI").val();
			var fechaF = $("#fechaF").val();

			$.post("<?php echo site_url('llegadas_tarde/buscarIngresos') ?>",
				{
				  usuario: usuario, 
				  nombres: nombres,
				  apellidos:apellidos,
				  grd_13:grd_13,
				  observaciones:observaciones,
				  fecha:fecha,
				  hora:hora,
				  fechaI:fechaI,
				  fechaF:fechaF
				},function(data){
			  	//alert(data);
			   	$('#datosIngresos').html(data);
			  });
			return false;
		})
		//envia los datos de de la busqueda de registros
		$('#fecha').change(function () {

			var usuario = "";
			var nombres = "";
			var apellidos = "";
			var grd_13 = "";
			var observaciones = "";
			var fecha = $(this).val();
			var hora = "";
			var fechaI = "" ;
			var fechaF = "";

			$.post("<?php echo site_url('llegadas_tarde/buscarIngresos') ?>",
				{
				  usuario: usuario, 
				  nombres: nombres,
				  apellidos:apellidos,
				  grd_13:grd_13,
				  observaciones:observaciones,
				  fecha:fecha,
				  hora:hora,
				  fechaI:fechaI,
				  fechaF:fechaF
				},
			  function(data){
			  	//alert(data);

			   	$('#datosIngresos').html(data);
			  });

		});
	
		//eventos de los botones borrar de acciones
		$(document).delegate('.borrar',"click",function () {

			var id = $(this).attr('id');
			var res = confirm('Esta seguro Que dese eliminar el Registros ?');
			if (res ==  true)
			{
				
			$.post("<?php echo site_url('llegadas_tarde/eliminar') ?>",
				{
				  id: id
				},
			  function(data){
		  		//alert(data); 

			  });
				$('.'+id).hide();
			}else
			{
				
			}
			return false;
		});
		//eventos de los botones editar de acciones
		$(document).delegate('.editar',"click",function () {
			var id = $(this).attr('id');
			var codigo = $("."+id+"  .codigo").html();
			var nombre = $("."+id+"  .nombre").html();
			var apellido = $("."+id+"  .apellido").html();
			var grupo = $("."+id+"  .grupo").html();
			var fecha = $("."+id+"  .fecha").html();
			var hora = $("."+id+"  .hora").html();
			var observaciones = $("."+id+"  .observaciones").html();
			
			$("#Ecodigo").val(codigo);
			$("#Enombre").val(nombre);
			$("#Eapellido").val(apellido);
			$("#Egrupo").val(grupo);
			$("#Efecha").val(fecha);
			$("#Ehora").val(hora);
			$("#Eid").val(id);
			$("#Eobservaciones").val(observaciones);
			//abre el dialogo de editar
			$('.Dialogeditar').dialog('open');
			return false;
		})
		//eventos de los botones cancelar de el dialogo 
		$('#cancelar').click(function () {
			//cierra el dialogo de editar
			$('.Dialogeditar').dialog('close');
		})
		$('#modify').submit(function () {
			var id  = $("#Eid").val();
			var codigo = $("#Ecodigo").val();
			var observaciones = $("#Eobservaciones").val();
 			var nombre = $("#Enombre").val();
			var apellido = $("#Eapellido").val();
			var grupo = $("#Egrupo").val();
			var Fecha = $("#Efecha").val();
			var hora = $("#Ehora").val();
			
				
			$.post("<?php echo site_url('llegadas_tarde/editar') ?>",{
				  id: id,
				  estudiante:codigo,
				  observaciones:observaciones
				},
			  function(data){
			  	
		  		if (data == "si") {

		  			alert("Registro Modificado Correctamente");
		  			$("."+id+"  .codigo").html(codigo);
					$("."+id+"  .nombre").html(nombre);
					$("."+id+"  .grupo").html(grupo);
					$("."+id+"  .apellido").html(apellido);
					$("."+id+"  .observaciones").html(observaciones);
					
	
		  		}else
		  		{
		  			alert("Error al Actualizar el Registros");
		  		}
			  });
			$('.Dialogeditar').dialog('close');
			
			return false;
		});
	}

</script>