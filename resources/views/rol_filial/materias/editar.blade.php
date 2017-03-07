@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('materia.editarmateria')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.materias_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<input type="hidden" name="id" value="{{$materia->id}}">
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('materia.nombre')</label>
								{!! Form::text('nombre', $materia->nombre, array('class'=>'form-control')) !!}
							</div>

			              	<div class="col-md-3 form-group">
								<label>@lang('preinforme.carreras')</label>
								<select name="carrera[]" id="carreras" class='form-control' multiple>
									<?php foreach ($carreras as $carrera) { ?>
										<option value="{{$carrera->id}}"
										<?php foreach ($materiaCarreraCurso as $m){
											if( $m->carrera_id == $carrera->id )
												echo 'selected';
										}?> >
											{{$carrera->nombre}}
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-3 form-group">
								<label>@lang('preinforme.cursos')</label>
								<select name="curso[]" id="cursos" class='form-control' multiple>
									<?php foreach ($cursos as $curso) { ?>
										<option value="{{$curso->id}}"
										<?php foreach ($materiaCarreraCurso as $m){
											if( $m->curso_id == $curso->id )
												echo 'selected';
										}?>>
											{{$curso->nombre}}
										</option>
									<?php } ?>
								</select>
							</div>
                            
							<div class="col-md-6 form-group teorica_practica">
                                <label>@lang('materia.tipomateria')</label>
                                <div>
                                    <input type='radio' class='flat-red' name='teorica_practica' value="1" <?php if($materia->practica == 1) echo 'checked'; ?> >@lang('materia.practica')
                                    <input type='radio' class='flat-red' name='teorica_practica' value="0" <?php if($materia->teorica == 1) echo 'checked'; ?> >@lang('materia.teorica')
                                </div>
                            </div>
							<div class="col-md-6 form-group">
								<label>@lang('materia.descripcion')</label>
					     		{!! Form::textarea('descripcion',$materia->descripcion,array('class'=>'form-control','size'=>'30x3')) !!}
							</div>
				
							<div class="box-footer col-xs-12">
							<button type="submit" class="btn btn-success">@lang('materia.guardar') </button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection