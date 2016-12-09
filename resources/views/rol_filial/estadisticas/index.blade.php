@extends('template')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
@endsection
@section('content')    

<<<<<<< HEAD
 <div class="row">      
            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                   <h1> {{$persona}} </h1>
                  <p>@lang('estadistica.personasi')</p>
                </div>
                <div class="icon">
                  <i class="ion ion-ios-people-outline"></i>
                </div>
                <a href="#" class="small-box-footer">@lang('estadistica.masinformacion')<i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->

            <div class="col-lg-6 col-xs-6">
              <!-- small box -->
              <div class="small-box bg-yellow">
                <div class="inner">
                   <h1> {{$asesores}} </h1>
                  <p>@lang('estadistica.asesoresr')</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">@lang('estadistica.masinformacion') <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div><!-- ./col -->
         
          </div><!-- /.row -->
=======
<div class="row">      
  <div class="col-lg-6 col-xs-6">
  <div class="small-box bg-yellow">
  <div class="inner">
  <h1>@if(isset($totalPersonas)){{$totalPersonas}}@endif</h1>
  <p>Personas Inscriptas</p>
  </div>
  <div class="icon">
  <i class="ion ion-ios-people-outline"></i>
  </div>
  <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
  </div>
  </div>
  <div class="col-lg-6 col-xs-6">
  <div class="small-box bg-yellow">
  <div class="inner">
  <h1>@if(isset($totalAsesores)){{$totalAsesores}}@endif</h1>
  <p>Asesores Registrados</p>
  </div>
  <div class="icon">
  <i class="ion ion-person-add"></i>
  </div>
  <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
  </div>
  </div>
</div>
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9

<div class="box box-success">
  <div class="box-header with-border">
<<<<<<< HEAD
    <h3 class="box-title">@lang('estadistica.ingresefecha')</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    {!! Form::model(Request::all(), ['route'=> 'estadisticas.detalles', 'method'=>'post']) !!} 

          <div class="col-xs-4">
             {!! Form::text('fecha', null ,  array('class'=>'form-control', 'id'=>'reservation')) !!}
          </div>
          <div class="col-xs-4">
           <select class="form-control" id="selectvalue" name="selectvalue">
              <option value="inscripcion">@lang('estadistica.inscripciones')</option>
              <option value="preinforme">@lang('estadistica.preinformes')</option>
              <option value="recaudacion">@lang('estadistica.recaudacion')</option>
              <option value="morosidad">@lang('estadistica.morosidad')</option>
              <option value="examen">@lang('estadistica.examen')</option>
            </select>
          </div> 

          <div class="col-xs-2">
           <button class="btn btn-block btn-success " id="btn_buscar">@lang('estadistica.buscar')</button>
          </div> 
=======
    <h3 class="box-title">Ingrese una fecha y opción</h3>
   </div>
  <div class="box-body">
   {!! Form::model(Request::all(), ['route'=> 'estadisticas.detalles', 'method'=>'post', 'class'=>'form-horizontal'] ) !!}
      @include('partials.estadisticas.view_form')
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
    {!! Form::close() !!}
  </div>
</div>

<<<<<<< HEAD
  </div><!-- /.box-body -->
</div><!-- /.box -->

@if(isset($genero))
 <div class="row">
            <div class="col-md-6">
             <div class="box box-success">
  <div class="box-header with-border">
                  <h3 class="box-title">@lang('estadistica.porcentaje')</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="torta" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>

            <div class="col-md-6">

              <div class="box box-success">
  <div class="box-header with-border">
                  <h3 class="box-title">@lang('estadistica.nivelestudios')</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="sales-chart" style="height: 300px; position: relative;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

            </div>

=======
@if(isset($secion))
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9

    @if($secion == 'inscripcion')
        @include('partials.estadisticas.grafico_inscripcion', ['genero' => 'Inscripciones según género','nivel'=>'Estadísticas según nivel de estudio','persona'=>'Estadística por personas'])
    @endif

    @if($secion == 'preinforme')
        @include('partials.estadisticas.grafico_preinforme', ['titulo' => 'Inscripciones'])
    @endif

<<<<<<< HEAD
@if(isset($inscripcion))
<div class="box box-success">
  <div class="box-header with-border">
  <h3 class="box-title">@lang('estadistica.estadisticapersonas')</h3>
  <div class="box-tools pull-right">
    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
  </div>
  </div>
  <div class="box-body chart-responsive">
  <div class="chart" id="bar-chart" style="height: 300px;"></div>
  </div><!-- /.box-body -->
</div><!-- /.box -->
=======
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
@endif


@endsection


@section('js')
<script type="text/javascript">
$(function () {
    //Grafico torata para generos
    $('#torta').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        exporting: {
         enabled: false
        },
        title: {
            <?php if(isset($totalPersonasFilial)){?>
            text: ' Cantidad de inscriptos: {{$totalPersonasFilial}} '
            <?php }?>
            
        },
        tooltip: {
            pointFormat: '{series.name}: <b>{point.percentage:.1f}%</b>'
        },
        plotOptions: {
            pie: {
                allowPointSelect: true,
                cursor: 'pointer',
                dataLabels: {
                    enabled: true,
                    format: '<b>{point.name}</b>: {point.percentage:.1f} %',
                    style: {
                        color: (Highcharts.theme && Highcharts.theme.contrastTextColor) || 'black'
                    }
                }
            }
        },
        series: [{
            type: 'pie',
            name: 'Genero',
            data: [
                //si existe genero
                <?php
                if(isset($genero))
                {
                    foreach ($genero as $key => $value) {
                    ?>
                     ['{{$value['nombre']}}', {{$value['count'] }} ],
                    <?php
                    }
                }
                ?>
                //si existe preinforme
                 <?php
                if(isset($preinforme))
                { 
                  
                    foreach ($preinforme as $key => $value) {
                    ?>
                      [ '{{$key}}', {{$value->count()}} ],
                    <?php
                    }
                }
                ?>

            ]
        }]
    });//Fin de la torta

        //grafico disponibilidad por persona
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
              <?php
              if(isset($disponibilidad))
               {
             for($i=0; $i<count($disponibilidad); $i++){
              ?>
               {y: '{{$disponibilidad[$i]['label']}}', a: {{$disponibilidad[$i]['si']}}, b: {{$disponibilidad[$i]['no']}} },
              <?php
               }
                }
              ?>
          ],
          barColors: ['#00a65a', '#f56954'],
          xkey: 'y',
          ykeys: ['a','b'],
          labels: ['SI','NO'],
          hideHover: 'auto'
        });
   
       //Grafico por nivel de estudios
        var donut = new Morris.Donut({
          element: 'sales-chart',
          resize: true,
          colors: ["#3c8dbc", "#f56954", "#00a65a"],
          data: [

            <?php
            if(isset($nivelEstudios))
            { 
              foreach($nivelEstudios as $val => $key){
            ?>

            {label: "{{$val}}", value: {{$key->count()}}},
           
            <?php
              }
            }
            ?>
          ],
          hideHover: 'auto'
        });

});
</script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('js/Highcharts-4.1.5/js/highcharts.js')}}"></script>
<script src="{{asset('js/Highcharts-4.1.5/js/modules/exporting.js')}}"></script>
@endsection


