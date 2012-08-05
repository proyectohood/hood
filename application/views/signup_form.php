
<body id="body_register">
	<div class="container-fluid">
		<a href="<?php echo base_url();?>" class="btn send_formRegis">Login</a>
		<h1 class="logo_hood_Reg">
			<a href="#">Hood</a>
		</h1>

		<?php
			$attributes = array('class' => 'form-horizontal', 'id' => 'formRegister');
			echo form_open('index.php/login/create_member', $attributes);
		?>
		    <fieldset class="field_Reg">

		    	<div class="control-group">
					<div class="controls">
						<?php $first_name = array('name' => 'first_name', 'id' => 'first_name', 'placeholder' => 'Nombre', 'class' => 'input-large focused', 'value' => set_value('first_name')); ?>
						<?php echo form_input($first_name); ?>
						<?php echo form_error('first_name'); ?>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<?php $last_name = array('name' => 'last_name', 'id' => 'last_name', 'placeholder' => 'Apellido', 'class' => 'input-large focused','value' => set_value('last_name')); ?>
						<?php echo form_input($last_name); ?>
						<?php echo form_error('last_name'); ?>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on">@</span>
							<?php $username = array('name' => 'username', 'id' => 'username', 'placeholder' => 'Usuario', 'class' => 'input-large focused span3', 'value' => set_value('username')); ?>
							<?php echo form_input($username); ?>
							<?php echo form_error('username'); ?>
						</div>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
						<div class="input-prepend">
							<span class="add-on">
								<i class="icon-envelope"></i>
							</span>
							<?php $email_address = array('name' => 'email_address', 'id' => 'email_address', 'placeholder' => 'Correo', 'class' => 'input-large focused span3', 'value' => set_value('email_address')); ?>
							<?php echo form_input($email_address); ?>
							<?php echo form_error('email_address'); ?>
						</div>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
							<?php $options = array('direccion' => 'Direcci&oacute;n', 'coordinacion' => 'Coordinaci&oacute;n', 'recepcion' => 'Recepci&oacute;n', 'gerencia' => 'Gerencia', 'asistencia' => 'Asistencia Admnistrativa', 'finanzas' => 'Finanzas', 'soporte' => 'Soporte T&eacute;cnico', 'ventas' => 'Ventas', 'recursos' => 'Recursos Humanos', 'proveeduria' => 'Proveeduria', 'control' => 'Control de Calidad', 'relaciones' => 'Relaciones P&uacute;blicas');?>
							<?php echo form_dropdown('job_position', $options);?>
					</div>
				</div>

				 <div class="control-group">
					<div class="controls">
							<?php $password = array('name' => 'password', 'type' => 'password', 'id' => 'password', 'placeholder' => 'Contrase&ntilde;a', 'class' => 'input-large focused'); ?>
							<?php echo form_input($password); ?>
							<?php echo form_error('password'); ?>
					</div>
				</div>

				<div class="control-group">
					<div class="controls">
							<?php $password2 = array('name' => 'password2', 'type' => 'password', 'id' => 'password2', 'placeholder' => 'Confirmar Contrase&ntilde;a', 'class' => 'input-large focused'); ?>
							<?php echo form_input($password2); ?>
							<?php echo form_error('password2'); ?>
					</div>
				</div>

				<?php $submit = array('name' => 'submit', 'value' => 'Crear Usuario', 'id' => 'registerSubmit', 'type' => 'submit',  'class' => 'btn-normal btn-small'); ?>	
				<?php echo form_submit($submit); ?>

			</fieldset>
	    
	    <?php echo form_close(); ?>

	</div>
	<div id="signup-error" class="modal hide fade">
		<div class="modal-header">
          	<button type="button" class="close" data-dismiss="modal">×</button>
		    <h1>Registro Hood</h1>
        </div>
        <div class="modal-body">
			<p id="errorRegistro"></p>
		</div>
	</div>
</body>
</html>