<html>
<head>
	<title>Llegadas Tarde</title>
 	<style type="text/css">
 		#contenedor
 		{
 			background-color:#E4E4E4;
 			text-align:center;
 			color:#000000;
 			width:300px;
 			border-radius: 15px;
 			font-family:sans-serif;
 			padding: 15px;
 			
 		}
 	
 	</style>
</head>
<body>
	<center>
		<div id="contenedor">
			<!-- <img src="../../../img/colegio.png"> -->
			<?php echo img('img/colegio.png') ?>
			<h4>Se Informa que el estudiante ah Llegado Tarde</h4> 
			<p><strong>Codigo:</strong> <?php echo $codigo ?></p>
			<p><strong>Nombre:</strong> <?php echo $nombre." ".$apellido ?></p>
			<p><strong>Grupo:</strong> <?php echo $grupo ?></p>
			<p><strong>Fecha:</strong> <?php echo $fecha ?></p>
			<p><strong>Hora:</strong> <?php echo $hora?></p>
		</div>
	</center>
</body>
</html>