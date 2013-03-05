<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<div class="formulario">
				<center><h1>Registrar una Inasistencia</h1></center>
				<form action="<?php echo site_url('usuarios/validar') ?>" class="frm well form-search" method="post">
					<label for="usuario" id="codigo">Codigo</label>
					<input type="text" name="codigo" value="<?php if (isset($codigo)) {
						echo $codigo;
					} ?>" class="span7 " id="Tcodigo" >

					<input type="button" value="Buscar" id="buscar">
				</form>
			</div>
		</section>
	</div>
</div>
<!-- Dialogo para Registrar  -->

					<div id="registrar" style="display:none" >
						<center><h1>Registrar una Asistencia</h1></center>
						<label for="observaciones">Observaciones</label> 
						<textarea name="observaciones" value="<?php echo set_value('observaciones'); ?>" cols="1" id="observaciones"></textarea>
						<hr>
						<input type="button" value="Registrar" id="enviar" class="btn">
						<input type="button" value="Cancelar" id="cancelar" class="btn">
					</div> 

<!-- Dialogo para Buscar Estudiante  -->

					<div id="estudiantes" style="display:none" >
						<center><h1>Estudiantes</h1></center>
						Nombre&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						Apellido&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp;&nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;
						 &nbsp; &nbsp; &nbsp;  Grupo
						<br>
						<input type="text" name="nombre" id="nombreE">
						

						<input type="text" name="apellido" id="apellidoE">
						
						
						<input type="text" name="grupo" id="grupoE" class="span2">
						<br>
						<input type="button" value="Buscar" id="buscarE" class="btn">
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
$(document).ready(function(){
	//pone el foco en el campo del codigo
	$('#Tcodigo').focus();
	
	//se declaran las 2 entanas de dialogo registrar y buscar 
	$('#registrar').dialog({
		autoOpen: false,
		height: 370,
		title:"Registrar una Llegada Tarde",
		width: 370,
		modal: true,
		

	});
	
	$('#estudiantes').dialog({
		autoOpen: false,
		title:"Buscar un Estudiante",
		height: 470,
		width: 660,
		modal: true

	});

	//le doy al boton cerrar la funcionalidad de cerrar la ventana
	$('#cancelar').click(function(){
		$('#registrar').dialog('close');
	});
	$('#cerrar').click(function(){
		$('#estudiantes').dialog('close');
	});
	//le doy funcionalidad al boton registrar para hacer el envio de los datos
	$('#enviar').click(function(){
		$('#registrar').dialog('close');
		var codigo = $('#Tcodigo').val();
		var observaciones = $('#observaciones').val();
		$.post("<?php echo site_url('llegadas_tarde/validarEstudiante') ?>", { codigo: codigo, observaciones: observaciones},
		  function(data){
		    alert(data);
		  });
		
		$('#Tcodigo').val('');
		$('#observaciones').val('');

	});

	//abre la ventana cuando se envia el codigo 
	$('.frm').submit(function () {
		$('#registrar').dialog('open');

		return false;
	});

	//se abre la ventana cuando se da click en el boton buscar
	$('#buscar').click(function () {
		$('#estudiantes').dialog('open');
		return false;
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
	$(".es").click(function () {
		
		alert("codigo");
	});
	
})
</script>