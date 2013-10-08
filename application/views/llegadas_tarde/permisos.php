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
			 			<h2 align="center">Buscar Funciones por Rango</h2>
			 			<br>
			 			<center>
				 			<input type="text" class="span6" id="rango">
						</center>
						<br>
						
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


	
	


	  var projects = [
      {
        value: "1",
        label: "Administrador"
       
      },
      {
        value: "2",
        label: "Recepcionista"
      
      }
    ];


	$( "#rango" ).autocomplete({
      source: function( request, response ) {
        $.ajax({
          url: "<?php echo site_url('rango/jsonRangos') ?>",
          dataType: "jsonp",
          data: {
            featureClass: "P",
            style: "full",
            maxRows: 12,
            name_startsWith: request.term
          },
          success: function( data ) {
            response( $.map( data.geonames, function( item ) {
              return {
                label: item.name + (item.adminName1 ? ", " + item.adminName1 : "") + ", " + item.countryName,
                value: item.name
              }
            }));
          }
        });
      },
      focus: function( event, ui ) {
        $( "#rango" ).val( ui.item.label );
        return false;
      },
      select: function( event, ui ) {
        $( "#rango" ).val( ui.item.label );
       var idRango = ui.item.value ;
       
      	
      		
		
		$.post("<?php echo site_url('rango_funciones/permisos') ?>", {idRango:idRango},
			  function(data){
			  	
		   	$('#datosPermisos').html(data.resultados);
		   	$("#filas").html(data.filas);
		   	
		},"json");
 
        return false;
      }
    })
    .data( "ui-autocomplete" )._renderItem = function( ul, item ) {
      return $( "<li>" )
        .append( "<a>" + item.label + "</a>" )
        .appendTo( ul );
    };



	//boton de editar en las acciones del registros
	$(document).delegate('.editar',"change",function () {
			var id = $(this).attr("id");
			var estado = $(this).is(':checked');
			var idRango = $(this).attr('rango');
			var confir = confirm("Estas seguro que deseas modificar el permiso de esta funcion")
			alert(estado);
			if (confir)
			{
			$.post("<?php echo site_url('rango_funciones/agregarQuitarPermiso') ?>", {idFuncion:id,estado:estado,idRango:idRango},
			  function(data){
			  	
		 	  alert(data.resultados);
		   	
		   	
			},"json");
			return false;
				
			};
		})
	// funcionalidad del boton limpiar del cuadro de busqueda de estudiantes
		$("#limpiar").click(function() {
			$('#rango').val("");
			
		});
			
		
})//fin function principal

</script>