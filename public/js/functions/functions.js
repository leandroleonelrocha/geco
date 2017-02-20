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
   	// Duplicar los campos de Pagos -- Plan de Pagos ~~ Matrículas
   	$('#mas').click(function(){
        var cant = $('#cantidadPagos').val();
   		// Clonación - Búsqueda de cada campo
        for (var i = 0; i < cant; i++) {
    	   $('.pagos:last').clone().appendTo('#planDePagos').find(".pago-item");
        }
    });

    $('#borrarTodo').click(function(){
        var contador = 0;
       $('.pagos').each(function(){
            if(contador != 0)
                $(this).remove();
            contador++;
       });
    });

    $('#borrarUltimo').click(function(){ 
        if( $('.pagos').length > 1)
            $('.pagos:last').remove();
    });

    // Bloquear Grupos según la carrera/curso elegido -- Datos de la Matrícula ~~ Alta Matrículas
    $("#cursos_carreras").change(function(){
        var thiss = $(this).val(),
            link = $("#cursos_carreras").data('url');
        if (thiss == "") {
            $(".select_grupo").empty();
        }
        else{
            var tipo = thiss.split(';');
            $.ajax({
                url: link,
                type: "POST",
                data: {tipo: tipo[0], id: tipo[1]},
                headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                },
                success: function(result){
                   $(".select_grupo").empty();
                   $.each(result, function(clave, valor) {
                        if (valor.practica == 1 && valor.teorica == 1) {
                            $('.select_grupo').append( '<option value="'+valor.id+'">'+valor.descripcion+'</option>' );
                        }
                        if (valor.practica == 1){
                            if (valor.lang == "es")
                                $('.select_grupo').append( '<option value="'+valor.id+'">'+valor.descripcion+' - Práctica </option>' );
                            
                            if (valor.lang == "en")
                                $('.select_grupo').append( '<option value="'+valor.id+'">'+valor.descripcion+' - Practical </option>' );

                            if (valor.lang == "pt")
                                $('.select_grupo').append( '<option value="'+valor.id+'">'+valor.descripcion+' - Prática </option>' );
                        }
                        if (valor.teorica == 1){
                            if (valor.lang == "es")
                                $('.select_grupo').append( '<option value="'+valor.id+'">'+valor.descripcion+' - Teórica </option>' );
                            
                            if (valor.lang == "en")
                                $('.select_grupo').append( '<option value="'+valor.id+'">'+valor.descripcion+' - Theoretical </option>' );

                            if (valor.lang == "pt")
                                $('.select_grupo').append( '<option value="'+valor.id+'">'+valor.descripcion+' - Teórica </option>' );
                        }
                   });
                }
            });
        }
            
    });

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


        /* ------------------------- Agregar Nombre de aulas ------------------------- */
    var max_fields      = 50; //maximum input boxes allowed
    var wrapperN         = $(".input_fields_nombre"); //Fields wrapper
    var add_button_nombre      = $(".add_input_nombre"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button_nombre).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapperN).append('<div><input type="text" name="nombre[]" class="form-control"/><a href="#" class="remove_fieldnombre" >&times;</a></div>'); //add input box
        }
    });

    $(wrapperN).on("click",".remove_fieldnombre", function(e){ //click en eliminar campo
       
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });

            /* ------------------------- Agregar Medio Preinforme ------------------------- */
    var max_fields      = 50; //maximum input boxes allowed
    var wrapperMedio         = $(".input_fields_medio"); //Fields wrapper
    var add_button_medio      = $(".add_input_medio"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button_medio).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapperMedio).append('<div><input type="text" name="medio[]" class="form-control"/><a href="#" class="remove_fieldmedio" >&times;</a></div>'); //add input box
        }
    });

    $(wrapperMedio).on("click",".remove_fieldmedio", function(e){ //click en eliminar campo
       
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });

                /* ------------------------- Agregar Como nos Encontro Preinforme ------------------------- */
    var max_fields      = 50; //maximum input boxes allowed
    var wrapperEncontro         = $(".input_fields_encontro"); //Fields wrapper
    var add_button_encontro      = $(".add_input_encontro"); //Add button ID

    var x = 1; //initlal text box count
    $(add_button_encontro).click(function(e){ //on add input button click
        e.preventDefault();
        if(x < max_fields){ //max input box allowed
            x++; //text box increment
            $(wrapperEncontro).append('<div><input type="text" name="como_encontro[]" class="form-control"/><a href="#" class="remove_fieldencontro" >&times;</a></div>'); //add input box
        }
    });

    $(wrapperEncontro).on("click",".remove_fieldencontro", function(e){ //click en eliminar campo
       
        if( x > 1 ) {
            $(this).parent('div').remove(); //eliminar el campo
            x--;
        }
        return false;
    });

   /* ------------------------- Aceptar/Rechazar Pases ------------------------- */
    $('.CR').on('click', function(event) {
        event.preventDefault();
        var thiss = $(this);
        thiss.html('<i class="btn btn-blue" title="Cargando"><i class="fa fa-refresh fa-spin"></i></i>').attr('disabled', '');
        $.ajax({
            url: thiss.data('url'),
            type: 'GET',
            dataType: 'json',
            data: {id: thiss.data('id')},
        })
        .done(function(resultado) {
            if (thiss.data('actividad') == 'confirmar') {
                thiss.html(resultado);
                thiss.parent('td').parent('tr').find('.accion').html('<span class="text-success"> CONFIRMADO </span>');
                thiss.parent('td').find('.rechazar').remove();
            }
            
            if (thiss.data('actividad') == 'rechazar') {
                if(resultado == true)
                    thiss.parent('td').parent('tr').remove();
            }
        })
        .fail(function() {
            console.log("error");
        });
    });

    /* ------------------------- Pagos ------------------------- */
    var actual  = parseFloat($('.monto_actual').val()); // Monto actual - antes de ser modificado
    // Descuento adicional
    $('.descuento_adicional').keyup(function(){
        var descAd      = parseFloat($('.descuento_adicional').val()),
            desc        = actual - descAd;

        $('.monto_actual').val(desc);
        if (isNaN(descAd)) $('.monto_actual').val(actual);
    });

    // Reecargo adicional
    $('.recargo_adicional').keyup(function(){
        var recAd      = parseFloat($('.recargo_adicional').val()),
            rec        = actual + recAd;

        $('.monto_actual').val(rec);

        if (isNaN(recAd)) $('.monto_actual').val(actual);
    });
});