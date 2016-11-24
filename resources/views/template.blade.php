<!DOCTYPE html>
<html>
  <head>
    <link rel="shortcut icon" href="../img/logo/Geco-Blanco.png">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>GECO | Gestión y Cobranza</title>

    <!-- Tell the browser to be responsive to screen width -->
     <meta name="csrf-token" content="{{{ Session::token() }}}">
     <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   
    @include('templates.template_css')
    @yield('css')
  </head>
  <body class="hold-transition skin-blue sidebar-mini">
    <div class="wrapper">
      
      @include('templates.template_nav')
      <!-- Left side column. contains the logo and sidebar -->
      @include('templates.template_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
          <h1>
            Dashboard
            <small>Control panel</small>
          </h1>
          <ol class="breadcrumb">
            <li><a href="#"><i class="fa fa-dashboard"></i> Home</a></li>
            <li class="active">Dashboard</li>
          </ol>
        </section>

        <!-- Main content -->

        <section class="content">
            @include('partials.mensajes')
            @yield('content')
        </section><!-- /.content -->

      </div><!-- /.content-wrapper -->
      <footer class="main-footer">
        <div class="pull-right hidden-xs">
          <b>Versión</b> 1.0
        </div>
        <strong>Copyright &copy; 2016 <a href=https://www.facebook.com/WhiteoutTeam/?fref=ts>@The Whiteout Team</a>.</strong> Reservado todos los derechos.
      </footer>

     @include('templates.template_aside')
    </div><!-- ./wrapper -->

  
    @include('templates.template_js')
    @yield('js')

  </body>
</html>