<aside class="main-sidebar">
    <section class="sidebar">
          <!-- sidebar: style can be found in sidebar.less -->
            <!-- Sidebar user panel -->
          
            <ul id="Defaultses" class="sidebar-menu"> 
                <!-- search form -->
            <!-- <form action="#" method="get" class="sidebar-form">
              <div class="input-group">
                <input type="text" name="q" class="form-control" placeholder="Search...">
                <span class="input-group-btn">
                  <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
                </span>
              </div>
            </form> -->
            <!-- /.search form -->
              <?php
                $u = session('usuario')['entidad_id'];
                $h = session('usuario')['habilitado'];
                switch (session('usuario')['rol_id']) {
                  case 2: 
              ?>
                  <li class="treeview">
                    <a href="{{route('dueño.directores')}}">
                      <i class="fa fa-child"></i> <span>@lang('menu.directores')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('dueño.directores')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                      <li> <a href="{{route('dueño.directores_nuevo') }}"><i class="fa fa-circle-o"></i> @lang('menu.nuevo')</a></li>
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{route('dueño.filiales')}}">
                      <i class="fa fa-child"></i> <span>@lang('menu.filiales')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('dueño.filiales')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                      <li> <a href="{{route('dueño.filiales_nuevo')}}"><i class="fa fa-circle-o"></i> @lang('menu.nuevo')</a></li>
                    </ul>
                  </li>

                  <li>
                    <a href="#" > <i class="fa fa-bar-chart-o"></i> <span>@lang('menu.estadistica')</span> </a>
                  </li>

                  <li class="treeview">
                    <a href="#">
                      <i class="fa fa-wrench"></i> <span>@lang('menu.configuracion')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li> <a href="{{ route('contrasena.nueva')}}"><i class="fa fa-circle-o"></i> @lang('menu.cambiarcontraseña')</a></li>
                    </ul>
                  </li>
                  <?php
                  break;
                  case 3:
                  ?>
                  <li>
                    <a href="{{route('director.estadisticas')}}"> <i class="fa fa-bar-chart-o"></i> <span>@lang('menu.estadistica')</span> </a>
                  </li>

                  <li class="treeview">
                    <a href="">
                      <i class="fa fa-wrench"></i> <span>@lang('menu.configuracion')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
<!--                     <ul class="treeview-menu">
                      <li> <a href="{{route('director.perfil_editarPerfil',$u)}}"><i class="fa fa-circle-o"></i> @lang('menu.perfil')</a></li>
                    </ul> -->
                  </li>

              <?php
                  break;
                  case 4:
              ?>
                  <li class="treeview">
                      <a href="{{route('filial.personas')}}">
                        <i class="fa fa-user"></i> <span>@lang('menu.persona')</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li class="active"><a href="{{route('filial.personas')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                        <?php if($h == 1){ ?>
                        <li> <a href="{{route('filial.personas_nuevo') }}"><i class="fa fa-circle-o"></i> @lang('menu.nueva')</a></li>
                        <?php } ?>
                      </ul>
                  </li>

                  <li class="treeview">
                      <a href="{{route('filial.preinformes')}}">
                        <i class="fa fa-list-alt"></i> <span>@lang('menu.preinforme')</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li class="active"><a href="{{route('filial.preinformes')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                        <?php if($h == 1){ ?>
                        <li> <a href="{{route('filial.preinformes_seleccion') }}"><i class="fa fa-circle-o"></i> @lang('menu.nuevo')</a></li>
                        <?php } ?>
                      </ul>
                  </li>

                    <li class="treeview">
                      <a href="{{route('filial.matriculas')}}">
                        <i class="fa fa-graduation-cap"></i> <span>@lang('menu.matricula')</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li class="active"><a href="{{route('filial.matriculas')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                        <?php if($h == 1){ ?>
                        <li> <a href="{{route('filial.matriculas_seleccion') }}"><i class="fa fa-circle-o"></i> @lang('menu.nueva')</a></li>
                        <li> <a href="#" class="not-active"><i class="fa fa-circle-o"></i> @lang('menu.pases')</a></li>
                        <?php } ?>
                      </ul>
                    </li>

                    <li class="treeview">
                      <a href="{{route('filial.cursos') }}">
                        <i class="fa fa-circle-o"></i> <span>Pagos</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li class="active"><a href="{{route('estadisticas.caja_diaria')}}"><i class="fa fa-circle-o"></i> Caja diaria</a></li>
                        <li class="active"><a href="{{route('filial.vista_libro_iva')}}"><i class="fa fa-circle-o"></i> Morosidad - IVA</a></li>

                      </ul>
                    </li>
                   
                    <li class="treeview">
                      <a href="{{ route('grupos.index')}}">
                        <i class="fa  fa-users"></i> <span>@lang('menu.grupo')</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                          <li class="active"><a href="{{route('grupos.index')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                          <?php if($h == 1){ ?>
                          <li> <a href="{{route('grupos.nuevo') }}"><i class="fa fa-circle-o"></i> @lang('menu.nuevo')</a></li>
                          <?php } ?>
                          <li> <a href="{{route('grupos.clases') }}"><i class="fa fa-circle-o"></i> @lang('menu.clases')</a></li>
                      </ul>
                    </li>

                    <li class="treeview">
                      <a href="{{route('filial.examenes')}}">
                      <i class="fa fa-file-text-o"></i> <span>@lang('menu.examen')</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li class="active"><a href="{{route('filial.examenes')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                          <?php if($h == 1){ ?>
                          <li class="active"><a href="{{route('filial.examenes_nuevo')}}"><i class="fa fa-circle-o"></i> @lang('menu.nuevo')</a></li>
                          <?php } ?>
                      </ul>
                    </li>

   

                    <li class="treeview">
                      <a href="{{route('filial.asesores')}}">
                        <i class="fa fa-user"></i> <span>@lang('menu.asesor')</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li class="active"><a href="{{route('filial.asesores')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                        <?php if($h == 1){ ?>
                        <li> <a href="{{route('filial.asesores_nuevo') }}"><i class="fa fa-circle-o"></i> @lang('menu.nuevo')</a></li>
                        <?php } ?>
                      </ul>
                    </li>



                    <li class="treeview">
                      <a href="{{route('filial.docentes')}}">
                        <i class="fa fa-user"></i> <span>@lang('menu.docente')</span><i class="fa fa-angle-left pull-right"></i>
                      </a>
                      <ul class="treeview-menu">
                        <li class="active"><a href="{{route('filial.docentes')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                        <?php if($h == 1){ ?>
                        <li> <a href="{{route('filial.docentes_nuevo') }}"><i class="fa fa-circle-o"></i> @lang('menu.nuevo')</a></li>
                        <?php } ?>
                      </ul>
                    </li>

                    <li>
                      <a href="#" class="not-active"> <i class="fa fa-envelope"></i> <span>Mails</span> </a>
                    </li>

                    <li>
                      <a href="{{route('estadisticas.preinforme')}}" > <i class="fa fa-bar-chart-o"></i> <span>@lang('menu.estadistica')</span> </a>
                      
                    </li>
    
                    <li class="treeview">
                      <a href="">
                        <i class="fa fa-wrench"></i> <span>@lang('menu.configuracion')</span><i class="fa fa-angle-left pull-right"></i>
                      </a>

                      <ul class="treeview-menu">
                        <li> 
                          <a href="{{route('filial.perfil_editarPerfil',$u)}}"><i class="fa fa-circle-o"></i>@lang('menu.perfil')</a>
                        </li>
                        
                        <li> 
                          <a href="{{route('filial.asignacionAulas_nuevo')}}"><i class="fa fa-circle-o"></i>Aulas</a>
                        </li>
                       
                        <li> 
                          <a href="{{route('filial.preinformes_nuevoDatos')}}"><i class="fa fa-circle-o"></i>@lang('menu.asignardatospreinforme')</a>
                        </li>
                        
                      </ul>
                    </li> 

              <?php
                  break;
                }
              ?>

              <li>
                <a href="{{route('filial.contacto')}}">
                  <i class="fa fa-phone"></i> <span>@lang('menu.contacto')</span>
                </a>
              </li>

              <li>
                <a href="https://drive.google.com/file/d/0Bynkrt-QFIH7dVh0R2paX0lRLXM/view?usp=sharing" target="_blank">
                  <i class="fa fa-book"></i> <span>Manual</span>
                </a>
              </li>

            </ul>
          </section>
    <!-- /.sidebar -->
  
</aside>
   
