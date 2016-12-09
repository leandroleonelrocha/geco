@extends('template')
@section('css')
        <style type="text/css">
${demo.css}

        </style>
  <!-- Morris charts -->
    <link rel="stylesheet" href="{{asset('plugins/morris/morris.css')}}">
@endsection
@section('content')    

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

<div class="box box-default">
  <div class="box-header with-border">
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
    {!! Form::close() !!}

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


</div>          <br><br>
@endif


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
        exporting: {
         enabled: false
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
             for($i=0; $i<count($inscripcion); $i++){
             
              ?>

               {y: '{{$inscripcion[$i]['label']}}', a: {{$inscripcion[$i]['si']}}, b: {{$inscripcion[$i]['no']}} },
           
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
              foreach($nivel as $val => $key){
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

    <!-- Morris.js charts -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/raphael/2.1.0/raphael-min.js"></script>
<script src="{{asset('plugins/morris/morris.min.js')}}"></script>
<script src="{{asset('js/Highcharts-4.1.5/js/highcharts.js')}}"></script>
<script src="{{asset('js/Highcharts-4.1.5/js/modules/exporting.js')}}"></script>
@endsection


