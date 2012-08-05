<body>

 <?php $this->load->view('includes/header_content'); ?>

  <div class="container-fluid container_general span12">

    <div class="row-fluid">

  
      <div class="span12 listaResultadosBusqueda">
        <h3>Resultados de b&uacute;squeda</h3>
        <section class="hoodsContainer">
        	<?php foreach ($hoodsResults as $user): ?>

        	<a class="clearfix" href="<?php echo base_url() . 'index.php/perfil/show/user/' . $user['username'] ?>">
        		<img src="<?php echo base_url() . 'img/userImages/' . $user['url_img'] ?>">
        		<div>
	        		<h1><?php echo $user['name'] . ' ' . $user['last_name']; ?></h1>
	        		<h2><?php echo $user['job_position']; ?></h2>
        		</div>
        		<p>
    				<span><?php echo '@' . $user['username']; ?></span>
	        		<span><?php echo $user['email']; ?></span>
        		</p>
        	</a>

        	<?php endforeach; ?>
        </section>

      </div>
    </div>

  </div>

  <!--<script type="text/javascript" src="<?php echo base_url();?>js/chargeHoodsByAjax.js"></script>-->