     {!! Form::open(['route'=>'lenguaje.cambiar', 'method' => 'post']) !!}

          <div class="form-group has-feedback">
          
          <select name="locale">
              <option value="en">English</option>
              <option value="es">Español</option>
              
          </select>
          </div>
       
          <div class="row">
            <div class="col-xs-4">
              <button type="submit" class="btn btn-primary btn-block btn-flat">Cambiar</button>
            </div><!-- /.col -->
          </div>
        {!! Form::close() !!}
