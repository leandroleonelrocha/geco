<aside class="control-sidebar control-sidebar-dark">
        <!-- Create the tabs -->
        <ul class="nav nav-tabs nav-justified control-sidebar-tabs">
          <li><a href="#control-sidebar-home-tab" data-toggle="tab"><i class="fa fa-home"></i></a></li>
          </li>
        </ul>
        <!-- Tab panes -->
        <div class="tab-content">
          <!-- Home tab content -->
          <div class="tab-pane" id="control-sidebar-home-tab">
            <ul class="control-sidebar-menu">

              <?php
              $s=session('usuario')['rol_id'];
              $ds=session('usuario');
              $u=$ds['entidad_id'];
                switch ($s){
                  case 2:
              ?>

              <li>
                  <a href="">
                    <i class="menu-icon fa fa-user bg-yellow"></i>
                    <div class="menu-info">
                      <h4 class="control-sidebar-subheading">Perfil</h4>
                    </div>
                  </a>
              </li>

              <li>
                <a href="{{route('auth.getLogout')}}">
                  <i class="menu-icon fa fa-sign-out bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cerrar sesión</h4>
                  </div>
                </a>
              </li>

              <?php
                break;
                case 3:
              ?>

              <li>
                <a href="{{route('director.perfil_editarPerfil',$u)}}">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Perfil</h4>
                  </div>
                </a>
              </li>

              <li>
                <a href="{{route('auth.getLogout')}}">
                  <i class="menu-icon fa fa-sign-out bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cerrar sesión</h4>
                  </div>
                </a>
              </li>

              <?php
                break;
                case 4:
              ?>

              <li>
                <a href="{{route('filial.perfil_editarPerfil',$u)}}">
                  <i class="menu-icon fa fa-user bg-yellow"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Perfil</h4>
                  </div>
                </a>
              </li>

              <li>
                <a href="{{route('auth.getLogout')}}">
                  <i class="menu-icon fa fa-sign-out bg-green"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cerrar sesión</h4>
                  </div>
                </a>
              </li>

              <ul>
                <h3 class="control-sidebar-heading">Configuración</h3>
              </ul>

              <li>
                <a href="{{route('filial.asignacionAsesores')}}">
                  <i class="menu-icon fa fa-users bg-blue"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Asignar Asesores</h4>
                  </div>
                </a>
              </li> 

              <?php
                break;
              }
              ?>

              <li>
                <a href="{{ route('contrasena.nueva')}}">
                  <i class="menu-icon fa fa-key bg-red"></i>
                  <div class="menu-info">
                    <h4 class="control-sidebar-subheading">Cambiar Contraseña</h4>
                  </div>
                </a>
              </li> 

            </ul><!-- /.control-sidebar-menu -->


          </div><!-- /.tab-pane -->
          <!-- Stats tab content -->
          <div class="tab-pane" id="control-sidebar-stats-tab">Stats Tab Content</div><!-- /.tab-pane -->
          <!-- Settings tab content<div class="tab-pane" id="control-sidebar-settings-tab"> -->
          

 

          </div><!-- /.tab-pane -->
        </div>
      </aside><!-- /.control-sidebar -->

       <!-- Control Sidebar -->
      
      <!-- Add the sidebar's background. This div must be placed
           immediately after the control sidebar -->
      <div class="control-sidebar-bg"></div>