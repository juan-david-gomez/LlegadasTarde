<div class="row-fluid">
	<div class="span10 offset1">
		<section>
			<center><h1>MI CUENTA</h1></center>
			<div id="tabs">
			 	<ul>
			 		<li><a href="#tabs-2" >Mi Cuenta</a></li>
			 		
			 		
			 	</ul>
			 	
			 	<div id="tabs-2">
			 		<form action=""  id="modify" class="" method="post">
		<div style="width: 450px;
margin: 0 auto;">
				<center><h1>Mis Datos</h1></center>
				<br>
				<div style="float:right;width:200px">
					
					Usuario:
					<input type="text" id="UDusuario" value="" >	
					Nombre:
					<input type="text" id="UDnombre" value="" >
					<br>
					<br>
					<div>
						<input type="button" id="modificar" value="Modificar" class="btn">
						<input type="button" id="eliminar" value="Eliminar" class="btn">
					</div> 							
					
				
					

				</div >
				<div style="width:230px">
					Id:
					<input type="text" id="UDid" value=""  >

					Contraseña:
					<input type="password" id="UDclave" value="" style="text-align: center;">

					Rango:
					<input type="text" id="UDrango" value="" >
				
				</div>

		</div>
		
	</form>
			 	</div>
			 	
			 
			</div><!-- tabs -->

				
		</section>
	</div>
</div><!-- row fluid -->

					
	
<script type="text/javascript">
$(function() {

	

	function miUsuario () {
		var id = <?php echo $this->session->userdata('id'); ?> ;

		$.post("<?php echo site_url('usuarios/usuarioSession') ?>",{id:id}, function(data){

		   	
		
		   	var id = data.ide;

		   	var nombre = data.nombre;
		   	var usuario = data.usuario;
		   	var clave = data.clave;
		   	var rango = data.rango;
			
		   	 $("#UDid").val(id);
			 $("#UDnombre").val(nombre);
		 	 $("#UDusuario").val(usuario);
			 $("#UDclave").val(clave);
			 $("#UDrango").val(rango);
		   		
		   		
		},"json");
		

		
	}
	miUsuario();

	//activa las pestañas del Estudiantes
	$("#tabs").tabs();

	
	//Bonton buscar el cual trae los resultados de la base de datos
	$("#modificar").click(function() {	
		var id = $("#UDid").val();
		var nombre = $("#UDnombre").val();
		var usuario = $("#UDusuario").val();
		var clave = $("#UDclave").val();
		var rango = $("#UDrango").val();
		
		$.post("<?php echo site_url('usuarios/modificar') ?>", {id:id, nombre:nombre, usuario: usuario,clave:clave,rango:rango},
			  function(data){
		   	alert(data);
		   		document.location.reload(true);
		});

		
	})

		

	//boton de borrar en las acciones dle registros
	$("#eliminar").click(function () {

			var iden = <?php echo $this->session->userdata('id'); ?> ;

			var res = confirm('Esta seguro Que dese eliminar el Registros ?');
			if (res ==  true)
			{
				
			$.post("<?php echo site_url('usuarios/eliminar') ?>",
				{
				  id: iden
				},
			  function(data){
		  		alert(data); 

			  });
			document.location.href= "<?php echo site_url('usuarios/logout') ?>";
			}
		
		});
	//boton de editar en las acciones del registros
	$(document).delegate('.editar',"click",function () {
			var id = $(this).attr('id');
			var nombre = $("."+id+"  .nombre").html();
			var usuario = $("."+id+"  .usuario").html();
			var clave = $("."+id+"  .clave").html();
			var rango = $("."+id+"  .rango").html();

			
			$("#UDid").val(id);
			$("#UDnombre").val(nombre);
			$("#UDusuario").val(usuario);
			$("#UDclave").val(clave);
			$("#UDrango").val(rango);
			
			
		
			//abre el dialogo de editar
			$('.Dialogeditar').dialog('open');
			return false;
		})
	// funcionalidad del boton limpiar del cuadro de busqueda de estudiantes
		$("#limpiar").click(function() {
			$('#idU').val("");
			$('#nombreU').val("");
			$('#usuarioU').val("");
			$('#claveU').val("");
			
			});
		// funcionalidad del boton limpiar del cuadro de insercion de estudiantes
		$("#Ulimpiar").click(function() {
			$('#Uid').val("");
			$('#Unombre').val("");
			$('#Uusuario').val("");
			$('#Uclave').val("");
			$('#Urango').val("");
			});

		
})//fin function principal

</script>
		