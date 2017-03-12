@extends('template')

@section('content')
	
	<section class="invoice">
          <!-- title row -->
          <div class="row">
            <div class="col-xs-12">
              <h2 class="page-header">
                <i class="fa fa-bar-chart"></i> @lang('estadistica.estadisticas') {{$filial->nombre}}
                <small class="pull-right">
                  @lang('estadistica.desde') {{$dia_inicio_mes}}
                  @lang('estadistica.hasta') {{$dia_fin_mes}}
                </small>

              </h2>
            </div><!-- /.col -->
          </div>
          
          <div class="row">
            <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>@lang('estadistica.fecha')</th>
                    <th>@lang('estadistica.informado')</th>
                    <th>@lang('estadistica.inscriptos')</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($preinformes as $preinforme)
                  <tr>

                    <td>{{$preinforme->fecha}}</td>
                    <td>{{$preinforme->total}}</td>
                    <td>
                      {{count($preinforme->Persona->Matricula)}}
                    </td>
                  </tr>

                  @endforeach
                   <tr>
                    <td></td>
                    <td>{{$preinformes->sum('total')}}</td>
                    <td>
                        <?php
                         $total=0;
                         foreach ($preinformes as $preinforme) {
                         $total += count($preinforme->Persona->Matricula);
                         }
                        ?>
                        {{$total}}   
                    </td>
                  </tr>
                  
                </tbody>
              </table>
            </div><!-- /.col -->
          </div><!-- /.row -->

          <div class="row">
            <p class="lead">@lang('estadistica.codasesor')</p>
           <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>@lang('estadistica.asesor')</th>
                    <th>@lang('estadistica.informado')</th>
                    <th>@lang('estadistica.inscriptos')</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($asesores as $asesor)
                  <tr>
                 
                    <td>{{$asesor->nombres}}</td>
                    
                   <td>
                    {{count($asesor->Preinforme()->whereDate('created_at', '>=', first_day_month())->whereDate('created_at','<=', last_day_month())->get()->toArray())}}

                    </td>
                    
                    <td>
                      {{count($asesor->Matricula()->whereDate('created_at', '>=', first_day_month())->whereDate('created_at','<=', last_day_month())->get()->toArray())}}
                    </td>
                   
                  </tr>
                  @endforeach
                  
                </tbody>
              </table>
            </div><!-- /.col -->
          </div>   

            <div class="row">
            <p class="lead">@lang('estadistica.codmedio')</p>
           <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>@lang('estadistica.medio')</th>
                    <th>@lang('estadistica.informado')</th>
                    <th>@lang('estadistica.inscriptos')</th>
                    
                  </tr>
                </thead>
                <tbody>
                  @foreach($medios as $medio)
                  <tr>

                    <td>{{$medio->PreinformeMedio->medio}}</td>
                    <td>{{$medio->total}}</td>
                    <td>
                    {{count($medio->Persona->Matricula)}}
                    </td>
                   
                  </tr>
                  @endforeach
                 
                  
                </tbody>
              </table>
            </div><!-- /.col -->
          </div>  

            <div class="row">
            <p class="lead">@lang('estadistica.codcurso')</p>
           <div class="col-xs-12 table-responsive">
              <table class="table table-striped">
                <thead>
                  <tr>
                    <th>#</th>
                    <th>@lang('estadistica.informado')</th>
                    <th>@lang('estadistica.inscriptos')</th>
                  </tr>
                </thead>
                <tbody>

                  @foreach($carreras as $carrera) 
                   <tr>
                    <td>{{$carrera->nombre}}</td>
                    <td>
                    {{count($carrera->PersonaInteres()->whereDate('created_at', '>=', first_day_month())->whereDate('created_at','<=', last_day_month())->get()->toArray())}} 
                    </td>
                    <td>
                    {{count($carrera->Matricula()->whereDate('created_at', '>=', first_day_month())->whereDate('created_at','<=', last_day_month())->get()->toArray())}} 
                    </td>
                  </tr>
                  @endforeach

                  @foreach($cursos as $curso) 
                   
                   <tr>
                    <td>{{$curso->nombre}}</td>
                    <td>
                    {{count($curso->PersonaInteres()->whereDate('created_at', '>=', first_day_month())->whereDate('created_at','<=', last_day_month())->get()->toArray())}} 
                    </td>
                    <td>
                    {{count($curso->Matricula()->whereDate('created_at', '>=', first_day_month())->whereDate('created_at','<=', last_day_month())->get()->toArray())}} 
                    </td>
                  </tr>
                  @endforeach

                  
                  
                  
                </tbody>
              </table>
            </div><!-- /.col -->
          </div>  


        </section>
@endsection