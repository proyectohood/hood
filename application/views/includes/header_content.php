<header class="container-fluid">
    <div class="container-fluid span12">
      <h1><a href="#">hood</a></h1>
      
          <a class="mini_icon_hood" href="#modal-editarHood"  data-toggle="modal"></a>

      <div class="btn-group pull-right">
              <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                <i class="icon-user confOptions"></i>
                <span class="caret"></span>
              </a>
              <ul class="dropdown-menu">
                <li><a href="#"><img src="<?php echo base_url() ?>img/userImages/user.jpg"> Perfil</a></li>
                <li><a href="#">Cerrar sesi&oacute;n</a></li>
              </ul>
          </div>

          <form>
        <input type="text" placeholder="Buscar">
              <div class="btn-group pull-right">
                <a class="btn dropdown-toggle" data-toggle="dropdown" href="#">
                  <i class="icon-user buscarOptions"></i>
                  <span class="caret"></span>
                </a>
                <ul class="dropdown-menu">
                  <li>
                     <a href="#" class="icon-user"><span>Usuario</span></a>
                  </li>
                  <li>
                     <a href="#" class="icon-tag"><span>Tema</span></a>
                  </li>
                  <li>
                     <a href="#" class="icon-envelope"><span>Email</span></a>
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
                <a href="#"></a>
                <input type="submit" name="publicar" value="" class="btn send_formRegis" id="modal-btnInsertHood">
            </fieldset>
          </form>
        </div>
      </div>

    </div>
  </header>