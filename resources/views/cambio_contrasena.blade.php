@extends('template')

@section('content')

    <div class="register-box-body">
       <h3> <p class="login-box-msg">Cambio de contraseña del usuario</p> </h3>
        {!! Form::open(['route'=>'contrasena.postNueva', 'method' => 'post']) !!}

         
          <div class="form-group has-feedback">

           {!! Form::email('mail',null ,  array('class'=>'form-control','placeholder'=>'Ingrese el E-Mail' )) !!}  
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

          <div class="row">
            <div class="col-xs-12">
                <button type="submit" class="btn btn-primary btn-block btn-flat center-block">Cambiar contraseña ahora</button> <br/>
            </div><!-- /.col -->
          </div>
        {!! Form::close() !!}

    </div><!-- /.register-box -->

@endsection