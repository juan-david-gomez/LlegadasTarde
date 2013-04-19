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

			 		</form>
					
			 	</div>
			 	<div id="tabs-2">
			 		<form action="" method="post" class="well">
			 			<h2 align="center">Buscar Estudiante o Acudiente</h2>
			 			<br>
			 			<center>
			 			<div class="input-append">	
			 			<input type="text" name="estudiante" id="Ecodigo" placeholder="Codigo Estudiante" class = "span5">
			 			<button class="btn"><i class="icon-search" style="margin-top : -5px"></i></button>	
			 			</div>

			 			<input type="text" name="id" id="Aidentificacion" placeholder="Identificacion Acudiente" class="span5">
			 			</center>
			 			
						<br>
						<input type="button" value="Buscar" id="buscarE" class="btn">
						<input type="button" value="Limpiar" id="limpiar" class="btn">
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