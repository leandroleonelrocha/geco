@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>@lang('preinforme.editarpreinforme')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.preinformes_editar_post', 'method'=>'post']) !!}
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('preinforme.datospreinforme')</h4>
			              	</div>
			              	<div class="col-md-12 form-group">
			              		{!! Form::hidden('preinforme', $preinforme->id, array('class'=>'form-control')) !!}
								<label>@lang('persona.asesor')</label>
								{!! Form::select('asesor',$asesores->toArray(),$preinforme->Asesor->id,array('class' => 'form-control select2')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>@lang('preinforme.descripcion')</label>
								{!! Form::textarea('descripcion_preinforme',$preinforme->descripcion,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Medio</label>
								{!! Form::textarea('medio',$preinforme->medio,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-12 form-group">
								<label>@lang('preinforme.encontro')</label>
								{!! Form::textarea('como_encontro',$preinforme->como_encontro,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('preinforme.intereses')</h4>
			              	</div>
			              	<div class="col-md-5 form-group">
								<label>@lang('preinforme.carreras')</label>
								<select name="carrera[]" id="carreras" class='form-control' multiple>
									<?php foreach ($carreras as $carrera) { ?>
										<option value="{{$carrera->id}}"
										<?php foreach ($intereses as $interes){
											if( $interes->carrera_id == $carrera->id )
												echo 'selected';
										}?> >
											{{$carrera->nombre}}
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-5 form-group">
								<label>@lang('preinforme.cursos')</label>
								<select name="curso[]" id="cursos" class='form-control' multiple>
									<?php foreach ($cursos as $curso) { ?>
										<option value="{{$curso->id}}"
										<?php foreach ($intereses as $interes){
											if( $interes->curso_id == $curso->id )
												echo 'selected';
										}?>>
											{{$curso->nombre}}
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2 form-group">
								<label>@lang('preinforme.ningunat')</label>
								<div>{!! Form::checkbox('ninguna', '1',null,array('id'=>'ninguna')) !!}</div>
							</div>
							<div class="col-md-12 form-group">
								<label>@lang('preinforme.otrost')</label>
								<textarea disabled name="descripcion_interes" id="otros" class="form-control" cols="30" rows="4">@foreach ($intereses as $interes){{$interes->descripcion}}@endforeach</textarea>
							</div>
							<div class="box-footer col-xs-12">
								 <button type="submit" class="btn btn-success">@lang('preinforme.guardar')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection