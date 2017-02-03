<div class="form-group">
	<div class="input-group input-group-sm">
	{!! Form::text('fecha', null ,  array('class'=>'form-control dateranger2')) !!}
		<span class="input-group-btn">
			<button type="button" class="btn btn-default buscar_iva">
				@lang('lista.buscar')
				<span class="glyphicon glyphicon-search "></span> 
			</button>
		</span>
	</div>
		         	  
	<br>
		           
	<div class="panel panel-default">
						
		<div class="panel-heading clearfix">
			<b>@lang('impresiones/libro_iva.libro')</b>
			<div class="btn-group pull-right">
				<a href="{{route('filial.imprimir_iva')}}" target="_blank" type="button" class="btn btn-default">
				@lang('lista.imprimir')
				<span class="glyphicon glyphicon-print"></span> 
				</a>
			</div>
		</div>
							
		<table id="tabla_libro_iva" class="table table-bordered table-striped">
			<thead>
				<tr>
				<th class="text-center">@lang('impresiones/libro_iva.fecha')</th>
				<th class="text-center">@lang('impresiones/libro_iva.recibo')</th>
				<th class="text-center">@lang('impresiones/libro_iva.nombre')</th>
				<th class="text-center">@lang('impresiones/libro_iva.importe')</th>
				</tr>
			</thead>
		<tbody>
						
		</tbody>
		</table>

	</div>
		            		
</div>