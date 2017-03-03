<div class="col-xs-6 register-box-body">        

  {!! Form::open(['route'=>'contrasena.postNueva', 'method' => 'post']) !!}

    <div class="form-group has-feedback">
      <label>@lang('filial.cuenta')</label>
      <input type="text" name="mail" class="form-control" value="{{$mail}}" disabled="">
      <span class="glyphicon glyphicon-envelope form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
      <label>@lang('contrasena.cambio1')</label>
      <input type="password" name="passwordActual" class="form-control">
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
    <label>@lang('contrasena.cambio2')</label>
      <input type="password" name="contrasena" class="form-control"> 
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="form-group has-feedback">
    <label>@lang('contrasena.cambio3')</label>
      <input type="password" name="passwordr" class="form-control">  
      <span class="glyphicon glyphicon-lock form-control-feedback"></span>
    </div>

    <div class="row">
      <div class="col-xs-6">
          <button type="submit" class="btn btn-success">@lang('contrasena.aceptar')</button> <br/>
      </div><!-- /.col -->
    </div>
  {!! Form::close() !!}
</div>     

