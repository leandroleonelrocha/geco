							<div class="row">
								<div class="col-xs-6 form-group">
									<label>@lang('persona.estadocivil')</label>
									{!! Form::text('estado_civil',null,array('class'=>'form-control')) !!}
								</div>
							    <div class="col-xs-6">
			                     	<label>@lang('persona.fnacimiento')</label>
									{!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
			                    </div>
			                </div>    

							<div class="form-group">
								<label>@lang('persona.nivelestudios')</label>
								{!! Form::select('nivel_estudios',['Secundario Completo' => 'Secundario Completo','Terciario' => 'Terciario','Universitario' => 'Universitario'],null,array('class' => 'form-control')) !!}
							</div>
							<div class="form-group">
								<label>@lang('persona.computacion')</label>
								<div>{!! Form::checkbox('estudio_computacion', '1', null, array('class'=>'flat-red')) !!} @lang('persona.si')</div>
							</div>
							<div class="form-group">
								<label>@lang('persona.computadora')</label>
								<div>{!! Form::checkbox('posee_computadora', '1', null, array('class'=>'flat-red')) !!} @lang('persona.si')</div>
							</div>
							<div class="form-group">
								<label>@lang('persona.disponibilidad')</label>
								<div class="form-check">
								  <label>
								   {!! Form::checkbox('disponibilidad_manana', '1', null,array('class'=>'flat-red')) !!} 
								   @lang('persona.mañana')
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								    {!! Form::checkbox('disponibilidad_tarde', '1', null,array('class'=>'flat-red')) !!} 
								  @lang('persona.tarde')
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								  {!! Form::checkbox('disponibilidad_noche', '1', null,array('class'=>'flat-red')) !!} 
								  @lang('persona.noche')
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								  {!! Form::checkbox('disponibilidad_sabados', '1', null,array('class'=>'flat-red')) !!}
								  @lang('persona.sabados')
								  </label>
								</div>
							</div>	
						<hr>
				    