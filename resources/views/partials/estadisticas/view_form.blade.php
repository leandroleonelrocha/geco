<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">Fecha</label>
<div class="col-sm-10">
{!! Form::text('fecha', null ,  array('class'=>'form-control', 'id'=>'reservation')) !!}
</div>
</div>
<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">Opciones</label>
<div class="col-sm-10">
<select class="form-control" id="selectvalue" name="selectvalue">
<option value="inscripcion">Inscripciones</option>
<option value="preinforme">Pre informes</option>
<option value="recaudacion">Recaudación</option>
<option value="morosidad">Morosidad</option>
<option value="examen">Examen</option>
</select>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-default">Buscar</button>
</div>
</div>