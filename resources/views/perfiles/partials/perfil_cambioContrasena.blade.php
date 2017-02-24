<div class="register-logo">
</div>
<div class="col-xs-6 register-box-body">        

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
      <div class="col-xs-6">
          <button type="submit" class="btn btn-success">@lang('contrasena.aceptar')</button> <br/>
      </div><!-- /.col -->
    </div>
  {!! Form::close() !!}
</div>     

