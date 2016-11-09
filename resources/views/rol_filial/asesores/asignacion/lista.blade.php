@extends('template')

@section('content')
		
						
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">Listado de mis asesores</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.asignacionAsesores_nuevo')}}" class="btn btn-success text-white"> Selecci&oacute;n</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>N&uacute;mero de Asesor</th>
						<th>N&uacute;mero de Documento</th>
						<th>Apellido</th>
						<th>Nombre</th>
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>

			 		 	@foreach($asesor as $a)

						    <tr role="row" class="odd">
					    		<td>{{ $a->asesor_id}}</td>
					    		<td>{{ $a->Asesor->nro_documento}}</td>
					    		<td>{{ $a->Asesor->apellidos}}</td>
								<td>{{ $a->Asesor->nombres}}</td>
				    		   	<td>
					           		<a href="{{route('filial.asignacionAsesores_borrar',$a->asesor_id)}}" class="btn btn-danger text-white">BORRAR</a></td>
						    </tr>
					    @endforeach
						    	         
					   	</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection