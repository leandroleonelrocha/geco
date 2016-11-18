@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('director.editardirector')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
							{!! Form::open(['route'=> 'dueño.directores_editar_post', 'method'=>'post']) !!}
							<div class="col-md-12 form-group">
								<label>@lang('director.numero')</label>
								{!! Form::text(null, $director->id, array('class'=>'form-control','disabled')) !!}
								<input type="hidden" name="id" value="{{$director->id}}">
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('director.tipodocumento')</label>
     				      		{!! Form::select('tipo_documento_id',$tipos->toArray(),$director->TipoDocumento->id,array('class' => 'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('director.numerodocumento')</label>
								{!! Form::text('nro_documento', $director->nro_documento, array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('director.apellido')</label>
								{!! Form::text('apellidos', $director->apellidos, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('director.nombre')</label>
								{!! Form::text('nombres', $director->nombres, array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('director.telefonos')</label>
                                <button class="add_input_telefono btn btn-success">+</button>   
                                <div class="input_fields_telefono">
                        			@foreach ($telefono as $t)
										{!! Form::text('telefono[]', $t->telefono, array('class'=>'form-control')) !!}	
									@endforeach
                                </div>
							</div>

			              	<div class="col-md-6 form-group">
                                <label>E-Mails</label>
                                <button class="add_input_mail btn btn-success"">+</button>  
                                <div class="input_fields_wrap">
									@foreach ($mail as $m)
										{!! Form::email('mail[]', $m->mail, array('class'=>'form-control')) !!}	
									@endforeach
                                </div>
                            </div>

							<div class="box-footer col-xs-12">
							{!! Form::submit('Guardar',array('class'=>'btn btn-success')) !!}
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