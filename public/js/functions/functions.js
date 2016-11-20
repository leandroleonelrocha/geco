$(document).ready(function(){
	/* ------------------------- Preinformes ------------------------- */
	// Se Corrobora que no se haya seleccionado ninguna Carrera o Curso
	function seleccionoCarreraCurso(){
		var seleccionCarrera, seleccionCurso;
		$('#carreras').each(function(){ // Se recorre todo el select de Carreras
			if ( $(this).val() != null )
				seleccionCarrera = true;
			else 
				seleccionCarrera = false;
		});
		$('#cursos').each(function(){ // Se recorre todo el select de Cursos
			if ( $(this).val() != null ) 
				seleccionCurso = true;
			else 
				seleccionCurso = false;
		});

		if (seleccionCarrera == true || seleccionCurso == true) // Si hay alguno seleccionado
			$('#ninguna').attr('disabled',true);
		else 
			$('#ninguna').removeAttr('disabled');
	}

	// Se bloquea/habilita la opción ninguna
	seleccionoCarreraCurso(); // Al cargar la página
	// Al hacer click en alguna Carrera o Curso
	$('#carreras').click(function(){ seleccionoCarreraCurso(); });
	$('#cursos').click(function(){ seleccionoCarreraCurso(); });

	// Permite agregar 'Otros' en Intereses -- Seccion de Preinformes
    $('#ninguna').click(function(){
        if( $('#ninguna').prop('checked') ) {
		    $('#otros').removeAttr('disabled');
		}
		else
			$('#otros').attr('disabled',true);
    });

   	/* ------------------------- Matrículas ------------------------- */
   	// Duplicar los campos de Pagos -- Plan de Pagos ~~ Alta Matrículas
   	$('#mas').click(function(){
   		// Clonación - Búsqueda de cada campo - Reseteo del value
    	$('.pagos:last').clone().appendTo('#planDePagos').find(".pago-item").val("");
    });

    // Bloquear Grupos según la carrera/curso elegido -- Datos de la Matrícula ~~ Alta Matrículas
    function bloquearGrupos(){
    	var cs = $('#carreras_cursos').val().split(';'); // cs -> Carrera/Curso Seleccionado
    	// cs[0] = carrera/curso -- cs[1] = carrera_id/curso_id
    	
    }
    // bloquearGrupos();

    /* ------------------------- Agregar más E-mail y Teléfono ------------------------- */
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