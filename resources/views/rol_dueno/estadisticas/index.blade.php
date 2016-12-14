@extends('template')
@section('css')
<link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
@endsection
@section('content')

@include('rol_dueno.partials.row_dueno')

<div class="row">
<div class="col-xs-12">
<div class="box box-success">
  <div class="box-header with-border">
    <h3 class="box-title">@lang('estadistica.busqueda')</h3>
  </div>
  <div class="box-body">
    {!! Form::model(Request::all(), ['route'=> 'dueno.estadisticas_detalles', 'method'=>'post', 'class'=>'form-horizontal']) !!} 
      @include('partials.estadisticas.view_form')  
    {!! Form::close() !!}
  </div>
</div>
</div>
</div>

@if(isset($secion))

    @if($secion == 'inscripcion')
        @include('partials.estadisticas.grafico_inscripcion', ['genero' => 'Estadísticas según género','nivel'=>'Estadísticas según nivel de estudios','persona'=> 'Estadísticas por persona'])
    @endif  

    @if($secion == 'preinforme')
        @include('partials.estadisticas.grafico_preinforme', ['titulo' => 'Inscripciones según preinformes'])
    @endif


@endif


@endsection

@section('js')
<script type="text/javascript">
$(function () {
    $('#torta').highcharts({
        chart: {
            plotBackgroundColor: null,
            plotBorderWidth: null,
            plotShadow: false
        },
        title: {
            <?php if(isset($total)){?>
            text: ' Cantidad de inscriptos: {{$total}} '
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


    //BAR CHART
        var bar = new Morris.Bar({
          element: 'bar-chart',
          resize: true,
          data: [
              <?php
              if(isset($disponibilidad))
               {
              foreach($disponibilidad as $insc ){
              ?>
               {y: '{{$insc["label"]}}', a: {{$insc["si"]}}, b: {{$insc["no"]}} },
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

    //DONUT CHART
    var donut = new Morris.Donut({
        element: 'sales-chart',
        resize: true,
        colors: ["#3c8dbc", "#f56954", "#00a65a"],
        data: [
           <?php
           if(isset($nivelEstudios))
           {
            foreach ($nivelEstudios as $key => $value) {
            ?>
            //{label: "Download Sales", value: 12},
            { label:'{{$key}}', value: {{$value->count()}} },

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