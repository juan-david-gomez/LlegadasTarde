<!DOCTYPE HTML>
<html lang="es-ES">
<head>
	<meta charset="UTF-8">
	<title>Usuarios</title>
	
	<?php echo link_tag("css/bootstrap.css") ?>
	<?php echo link_tag("css/bootstrap.min.css") ?>
	<?php echo link_tag("css/bootstrap-responsive.css") ?>
	<?php echo link_tag("css/bootstrap-responsive.min.css") ?>
	<?php echo link_tag("css/styles2.css") ?>

</head>
<body>
	<div class="container-fluid">
	
		<div class="row-fluid">
			<div class="span12">
			
			  
				
			</div>
		</div>
		<div class="row-fluid">
			<div class="span4 offset4 ">
					
					
					<div class="panel">
						<h1 align="center">Bienvenidos</h1>
						 
							   	<?php echo validation_errors(); ?>
						 
						  		<?php if(isset($error)){echo $error;} ?>
						  
						

						<form action="<?php echo site_url('usuarios/validar') ?>" class="well" method="post">
							<label for="usuario">Usuario</label>
							<input type="text" name="usuario" value="<?php echo set_value('usuario'); ?>">
							<label for="clave">Contaseña</label>
							<input type="password" name="clave" value="<?php echo set_value('clave'); ?>">
							<br>
							<input type="submit" value="Entrar">
						</form>
				    </div>
				
			</div>
		</div>
	</div>


	<script type="text/javascript" src="<?php echo site_url('js/bootstrap.js') ?>">
	</script>

</body>
</html>