<body>
  <?php $this->load->view('includes/header_content');?>

  <div class="container-fluid container_general span12">

    <div class="row-fluid">
      <div class="span4">
        <div class="clearfix">
          <img src="<?php echo base_url() .'img/userImages/'. $url_img ?>"/>
          <h1><?php echo $name . " " . $last_name; ?></h1>
          <h2><?php echo $job_position ?></h2>
        </div>
        <ul class="clearfix">
          <li class="span4">
            <h1>hoods</h1>

            <h2 class="hoodsAmount"><?php echo $numberHoods ?></h2>
          </li>
          <li class="span4">
            <h1>adjuntos</h1>
            <h2 class="attachmentsAmount"><?php echo $numberAttachments ?></h2>
          </li>
        </ul>
      </div>

      <div class="span8 content_top">
        <!-- Abrir el formulario-->
        <?php
          $attributes = array('class' => 'form-horizontal', 'id' => 'formPublishHood');
          echo form_open('http://'.$_SERVER['HTTP_HOST'].$_SERVER['REQUEST_URI'], $attributes);
        ?>


          <fieldset>

            <!-- Atributos de los inputs -->
            <?php 
              $textHood = array('name' => 'texthood', 'class' => 'span9', 'id' => 'inputTextHood', 'placeholder' => 'Escriba su hood aqui..', 'maxlength' => '500');
              $send_button = array('value' => '', 'name' => 'publicar', 'class' => 'btn send_formRegis', 'type' => 'submit', 'id' => 'btnInsertHood');
            ?>

            <div class="span10">
              <?php echo form_textarea($textHood); ?>
              <?php echo form_error('texthood'); ?>
              <a href="#" id="upload_button"></a>
              <iframe id="upload_frame" src="<?php echo base_url();?>index.php/gallery" frameborder="0" scrolling="no"></iframe>
            </div>
            <span></span>
            <?php echo form_submit($send_button); ?>
          </fieldset>

          
      <!-- Cerrar el formulario -->
      <?php echo form_close();?>
      </div>

      <div class="span4 listaUsuarios">
        <h3>usuarios <span><?php echo $numberUsers ?></span></h3>
        <ul>
          <?php 
              foreach ($infoAllUsers as $clave => $valor){ ?>
                <li class="clearfix">
                  <?php if($valor['username'] == $currentUser){ ?>
                  <a href="<?php echo base_url() . "index.php/perfil/"; ?>"><img src="<?php echo base_url() . 'img/userImages/' . $valor['url_img'] ?>"/></a>
                  <a href="<?php echo base_url() . "index.php/perfil/"; ?>">
                  <?php } 
                  		else{?>
                  		<a href="<?php echo base_url() . "index.php/perfil/show/user/" . $valor['username'] ?>"><img src="<?php echo base_url() . 'img/userImages/' . $valor['url_img'] ?>"/></a>
                  <a href="<?php echo base_url() . "index.php/perfil/show/user/" . $valor['username'] ?>">
                  <?php } ?>
                    <h1><?php echo $valor['name'] . " " . $valor['last_name']; ?></h1>
                    <h2><?php echo $valor['job_position'] ?></h2>
                    <span>@<?php echo $valor['name'] ?></span>
                  </a>
                </li>
            <?php   
                }
            ?>
        </ul>
      </div>

      <div class="span8">
        <h3>hoods</h3>
        <section class="hoodsContainer"></section>
            <?php /*
              foreach ($records as $clave => $valor){ ?>
            
                <div>
                  <a href="#">
                    <img src="../img/img_perfil.png"/>
                    <h1><?php echo $valor['user']; ?></h1>
                    <span>@<?php echo $valor['username']; ?></span>
                  </a>
                  <p><?php echo $valor['text']; ?></p>
                  <div>
                    <span><?php echo $valor['time']; ?></span>
                    <span><?php echo $valor['date']; ?></span>
                    <a href="#">Archivo adjunto.pdf</a>
                  </div>
                </div>

            <?php   
                }*/
            ?>
        
        <div>
             <!-- <a class="btnVerMas" href="JavaScript:void(0);">Ver m&aacute;s</a> -->
        </div>
      </div>
    </div>


  </div>


  
    
  <script type="text/javascript" src="<?php echo base_url();?>js/chargeHoodsByAjax.js"></script>

