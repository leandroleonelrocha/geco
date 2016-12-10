@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('filial.editarfilial')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'dueño.filiales_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<label>@lang('filial.cuenta')</label>
								<input type="hidden" name="id" value="{{$filial->id}}">
								<input type="hidden" name="maila" value="{{$filial->mail}}">
							    {!! Form::email('mail',$filial->mail,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('filial.nombre')</label>
								{!! Form::text('nombre', $filial->nombre, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('filial.direccion')</label>
								{!! Form::text('direccion', $filial->direccion, array('class'=>'form-control')) !!}
							</div>


							<div class="col-md-6 form-group">
								<label>@lang('filial.localidad')</label>
			     				{!! Form::text('localidad', $filial->localidad, array('class'=>'form-control')) !!}
							</div>

					        <div class="col-md-6 form-group">
                                <label>@lang('filial.codigopostal')</label>
                               		{!! Form::text('codigo_postal', $filial->codigo_postal, array('class'=>'form-control')) !!}
							</div>

                           	<div class="col-md-6 form-group">
                                <label>@lang('filial.cadena')</label>
                                {!! Form::select('cadena_id', $cadenas->toArray() , $filial->Cadena->id, array('class'=>'form-control')) !!}
                            </div>

							<div class="col-md-6 form-group">
								<label>Director</label>
     				            {!! Form::select('director_id', $directores->toArray() , $filial->Director->id, array('class'=>'form-control')) !!}
							</div>

                            <div class="col-md-6 form-group">
                                <label>@lang('filial.telefonos')</label>
                                <button class="add_input_telefono btn btn-success">+</button> 
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
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection