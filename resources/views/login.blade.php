<!DOCTYPE html>
<html>
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>AdminLTE 2 | Log in</title>
    <!-- Tell the browser to be responsive to screen width -->
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
    <!-- Bootstrap 3.3.5 -->
    <link rel="stylesheet" href="{{asset('bootstrap/css/bootstrap.min.css')}}">
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.4.0/css/font-awesome.min.css">
    <!-- Ionicons -->
    <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
    <!-- Theme style -->
    <link rel="stylesheet" href="{{asset('dist/css/AdminLTE.min.css')}}">
    <!-- iCheck -->
    <link rel="stylesheet" href="{{asset('plugins/iCheck/square/blue.css')}}">

    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/html5shiv/3.7.3/html5shiv.min.js"></script>
        <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->
  </head>
  <body class="hold-transition login-page">
    <div class="login-box">
      <div class="login-logo">
        <a href="../../index2.html"><b>GECO</b></a>
      </div><!-- /.login-logo -->
      <div class="login-box-body">
        <p class="login-box-msg">Ingrese los datos para iniciar la sesión</p>
        
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
                  <div class="checkbox icheck"> 
                    <label>
                      <input type="checkbox">Recordarme
                    </label>
                  </div>
                </div><!-- /.col -->
                <div class="col-xs-4">
                  <button id="Send" type="submit" class="btn btn-primary btn-block btn-flat">Entrar</button>
                </div><!-- /.col -->
              </div>
            {!! Form::close() !!}


        <a href="{{ route('restaurarCuenta.nueva')}}" class="text-center">Olvidó la contraseña</a>
        <div class ="row">
            <div class="col-xs-12">
                <!-- Mensaje -->
                @if (session()->has('msg_error'))
                    <div class="alert alert-danger">
                        <strong>Error!</strong><br />
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
    <script>
      $(function () {
        $('input').iCheck({
          checkboxClass: 'icheckbox_square-blue',
          radioClass: 'iradio_square-blue',
          increaseArea: '20%' // optional
        });
      });
    </script>
  </body>
</html>