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
    $('.agregar').click(function(){
    	var clase = "."+$(this).data('info');
    	$(this).next().clone().appendTo(clase).find('.item').val("");
    });

    $('.quitar').click(function(){
    	var clase = "."+$(this).data('info');
    	$(this).prev().remove();
    });
});