<header class="container-fluid">
    <div class="container-fluid span12">
      <h1><a href="<?php echo base_url() ?>index.php/poste">hood</a></h1>
      
      <a class="mini_icon_hood" href="#modal-editarHood" data-toggle="modal"></a>

      <div class="btn-group pull-right">
        <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
          <i class="icon-user"></i>
          <span class="caret"></span>
        </a>
        <ul class="dropdown-menu">
          <li><a href="<?php echo base_url() ?>index.php/perfil"><img src="<?php echo base_url() ?>img/userImages/user.jpg"> Perfil</a></li>
          <li><a href="<?php echo base_url() ?>index.php/login/logout">Cerrar sesi&oacute;n</a></li>
        </ul>
      </div>

      <form id="formSearch" action="<?php echo base_url() ?>index.php/search/searchbyusername" method="get">
        <input type="text" placeholder="Buscar" name='q'>
        <div class="btn-group pull-right">
          <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
            <i class="icon-search" id="icon_general_search"></i>
            <span class="caret"></span>
          </a>
          <ul class="dropdown-menu">
            <li id="link_search_user">
               <a href="javascript:void(0)" class="icon-user"><span>Usuario</span></a>
            </li>
            <li id="link_search_tag">
               <a href="javascript:void(0)" class="icon-tag"><span>Tema</span></a>
            </li>
            <li id="link_search_email">
               <a href="javascript:void(0)" class="icon-envelope"><span>Email</span></a>
            </li>
          </ul>
        </div>
      </form>



      <!-- Modal editar Hood -->

      <div class="modal hide fade" id="modal-editarHood">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">×</button>
          <h1>¿Que quieres compartir?</h1>
        </div>
        <div class="modal-body">
          <form>
            <fieldset>
                <textarea placeholder="Escriba su hood aqui.." class="span7"></textarea>
                <a href="javascript:void(0)"></a>
                <input type="submit" name="publicar" value="" class="btn send_formRegis" id="modal-btnInsertHood">
            </fieldset>
          </form>
        </div>
      </div>

    </div>
  </header>