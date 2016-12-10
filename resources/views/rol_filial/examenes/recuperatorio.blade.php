@extends('template')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('docente.nuevodocente')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=>'filial.examenes_recuperatorio_post']) !!}
								<div class="col-md-6 form-group">
									<input type="hidden" name="recuperatorio_nro_acta" value="{{$examen->id}}">
									<label>@lang('examen.materia')</label>
									{!! Form::text('materia',$examen->Materia->nombre,array('class'=>'form-control', 'disabled')) !!}
									<input type="hidden" name="materia_id" value="{{$examen->materia_id}}">
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('examen.docente')</label>
									{!! Form::select('docente_id',(['' => 'Seleccionar docente'] + $docentes->toArray()), $examen->docente_id, [ 'class' => 'form-control']) !!}
								</div>
								<div class="col-md-4 form-group">
									<label>@lang('examen.matricula')</label>
									{!! Form::text('matricula',$examen->matricula_id,array('class'=>'form-control', 'disabled')) !!}
									<input type="hidden" name="matricula_id" value="{{$examen->matricula_id}}">
									<input type="hidden" name="grupo_id" value="{{$examen->grupo_id}}">
								</div>
								<div class="col-md-4 form-group">
									<label>@lang('examen.persona')</label>
									<?php $nombre = $examen->Matricula->Persona->apellidos.' '.$examen->Matricula->Persona->nombres; ?>
									{!! Form::text('persona',$nombre,array('class'=>'form-control', 'disabled')) !!}
								</div>
								<div class="col-md-4 form-group">
									<label>@lang('examen.nota')</label>
									{!!Form::text('nota',null,array('class'=>'form-control'))!!}
								</div>
								<div class="box-footer col-xs-12">
								<button type="submit" class="btn btn-success">@lang('examen.crear')</button>
					          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection