@extends('template')

@section('content')

	<!-- Lista de Docentes -->


	<div class="row">
		<div class="col-xs-12">

			<div class="input-group input-group-sm">
				{!! Form::select('grupo_id',(['' => 'Seleccionar grupo'] + $grupos->toArray()), null, [ 'class' => 'form-control grupo_id']) !!}
				<span class="input-group-btn">
                      <button class="btn btn-info btn-flat buscar" type="button">Buscar!</button>
                    </span>
			</div>

			<br>
			{!! Form::open(['route'=>'filial.examenes_nuevo_post']) !!}
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de Examenes</h3>
				</div>
				
				<div class="lalocura col-xs-12" style="display: none">
					<div class="form-group materia" >
			            <label for="exampleInputEmail1">Materia</label>
			            <select name="materia_id" class="form-control materia_id">
			            <!-- <option>Seleccione materia</option> -->
			           	</select>
			        </div>
			        <div class="form-group materia" >
			           <label for="exampleInputEmail1">Docente  </label>
			           {!! Form::select('docente_id',(['' => 'Seleccionar docente'] + $docentes->toArray()), null, [ 'class' => 'form-control docente_id']) !!}
			        </div>

			        <!--grupo_id -->
			        {!! Form::hidden('grupo_id',null, ['class'=>'form-control grupo_id'])!!}
				</div>

				<div class="box-body">
				</div>
			</div>
			<div class="box-footer">
				<button type="submit" class="btn btn-primary">Guardar</button>
			</div>
			{!! Form::close() !!}

		</div>
	</div>
@endsection

@section('js')
<script type="text/javascript">

	$( ".buscar" ).click(function() {
		var grupo = $('.grupo_id').val();

		// alert( "Handler for .click() called." );
		$.ajax(
			{
			url: "grupos_examenes",
			type: "POST",
			data: 'grupo_id='+grupo,
			headers: {
			'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(result){
				$('.box-body').empty();
				$('.box-body').append(table());
				$('.lalocura').show();
				var body = $('#example1').children('tbody');
				$('.docente_id').val(result.grupo.docente_id);
				$('.grupo_id').val(result.grupo.id);
				var select_materia = $('.materia_id');				
					// $.each(result.materia, function(clave, valor) {
					// 	select_materia.append('<option value='+valor.id+'>'+valor.nombre+'</option>');
					// });

					select_materia.append('<option value='+result.materia.id+'>'+result.materia.nombre+'</option>');
				
					$.each(result.matriculas, function(clave, valor) {
						var matricula 	= valor.id;
						var persona 	= valor.persona_id;
						var nombre;
						$.each(result.personas, function(claveP, valorP){
							if (valorP.id == persona)
								nombre = valorP.nombres +' '+ valorP.apellidos;
						});
						// var nombre = 'Beto';
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
				 '<td><input type="hidden" name="matricula[]" value="'+matricula+'"><input type="text" name="nota[]" class="form-control"></td>'+
				 '</tr>';
		return tr;
	}



</script>
@endsection