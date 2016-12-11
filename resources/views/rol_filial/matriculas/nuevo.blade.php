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
							{!! Form::open(['route'=> 'filial.matriculas_nuevo_post', 'method'=>'post']) !!}
							<!-- ---------- Datos Personales ---------- -->
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">@lang('matricula.datospersonales')</h4>
				            </div>
							<div class="col-md-4 form-group">
				            	{!! Form::hidden('persona',$persona->id,array('class'=>'form-control')) !!}
				            	<label>@lang('persona.nombre')</label>
								<span class="form-control">{{$persona->apellidos}} {{$persona->nombres}}</span>
							</div>
							<div class="col-md-4 form-group">
				            	<label>@lang('persona.numerodocumento')</label>
								<span class="form-control">{{$persona->nro_documento}}</span>
							</div>
							<div class="col-md-4 form-group">
				            	<label>@lang('persona.fnacimiento')</label>
								<span class="form-control">{{$persona->fecha_nacimiento}}</span>
							</div>
										<!-- ---------- Datos de la Matrícula ---------- -->
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('matricula.datosmatricula')</h4>
			              	</div>
			              	<div class="col-md-6 form-group">
								<label>@lang('matricula.asesor')</label>
								{!! Form::select('asesor',$asesores->toArray(),null,array('class' => 'form-control')) !!}
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
							<div class="col-md-12 form-group grupo">
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
							<div id="planDePagos">
							<div class="pagos">
				              	<div class="col-md-6 form-group">
									<label>@lang('matricula.numerodepago')</label>
									{!! Form::text('nro_pago[]',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.fechavencimiento')</label>
									{!! Form::date('vencimiento[]',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.montooriginal')</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('monto_original[]',null,array('class'=>'pago-item form-control')) !!}
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.descuento')</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('descuento',null,array('class'=>'pago-item form-control')) !!}
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
							</div><!-- Fin pagos -->
							</div><!-- Fin planDePagos -->
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
							<div class="box-footer col-xs-12">
					     		<button type="submit" class="btn btn-success">@lang('matricula.crear')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection