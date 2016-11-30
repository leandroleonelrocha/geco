<aside class="main-sidebar">
        <!-- sidebar: style can be found in sidebar.less -->
        <section class="sidebar">
          <!-- Sidebar user panel -->
        
          <ul id="Defaultses" class="sidebar-menu"> 
              <!-- search form -->
          <form action="#" method="get" class="sidebar-form">
            <div class="input-group">
              <input type="text" name="q" class="form-control" placeholder="Search...">
              <span class="input-group-btn">
                <button type="submit" name="search" id="search-btn" class="btn btn-flat"><i class="fa fa-search"></i></button>
              </span>
            </div>
          </form>
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
                  <a href="{{route('dueño.estadisticas')}}"> <i class="fa fa-bar-chart-o"></i> <span>@lang('menu.estadistica')</span> </a>
                </li>

                <li class="treeview">
                  <a>
                    <i class="fa fa-user"></i> <span>@lang('menu.configuracion')</span><i class="fa fa-angle-left pull-right"></i>
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
                  <a>
                    <i class="fa fa-user"></i> <span>@lang('menu.configuracion')</span><i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li> <a href="{{route('director.perfil_editarPerfil',$u)}}"><i class="fa fa-circle-o"></i> @lang('menu.perfil')</a></li>
                    <li> <a href="{{ route('contrasena.nueva')}}"><i class="fa fa-circle-o"></i> @lang('menu.cambiarcontraseña')</a></li>
                  </ul>
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
                      <?php } ?>
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{route('filial.pagos_matriculas')}}">
                      <i class="fa fa-dollar"></i> <span>@lang('menu.pago')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.pagos_matriculas')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{route('filial.cursos') }}">
                      <i class="fa fa-circle-o"></i> <span>@lang('menu.curso')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.cursos')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                      <?php if($h == 1){ ?>
                      <li> <a href="{{route('filial.cursos_nuevo') }}"><i class="fa fa-circle-o"></i> @lang('menu.nuevo')</a></li>
                      <?php } ?>
                    </ul>
                  </li>


                  <li class="treeview">
                    <a href="{{route('filial.carreras')}}">
                      <i class="fa  fa-circle-o"></i> <span>@lang('menu.carrera')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.carreras')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                      <?php if($h == 1){ ?>
                      <li> <a href="{{route('filial.carreras_nuevo') }}"><i class="fa fa-circle-o"></i> @lang('menu.nueva')</a></li>
                      <?php } ?>
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{route('filial.materias')}}">
                      <i class="fa fa-circle-o"></i> <span>@lang('menu.materia')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.materias')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                      <?php if($h == 1){ ?>
                      <li> <a href="{{route('filial.materias_nuevo') }}"><i class="fa fa-circle-o"></i> @lang('menu.nueva')</a></li>
                      <?php } ?>
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


                  <li class="treeview">
                    <a href="{{route('filial.mails')}}">
                      <i class="fa fa-envelope"></i> <span>Mails</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.mails')}}"><i class="fa fa-circle-o"></i> @lang('menu.lista')</a></li>
                    </ul>
                  </li>

                  <li>
                    <a href="{{route('filial.estadisticas')}}"> <i class="fa fa-bar-chart-o"></i> <span>@lang('menu.estadistica')</span> </a>
                  </li>
  
                  <li class="treeview">
                    <a>
                      <i class="fa fa-wrench"></i> <span>@lang('menu.configuracion')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li> <a href="{{route('filial.perfil_editarPerfil',$u)}}"><i class="fa fa-circle-o"></i>@lang('menu.perfil')</a></li>
                      <li> <a href="{{route('filial.asignacionAsesores') }}"><i class="fa fa-circle-o"></i> @lang('menu.asignar')</a></li>
                      <li> <a href="{{ route('contrasena.nueva')}}"><i class="fa fa-circle-o"></i> @lang('menu.cambiarcontraseña')</a></li>
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

          </ul>
        </section>

        <!-- /.sidebar -->
      </aside>
   
