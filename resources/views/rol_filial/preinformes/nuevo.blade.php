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
							{!! Form::open(['route'=> 'filial.preinformes_nuevo_post', 'method'=>'post']) !!}
							<!-- ---------- Datos Personales ---------- -->
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">Datos Personales</h4>
				            </div>
				            <div class="col-md-4 form-group">
				            	{!! Form::hidden('persona',$persona->id,array('class'=>'form-control')) !!}
				            	<label>Nombre</label>
								<span class="form-control">{{$persona->apellidos}} {{$persona->nombres}}</span>
							</div>
							<div class="col-md-4 form-group">
				            	<label>N&uacute;mero de Documento</label>
								<span class="form-control">{{$persona->nro_documento}}</span>
							</div>
							<div class="col-md-4 form-group">
				            	<label>Fecha de Nacimiento</label>
								<span class="form-control">{{$persona->fecha_nacimiento}}</span>
							</div>
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">Datos del Preinforme</h4>
			              	</div>
			              	<div class="col-md-12 form-group">
								<label>Asesor</label>
								{!! Form::select('asesor',$asesores->toArray(),null,array('class' => 'form-control')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>Descripci&oacute;n</label>
								{!! Form::textarea('descripcion_preinforme',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Medio</label>
								{!! Form::textarea('medio',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-md-12 form-group">
								<label>¿C&oacute;mo nos encontr&oacute;?</label>
								{!! Form::textarea('como_encontro',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">Intereses</h4>
			              	</div>
			              	<div class="col-md-5 form-group">
								<label>Carreras</label>
								{!! Form::select('carrera',$carreras->toArray(),null, array('id'=>'carreras', 'class' => 'form-control', 'multiple')) !!}
							</div>
							<div class="col-md-5 form-group">
								<label>Cursos</label>
								{!! Form::select('curso',$cursos->toArray(),null,array('id'=>'cursos', 'class' => 'form-control', 'multiple')) !!}
							</div>
							<div class="col-md-2 form-group">
								<label>Ninguna</label>
								<div>{!! Form::checkbox('ninguna', '1',null,array('id'=>'ninguna')) !!}</div>
							</div>
							<div class="col-md-12 form-group">
								<label>Otros</label>
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
	<!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
	<script src="{{asset('js/functions/functions.js')}}"></script>
@endsection