<div class="form-group">
								<label>@lang('persona.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control', 'required' => 'required')) !!}
							</div>
				          <div class="form-group">
				            <label>@lang('persona.tipodocumento')</label>
							{!! Form::text('nro_documento',null,array('class'=>'form-control', 'required' => 'required', 'placeholder' => 'Escriba el númnero de documento' )) !!}
				          </div>
				          <div class="form-group">
				          	    <label>@lang('persona.apellido')</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control', 'required' => 'required', 'placeholder' => 'Escriba el apellido')) !!}
				          </div>
				          <div class="form-group">
				            <label>@lang('persona.nombre')</label>
							{!! Form::text('nombres',null,array('class'=>'form-control', 'required' => 'required', 'placeholder' => 'Escriba el nombre' )) !!}
				          </div>
				          	
				          	<div class="row">
								<div class="col-md-4 form-group">
									<label>@lang('persona.domicilio')</label>
									{!! Form::text('domicilio',null,array('class'=>'form-control')) !!}
								</div>
								<div class="col-md-4 form-group">
									<label>@lang('persona.localidad')</label>
									{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
								</div>

				                 <div class="col-md-4 form-group">
	                                <label>@lang('filial.pais')</label>
	                                {!! Form::select('pais_id', $paises->toArray() , null, array('class'=>'form-control select2')) !!}
                            	</div>
							</div>
						
							<div class="row">
			                    <div class="col-xs-6">
			                     	<div class="col-xs-12"><label>@lang('persona.genero')</label></div>
									<div class="col-xs-3">
										{!! Form::radio('genero', 'M',null, array('class'=>'flat-red') ) !!} @lang('persona.masculino')
									</div>
									<div class="col-xs-3">
										{!! Form::radio('genero', 'F',null, array('class'=>'flat-red') ) !!} @lang('persona.femenino')
									</div>
			                    </div>
			                    <div class="col-xs-6">
			                     	<label>@lang('persona.fnacimiento')</label>
									{!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
			                    </div>
		                   	</div>
		                    <hr>
                   			