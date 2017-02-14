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
					<h3 class="box-title">@lang('matricula.nuevopago')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-md-12">
							{!! Form::open(['route'=> 'filial.pagos_nuevo_post', 'method'=>'post']) !!}
				              	<div class="col-md-6 form-group">
									<label>@lang('matricula.numerodepago')</label>
									{!! Form::hidden('matricula', $matricula->id, array('class'=>'form-control matricula_id')) !!}
									{!! Form::text('nro_pago',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.vencimiento')</label>
									{!! Form::date('vencimiento',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>Fecha Recargo</label>
									{!! Form::date('fecha_recargo[]',null,array('class'=>'pago-item form-control')) !!}
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.montooriginal')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('monto_original',null,array('class'=>'pago-item form-control')) !!}
									</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.descuento')</label>
									<div class="input-group">
		  								<span class="input-group-addon">
		  									<?php echo session('moneda')['simbolo']; ?>
		  								</span>
										{!! Form::text('descuento',null,array('class'=>'pago-item form-control')) !!}
		  							</div>
								</div>
								<div class="col-md-6 form-group">
									<label>@lang('matricula.recargo')</label>
									<div class="input-group">
										{!! Form::text('recargo',null,array('class'=>'pago-item form-control')) !!}
		  								<span class="input-group-addon">%</span>
		  							</div>
								</div>
								<div class="col-md-12 form-group">
									<label>@lang('matricula.descripcion')</label>
									{!! Form::textarea('descripcion',null,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
								</div>
								<div class="box-footer col-xs-12">
									<a href="#" class="btn btn-success enlaceajax">@lang('matricula.crear') </a>
							   		<!--<button type="submit" class="btn btn-success enlaceajax">@lang('matricula.crear')</button>
				          			-->
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
    var nro_pago     = $("input[name=nro_pago]").val();
    var matricula_id = $('.matricula_id').val();

    var cars = [
	    nro_pago,
	    matricula_id,
	    "BMW"
	];	
	console.log(cars);

    console.log($("input[name=nro_pago]").val());
    console.log($('.matricula_id').val());		
      
      $(".destino").load("{{ URL::to('/filial/carrito') }}");
   
  }); 


</script>
@endsection