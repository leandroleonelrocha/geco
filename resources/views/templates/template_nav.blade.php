<header class="main-header">
        <!-- Logo -->
        <div href="#" class="logo">
          <span class="logo-mini"><img src="{{asset('img/logo/Geco-Negro.png')}}"  height="35" width="35" > </span>
          <!-- <span class="logo-lg"><b>Admin</b>LTE</span> -->
         
            <div class="pull-left info magia">
              
              <a href="#"><i class="fa fa-circle text-success "></i></a>
            </div>
           
          <div class="pull-left image" style="margin-top: -0.4%"> <!--PASAR A CSS!!!!!!!!!!!ESTO ES INACEPTABLE-->
              <img src="{{asset('/img/logo/Logotipo 2.png')}}"  height="40" width="112" >
            </div>
          </div>

        <nav class="navbar navbar-static-top" role="navigation">

          <!-- Sidebar toggle button-->
          <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
            <span class="sr-only">Toggle navigation</span>
          </a>
          <!--FALTA EXPANDIR LA BARRA DESDE EL ESTILO PROPIO DEL BUSCADOR O ASIGANRLE UNA NUEVA DIMENSION DE COL -->
          <div class="navbar-custom-menu col-lg-2" style="margin-right: -5%;"> <!--CONTRAIGO LA BARRA DE NAVEGACION PARA QUE ENTRE EL BUSCADOR--> <!--PASAR A CSS!!!!!!!!!!!ESTO ES INACEPTABLE-->
            <ul class="nav navbar-nav">
              <!-- Messages: style can be found in dropdown.less-->
               <li class="buscame col-lg-2" style="margin-left: -318%;"> <!--PASAR A CSS!!!!!!!!!!!ESTO ES INACEPTABLE-->
              
                   <!-- sidebar menu: : style can be found in sidebar.less -->
              <li class="dropdown messages-menu ">
                <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <i class="fa fa-language"></i>
                </a>
                <!--EMPIEZA EL BOTON QUE DESPLIEGA IDIOMA-->
                <ul class="dropdown-menu">
                  <li>
                    <!-- inner menu: contains the actual data -->
                    <ul class="menu">
                      <li>
                        <a href="{{ url('lang', ['es']) }}">
                          @lang('header.espanol')
                          <div class="pull-left">
                            <img src=" {{asset('dist/img/español_128.png')}}" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            AdminLTE Design Team
                            <small><i class="fa fa-clock-o"></i> 2 hours</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('lang', ['en']) }}">
                        @lang('header.ingles')
                          <div class="pull-left">
                            <img src="{{asset('dist/img/english_128.png')}}" class="img-circle" alt="User Image">
                          </div>
                          <h4>
                            Developers
                            <small><i class="fa fa-clock-o"></i> Today</small>
                          </h4>
                          <p>Why not buy a new awesome theme?</p>
                        </a>
                      </li>
                    
                    </ul>
                  </li>
                 
                </ul>
                
              </li>
             
               <!--ACA DEBERIA DE ESTAR EL BUSCADOR-->
              </li>
              <!-- Notifications: style can be found in dropdown.less -->
             
              <!-- User Account: style can be found in dropdown.less -->
              <li class="dropdown user user-menu">
                <a href="{{route('auth.getLogout')}}" class="menu-icon fa fa-sign-out" > @lang('menu.salir')</a>
                    
        
                <!-- <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                  <img src="{{asset('dist/img/log.jpg')}}" class="user-image" alt="User Image">
                  <span class="hidden-xs">Alexander Pierce</span>
                </a>
                <ul class="dropdown-menu"> -->
                  <!-- User image -->
                  <!-- <li class="user-header">
                    <img src="{{asset('dist/img/log.jpg')}}" class="img-circle" alt="User Image">
                    <p>
                      Alexander Pierce - Web Developer
                      <small>Member since Nov. 2012</small>
                    </p>
                  </li> -->
                  <!-- Menu Body -->
                  <!-- <li class="user-body">
                    <div class="col-xs-4 text-center">
                      <a href="#">Followers</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Sales</a>
                    </div>
                    <div class="col-xs-4 text-center">
                      <a href="#">Friends</a>
                    </div>
                  </li> -->
                  <!-- Menu Footer-->
                  <!-- <li class="user-footer">
                    <div class="pull-left">
                      <a href="#" class="btn btn-default btn-flat">Profile</a>
                    </div>
                    <div class="pull-right">
                      <a href="#" class="btn btn-default btn-flat">Sign out</a>
                    </div>
                  </li>
                </ul> -->
              </li>
              <!-- Control Sidebar Toggle Button -->
              <li>
                
              </li>
            </ul>
          </div>
        </nav>
      </header>