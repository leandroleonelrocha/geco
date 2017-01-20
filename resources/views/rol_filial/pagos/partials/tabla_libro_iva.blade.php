<div class="form-group">
	<div class="input-group input-group-sm">
	{!! Form::text('fecha', null ,  array('class'=>'form-control dateranger2')) !!}
		<span class="input-group-btn">
			<button type="button" class="btn btn-default buscar_iva">
				Buscar
				<span class="glyphicon glyphicon-search "></span> 
			</button>
		</span>
	</div>
		         	  
	<br>
		           
	<div class="panel panel-default">
						
		<div class="panel-heading clearfix">
			<b>Libro IVA</b>
			<div class="btn-group pull-right">
				<a href="{{route('filial.imprimir_iva')}}" target="_blank" type="button" class="btn btn-default">
				Imprimir
				<span class="glyphicon glyphicon-print"></span> 
				</a>
			</div>
		</div>
							
		<table id="tabla_libro_iva" class="table table-bordered table-striped">
			<thead>
				<tr>
				<th class="text-center">Fecha</th>
				<th class="text-center">Recibo</th>
				<th class="text-center">Nombre</th>
				<th class="text-center">Importe</th>
				</tr>
			</thead>
		<tbody>
						
		</tbody>
		</table>

	</div>
		            		
</div>