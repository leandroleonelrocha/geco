	<div class="form-group">
					{!! Form::open(['route'=> 'filial.tabla_morisidad', 'method'=>'post']) !!}
						 <div class="input-group input-group-sm">
		                   {!! Form::text('fecha', null ,  array('class'=>'form-control daterangerp')) !!}
		                    <span class="input-group-btn">
		                      
			                <button type="button" class="btn btn-default buscar_fecha">
			               		@lang('lista.buscar')
						     	<span class="glyphicon glyphicon-search "></span> 
						    </button>

		                    </span>
		                  </div><!-- /input-group -->
		         	{!! Form::close() !!}  
		            <br>
		           

		            <div class="panel panel-default">
					  <!-- Default panel contents -->
					<div class="panel-heading clearfix">
				     	<b>@lang('impresiones/morosidad.listado')</b>
				       <div class="btn-group pull-right">
				      	
				        <a href="{{route('filial.imprimir_morosidad')}}" target="_blank" type="button" class="btn btn-default">
			               	@lang('lista.imprimir')
						    <span class="glyphicon glyphicon-print"></span> 
						</a>
				      
				      </div>
				  	</div>
					
					    <table id="tabla_morosidad" class="table table-bordered table-striped">
						<thead><tr>
						<th class="text-center">@lang('impresiones/morosidad.matricula')</th>
						<th class="text-center">@lang('impresiones/morosidad.grupo')</th>
						<th class="text-center">@lang('impresiones/morosidad.nombre')</th>
						<th class="text-center">@lang('impresiones/morosidad.cuota')</th>
						<th class="text-center">@lang('impresiones/morosidad.fechapago')</th>
						<th class="text-center">@lang('impresiones/morosidad.vencimiento')</th>
						<th class="text-center">@lang('impresiones/morosidad.saldo')</th>
						<th class="text-center">@lang('impresiones/morosidad.telefono')</th>
						<th class="text-center">Emails</th>

						</tr> </thead>
						<tbody>
				
						</tbody>
						</table>
					</div>
		</div><!-- /.tab-pane -->