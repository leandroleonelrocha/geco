@extends('template')

@section('content')			
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Mails</h3>
				</div>
				<div class="box-body">
					<div class="morosos">
						<div class="row">
	                        <div class="col-xs-12">
	                            <table id="example1" class="table table-bordered table-striped">
									<thead><tr>
										<th></th>
										<th>@lang('mail.razon')</th>
										<th>@lang('mail.destinatarios')</th>
									</tr></thead>
									<tbody>
										<?php if ($cantMorosos > 0): ?>
										<tr>
											<td></td>
											<td>Moroso</td>
											<td>{{$cantMorosos}}</td>
										</tr>
										<?php endif ?>
										<?php if ($cantInteres > 0): ?>
										<tr>
											<td></td>
											<td>Inter&eacute;s</td>
											<td>{{$cantInteres}}</td>
										</tr>
										<?php endif ?>
										<?php if ($cantGrupos > 0): ?>
										<tr>
											<td></td>
											<td>Nuevo Grupo</td>
											<td>{{$cantGrupos}}</td>
										</tr>
										<?php endif ?>
									</tbody>
								</table>
	                            <div class="box-footer col-xs-12">
	                            <a href="{{route('filial.mails_enviar')}}" class="btn btn-success">@lang('mail.enviar')</a>
	                            </div>

	                            {!! Form::close() !!}
	                        </div>
	                    </div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection