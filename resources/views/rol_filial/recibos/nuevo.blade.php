@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Nuevo Recibo</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::open(['route'=> 'filial.recibo_nuevo_post', 'method'=>'post']) !!}
				              	<div class="col-md-6 form-group">
									<label>Tipo</label>
									{!! Form::select('recibo_tipo_id', $tipos->toArray(),null, array('class'=>'form-control')) !!}
									{!! Form::hidden('pago_id', $pago->id, array('class'=>'form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Monto</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('monto',null,array('class'=>'form-control')) !!}
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label>Concepto del Pago</label>
									{!! Form::select('recibo_concepto_pago_id', $conceptos->toArray(), null, array('class'=>'form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Descripci&oacute;n</label>
									{!! Form::textarea('descripcion',null,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
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