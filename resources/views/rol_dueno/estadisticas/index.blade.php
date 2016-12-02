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
    <h3 class="box-title">Collapsable</h3>
  </div>
  <div class="box-body">
    {!! Form::model(Request::all(), ['route'=> 'dueno.estadisticas_detalles', 'method'=>'post', 'class'=>'form-horizontal']) !!} 
      @include('partials.estadisticas.view_form')  
    {!! Form::close() !!}
  </div>
</div>
</div>
</div>

@if(isset($genero))
    <div class="row">
        <div class="col-lg-12 col-xs-12">
            @include('partials.estadisticas.view_genero', ['titulo' => 'Total de inscripciones por géneros'])
            @include('partials.estadisticas.view_nivelestudio', ['titulo' => 'Nivel de estudios'])
        </div>
    </div>
@endif

@if(isset($preinforme))
    <div id="torta"></div>
    <br><br>
@endif



@if(isset($inscripcion))
    @include('partials.estadisticas.view_porpersona', ['titulo' => 'Estadisticas total de personas'])
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
              if(isset($inscripcion))
               {
              foreach($inscripcion as $insc ){
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
           if(isset($nivel))
           {
            foreach ($nivel as $key => $value) {
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