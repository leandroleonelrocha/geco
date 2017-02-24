@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							<div class="col-lg-12 col-xs-12">
			              	<!-- small box -->
			              		<div class="small-box bg-green">
			                		<div class="inner">
			                  			<div class="row">
				                    		<div class="col-sm-4 border-right">
				                      			<div class="description-block">
				                        			<h5 class="description-header">@lang('filial.bienvenido')</h5>
				                        			<span class="description-text">{{$filial->nombre}}</span>
			                      				</div><!-- /.description-block -->
		                    				</div><!-- /.col -->

			                    			<div class="col-sm-4 border-right">
				                      			<div class="description-block">
				                        			<h5 class="description-header">@lang('filial.cadena')</h5>
				                        			<span class="description-text">{{$filial->Cadena->nombre}}</span>
				                      			</div><!-- /.description-block -->
				                    		</div><!-- /.col -->

		                          			<div class="col-sm-4">
			                      				<div class="description-block">
				                        			<h5 class="description-header">Email</h5>
				                        			<span class="description-text">{{$filial->mail}}</span>
				                      			</div><!-- /.description-block -->
				                    		</div><!-- /.col -->
			                  			</div>
			       	
		                   				<div class="row">
						                    <div class="col-sm-4 border-right">
						                      <div class="description-block">
						                        <h5 class="description-header">@lang('filial.direccion')</h5>
						                        <span class="description-text">{{$filial->direccion}} {{$filial->localidad}}</span>
						                      </div><!-- /.description-block -->
						                    </div><!-- /.col -->

				                       		<div class="col-sm-4 border-right">
				                      			<div class="description-block">
							                        <h5 class="description-header">@lang('filial.pais')</h5>
							                        <span class="description-text">{{$filial->Pais->pais}} </span>
				                  				</div><!-- /.description-block -->
					                       	</div><!-- /.col -->

		                          			<div class="col-sm-4">
				                      			<div class="description-block">
					                        		<h5 class="description-header">@lang('filial.telefonos')</h5>
							                        @foreach ($telefono as $t)
							                        	<span class="description-text">{{$t->telefono}} | </span>                      	
						                        	@endforeach
						                      	</div><!-- /.description-block -->
						                    </div><!-- /.col -->
										</div>
									</div>
								</div>
							</div>	
						</div>	
					</div>	
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->

          	<div class="nav-tabs-custom col-xs-12">
	            <ul class="nav nav-tabs">
	                <li class="active"><a href="#tab_1" data-toggle="tab">@lang('menu.cambiarmail')</a></li>
	                <li><a href="#tab_2" data-toggle="tab">@lang('menu.cambiarcontraseña')</a></li>
	               <li><a href="#tab_3" data-toggle="tab">@lang('menu.agregartelefonos')</a></li>      
	            </ul>

            	<div class="tab-content">
	                <div class="tab-pane active" id="tab_1">
	                <br></br>
	                    @include('perfiles.partials.perfil_cambioMail')
	                </div><!-- /.tab-pane -->

	                <div class="tab-pane" id="tab_2">
	                    @include('perfiles.partials.perfil_cambioContrasena')
	                </div><!-- /.tab-pane -->

	                <div class="tab-pane" id="tab_3">
	                 <br></br>
	                    @include('perfiles.partials.perfil_agregartelefono')
	                </div><!-- /.tab-pane -->
            	</div><!-- tab-content -->
        	</div><!-- nav-tabs-custom --> 
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection