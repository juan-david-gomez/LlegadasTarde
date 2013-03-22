<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<center><h1>Estudiantes</h1></center>
			<div id="tabs">
			 	<ul>
			 		<li><a href="#tabs-1" >Buscar Estudinates</a></li>
			 		<li><a href="#tabs-2" >Insertar Estudiantes</a></li>
			 	</ul>
			 	<div id="tabs-1">
			 		<form action="" method="post" class="well">
			 			<h2 align="center">Buscar Por Nombre y Codigo</h2>
			 			<br>
			 			<center>
			 			<input type="text" name="Codigo" id="codigoE" placeholder="Codigo">
			 			</center>
			 			<br>
			 			<input type="text" name="nombre" id="nombreE" placeholder="Nombre" class="span4">
						<input type="text" name="apellido" id="apellidoE" placeholder="Apellido" class="span4">
						<input type="text" name="grupo" id="grupoE" class="span4" placeholder="Grupo">
						<br>
						<input type="button" value="Buscar" id="buscarE" class="btn">
						<input type="button" value="Limpiar" id="limpiar" class="btn">
			 		</form>
			 	</div>
			 	<div id="tabs-2">
			 		<form action="" method="post" class="well">
			 			<h2 align="center">Registrar un Estudiante</h2>
			 			<br>
			 			<center>
			 			<input type="text" name="Codigo" id="Ecodigo" placeholder="Codigo">
			 			</center>
			 			<br>
			 			<input type="text" name="nombre" id="Enombre" placeholder="Nombre" class="span4">
						<input type="text" name="apellido" id="Eapellido" placeholder="Apellido" class="span4">
						<input type="text" name="grupo" id="Egrupo" class="span4" placeholder="Grupo">
						<input type="text" name="apellido" id="Ecupo" placeholder="Cupo" class="span4">
						<select name="sexo" id="Esexo" >
							<option value="M">Masculino</option>
							<option value="F">Femenino</option>
						</select>
						<br>
						<input type="button" value="Insertar" id="Einsertar" class="btn">
						<input type="button" value="Limpiar" id="Elimpiar" class="btn">
			 		</form>
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
								<tbody id="datosEstudiante">
								

								</tbody>
    			</table>
			</div><!-- tabs -->

				
		</section>
	</div>
</div>
<script type="text/javascript">
$(function() {
	//activa las pestañas del Estudiantes
	$("#tabs").tabs();
})

</script>