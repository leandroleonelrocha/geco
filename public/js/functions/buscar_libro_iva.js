	$( ".buscar_iva" ).click(function() {
		var link = $(this);
		link.find('span').remove();
		link.append('<span class="fa fa-refresh fa-spin"></span>');
		var fecha = $('.daterangerp').val();
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
				
				$('#tabla_morosidad').children('tbody').empty();
				
				link.find('span').remove();
				link.append('<span class="glyphicon glyphicon-search "></span>');
				
				var body = $('#tabla_morosidad').children('tbody');
					
					$.each(result, function(clave, valor){

						var mail 	 = persona_email(valor.persona_email);
						var telefono = persona_telefono(valor.persona_telefono);
						body.append(tr(valor.matricula, valor.grupo, valor.persona, valor.nro_pago, 'fecha', valor.vencimiento, valor.saldo, telefono, mail));
					});
			}}

		);

	});	

function tr(matricula, grupo, nombre, cuota, fecha_pago, fecha_vencimiento, saldo, telefono, mail) {

		var tr = '<tr>'+
				 '<td>'+ matricula + '</td>'+
				 '<td>'+ grupo + '</td>'+
				 '<td>'+ nombre + '</td>'+
				 '<td>'+ cuota + '</td>'+
				 '<td>'+ fecha_pago + '</td>'+
				 '<td>'+ fecha_vencimiento + '</td>'+
				 '<td>'+ saldo + '</td>'+
				 '<td>'+ telefono + '</td>'+
				 '<td>'+ mail + '</td>'+
				 
				 '</tr>';
		return tr;
	}	