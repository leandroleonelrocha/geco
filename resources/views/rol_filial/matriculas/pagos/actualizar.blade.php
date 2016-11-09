@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Actualizar Pago</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::open(['route'=> 'filial.pagos_actualizar_post', 'method'=>'post']) !!}
				              	<div class="col-md-12 form-group">
									<label>N&uacute;mero de Pago</label>
									{!! Form::hidden('pago', $pago->id, array('class'=>'form-control')) !!}
									{!! Form::text('nro_pago',$pago->nro_pago,array('class'=>'pago-item form-control', 'disabled')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Monto Original</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('monto_original',$pago->monto_original,array('class'=>'pago-item form-control', 'disabled')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>Monto Actual</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('monto_actual',$pago->monto_actual, array('class'=>'pago-item form-control', 'disabled')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>Abon&oacute;</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('monto_pago',$pago->monto_pago, array('class'=>'pago-item form-control', 'disabled')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>Monto a Pagar</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('monto_a_pagar',null, array('class'=>'pago-item form-control')) !!}
		  							</div>
								</div>
								<div class="box-footer col-xs-12">
								{!! Form::submit('Actualizar',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection