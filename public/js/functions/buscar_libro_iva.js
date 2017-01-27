	$( ".buscar_iva" ).click(function() {
		var link = $(this);
		link.find('span').remove();
		link.append('<span class="fa fa-refresh fa-spin"></span>');
		var fecha = $('.dateranger2').val();
		var url   = 'tabla_iva';

			$.ajax(
			{
			url: url,
			type: 'post',
			data: 'fecha='+fecha,
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result){
				console.log(result);	
				$('#tabla_libro_iva').children('tbody').empty();
				
				link.find('span').remove();
				link.append('<span class="glyphicon glyphicon-search "></span>');
				
				var body = $('#tabla_libro_iva').children('tbody');
					
					$.each(result, function(clave, valor){
						console.log(valor);	
						body.append(tr_iva(valor.fecha, 'A', valor.nombre, valor.importe));
					});
			}}

		);

	});	

function tr_iva(fecha, recibo, nombre, importe) {

		var tr = '<tr>'+ 
				 '<td>'+ fecha   + '</td>'+
				 '<td>'+ recibo  + '</td>'+
				 '<td>'+ nombre  + '</td>'+
				 '<td>'+ importe + '</td>'+
				 
				 '</tr>';
		return tr;
	}	