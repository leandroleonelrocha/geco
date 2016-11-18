@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('persona.nuevopersona')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.personas_nuevo_post', 'method'=>'post']) !!}

					    	<div class="col-md-12 form-group">
								<label>@lang('persona.asesor')</label>
								{!! Form::select('asesor_id',$asesores->toArray(),null,array('class' => 'form-control')) !!}
							</div>
				            <div class="col-xs-12">
				            	<h4 class="box-title text-center">@lang('persona.titulo')</h4>
				            </div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.numerodocumento')</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.apellido')</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.nombre')</label>
								{!! Form::text('nombres',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<div class="col-xs-12"><label>@lang('persona.genero')</label></div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'M') !!} @lang('persona.masculino')
								</div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'F') !!} @lang('persona.femenino')
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.fnacimiento')</label>
								{!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.domicilio')</label>
								{!! Form::text('domicilio',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.localidad')</label>
								{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.estadocivil')</label>
								{!! Form::text('estado_civil',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.nivelestudios')</label>
								{!! Form::text('nivel_estudios',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computacion')</label>
								<div>{!! Form::checkbox('estudio_computacion', '1') !!} Si</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.computadora')</label>
								<div>{!! Form::checkbox('posee_computadora', '1') !!} Si</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.disponibilidad')</label>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_manana', '1') !!} @lang('persona.mañana')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_tarde', '1') !!} @lang('persona.tarde')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_noche', '1') !!} @lang('persona.noche')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_sabados', '1') !!} @lang('persona.sabados')
								</div>
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.aclaraciones')</label>
								{!! Form::textarea('aclaraciones',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.telefonos')</label>
								<button class="add_input_telefono btn btn-success">+</button>	
								<div class="input_fields_telefono">
									{!! Form::text('telefono[]',null,array('class'=>'form-control')) !!}
								</div>
							</div>

							<div class="col-md-6 form-group">
								<label>E-mails</label>
								<button class="add_input_mail btn btn-success"">+</button>	
								<div class="input_fields_wrap">
							   		{!! Form::email('mail[]',null,array('class'=>'form-control')) !!}
								</div>	
							</div>

							<div class="box-footer col-xs-12">
								{!! Form::submit('Crear',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<!-- jQuery 2.1.4 -->
	<!--<script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

    <script src="{{asset('js/functions/functions.js')}}"></script>-->
@endsection

@section('js')
	<script type="text/javascript">
		$(document).ready(function() {
	    var max_fields      = 5; //maximum input boxes allowed
	    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
	    var wrapper2 = $(".input_fields_telefono");
	    var add_button_mail      = $(".add_input_mail"); //Add button ID
	    var add_button_telefono = $(".add_input_telefono");

	    var x = 1; //initlal text box count
	    $(add_button_mail).click(function(e){ //on add input button click
	        e.preventDefault();
	        if(x < max_fields){ //max input box allowed
	            x++; //text box increment
	            $(wrapper).append('<div><input type="text" name="mail[]" class="form-control"/><a href="#" class="remove_fieldMail" >&times;</a></div>'); //add input box
	        }
	    });

	    $(add_button_telefono).click(function(e){
	    	e.preventDefault();
	       if(x < max_fields){ //max input box allowed
	            x++; //text box increment
	    		$(wrapper2).append('<div><input type="text" name="telefono[]" class="form-control"/><a href="#" class="remove_fieldTel" >&times;</a></div>'); //add input box
	    	}
	    });

	    $(wrapper).on("click",".remove_fieldMail", function(e){ //click en eliminar campo
	       
	    	if( x > 1 ) {
	            $(this).parent('div').remove(); //eliminar el campo
	            x--;
	    	}
	        return false;
	    });

	    $(wrapper2).on("click",".remove_fieldTel", function(e){ //click en eliminar campo
	       
	    	if( x > 1 ) {
	            $(this).parent('div').remove(); //eliminar el campo
	            x--;
	    	}
	    	return false;
	    });
	});
	</script>
@endsection
