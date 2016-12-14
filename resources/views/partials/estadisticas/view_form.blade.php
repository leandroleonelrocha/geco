<div class="form-group">
<label for="inputEmail3" class="col-sm-2 control-label">@lang('estadistica.fecha')</label>
<div class="col-sm-10">
{!! Form::text('fecha', null ,  array('class'=>'form-control', 'id'=>'reservation')) !!}
</div>
</div>
<div class="form-group">
<label for="inputPassword3" class="col-sm-2 control-label">@lang('estadistica.opciones')</label>
<div class="col-sm-10">
<select class="form-control" id="selectvalue" name="selectvalue">
<option value="inscripcion">@lang('estadistica.inscripciones')</option>
<option value="preinforme">@lang('estadistica.preinformes')</option>
<option value="recaudacion">@lang('estadistica.recaudacion')</option>
<option value="morosidad">@lang('estadistica.morosidad')</option>
<option value="examen">@lang('estadistica.examen')</option>
</select>
</div>
</div>
<div class="form-group">
<div class="col-sm-offset-2 col-sm-10">
<button type="submit" class="btn btn-success">@lang('estadistica.buscar')</button>
</div>
</div>