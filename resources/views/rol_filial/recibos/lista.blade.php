@extends('template')

@section('content')

						
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('recibo.listadorecibo')</h3>
				</div>
				<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('recibo.tipo')</th>
						<th>@lang('recibo.monto')</th>
						<th>@lang('recibo.concepto')</th>
						<th>@lang('recibo.descripcion')</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
							@foreach($recibos as $recibo)
							<tr class="text-center">
								<td>{{$recibo->ReciboTipo->recibo_tipo}}</td>
								<td>{{$recibo->monto}}</td>
								<td>{{$recibo->ReciboConceptoPago->concepto_pago}}</td>
								<td>{{$recibo->descripcion}}</td>
								<td><a href="{{route('filial.recibo_imprimir',$recibo->id)}}" target="_blank" title="@lang('lista.imprimir')"><i class="btn btn-warning glyphicon glyphicon-print"></i></a></td>
							</tr>
							@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection