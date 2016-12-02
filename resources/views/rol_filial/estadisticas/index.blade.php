@extends('template')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
@endsection
@section('content')    

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

<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">Ingrese una fecha y opción</h3>
   </div>
  <div class="box-body">
   {!! Form::model(Request::all(), ['route'=> 'estadisticas.detalles', 'method'=>'post', 'class'=>'form-horizontal'] ) !!}
      @include('partials.estadisticas.view_form')
    {!! Form::close() !!}
  </div>
</div>

@if(isset($secion))

    @if($secion == 'inscripcion')
        @include('partials.estadisticas.grafico_inscripcion', ['titulo' => 'Inscripciones'])
    @endif



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
            <?php if(isset($total)){?>
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


