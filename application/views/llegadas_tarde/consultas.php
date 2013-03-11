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
							<center><h1>Busqueda Estudiante</h1></center>
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
<div class="Dialogeditar" style="display:none">
	<h1 align="center">Editar Registros de los Estudiantes</h1>
	<hr>
	<form action=""  id="modify" class="" method="post">
		Codigo:
		<input type="text" name="Enombre" value="3127239">
		
		Nombre:
		<input type="text" name="Enombre" value="Juan David">
		<br>
		Apellido:
		<input type="text" name="Enombre" value="Gomez Escoabar">
		
		Grupo:
		<input type="text" name="Enombre" value="11A">
		<br>
		Fecha:
		<input type="text" name="Enombre" value="<?php echo  date('Y-m-d') ?>">
		
		Hora:
		<input type="text" name="Enombre" value="<?php echo date('h:i:s',time())?>">
		<hr>
		<input type="submit" id="modificar" value="Modificar" class="btn">
		<input type="button" id="cancelar" value="Cancelar" class="btn">
	</form>
</div>
<script type="text/javascript">
	$(document).ready(inicio());
	function inicio () 
	{
		$( "#tabs" ).tabs();

		//activa el calendario
		$('.fecha').datepicker();
		$('.fecha').datepicker(
			"option", "dateFormat",'yy-mm-dd'
			);
		//declara la ventana de dialogo para editar
			$('.Dialogeditar').dialog({
				autoOpen: false,
				height: 368,
				title:"Modificar una Llegada Tarde",
				width: 630,
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

		//envia los datos de la busqueda por estuudiante y deuelve los resultados
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
		$('.borrar').click(function () {
			var res = confirm('Esta seguro Que dese eliminar el Registros ?');
			if (res ==  true)
			{
				alert('Registro Borrado');
			}else
			{

			}
		})
		//eventos de los botones editar de acciones
		$('.editar').click(function () {
			//abre el dialogo de editar
			$('.Dialogeditar').dialog('open');
		})
		//eventos de los botones cancelar de el dialogo 
		$('#cancelar').click(function () {
			//cierra el dialogo de editar
			$('.Dialogeditar').dialog('close');
		})
		$('#modify').submit(function () {
			$('.Dialogeditar').dialog('close');
			alert('Registro Modificado');
			return false;
		})
	}

</script>