<div class="row-fluid" >
			<div class="span11 offset1" >
				<div class="menu">
					<a class="dock-item2" href="<?php echo site_url('inicio/abrir/registrar') ?>">
			  			<span>Registrar Llegada</span>
			  			<?php echo img('img/resgistration.png')?>
			  		</a> 

					<a class="dock-item2" href="<?php echo site_url('inicio/abrir/consultas') ?>">
					  	<span>Consultar Llegadas</span>
					  	<?php echo img('img/consutar.png') ?>
					</a> 

					<a class="dock-item2" href="<?php echo site_url('inicio/abrir/cuenta') ?>">
					  	<span>Mi Cuenta</span>
					 	<?php echo img('img/user.png') ?>
					</a> 

					<a class="dock-item2" href="<?php echo site_url('inicio/abrir/usuarios') ?>">
					  	<span>Usuarios</span>
					  	<?php echo img('img/users.png') ?>
					</a> 

					<a class="dock-item2" href="<?php echo site_url('usuarios/logout') ?>">
					  	<span>Cerrar Sesion</span>
					  	<?php echo img('img/logout.png') ?>
					</a>
				</div>
			  
					
		</div>	
	</div>	
</div>	
<script type="text/javascript" src="<?php echo site_url('js/bootstrap.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/bootstrap-collapse.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/bootstrap-transition.js') ?>"></script>
<script type="text/javascript" src="<?php echo site_url('js/bootstrap-tap.js') ?>"></script>
<script type="text/javascript">
	$(document).ready(function(){

		$('section').animate({'opacity':'1'},'slow');

		var text = $(this).find('span');
		text.stop(true,true).css({

				'opacity':'0'
			});
		$('.menu a').hover(function(){

			var img = $(this).find('img'),text = $(this).find('span');
			img.stop(true,true).animate({
				'width':'90px',
				'height':'90px'
			},'fast');
			
			text.stop(true,true).animate({

				'opacity':'0.9'
			});


		},function(){
			var img = $(this).find('img'),text = $(this).find('span');
			img.stop(true,true).animate({
				'width':'80px',
				'height':'80px'
			},'fast');
			text.stop(true,true).animate({
				'opacity':'0'
			});


		});


	});

</script>
</body>
</html>