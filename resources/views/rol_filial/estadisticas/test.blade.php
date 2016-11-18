<<<<<<< HEAD
@extends('template')
@section('css')
        <style type="text/css">
${demo.css}

        </style>
  <!-- Morris charts -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
@endsection
@section('content')

<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Collapsable</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    {!! Form::model(Request::all(), ['route'=> 'estadisticas.estadistica_preinformes_ajax', 'method'=>'post']) !!}
          <div class="col-xs-4">
             {!! Form::text('fecha', null ,  array('class'=>'form-control', 'id'=>'reservation')) !!}
          </div>
          <div class="col-xs-4">
           <select class="form-control" id="selectvalue" name="selectvalue">
              <option value="inscripcion">Inscripciones</option>
              <option value="preinforme">Pre informes</option>
              <option value="recaudacion">Recaudación</option>
              <option value="morosidad">Morosidad</option>
            </select>
          </div>

          <div class="col-xs-2">
           <button class="btn btn-block btn-default " id="btn_buscar">Buscar</button>
          </div>
    {!! Form::close() !!}
  </div><!-- /.box-body -->
</div><!-- /.box -->
<div id="torta"></div>
<br><br>
<div id="bar"></div>
<br><br>
 <!-- BAR CHART -->
              <div class="box box-success">
                <div class="box-header with-border">
                  <h3 class="box-title">Bar Chart</h3>
                  <div class="box-tools pull-right">
                    <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
                    <button class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                  </div>
                </div>
                <div class="box-body chart-responsive">
                  <div class="chart" id="bar-chart" style="height: 300px;"></div>
                </div><!-- /.box-body -->
              </div><!-- /.box -->

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
            text: '¿ Como nos encontró ?'
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
            name: 'Deudores',
            data: [

                <?php

                if(session()->has('data'))
                {
                    foreach(Session::get('data') as $data => $value)
                    {

                    ?>

                     ['{{$data}}', {{$value->count()}} ],


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

                  if(session()->has('data'))
                  {
                  foreach(Session::get('data') as $data => $value)
                  {
                  ?>

              ['{{$data}}', {{$value->count()}} ],


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



});
</script>

    <!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('js/Highcharts-4.1.5/js/highcharts.js')}}"></script>
<script src="{{asset('js/Highcharts-4.1.5/js/modules/exporting.js')}}"></script>
@endsection


=======
test.blade.php
>>>>>>> 476d734517b30d4481c239fe09fcb5e9c10c4a55
