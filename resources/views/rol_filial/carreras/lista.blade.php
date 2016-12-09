@extends('template')

@section('content')
	
								
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('carrera.listadocarrera')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.carreras_nuevo')}}" class="btn btn-success text-white"> @lang('carrera.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('carrera.nombre')</th>
						<th>@lang('carrera.duracion')</th>
						<th>@lang('carrera.descripcion')</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
					    	@foreach($carrera as $ca)
						    	<tr role="row" class="odd">

						        	<td class="sorting_1">{{ $ca->nombre }}</td>
						        	<input type="hidden" value="{{$ca->id_carrera}}">
							        <td>{{ $ca->duracion }}</td>
						            <td>{{ $ca->descripcion }}</td>
						           	<td class="text-center">
					      			<a href="{{route('filial.carreras_editar',$ca->id)}}" title="Editar"><i class="btn-xs btn-success glyphicon glyphicon-pencil"></i></a>	
									</td>
							    </tr>
						    @endforeach
				   		</tbody>
				    </table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	<div class="row">
        <div class="col-sm-12">
	        <div class="dataTables_paginate paging_simple_numbers" id="example1_paginate">
	        	{!! $carrera->render() !!}
	        </div>
        </div>
    </div>
@endsection