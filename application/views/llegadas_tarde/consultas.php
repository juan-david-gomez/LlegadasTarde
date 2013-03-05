<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			
				<h1 align="center">Consultar</h1>
				
				<div id="tabs">
					<ul>
					<li><a href="#tabs-1">Por Fecha</a></li>
					<li><a href="#tabs-2">Por Estudiante</a></li>
					<li><a href="#tabs-3">Rango de Fechas</a></li>
					</ul>
				<div id="tabs-1">
					<form action="" class="well" method="post">
					<div class="busquedaF" >
							<center>
								<label for="date" id="date"><strong>Fecha Inicio</strong></label>
							<input type="text" name="date" id="fecha" value="<?php echo date('Y-m-d'); ?>" class="span3" >
						
						</center>
					</div>
					</form>
				</div>
				<div id="tabs-2">
					<form action="" class="well" method="post">
					<div class="busquedaF" >
						&nbsp; &nbsp; &nbsp; &nbsp;
							<strong>Nombre</strong>						&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								<strong>Apellido</strong>
&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								<strong>Grupo</strong>
								<br>
								<input type="text" name="nombre" id="nombre"  class="span4"  >
								<input type="text" name="apellido" id="apellido" class="span4"  >
								<input type="text" name="grupo" id="apellido" class="span4"  >
								<br>
								<input type="submit" value="Buscar" class="btn">
					</div>
					</form>
					<!-- <div class="busquedaF" >
						<strong>Nombre</strong>						&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; 
								<strong>Apellido</strong>
&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
								<strong>Grupo</strong>
								<br>
								<input type="text" name="nombre" id="nombre"  class="span4"  >
								<input type="text" name="apellido" id="apellido" class="span4"  >
								<input type="text" name="grupo" id="apellido" class="span4"  >
								<br>
								<input type="submit" value="Buscar" class="btn">
					</div> -->
				</div>
				<div id="tabs-3">
				
					<form action="" class="well" method="post">
					<div class="busquedaF" >
						<center>
							<strong>Fecha Inicial</strong>&nbsp; &nbsp; &nbsp; &nbsp; 	&nbsp; &nbsp; &nbsp; &nbsp; 
							<strong>Fecha Final</strong>
							<br>
							<input type="text" name="date" id="fecha3" value="<?php echo date('Y-m-d'); ?>" class="span3" >
							&nbsp; &nbsp; &nbsp; &nbsp;
							<input type="text" name="date2" id="fecha3" value="<?php echo date('Y-m-d'); ?>" class="span3" >
						</center>
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
								<tbody>
								<tr>
								<td>3127239</td>
								<td>Juan David</td>
								<td>Gomez Escobar</td>
								<td>11A</td>
								<th><?php echo date('Y-m-d')?></th>
								<th><?php echo date('h:i:s')?></th>
								<th>
									<a href="#" title="" class="borrar">Borrar</a>
									<a href="#" title="" class="editar">Editar</a>
								</th>
								</tr>
								<tr>
								<td>3628384</td>
								<td>Santiago Lopez</td>
								<td>Lopez Estrada</td>
								<td>9B</td>
								<th><?php echo date('Y-m-d');?></th>
								<th><?php echo date('h:i:s',time())?></th>
								<th>
									<a href="#" title="" class="borrar">Borrar</a>
									<a href="#" title="" class="editar">Editar</a>
								</th>
								</tr>
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
		$('#fecha').datepicker();
		$('#fecha').datepicker(
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