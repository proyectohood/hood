<body>

 <?php $this->load->view('includes/header_content'); ?>

  <div class="container-fluid container_general span12">

    <div class="row-fluid">

      <div class="hood-body-box content_top">
        <a href="<?php echo base_url();?>index.php/editar" class="btn-hood btn-normal btn-small">editar</a>
        <div class="span7">
          <img src="<?php echo base_url() . 'img/userImages/'.$url_img ?>"/>
          <h1><?php echo $name . " " . $last_name; ?></h1>
          <h2><?php echo $job_position ?></h2>
          <span>@<?php echo $name ?></span>
        </div>


        <ul class="clearfix span4">
          <li class="span4">
            <h1>hoods</h1>
            <h2><?php echo $numberHoods ?></h2>
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
                    <span>@<?php echo $valor['username'] ?></span>
                  </a>
                </li>
            <?php   
                }
            ?>
        </ul>
      </div>

      <div class="span8 listaHoods">
        <h3>hoods</h3>
        <section class="hoodsContainer"></section>
  
      </div>
    </div>

  </div>

  <script type="text/javascript" src="<?php echo base_url();?>js/chargeHoodsByAjax.js"></script>