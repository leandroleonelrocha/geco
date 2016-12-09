<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('/img/logo/Geco-Blanco.png')}}">

    <title>GECO | @lang('inicio.ingresosistema')</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="{{asset('/font-awesome-4.7.0/css/font-awesome.min.css')}}">
    <!-- Ionicons -->
    <link rel="stylesheet" href="{{asset('/ionicons-2.0.1/css/ionicons.min.css')}}">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">
  </head>

  <body class="hold-transition login-page" class="cuerpo">
    <div class="login-box">
      <div class="login-logo">
      </div><!-- /.login-logo -->
      <div class="login-box-body">
      <img class="logo-login" src="{{asset('/img/logo/Geco-Blanco.png')}}" height="80" width="80">
        <p class="login-box-msg">@lang('inicio.titulo1')</p>
        
            {!! Form::open(['route'=>'auth.postLogin','method' => 'post']) !!}
              <div class="form-group has-feedback">
                {!! Form::text('usuario', null, array('id'=>'email', 'class'=>'form-control', 'placeholder'=>'Ingrese el E-mail' ))!!}
                <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
              </div>
              <div class="form-group has-feedback">
                {!! Form::password('password', array('id'=>'password', 'class'=>'form-control', 'placeholder'=>'Ingrese la contraseña' ))!!}
                <span class="glyphicon glyphicon-lock form-control-feedback"></span>
              </div>
              <div class="row">
                <div class="col-xs-8">
                  <a href="{{ route('restaurarCuenta.nueva')}}" class="text-center">@lang('inicio.olvidocontrasena')</a> 
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <button id="Send" type="submit" class="btn btn-success btn-block btn-flat">@lang('inicio.entrar')</button>
                </div>
                <br></br>
           <!-- /.col -->
              </div>
            {!! Form::close() !!}
       
        <div class ="row">
            <div class="col-xs-12">
                <!-- Mensaje -->
                @if (session()->has('msg_error'))
                    <div class="alert alert-danger">
                        <strong>Error!</strong>
                        {{ session('msg_error') }}
                    </div>
                @endif
            </div>
        </div>
      </div><!-- /.login-box-body -->
    </div><!-- /.login-box -->
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
  </body>
</html>