<header class="main-header">
        <!-- Logo -->
        <div href="#" class="logo">
          <span class="logo-mini"><img src="{{asset('/img/logo/Geco-Negro.png')}}"   height="35" width="35" > </span>
          <!-- <span class="logo-lg"><b>Admin</b>LTE</span> -->
         
            <div class="pull-left info magia">
              
            <a href="#"><i class="fa fa-circle text-<?php if($h==1) echo 'success'; else echo 'danger'; ?> "></i></a>
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
          <div class="navbar-custom-menu">
            <ul class="nav navbar-nav">
              
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
                        </a>
                      </li>
                      <li>
                        <a href="{{ url('lang', ['en']) }}">
                        @lang('header.ingles')
                          <div class="pull-left">
                            <img src="{{asset('dist/img/english_128.png')}}" class="img-circle" alt="User Image">
                          </div>
                        </a>
                      </li>

                      <li>
                        <a href="{{ url('lang', ['pt']) }}">
                        @lang('header.portugues')
                          <div class="pull-left">
                            <img src="{{asset('dist/img/brazil.png')}}" class="img-circle" alt="User Image">
                          </div>
                        </a>
                      </li>
     
                    </ul>
                  </li>
                </ul>
              </li>

              <li>

                <a href="#" class="star_intro" ><i class="fa fa-info-circle"></i></a>
              </li>

              <li class="dropdown user user-menu">
                <a href="{{route('auth.getLogout')}}" class="fa fa-sign-out" > @lang('menu.salir')</a>
              </li>
            </ul>
          </div>
        </nav>
      </header>