@extends('template')

@section('content')
	<div class="row">
	    <div class="col-xs-12">
	      <div class="box-tools pull-right no-print destino">
	       
	      </div>
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
							{!! Form::open(['route'=> 'filial.pagos_plan_nuevo_post', 'method'=>'post']) !!}
								<div id="planDePagos">
									<div class="pagos">
						              	<div class="col-md-6 form-group">
											<label>@lang('matricula.numerodepago')</label>
											{!! Form::hidden('matricula', $matricula->id, array('class'=>'form-control')) !!}
											{!! Form::text('nro_pago[]',null,array('class'=>'pago-item form-control')) !!}
										</div>
										<div class="col-md-6 form-group">
											<label>@lang('matricula.fechavencimiento')</label>
											{!! Form::date('vencimiento[]',null,array('class'=>'pago-item form-control')) !!}
										</div>
										<div class="col-md-6 form-group">
											<label>@lang('matricula.montooriginal')</label>
											<div class="input-group">
				  								<span class="input-group-addon">
				  									<?php echo session('moneda')['simbolo']; ?>
				  								</span>
												{!! Form::text('monto_original[]',null,array('class'=>'pago-item form-control')) !!}
											</div>
										</div>
										<div class="col-md-6 form-group">
											<label>@lang('matricula.descuento')</label>
											<div class="input-group">
				  								<span class="input-group-addon">
				  									<?php echo session('moneda')['simbolo']; ?>
				  								</span>
												{!! Form::text('descuento[]',null,array('class'=>'pago-item form-control')) !!}
				  							</div>
										</div>
										<div class="col-md-6 form-group">
											<label>@lang('matricula.recargo')</label>
											<div class="input-group">
				  								<span class="input-group-addon">%</span>
												{!! Form::text('recargo[]',null,array('class'=>'pago-item form-control')) !!}
				  							</div>
										</div>
										<div class="col-md-12 form-group">
											<label>@lang('matricula.descripcion')</label>
											{!! Form::textarea('descripcion[]',null,array('class'=>'pago-item form-control','size'=>'30x4')) !!}
											<div class="line"></div>
										</div>
									</div><!-- Fin pagos -->
									</div><!-- Fin planDePagos -->
									<div class="col-md-3">
										<input id="cantidadPagos" class="form-control" type="text" placeholder="@lang('matricula.cantidadpagos')">
									</div>
									<div id="mas" class="col-md-3">
										<span class="btn btn-danger btn-pagos">
											@lang('matricula.agregarpagos')
										</span>
									</div>
									<div id="borrarTodo" class="col-md-3">
										<span class="btn btn-danger btn-pagos">
											@lang('matricula.borrarpagos')
										</span>
									</div>
									<div id="borrarUltimo" class="col-md-3">
										<span class="btn btn-danger btn-pagos">
											@lang('matricula.borrarultimopago')
										</span>
									</div>
								<div class="box-footer col-xs-12">
							   		<button type="submit" class="btn btn-success">@lang('matricula.crear')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection