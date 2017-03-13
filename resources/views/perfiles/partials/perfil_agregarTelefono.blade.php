{!! Form::open(['route'=> 'filial.perfil_editarPerfil_post', 'method'=>'post']) !!} 	
	<input type="hidden" name="id" value="{{$filial->id}}">
	<div class="col-md-12 form-group">
		<label>@lang('filial.telefonos')</label>
		<button class="add_input_telefono btn-xs btn-success">+</button> 
		<div class="input_fields_telefono">    
			@foreach ($telefono as $t)
			<input type="text" name="telefono[]" class="form-control" value="{{$t->telefono}}">
			@endforeach
		</div>
	</div>
	<div class="box-footer col-xs-12">
		<button type="submit" class="btn btn-success">@lang('filial.guardar')</button>
	</div>
{!! Form::close() !!}