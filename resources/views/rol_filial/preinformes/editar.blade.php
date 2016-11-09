@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Nuevo Preinforme</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.preinformes_editar_post', 'method'=>'post']) !!}
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">Datos del Preinforme</h4>
			              	</div>
			              	<div class="col-md-12 form-group">
			              		{!! Form::hidden('preinforme', $preinforme->id, array('class'=>'form-control')) !!}
								<label>Asesor</label>
								{!! Form::select('asesor',$asesores->toArray(),$preinforme->Asesor->id,array('class' => 'form-control')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>Descripci&oacute;n</label>
								{!! Form::textarea('descripcion_preinforme',$preinforme->descripcion,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Medio</label>
								{!! Form::textarea('medio',$preinforme->medio,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-12 form-group">
								<label>¿C&oacute;mo nos encontr&oacute;?</label>
								{!! Form::textarea('como_encontro',$preinforme->como_encontro,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">Intereses</h4>
			              	</div>
			              	<div class="col-md-5 form-group">
								<label>Carreras</label>
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
								<label>Cursos</label>
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
								<label>Ninguna</label>
								<div>{!! Form::checkbox('ninguna', '1',null,array('id'=>'ninguna')) !!}</div>
							</div>
							<div class="col-md-12 form-group">
								<label>Otros</label>
								<textarea disabled name="descripcion_interes" id="otros" class="form-control" cols="30" rows="4">@foreach ($intereses as $interes){{$interes->descripcion}}@endforeach</textarea>
							</div>
							<div class="box-footer col-xs-12">
								{!! Form::submit('Guardar',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
	<script src="{{asset('js/functions/functions.js')}}"></script>
@endsection