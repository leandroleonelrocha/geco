@extends('template')

@section('content')

	<!-- Lista de Docentes -->


	<div class="row">
		<div class="col-xs-12">

			<div class="input-group input-group-sm">
				{!! Form::select('grupo_id',(['' => 'Seleccionar curso'] + $grupos->toArray()), null, [ 'class' => 'form-control grupo_id']) !!}


				<span class="input-group-btn">
                      <button class="btn btn-info btn-flat buscar" type="button">Buscar!</button>
                    </span>
			</div><!-- /input-group -->

			<p class="margin">Small <code>.input-group.input-group-sm</code></p>
			{!! Form::open(['route'=>'filial.examenes_nuevo_post']) !!}
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de Examenes</h3>
				</div>
				<div class="box-body">
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->

			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
			{!! Form::close() !!}

		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection

@section('js')
<script type="text/javascript">

	$( ".buscar" ).click(function() {
		var grupo = $('.grupo_id').val();
		console.log(grupo);
		alert( "Handler for .click() called." );
		$.ajax(
			{
			url: "examenes/grupos_examenes",
			type: "POST",
			data: 'grupo_id='+grupo,
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result){
				$('.box-body').empty();
				$('.box-body').append(table());
				var body = $('#example1').children('tbody');
				$.each(result, function(clave, valor) {

					var matricula = valor.id;
					var nombre = 'Beto';
					body.append(tr(matricula, nombre));

				});

			}}

		);

	});
	
	function table() {

		var table = '<table id="example1" class="table table-bordered table-striped">'+
					'<thead> <tr>'+
					'<th>Matricula</th>'+
					'<th>Persona</th>'+
					'<th>Nota</th>'+
					'<th class="no-print"></th>'+
					'</tr></thead>'+
					'<tbody>'+
					'</tbody>'+
					'</table>';
		return table;
	}

	function tr(matricula, persona) {

		var tr = '<tr>'+
				 '<td>'+ matricula + '</td>'+
				 '<td>'+ persona + '</td>'+
				 '<td><input type="text" name="nota"></td>'+
				 '</tr>';
		return tr;
	}


</script>
@endsection