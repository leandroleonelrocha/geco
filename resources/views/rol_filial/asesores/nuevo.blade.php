@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('asesor.nuevoasesor')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.asesores_nuevo_post', 'method'=>'post']) !!}
							<div class="col-md-6 form-group">
								<label>@lang('asesor.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.numerodocumento')</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.apellido')</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.nombre')</label>
								{!! Form::text('nombres',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('asesor.direccion')</label>
								{!! Form::text('direccion',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('asesor.localidad')</label>
								{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('asesor.telefonos')</label>
								<button class="add_input_telefono btn btn-success">+</button>	
								<div class="input_fields_telefono">
									{!! Form::text('telefono[]',null,array('class'=>'form-control')) !!}
								</div>
							</div>

							<div class="col-md-6 form-group">	
								<label>@lang('asesor.mail')</label>
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

<!-- <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>

<script src="{{asset('js/functions/functions.js')}}"></script> -->
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