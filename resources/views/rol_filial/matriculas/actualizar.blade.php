@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>Actualizar Matr&iacute;cula</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
						<?php foreach ($grupos as $grupo){
							} ?>
							{!! Form::open(['route'=> 'filial.matriculas_actualizar_post', 'method'=>'post']) !!}
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">Datos de la Matr&iacute;cula</h4>
			              	</div>
							<div class="col-md-10 form-group">
								{!! Form::hidden('matricula', $matricula->id, array('class'=>'form-control')) !!}
								<label>Grupos</label>
								<small>Ctrl + click para seleccionar m&aacute; de un grupo.</small>
								<select name="grupo[]" class='form-control' multiple>
									<?php foreach ($grupos as $grupo) { ?>
										<option value="{{$grupo}}"
										<?php foreach ($matricula->Grupo as $mg){
											if( $mg->id == $grupo )
												echo 'selected';
										}?> >
											{{$grupo}}
										</option>
									<?php } ?>
								</select>
							</div>
							<div class="col-md-2 form-group">
								<label>Cancelar</label>
								<div>{!! Form::checkbox('cancelado', '1', $matricula->cancelado) !!} Si</div>
							</div>
							<div class="box-footer col-xs-12">
								{!! Form::submit('Actualizar',array('class'=>'btn btn-success')) !!}
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<!-- jQuery 2.1.4 -->
    <script src="{{asset('plugins/jQuery/jQuery-2.1.4.min.js')}}"></script>
    <script src="{{asset('js/functions/functions.js')}}"></script>
@endsection