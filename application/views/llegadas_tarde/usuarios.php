<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<div class="formulario">
				<h1 align="center">Usuarios</h1>
				
				 <table class="table table-striped">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>Codigo</th>
								<th>Nombres</th>
								<th>Usuario</th>
								<th>Contraseña</th>
								
								<th>Acciones</th>
								</tr>
								</thead>
								<tbody>
								<tr>
								<td>1</td>
								<td>Juan David Gomez</td>
								<td>admin</td>
								<td>admin</td>
								
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
		Usuario:
		<input type="text" name="Enombre" value="Gomez Escoabar">
		
		Contraseña:
		<input type="text" name="Enombre" value="11A">
		<br>
		Fecha:
		<input type="text" name="Enombre" value="<?php echo date('m/d/Y')?>">
		
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
		//activa el calendario
		$('#fecha').datepicker();
		//declara la ventana de dialogo para editar
			$('.Dialogeditar').dialog({
				autoOpen: false,
				height: 368,
				title:"Modificar una Llegada Tarde",
				width: 630,
				modal: true,
			});

		//Evente del radio para cambiar de modo de busqueda
		$("#estudiante").click(function(){
			$(".busquedaF").css('display','none');
			$(".busquedaE").css('display','block');
			
		});
		$("#fechaLLegadas").click(function(){
			$(".busquedaE").css('display','none');
	 		$(".busquedaF").css('display','block');
			
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