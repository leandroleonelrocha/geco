@extends('template')

@section('content')
  <div class="register-box">
    <div class="register-logo">
    </div>
    <div class="register-box-body">
       <h4> <p class="login-box-msg">Cambio de contraseña</p> </h4>
        {!! Form::open(['route'=>'contrasena.postNueva', 'method' => 'post']) !!}

          <div class="form-group has-feedback">

           {!! Form::email('mail',$mail,array('class'=>'form-control','disabled')) !!}  
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
             {!! Form::password('passwordActual', array( 'class'=>'form-control', 'placeholder'=>'Ingrese la contraseña actual' ))!!}  
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
             {!! Form::password('password', array( 'class'=>'form-control', 'placeholder'=>'Ingrese la contraseña nueva') )!!}  
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="form-group has-feedback">
             {!! Form::password('passwordr', array( 'class'=>'form-control', 'placeholder'=>'Reingrese la contraseña nueva') )!!}  
            <span class="glyphicon glyphicon-lock form-control-feedback"></span>
          </div>

          <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat center-block">Aceptar</button> <br/>
            </div><!-- /.col -->
          </div>
        {!! Form::close() !!}

    </div><!-- /.register-box -->
  </div>
@endsection