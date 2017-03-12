@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>@lang('matricula.nuevamatricula')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.matriculas_nuevaPersona_post', 'method'=>'post']) !!}
							<!-- ---------- Datos Personales ---------- -->
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">@lang('persona.titulo')</h4>
				            </div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.apellido')</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.nombre')</label>
								{!! Form::text('nombres',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.tipodocumento')</label>
								{!! Form::select('tipo_documento',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.numerodocumento')</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<div class="col-xs-12"><label>@lang('persona.genero')</label></div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'M') !!} @lang('persona.masculino')
								</div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'F') !!} @lang('persona.femenino')
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.fnacimiento')</label>
								{!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
							</div>
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
							
							<div class="col-md-6 form-group">
								<label>@lang('persona.estadocivil')</label>
								{!! Form::text('estado_civil',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.nivelestudios')</label>
								{!! Form::text('nivel_estudios',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computacion')</label>
								<div>{!! Form::checkbox('estudio_computacion', '1', null, array('class'=>'minimal')) !!} @lang('persona.si')</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computadora')</label>
								<div>{!! Form::checkbox('posee_computadora', '1', null, array('class'=>'minimal')) !!} @lang('persona.si')</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.disponibilidad')</label>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_manana', '1', null, array('class'=>'minimal')) !!} @lang('persona.mañana')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_tarde', '1', null, array('class'=>'minimal')) !!} @lang('persona.tarde')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_noche', '1', null, array('class'=>'minimal')) !!} @lang('persona.noche')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_sabados', '1',  null, array('class'=>'minimal')) !!} @lang('persona.sabados')
								</div>
							</div>
							
							<div class="col-md-6 form-group">
								<label>@lang('persona.aclaraciones')</label>
								{!! Form::textarea('aclaraciones',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.telefonos')</label>
								<button class="add_input_telefono btn btn-success">+</button>	
								<div class="input_fields_telefono">
									<input type="text" name="telefono[]" class="form-control">
								</div>
							</div>

							<div class="col-md-6 form-group">
								<label>E-mails</label>
								<button class="add_input_mail btn btn-success"">+</button>	
								<div class="input_fields_wrap">
							   		<input type="text" name="mail[]" class="form-control">
								</div>	
							</div>
										<!-- ---------- Datos de la Matrícula ---------- -->
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('matricula.datosmatricula')</h4>
			              	</div>
			              	<div class="col-md-6 form-group">
								<label>@lang('matricula.asesor')</label>
								{!! Form::select('asesor',$asesores->toArray(),null,array('class' => 'form-control select2')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>@lang('matricula.carrerasycursos')</label>
								<select name="carreras_cursos" id="cursos_carreras" class="form-control" data-url="{{route('filial.matriculas_grupos')}}">
									<option value="">Seleccione una Carrera o Curso</option>
									<optgroup label=@lang('matricula.carreras')>
										@foreach($carreras as $carrera)
											<option value="carrera;{{$carrera->id}}">{{$carrera->nombre}}</option>
										@endforeach
									</optgroup>
									<optgroup label=@lang('matricula.cursos')>
										@foreach($cursos as $curso)
											<option value="curso;{{$curso->id}}">{{$curso->nombre}}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
							<div class="col-md-12 form-group">
								<label>@lang('matricula.grupos')</label>
								<small>Ctrl + click @lang('matricula.grupost').</small>
								<select name="grupo[]" class="form-control select_grupo" multiple>
					            </select>
							</div>
										<!-- ---------- Plan de Pagos ---------- -->
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('matricula.plandepagos')</h4>
			                	<div>@lang('matricula.plandepagost')</div>
			              	</div>
			              	<!-- ---------- Pago Matrícula ---------- -->
			              	<div class="col-xs-12">
				            	<h4 class="box-title text-left">@lang('matricula.matricula')</h4>
				            </div>
			              	<div class="col-xs-12">
			                	<div>
									<!-- <label>@lang('matricula.numerodepago')</label> -->
									{!! Form::hidden('nro_pago[]',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.fechavencimiento')</label>
									{!! Form::date('vencimiento[]',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Fecha Recargo</label>
									{!! Form::date('fecha_recargo[]',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.montooriginal')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
											<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('monto_original[]',null,array('class'=>'pago-item form-control')) !!}
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.descuento')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('descuento[]',null,array('class'=>'pago-item form-control')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.recargo')</label>
									<div class="input-group">
		  								<span class="input-group-addon">%</span>
										{!! Form::text('recargo[]',null,array('class'=>'pago-item form-control')) !!}
		  							</div>
								</div>
								<div class="col-md-12 form-group">
									<label>@lang('matricula.descripcion')</label>
									{!! Form::textarea('descripcion[]',null,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
									<div class="line"></div>
								</div>
			              	</div><!-- Fin Pago Matrícula -->
			              	<div class="col-xs-12">
				            	<h4 class="box-title text-left">@lang('matricula.restopago')</h4>
				            </div>
							<div>
								<table class="table table-bordered table-stripe">
                                    <thead><tr>
                                        <th class="text-center">#</th>
                                        <th class="text-center">
                                        	@lang('matricula.fechavencimiento')
                                        </th>
                                        <th class="text-center">
                                        	Fecha Recargo
                                        </th>
                                        <th class="text-center">
                                        	@lang('matricula.montooriginal')
                                        </th>
                                        <th class="text-center">
                                        	@lang('matricula.descuento')
                                        </th>
                                        <th class="text-center">
                                        	@lang('matricula.recargo')
                                        </th>
                                        <th class="text-center">
                                        	@lang('matricula.descripcion')
                                        </th>
                                    </tr></thead>
                                    <tbody id="planDePagos">
                                    	<tr class="pagos">
                                    		<td>
                                    			{!! Form::hidden('nro_pago[]',1,array('class'=>'pago-item form-control nro_pago')) !!}
                                    			<span class="nro">1</span>
                                    		</td>
                                    		<td>
                                    			{!! Form::date('vencimiento[]',null,array('class'=>'pago-item form-control')) !!}
                                    		</td>
                                    		<td>
                                    			{!! Form::date('fecha_recargo[]',null,array('class'=>'pago-item form-control')) !!}
                                    		</td>
                                    		<td>
                                    			<div class="input-group">
													<span class="input-group-addon">
													<?php echo session('moneda')['simbolo']; ?>
													</span>
													{!! Form::text('monto_original[]',null,array('class'=>'pago-item form-control')) !!}
												</div>
                                    		</td>
                                    		<td>
                                    			<div class="input-group">
													<span class="input-group-addon">
													<?php echo session('moneda')['simbolo']; ?>
													</span>
													{!! Form::text('descuento[]',null,array('class'=>'pago-item form-control')) !!}
												</div>
                                    		</td>
                                    		<td>
                                    			<div class="input-group">
													<span class="input-group-addon">%</span>
													{!! Form::text('recargo[]',null,array('class'=>'pago-item form-control')) !!}
												</div>
                                    		</td>
                                    		<td>
                                    			{!! Form::textarea('descripcion[]',null,array('class'=>'pago-item form-control','size'=>'30x1')) !!}
                                    		</td>
                                		</tr>
                                    </tbody>
                                </table>
								<div class="col-md-3">
									<input id="cantidadPagos" class="form-control" type="text" placeholder="@lang('matricula.cantidadpagos')">
								</div>
								<div id="mas" class="col-md-3">
									<span class="btn btn-danger btn-pagos">
										@lang('matricula.agregarpagos')
									</span>
								</div>
								<div id="borrarTodo" class="col-md-3">
									<span class="btn btn-danger btn-pagos">
										@lang('matricula.borrarpagos')
									</span>
								</div>
								<div id="borrarUltimo" class="col-md-3">
									<span class="btn btn-danger btn-pagos">
										@lang('matricula.borrarultimopago')
									</span>
								</div>
							</div>
							<div class="box-footer col-xs-12">
					     		<button type="submit" class="btn btn-success">@lang('persona.crear')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection