<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<center><h1>Permisos de usuario</h1></center>
			<div id="tabs">
			 	<ul>
			 		
			 		<li><a href="#tabs-1" >Permisos</a></li>
			 		
			 	</ul>
			 	
			 	
			 	<div id="tabs-1">
			 		<form action="" method="post" class="well">
			 			<center>
				 		<select id="selectrango"  class="span6" >
				 			 <option value="0">Seleccione un Rango </option>
						  
					
						</select>
				 			
						</center>
					
			 		</form>
			 	</div>
			 
			 	<div id="contador" style="text-align: center;">
					Numero de Registros:<strong id="filas"></strong>
				</div>
			 	<table class="table table-striped">
    						
								<thead>
								<tr class="ui-widget-header ">
								<th>Identificación</th>
								<th>Nombre</th>
								<th>Estado</th>
								</tr>
								</thead>
								<tbody id="datosPermisos">
								

								</tbody>
    			</table>
			</div><!-- tabs -->

				
		</section>
	</div>
</div><!-- row fluid -->

<script type="text/javascript">
$(function() {


	//activa las pestañas del Estudiantes
	$("#tabs").tabs();

	function llenarCombo () {
		

			$.post("<?php echo site_url('rango/jsonRangos') ?>",
			  function(data){
			
		  $('#selectrango').append(data.resultados);
		  
		   	
		},"json");
	}
 	 llenarCombo();


	
	$('#selectrango').change(function() {
		 var $selectedOption = $(this).find('option:selected');
	     var idRango = $selectedOption.val();
   		if (idRango == 0) 
   			{
   				 	$('#datosPermisos').html("");
   				 		$("#filas").html("");
   			}else{ 

   		$.post("<?php echo site_url('rango_funciones/permisos') ?>", {idRango:idRango},
			  function(data){
			  	
		   	$('#datosPermisos').html(data.resultados);
		   	$("#filas").html(data.filas);
		   	
		},"json");
   			}
 
		
		
	})	


	//boton de editar en las acciones del registros
	$(document).delegate('.editar',"change",function () {
			var id = $(this).attr("id");
			var estado = $(this).is(':checked');
			var idRango = $(this).attr('rango');
			var confir = confirm("Estas seguro que deseas modificar el permiso de esta funcion")
			
			if (confir)
			{
			$.post("<?php echo site_url('rango_funciones/agregarQuitarPermiso') ?>", {idFuncion:id,estado:estado,idRango:idRango},
			  function(data){
			  	
		 	  alert(data.resultados);
		   	
		   	
			},"json");
			return false;
				
			};
		})
	
			
		
})//fin function principal

</script>