@extends('template')

@section('content')
									<!-- Mensaje -->
	<div class="row">
	@if (session()->has('msg_ok'))
	    <div class="col-xs-10 col-md-offset-1 alert alert-success">
	        <strong>Éxito!</strong><br />
	        {{ session('msg_ok') }}
	    </div>
	@endif
	@if (session()->has('msg_error'))
	    <div class="col-xs-10 col-md-offset-1 alert alert-danger">
	        <strong>Error!</strong><br />
	        {{ session('msg_error') }}
	    </div>
	@endif
	</div>
									<!-- Lista de Preinformes -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de Preinformes</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.preinformes_seleccion')}}" class="btn btn-success text-white"> Agregar nuevo</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>N&uacute;mero de Preinforme</th>
						<th>Asesor</th>
						<th>Persona</th>
						<th>Medio</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($preinformes as $preinforme)
							<tr>
								<td>{{$preinforme->id}}</td>
								<td>{{$preinforme->Asesor->nombres}} {{$preinforme->Asesor->apellidos}}</td>
								<td>{{$preinforme->Persona->nombres}} {{$preinforme->Persona->apellidos}}</td>
								<td>{{$preinforme->medio}}</td>
								<td class="text-center"><a href="{{route('filial.preinformes_editar',$preinforme->id)}}" title="Editar"><i class="btn btn-success glyphicon glyphicon-pencil"></i></a></td>
							</tr>
						@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection