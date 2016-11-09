@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Nueva Matr&iacute;cula</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.matriculas_nuevo_post', 'method'=>'post']) !!}
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
										<!-- ---------- Datos de la Matrícula ---------- -->
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">Datos de la Matr&iacute;cula</h4>
			              	</div>
			              	<div class="col-md-6 form-group">
								<label>Asesor</label>
								{!! Form::select('asesor',$asesores->toArray(),null,array('class' => 'form-control')) !!}
							</div>
			              	<div class="col-md-6 form-group">
								<label>Carreras y Cursos</label>
								<select name="carreras_cursos" id="carreras_cursos" class="form-control">
									<optgroup label="Carreras">
										@foreach($carreras as $carrera)
											<option value="carrera;{{$carrera->id}}">{{$carrera->nombre}}</option>
										@endforeach
									</optgroup>
									<optgroup label="Cursos">
										@foreach($cursos as $curso)
											<option value="curso;{{$curso->id}}">{{$curso->nombre}}</option>
										@endforeach
									</optgroup>
								</select>
							</div>
							<div class="col-md-12 form-group">
								<label>Grupos</label>
								<small>Ctrl + click para seleccionar m&aacute; de un grupo.</small>
								{!! Form::select('grupo[]',$grupos->toArray(),null,array('id'=>'grupos', 'class' => 'form-control', 'multiple')) !!}
							</div>
										<!-- ---------- Plan de Pagos ---------- -->
							<div class="col-xs-12">
			                	<h4 class="box-title text-center">Plan de Pagos</h4>
			                	<div>Acontinuaci&oacute;n cargue cada uno de los pagos que conformar&aacute;n el plan.</div>
			              	</div>
							<div id="planDePagos">
							<div class="pagos">
				              	<div class="col-md-6 form-group">
									<label>N&uacute;mero de Pago</label>
									{!! Form::text('nro_pago[]',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Fecha de Vencimiento</label>
									{!! Form::date('vencimiento[]',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Monto Original</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('monto_original[]',null,array('class'=>'pago-item form-control')) !!}
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label>Recargo</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('recargo[]',null,array('class'=>'pago-item form-control')) !!}
		  							</div>
								</div>
								<div class="col-md-12 form-group">
									<label>Descripci&oacute;n</label>
									{!! Form::textarea('descripcion[]',null,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
									<div class="line"></div>
								</div>
							</div><!-- Fin pagos -->
							</div><!-- Fin planDePagos -->
							<div id="mas" class="col-md-12 btn btn-danger">Agregar Nuevo Pago</div>
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