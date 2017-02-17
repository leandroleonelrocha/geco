@extends('template')

@section('content')
	
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Caja diaria</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.asesores_nuevo')}}" class="btn btn-success text-white"> @lang('asesor.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('asesor.numerodocumento')</th>
						<th>@lang('asesor.apellido')</th>
						<th>@lang('asesor.nombre')</th>
						<th>@lang('asesor.direccion')</th>
						<th>@lang('asesor.localidad')</th>
						<th>@lang('asesor.telefonos')</th>
						<th>@lang('asesor.mail')</th>
			
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>
						  
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection