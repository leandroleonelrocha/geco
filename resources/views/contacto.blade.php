@extends('template')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h2>Contacto</h2>
					<h1 class="box-title">Equipo de desarrollo Whiteout Team</h1>
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
							<h4>Deje su Mensaje</h4>
					     </div>
						{!! Form::open(['route'=> 'filial.contacto_nuevo_post', 'method'=>'post']) !!}
                            <div class="col-md-8 form-group">
                                <label>Nombre</label>
                                {!! Form::text('nombre',null,array('class'=>'form-control')) !!}
                            </div>

                         	<div class="col-md-8 form-group">
                                <label>Tipo de consulta</label>
                                <SELECT NAME="tipoConsulta"> 
								   <OPTION VALUE="Técnica">Técnica</OPTION> 
								   <OPTION VALUE="Funcional">Funcional</OPTION> 
								   <OPTION VALUE="Otros">Otros</OPTION> 
								</SELECT> 
                            </div>

                            <div class="col-md-8 form-group">
                                <label>Tel&eacute;fono</label>
                                {!! Form::text('telefono',null,array('class'=>'form-control item')) !!}
                            </div>

                            <div class="col-md-8 form-group">
                                <label>E-Mail</label>
                                {!! Form::email('mail',null,array('class'=>'form-control')) !!}
                            </div>

                           <div class="col-md-8 form-group">
                                <label>Mensaje</label>
                                {!! Form::textarea('mensaje',null,array('class'=>'form-control','size'=>'30x4')) !!}
                            </div>

                            <div class="box-footer col-xs-12">
                            {!! Form::submit('Enviar',array('class'=>'btn btn-success')) !!}
                            </div>

                        {!! Form::close() !!}
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection