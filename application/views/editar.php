
<body>

  <?php $this->load->view('includes/header_content'); ?>

  <div class="container-fluid container_general span12">

    <div class="row-fluid">

      <div class="hood-body-box content_top">
        <a href="editar.html" class="btn-hood btn-normal btn-small">editar</a>
        <div class="span7">
          <img src="<?php echo base_url() . 'img/userImages/'.$url_img ?>"/>
          <h1><?php echo $name . " " . $last_name; ?></h1>
          <h2><?php echo $job_position ?></h2>
          <span>@<?php echo $name?></span>
        </div>


        <ul class="clearfix span4">
          <li class="span4">
            <h1>hoods</h1>
            <h2 class="hoodsAmount"><?php echo $numberHoods ?></h2>
          </li>
          <li class="span4">
            <h1>adjuntos</h1>
            <h2 class="attachmentsAmount"><?php echo $numberAttachments ?></h2>
          </li>
          <li class="span4 clearfix">
            <h1>suscripcion</h1>
            <a href="#" class="btn-hood btn-warn btn-small">RSS</a>
          </li>
        </ul>

      </div>

      <div class="span4 listaUsuarios">
        <h3>usuarios <span><?php echo $numberUsers ?></span></h3>
        <ul>
          <?php 
              foreach ($infoAllUsers as $clave => $valor){ ?>
                <li class="clearfix">
                  <a href="../perfil"><img src="<?php echo base_url() . 'img/userImages/' . $valor['url_img'] ?>"/></a>
                  <a href="../perfil">
                    <h1><?php echo $valor['name'] . " " . $valor['last_name']; ?></h1>
                    <h2><?php echo $valor['job_position'] ?></h2>
                    <span>@<?php echo $valor['username'] ?></span>
                  </a>
                </li>
            <?php   
                }
            ?>
        </ul>
      </div>

      <div class="span8 listaHoods">
        <h3>editar perfil</h3>

        <div class="editarPerfil">
          <?php
            $attributes = array('id' => 'formEditar');
            echo form_open('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI']."/verifyCredentials", $attributes);
          ?>
            <fieldset>
              <!-- Atributos de los inputs -->
              <?php 
                $user_name = array('name' => 'username', 'id' => 'username', 'placeholder' => 'Nombre de usuario', 'value' => set_value('username'));
                $pwd = array('name' => 'password', 'id' => 'password', 'placeholder' => 'Contraseña');
                $send_button = array('value' => '', 'name' => 'Guardar', 'type' => 'submit', 'id' => 'loginEditar', 'class' => 'btn-small');
              ?>
              <p class="clearfix">
                <?php echo form_input($user_name); ?>
                <?php echo form_error('username'); ?>
              </p>
              <p class="clearfix">
                <?php echo form_password($pwd); ?>
                <?php echo form_error('password'); ?>
              </p>
              <p class="clearfix">
                <?php $password2 = array('name' => 'password2', 'type' => 'password', 'id' => 'password2', 'placeholder' => 'Confirmar Contrase&ntilde;a', 'class' => 'input-large focused'); ?>
                <?php echo form_input($password2); ?>
                <?php echo form_error('password2'); ?>
              </p>

              <iframe id="upload_frame_img" src="<?php echo base_url();?>index.php/editar/cargar_upload" frameborder="0" scrolling="no"></iframe>

              <?php echo form_submit($send_button); ?>
            </fieldset>
            
            <div class="desactCuenta clearfix">
              <p>Si desactiva su cuenta no tendra acceso al sistema.</p>

              <a href="#modal-desactivarCuenta" class="btn-hood btn-warn btn-small" data-toggle="modal">desactivar cuenta</a>

            </div>
          <?php echo form_close(); ?>
        
        </div>
        <div id="edit-error" class="modal hide fade"></div>


         <!-- Modal editar Hood -->

      <div class="modal hide fade" id="modal-desactivarCuenta">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h1>Desactivaci&oacute;n cuenta Hood</h1>
        </div>
        <div class="modal-body">
          <p>¿Est&aacute; seguro que desea desactivar su cuenta?</p>
          <a href="#" class="btn-normal btn-small">Si</a>
          <a href="#" class="btn-warn btn-small" class="close" data-dismiss="modal">No</a>
        </div>
      </div>


      </div>
    </div>

  </div>
