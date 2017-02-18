<!DOCTYPE html>
<html>
  <head>

    <link rel="shortcut icon" href="{{asset('/img/logo/Geco-Blanco.png')}}">

    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <title>GECO | Gestión y Cobranza</title>

    <meta name="csrf-token" content="{{{ Session::token() }}}">
    <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
   
    @include('templates.template_css')
    @yield('css')
  </head>
  <?php $h = session('usuario')['habilitado']; ?>
  <body class="hold-transition skin-<?php if($h==1) echo 'blue'; else echo 'red'; ?> sidebar-mini ">
    <div class="wrapper">
      
      @include('templates.template_nav')
      <!-- Left side column. contains the logo and sidebar -->
      @include('templates.template_sidebar')

      <!-- Content Wrapper. Contains page content -->
      <div class="content-wrapper">
        <!-- Content Header (Page header) -->
        <section class="content-header">
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
        <strong><a href=https://www.facebook.com/WhiteoutTeam/?fref=ts>The Whiteout Team</a></strong>
      </footer>

     @include('templates.template_aside')
    </div><!-- ./wrapper -->

  
    @include('templates.template_js')
    @yield('modal')
    @yield('js')

  </body>
</html>