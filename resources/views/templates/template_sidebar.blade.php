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
              switch (session('usuario')['rol_id']) {
                case 2: 
            ?>
                <li class="treeview">
                  <a href="{{route('dueño.directores')}}">
                    <i class="fa fa-child"></i> <span>@lang('menu.directores')</span><i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li class="active"><a href="{{route('dueño.directores')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                    <li> <a href="{{route('dueño.directores_nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                  </ul>
                </li>

                <li class="treeview">
                  <a href="{{route('dueño.filiales')}}">
                    <i class="fa fa-child"></i> <span>@lang('menu.filiales')</span><i class="fa fa-angle-left pull-right"></i>
                  </a>
                  <ul class="treeview-menu">
                    <li class="active"><a href="{{route('dueño.filiales')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                    <li> <a href="{{route('dueño.filiales_nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                  </ul>
                </li>

                <li>
                  <a href="#"> <i class="fa fa-bar-chart-o"></i> <span>@lang('menu.estadistica')</span> </a>
                </li>
            <?php
                break;
                case 3:
                break;
                case 4:
            ?>
                <li class="treeview">
                    <a href="{{route('filial.personas')}}">
                      <i class="fa fa-user"></i> <span>@lang('menu.persona')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.personas')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.personas_nuevo') }}"><i class="fa fa-circle-o"></i> Nueva</a></li>
                    </ul>
                </li>

                <li class="treeview">
                    <a href="{{route('filial.preinformes')}}">
                      <i class="fa fa-list-alt"></i> <span>@lang('menu.preinforme')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.preinformes')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.preinformes_seleccion') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                    </ul>
                </li>

                  <li class="treeview">
                    <a href="{{route('filial.matriculas')}}">
                      <i class="fa fa-user"></i> <span>@lang('menu.matricula')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.matriculas')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.matriculas_seleccion') }}"><i class="fa fa-circle-o"></i> Nueva</a></li>
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{route('filial.recibos')}}">
                      <i class="fa fa-pencil-square-o"></i> <span>@lang('menu.recibo')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.recibos')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.recibo_nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>"treeview-menu"
                    </ul>
                  </li>



                  <li class="treeview">
                    <a href="{{route('filial.cursos') }}">
                      <i class="fa fa-user"></i> <span>@lang('menu.curso')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.cursos')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.cursos_nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>"treeview-menu"
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{route('filial.carreras')}}">
                      <i class="fa fa-user"></i> <span>@lang('menu.carrera')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>

                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.carreras')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.carreras_nuevo') }}"><i class="fa fa-circle-o"></i> Nueva</a></li>
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{route('filial.materias')}}">
                      <i class="fa fa-user"></i> <span>@lang('menu.materia')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.materias')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.materias_nuevo') }}"><i class="fa fa-circle-o"></i> Nueva</a></li>
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{ route('grupos.index')}}">
                      <i class="fa  fa-users"></i> <span>@lang('menu.grupo')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                        <li class="active"><a href="{{route('grupos.index')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                        <li> <a href="{{route('grupos.nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                    </ul>
                  </li>

                  <li class="treeview">
                    <a href="{{route('filial.examenes')}}">
                    <i class="fa fa-file-text-o"></i> <span>@lang('menu.examen')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.examenes')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                        <li class="active"><a href="{{route('filial.examenes_nuevo')}}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                    </ul>
                  </li>

 

                  <li class="treeview">
                    <a href="{{route('filial.asesores')}}">
                      <i class="fa fa-user"></i> <span>@lang('menu.asesor')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.asesores')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.asesores_nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                       <li> <a href="{{route('filial.asignacionAsesores') }}"><i class="fa fa-circle-o"></i> Asignaci&oacute;n a filial</a></li>
                    </ul>
                  </li>



                  <li class="treeview">
                    <a href="{{route('filial.docentes')}}">
                      <i class="fa fa-user"></i> <span>@lang('menu.docente')</span><i class="fa fa-angle-left pull-right"></i>
                    </a>
                    <ul class="treeview-menu">
                      <li class="active"><a href="{{route('filial.docentes')}}"><i class="fa fa-circle-o"></i> Lista</a></li>
                      <li> <a href="{{route('filial.docentes_nuevo') }}"><i class="fa fa-circle-o"></i> Nuevo</a></li>
                    </ul>
                  </li>

                  <li>
                  <a href="#">
                    <i class="fa fa-bar-chart-o"></i> <span>@lang('menu.estadistica')</span>
                  </a>
                  </li>
            <?php
                break;
              }
            ?>
                <li>
                  <a href="#">
                    <i class="fa fa-contao"></i> <span>@lang('menu.contacto')</span>
                  </a>
                </li>

    
           
            
        <!-- /.sidebar -->
      </aside>
   
