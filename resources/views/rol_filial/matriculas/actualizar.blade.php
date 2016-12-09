@extends('template')

@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>@lang('matricula.actualizarmatricula')</h3>
				</div>
				<div class="box-body">
					<div class="row">
						<div class="col-xs-12">
						<?php foreach ($grupos as $grupo){
							} ?>
							{!! Form::open(['route'=> 'filial.matriculas_actualizar_post', 'method'=>'post']) !!}
			              	<div class="col-xs-12">
			                	<h4 class="box-title text-center">@lang('matricula.datosmatricula')</h4>
			              	</div>
							<div class="col-md-10 form-group">
								{!! Form::hidden('matricula', $matricula->id, array('class'=>'form-control')) !!}
								<label>@lang('matricula.grupos')</label>
								<small>Ctrl + click @lang('matricula.grupost').</small>
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
								<label>@lang('matricula.cancelar')</label>
								<div>{!! Form::checkbox('cancelado', '1', $matricula->cancelado) !!} @lang('matricula.si')</div>
							</div>
							<div class="box-footer col-xs-12">
						     	<button type="submit" class="btn btn-success">@lang('matricula.actualizar')</button>
				          	</div>
							{!! Form::close() !!}
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection