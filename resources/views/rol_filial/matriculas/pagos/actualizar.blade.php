@extends('template')

@section('content')
	<div class="row">
    <div class="col-xs-12 destino">
      
    </div> <!-- Fin col -->
  </div> <!-- Fin row -->

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
										{!! Form::text('monto_actual',$pago->monto_actual, array('class'=>'pago-item form-control', 'disabled')) !!}
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
								<div class="box-footer col-xs-12">
								   	<button  class="btn btn-success enlaceajax">@lang('matricula.actualizar')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection


@section('js')
<script type="text/javascript">

  alert('asdasd');
  $(".enlaceajax").click(function(evento){
    //  evento.preventDefault();
      $(".destino").load("{{ URL::to('/filial/carrito') }}");
   
  }); 


</script>
@endsection