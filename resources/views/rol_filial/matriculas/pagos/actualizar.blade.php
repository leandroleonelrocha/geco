@extends('template')

@section('content')

	
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('matricula.actualizarpago')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::open(['route'=> 'filial.pagos_actualizar_post', 'method'=>'post']) !!}
				              	<div class="col-md-12 form-group">
									<label>@lang('matricula.numerodepago')</label>
									{!! Form::hidden('pago', $pago->id, array('class'=>'form-control')) !!}
									{!! Form::text('nro_pago',$pago->nro_pago,array('class'=>'pago-item form-control', 'disabled')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.descuentoadicional')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('descuento_adicional',null, array('class'=>'pago-item form-control descuento_adicional')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.recargoadicional')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('recargo_adicional',null, array('class'=>'pago-item form-control recargo_adicional')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.montooriginal')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('monto_original',$pago->monto_original,array('class'=>'pago-item form-control', 'disabled')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.montoactual')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('monto_actual',$pago->monto_actual, array('class'=>'pago-item form-control monto_actual', 'disabled')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.abono')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('monto_pago',$pago->monto_pago, array('class'=>'pago-item form-control', 'disabled')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.montoapagar')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('monto_a_pagar',null, array('class'=>'pago-item form-control')) !!}
		  							</div>
								</div>
								<div class="box-header">
									<h3 class="box-title">@lang('recibo.nuevorecibo')</h3>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('recibo.tipo')<label>
									{!! Form::select('recibo_tipo_id', $tipos->toArray(),null, array('class'=>'form-control')) !!}
									{!! Form::hidden('pago_id', $pago->id, array('class'=>'form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('recibo.concepto')</label>
									{!! Form::select('recibo_concepto_pago_id', $conceptos->toArray(), null, array('class'=>'form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('recibo.descripcion')</label>
									{!! Form::textarea('descripcion',null,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
								</div>
								<div class="box-footer col-xs-12">
				          	</div>
							<button type="submite" class="btn btn-success enlaceajax">@lang('matricula.actualizar')</button>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection

@section('modal')
@include('rol_filial.matriculas.partials.carrito')
@endsection

@section('js')
<script type="text/javascript">
	$('#ModalEdit').click(function(){

	// elimino la session y recargo
	/*
	var url   = '../limpiar_carrito';
	$.ajax(
			{
			url: url,
			type: 'GET',
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result){
				  location.reload();
			}}

		);
        });
    */    
</script>
@endsection