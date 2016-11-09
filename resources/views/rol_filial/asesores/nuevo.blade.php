@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Nuevo Asesor</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'filial.asesores_nuevo_post', 'method'=>'post']) !!}
							<div class="col-md-6 form-group">
								<label>Tipo de Documento</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>N&uacute;mero de Documento</label>
								{!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Apellido</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Nombres</label>
								{!! Form::text('nombres',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>Direcci&oacute;n</label>
								{!! Form::text('direccion',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Localidad</label>
								{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>Tel&eacute;fono</label>

								<button class="add_input_telefono">+</button>	
								{!! Form::text('telefono[]',null,array('class'=>'form-control')) !!}
								<div class="input_fields_telefono">
								</div>
							</div>


							<div class="col-md-6 form-group">
								
								<label>E-Mail</label>
								<button class="add_input_mail">+</button>	
								
								<div class="input_fields_wrap">
							   	{!! Form::text('mail[]',null,array('class'=>'form-control')) !!}
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
@endsection

@section('js')
<script type="text/javascript">
	$(document).ready(function() {
    var max_fields      = 10; //maximum input boxes allowed
    var wrapper         = $(".input_fields_wrap"); //Fields wrapper
    var wrapper2 = $(".input_fields_telefono");
    var add_button_mail      = $(".add_input_mail"); //Add button ID
    var add_button_telefono = $(".add_input_telefono");


    
    var x = 1; //initlal text box count
    $(add_button_mail).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapper).append('<div><input type="text" name="mail[]" class="form-control"/><a href="#" class="remove_field " >Remove</a></div>'); //add input box
        }
    });
    
    $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
        e.preventDefault(); $(this).parent('div').remove(); x--;
    })


    $(add_button_telefono).click(function(e){
    	e.preventDefault();
    	$(wrapper2).append('<div><input type="text" name="telefono[]" class="form-control"/><a href="#" class="remove_field " >Remove</a></div>'); //add input box

    });

});
</script>
@endsection