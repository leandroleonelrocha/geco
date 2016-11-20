@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('director.bienvenido') <strong>{!!$director->nombres!!} {!!$director->apellidos!!}</strong></h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'director.perfil_editarPerfil_post', 'method'=>'post']) !!}
							<div class="col-md-6 form-group">
								<input type="hidden" name="id" value="{{$director->id}}">
							</div>

							<div class="col-md-12 form-group">
								<label>@lang('director.cuenta')</label>
									{!! Form::text(null, $mailp, array('class'=>'form-control','disabled')) !!}	
							
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('director.tipodocumento')</label>
     				      		{!! Form::select('tipo_documento_id',$tipos->toArray(),$director->TipoDocumento->id,array('class' => 'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('director.numerodocumento')</label>
								{!! Form::text('nro_documento', $director->nro_documento, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('director.apellido')</label>
								{!! Form::text('apellidos', $director->apellidos, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('director.nombre')</label>
								{!! Form::text('nombres', $director->nombres, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('director.telefonos')</label>
                                <button class="add_input_telefono btn btn-success">+</button>   
                                <div class="input_fields_telefono">
                            			@foreach ($telefono as $t)
											{!! Form::text('telefono[]', $t->telefono, array('class'=>'form-control')) !!}	
										@endforeach
                                </div>
							</div>
	
		                 	<div class="col-md-6 form-group">
                                <label>E-Mails</label>
                                <button class="add_input_mail btn btn-success"">+</button>  
                                <div class="input_fields_wrap">
								 	@foreach ($mail as $m) 
								
									{!! Form::email('mail[]', $m->mail, array('class'=>'form-control')) !!}		
							@endforeach 
                                </div>
                            </div>
							<div class="box-footer col-xs-12">
							{!! Form::submit('Guardar',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection