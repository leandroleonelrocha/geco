<div class="form-group">
								<label>@lang('persona.aclaraciones')</label>
								{!! Form::textarea('aclaraciones',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="form-group">
								<label>@lang('persona.telefonos')</label>
								<button class="add_input_telefono btn-xs btn-success">+</button>	
								<div class="input_fields_telefono">
									@if(isset($persona))
										@foreach ($telefono as $t)
											<input type="text" name="telefono[]" class="form-control" value="{{$t->telefono}}">
										@endforeach
									@else
										<input type="text" name="telefono[]" class="form-control">
									@endif
								
								</div>
							</div>
							<div class="form-group">
								<label>E-Mails</label>
								<button class="add_input_mail btn-xs btn-success">+</button>	
								<div class="input_fields_wrap">
								@if(isset($persona))
										@foreach ($mail as $m)
										<input type="text" name="mail[]" class="form-control" value="{{$m->mail}}">
										@endforeach
									@else
										<input type="text" name="mail[]" class="form-control">
									@endif
							   		
								</div>	
							</div>
						<hr>	
				        <button class="btn btn-success pull-right" type="submit">@lang('persona.crear')</button>