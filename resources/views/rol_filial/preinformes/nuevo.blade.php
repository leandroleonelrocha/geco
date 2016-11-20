@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>@lang('preinforme.nuevopreinforme')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.preinformes_nuevo_post', 'method'=>'post']) !!}
							<!-- ---------- Datos Personales ---------- -->
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">@lang('persona.titulo')</h4>
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
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('preinforme.datospreinforme')</h4>
			              	</div>
			              	<div class="col-md-12 form-group">
								<label>@lang('persona.asesor')</label>
								{!! Form::select('asesor',$asesores->toArray(),null,array('class' => 'form-control')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>@lang('preinforme.descripcion')</label>
								{!! Form::textarea('descripcion_preinforme',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Medio</label>
								{!! Form::textarea('medio',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-12 form-group">
								<label>@lang('preinforme.encontro')</label>
								{!! Form::textarea('como_encontro',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('preinforme.intereses')</h4>
			              	</div>
			              	<div class="col-md-5 form-group">
								<label>@lang('preinforme.carreras')</label>
								{!! Form::select('carrera',$carreras->toArray(),null, array('id'=>'carreras', 'class' => 'form-control', 'multiple')) !!}
							</div>
							<div class="col-md-5 form-group">
								<label>@lang('preinforme.cursos')</label>
								{!! Form::select('curso',$cursos->toArray(),null,array('id'=>'cursos', 'class' => 'form-control', 'multiple')) !!}
							</div>
							<div class="col-md-2 form-group">
								<label>@lang('preinforme.ningunat')</label>
								<div>{!! Form::checkbox('ninguna', '1',null,array('id'=>'ninguna')) !!}</div>
							</div>
							<div class="col-md-12 form-group">
								<label>@lang('preinforme.otrost')</label>
								{!! Form::textarea('descripcion_interes',null,array('id'=>'otros', 'class' => 'form-control','disabled','size'=>'30x4')) !!}
							</div>
							<div class="box-footer col-xs-12">
								{!! Form::submit('Crear',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection