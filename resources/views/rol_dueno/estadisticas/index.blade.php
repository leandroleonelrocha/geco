@extends('template')
@section('content')

<div class="row">
<div class="col-xs-12">
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Collapsable</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div><!-- /.box-tools -->
  </div><!-- /.box-header -->
  <div class="box-body">
    {!! Form::model(Request::all(), ['route'=> 'estadisticas.detalles', 'method'=>'get']) !!} 

          <div class="col-xs-4">
             {!! Form::text('fecha', null ,  array('class'=>'form-control', 'id'=>'reservation')) !!}
          </div>
          <div class="col-xs-4">
           <select class="form-control" id="selectvalue" name="selectvalue">
              <option value="inscripcion">Inscripciones</option>
              <option value="preinforme">Pre informes</option>
              <option value="recaudacion">Recaudación</option>
              <option value="morosidad">Morosidad</option>
              <option value="examen">Examen</option>
            </select>
          </div> 

          <div class="col-xs-2">
           <button class="btn btn-block btn-default " id="btn_buscar">Buscar</button>
          </div> 
    {!! Form::close() !!}
  </div><!-- /.box-body -->
</div><!-- /.box -->
</div>
</div>
@endsection