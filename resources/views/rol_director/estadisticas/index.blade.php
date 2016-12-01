@extends('template')
@section('content')
 <div class="row">
            <div class="col-lg-4 col-xs-6">
             
              <div class="small-box bg-aqua">
                <div class="inner">
                  <h3>2</h3>
                  <p>Filiales</p>
                </div>
                <div class="icon">
                  <i class="ion ion-bag"></i>
                </div>
                <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-xs-6">
            
              <div class="small-box bg-green">
                <div class="inner">
                  <h3>53</h3>
                  <p>Personas</p>
                </div>
                <div class="icon">
                  <i class="fa fa-users"></i>
                </div>
                <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
            <div class="col-lg-4 col-xs-6">
              
              <div class="small-box bg-yellow">
                <div class="inner">
                  <h3>3</h3>
                  <p>Asesores</p>
                </div>
                <div class="icon">
                  <i class="ion ion-person-add"></i>
                </div>
                <a href="#" class="small-box-footer">Más información <i class="fa fa-arrow-circle-right"></i></a>
              </div>
            </div>
         
          </div>

<div class="row">
<div class="col-xs-12">
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Collapsable</h3>
    <div class="box-tools pull-right">
      <button class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
    </div>
  </div>
  <div class="box-body">
    {!! Form::model(Request::all(), ['route'=> 'director.estadisticas_detalles', 'method'=>'post', 'class'=>'form-horizontal']) !!} 
      @include('partials.estadisticas.view_form')
    {!! Form::close() !!}
  </div>
</div>
</div>
</div>
@endsection