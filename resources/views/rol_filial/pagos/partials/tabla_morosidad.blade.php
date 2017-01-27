	<div class="form-group">
					{!! Form::open(['route'=> 'filial.tabla_morisidad', 'method'=>'post']) !!}
						 <div class="input-group input-group-sm">
		                   {!! Form::text('fecha', null ,  array('class'=>'form-control daterangerp')) !!}
		                    <span class="input-group-btn">
		                      
			                <button type="button" class="btn btn-default buscar_fecha">
			               		Buscar
						     	<span class="glyphicon glyphicon-search "></span> 
						    </button>

		                    </span>
		                  </div><!-- /input-group -->
		         	{!! Form::close() !!}  
		            <br>
		           

		            <div class="panel panel-default">
					  <!-- Default panel contents -->
					<div class="panel-heading clearfix">
				     	<b>Listado de morosidad</b>
				       <div class="btn-group pull-right">
				      	
				        <a href="{{route('filial.imprimir_morosidad')}}" target="_blank" type="button" class="btn btn-default">
			               	Imprimir
						    <span class="glyphicon glyphicon-print"></span> 
						</a>
				      
				      </div>
				  	</div>
					
					    <table id="tabla_morosidad" class="table table-bordered table-striped">
						<thead><tr>
						<th class="text-center">Matrícula</th>
						<th class="text-center">Grupo</th>
						<th class="text-center">Nombre</th>
						<th class="text-center">Cuota</th>
						<th class="text-center">Fecha pago</th>
						<th class="text-center">Vencimiento</th>
						<th class="text-center">Saldo</th>
						<th class="text-center">Teléfonos</th>
						<th class="text-center">Correos</th>

						</tr> </thead>
						<tbody>
				
						</tbody>
						</table>
					</div>
		</div><!-- /.tab-pane -->