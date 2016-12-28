@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>@lang('matricula.editarmatricula')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.matriculas_editar_post', 'method'=>'post']) !!}
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('matricula.datosmatricula')</h4>
			              	</div>
			              	<div class="col-md-6 form-group">
								<label>@lang('matricula.asesor')</label>
								{!! Form::hidden('matricula', $matricula->id, array('class'=>'form-control')) !!}
								{!! Form::select('asesor',$asesores->toArray(),$matricula->Asesor->id,array('class' => 'form-control select2')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>@lang('matricula.carrerasycursos')</label>
								<select name="carreras_cursos" id="cursos_carreras" class="form-control" data-url="{{route('filial.matriculas_grupos')}}">
									<option value="">Seleccione una Carrera o Curso</option>
									<optgroup label=@lang('matricula.carreras')>
										@foreach($carreras as $carrera)
											<option value="carrera;{{$carrera->id}}" <?php if($matricula->carrera_id == $carrera->id) echo 'selected' ?>>{{$carrera->nombre}}</option>
										@endforeach
									</optgroup>
									<optgroup label=@lang('matricula.cursos')>
										@foreach($cursos as $curso)
											<option value="curso;{{$curso->id}}" <?php if($matricula->curso_id == $curso->id) echo 'selected' ?>>{{$curso->nombre}}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
										<!-- ---------- Plan de Pagos ---------- -->
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('matricula.plandepagos')</h4>
			                	<div>@lang('matricula.plandepagost')</div>
			              	</div>
							<div id="planDePagos">
							@foreach($pagos as $pago)
								<div class="pagos">
					              	<div class="col-md-6 form-group">
										<label>@lang('matricula.numerodepago')</label>
										<input name="pago[]" type="hidden" value="{{$pago->id}}">
										{!! Form::text('nro_pago[]',$pago->nro_pago,array('class'=>'pago-item form-control')) !!}
									</div>
									<div class="col-md-6 form-group">
										<label>@lang('matricula.vencimiento')</label>
										{!! Form::date('vencimiento[]',$pago->vencimiento,array('class'=>'pago-item form-control')) !!}
									</div>
									<div class="col-md-6 form-group">
										<label>@lang('matricula.montoapagar')</label>
										<div class="input-group">
			  								<span class="input-group-addon">$</span>
											{!! Form::text('monto_original[]',$pago->monto_original,array('class'=>'pago-item form-control')) !!}
										</div>
									</div>
									<div class="col-md-6 form-group">
										<label>@lang('matricula.recargo')</label>
										<div class="input-group">
			  								<span class="input-group-addon">%</span>
											{!! Form::text('recargo[]',$pago->recargo,array('class'=>'pago-item form-control')) !!}
			  							</div>
									</div>
									<div class="col-md-12 form-group">
										<label>@lang('matricula.descripcion')</label>
										{!! Form::textarea('descripcion[]',$pago->descripcion,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
										<div class="line"></div>
									</div>
								</div><!-- Fin pagos -->
							@endforeach
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
					     		<button type="submit" class="btn btn-success">@lang('matricula.modificar')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection