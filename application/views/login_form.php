
<body id="body_register" class="">
	<div class="container-fluid">
 
		<a href="<?php echo base_url();?>index.php/login/signup" class="btn send_formRegis">Registrarse</a>
		<h1 class="logo_hood_Log">
			<a href="#">Hood</a>
		</h1>

		<!-- Abrir el formulario-->
		<?php
			$attributes = array('class' => 'form-horizontal', 'id' => 'formLogin');
			echo form_open('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $attributes);
		?>

		<fieldset class="field_Reg">

		<!-- Atributos de los inputs -->
	    <?php 
	    	$user_name = array('name' => 'username', 'class' => 'span3', 'id' => 'username', 'placeholder' => 'Nombre de usuario', 'value' => set_value('username'));
	    	$pwd = array('name' => 'password', 'class' => 'input-large focused', 'id' => 'password', 'placeholder' => 'Contraseña');
	    	$send_button = array('value' => 'enviar', 'name' => 'enviar', 'class' => 'btn send_formRegis', 'type' => 'submit', 'id' => 'loginSubmit');
	    ?>

	    <!-- Nombre de Usuario -->
	    <div class="control-group">
			<div class="controls">
				<div class="input-prepend">
					<span class="add-on">@</span>
					<?php echo form_input($user_name); ?>
					<?php echo form_error('username'); ?>
				</div>
			</div>
		</div>

		<!-- Contraseña de Usuario -->
		<div class="control-group">
			<div class="controls">
			    <?php echo form_password($pwd); ?>
				<?php echo form_error('password'); ?>
			</div>
		</div>
		<?php echo $error;?>
		<!-- Boton enviar -->
	    <?php echo form_submit($send_button); ?>

		</fieldset>

		<!-- Cerrar el formulario -->
	    <?php echo form_close(); ?>
	</div>
	<div id="login-error" class="modal hide fade">
		<div class="modal-header">
          	<button type="button" class="close" data-dismiss="modal">×</button>
		    <h1>Error al Iniciar Sesi&oacute;n</h1>
        </div>
        <div class="modal-body">
			<p id="errorIniciarSesion"></p>
		</div>
	</div>
	<div id="inactive-error" class="modal hide fade">
		<div class="modal-header">
          	<button type="button" class="close" data-dismiss="modal">×</button>
		    <h1>Error al Iniciar Sesi&oacute;n</h1>
        </div>
        <div class="modal-body">
			<p id="errorInactive"></p>
			<?php
			$attributes = array('id' => 'formInactive');
			echo form_open('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."login/send_email_activate", $attributes);
			?>
			<fieldset>
			<?php
				$send_button_inactive = array('value' => 'enviar solicitud', 'name' => 'enviar', 'class' => 'btn send_formRegis', 'type' => 'submit', 'id' => 'inactiveSubmit');
				echo form_submit($send_button_inactive);
			?>
			</fieldset>
			<?php echo form_close(); ?>	
		</div>
	</div>
</body>
</html>