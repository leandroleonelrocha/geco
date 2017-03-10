@extends('template')

@section('content')
  <div class="register-box">
    <div class="register-logo">
    </div>
    <div class="register-box-body">
       <h4> <p class="login-box-msg">@lang('contrasena.cambiocontraseña')</p> </h4>
        {!! Form::open(['route'=>'contrasena.postNueva', 'method' => 'post']) !!}

          <div class="form-group has-feedback">

            <input type="text" name="mail" class="form-control" value="{{$mail}}" disabled="">
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="password" name="passwordActual" class="form-control" placeholder="@lang('contrasena.cambio1')">
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="password" name="contrasena" class="form-control" placeholder="@lang('contrasena.cambio2')"> 
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
            <input type="password" name="passwordr" class="form-control" placeholder="@lang('contrasena.cambio3')">  
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-success btn-block btn-flat center-block">@lang('contrasena.aceptar')</button> <br/>
            </div><!-- /.col -->
          </div>
        {!! Form::close() !!}

    </div><!-- /.register-box -->
  </div>
@endsection