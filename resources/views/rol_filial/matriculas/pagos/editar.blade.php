@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Modificar Pago</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::open(['route'=> 'filial.pagos_editar_post', 'method'=>'post']) !!}
				              	<div class="col-md-6 form-group">
									<label>N&uacute;mero de Pago</label>
									{!! Form::hidden('pago', $pago->id, array('class'=>'form-control')) !!}
									{!! Form::text('nro_pago',$pago->nro_pago,array('class'=>'pago-item form-control', 'disabled')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Fecha de Vencimiento</label>
									{!! Form::date('vencimiento',$pago->vencimiento,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Monto Original</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('monto_original',$pago->monto_original,array('class'=>'pago-item form-control')) !!}
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label>Recargo</label>
									<div class="input-group">
		  								<span class="input-group-addon">$</span>
										{!! Form::text('recargo',$pago->recargo,array('class'=>'pago-item form-control')) !!}
		  							</div>
								</div>
								<div class="col-md-12 form-group">
									<label>Descripci&oacute;n</label>
									{!! Form::textarea('descripcion',$pago->descripcion,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
								</div>
								<div class="box-footer col-xs-12">
								{!! Form::submit('Modificar',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection