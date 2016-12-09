<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <link rel="shortcut icon" href="{{asset('/img/logo/Geco-Blanco.png')}}">
    <title>GECO | @lang('inicio.restablecer')</title>
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

  <body class="hold-transition register-page">
    <div class="register-box">
      <div class="register-logo">
      </div>

      <div class="register-box-body">
        <img class="logo-login" src="{{asset('/img/logo/Geco-Blanco.png')}}" height="80" width="80">
        <p class="login-box-msg">@lang('inicio.titulo2')</p>
        {!! Form::open(['route'=>'restaurarCuenta.postNueva', 'method' => 'post']) !!}

        <div class="form-group has-feedback">
           {!! Form::email('mail', null ,  array('class'=>'form-control', 'placeholder'=>'Ingrese el E-mail')) !!}  
            <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
        </div>

        <div class="row">
          
          <div class="col-xs-12">
              <button type="submit" class="btn btn-success btn-block btn-flat">@lang('inicio.restablecer')</button></br>
          </div><!-- /.col -->
        </div>
        {!! Form::close() !!}
        <div class ="row">
          <div class="col-xs-12">

            @if (session()->has('msg_error'))
                <div class="alert alert-danger">
                    <strong>Error!</strong><br />
                    {{ session('msg_error') }}
                </div>
           @endif

           @if (session()->has('msg_ok'))
                 <div class="alert alert-success">
                    <strong>Exito!</strong><br />
                    {{ session('msg_ok') }}
                    <a href="../login">@lang('inicio.volver')</a>
                </div>
            @endif
          </div>     
        </div>   
      </div><!-- /.register-box -->
    <!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <!-- Bootstrap 3.3.5 -->
    <script src="{{asset('bootstrap/js/bootstrap.min.js')}}"></script>
    <!-- iCheck -->
    <script src="{{asset('plugins/iCheck/icheck.min.js')}}"></script>
  </body>
</html>