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
							<div class="nav-tabs-custom col-xs-12">
								<ul class="nav nav-tabs">
									<li class="active"><a href="#tab_1" data-toggle="tab">@lang('matricula.plandepagos')</a></li>
									<li><a href="#tab_2" data-toggle="tab">@lang('matricula.pagosindividuales')</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="tab_1">
										@include('rol_filial.matriculas.partials.tabla_plandepago')
									</div><!-- /.tab-pane -->
									<div class="tab-pane" id="tab_2">
										@include('rol_filial.matriculas.partials.tabla_pagosindividuales')
									</div><!-- /.tab-pane -->
								</div><!-- tab-content -->
							</div><!-- nav-tabs-custom -->
							
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