@extends('template')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h2>@lang('contacto.contacto')</h2>
					<h1 class="box-title">@lang('contacto.equipo')</h1>
				</div>

				<div class="box-body">
					<div class="row">
			  			<div class= "col-md-3">
				    		<div class="thumbnail">
				      			<img src="{{asset('img/geco/e1.png')}}" height="150" width="150" class="img-circle" >
			      				<div class="caption">
				        			<h4>Bruno Cristian</h4>
			        				<p>crisdabruno@hotmail.com<p>
	      						</div>
    						</div>
						</div>
					
			  			<div class="col-md-3">
				    		<div class="thumbnail">
				      			<img src="{{asset('img/geco/e4.png')}}" height="150" width="150" class="img-circle" >
				      			<div class="caption">
				        			<h4>Donato Gabriel</h4>
				        			<p>gabydonatognr@gmail.com<p>
	      						</div>
    						</div>
						</div>

						<div class="col-md-3">
				    		<div class="thumbnail">
				      			<img src="{{asset('img/geco/e2.png')}}" height="150" width="150"  class="img-circle" >
				      			<div class="caption">
				        			<h4>Rocha Leandro</h4>
			        				<p>rochaleandroleonel@gmail.com<p>
	      						</div>
    						</div>
						</div>

						<div class="col-md-3">
				    		<div class="thumbnail">
				      			<img src="{{asset('img/geco/e3.png')}}" height="150" width="150"  class="img-circle" >
				      			<div class="caption">
				        			<h4>Scaltritti Ian </h4>
				        			<p>ian.whiteout@outlook.com<p>
	      						</div>
    						</div>
						</div>
						<div class="col-xs-12">
							<h4>@lang('contacto.mensajedejar')</h4>
					     </div>
						{!! Form::open(['route'=> 'filial.contacto_nuevo_post', 'method'=>'post']) !!}
                            <div class="col-md-8 form-group">
                                <label>@lang('contacto.nombre')</label>
                                {!! Form::text('nombre',null,array('class'=>'form-control')) !!}
                            </div>

                         	<div class="col-md-8 form-group">
                                <label>@lang('contacto.tipoconsulta')</label>
                                <SELECT NAME="tipoConsulta"> 
								   <OPTION VALUE="Técnica">@lang('contacto.tecnica')</OPTION> 
								   <OPTION VALUE="Funcional">@lang('contacto.funcional')</OPTION> 
								   <OPTION VALUE="Otros">@lang('contacto.otros')</OPTION> 
								</SELECT> 
                            </div>

                            <div class="col-md-8 form-group">
                                <label>@lang('contacto.telefono')</label>
                                {!! Form::text('telefono',null,array('class'=>'form-control item')) !!}
                            </div>

                            <div class="col-md-8 form-group">
                                <label>E-Mail</label>
                                {!! Form::email('mail',null,array('class'=>'form-control')) !!}
                            </div>

                           <div class="col-md-8 form-group">
                                <label>@lang('contacto.mensaje')</label>
                                {!! Form::textarea('mensaje',null,array('class'=>'form-control','size'=>'30x4')) !!}
                            </div>

                            <div class="box-footer col-xs-10">
                            	{!! Form::submit('Enviar',array('class'=>'btn btn-success')) !!}
                            </div>

                        {!! Form::close() !!}
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection