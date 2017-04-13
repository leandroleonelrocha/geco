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
				
				if(result.length > 0)
				{	
				$('#tabla_libro_iva').children('tbody').empty();
				
				link.find('span').remove();
				link.append('<span class="glyphicon glyphicon-search "></span>');
				
				var body = $('#tabla_libro_iva').children('tbody');
					
					$.each(result, function(clave, valor){
						console.log(valor.recibo);	
						body.append(tr_iva(valor.fecha, valor.recibo, valor.nombre, valor.importe));
					});
				}else{
					link.find('span').remove();
					link.append('<span class="glyphicon glyphicon-search "></span>');
					alert('No se han encontrado resultados');
				}

			}

		});

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

var app = new Vue({
  el: '#app',
  data: {
    message: 'Hello Vue!'
  }
})		