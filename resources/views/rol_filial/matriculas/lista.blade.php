@extends('template')

@section('content')
									<!-- Lista de Matrículas -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('matricula.listadomatricula')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.matriculas_seleccion')}}" class="btn btn-success text-white"> @lang('matricula.agregarnueva')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('matricula.numero')</th>
						<th>@lang('matricula.persona')</th>
						<th>@lang('matricula.cursa')</th>
						<th>@lang('preinforme.fecha')</th>
						<th>@lang('matricula.estado')</th>
						<th>@lang('matricula.asesor')</th>
						<th class="no-print"></th>
						</tr> </thead>
						<tbody>
						@foreach($matriculas as $matricula)
							<tr>
								<td>{{$matricula->id}}</td>
								<td>{{$matricula->Persona->apellidos}} {{$matricula->Persona->nombres}}</td>
								<td><?php
									if (isset($matricula->Carrera->nombre)) 
											echo $matricula->Carrera->nombre;
									if (isset($matricula->Curso->nombre)) 
											echo $matricula->Curso->nombre;
								?></td>
								<td><?php 
									echo date_format($matricula->created_at, 'd-m-Y'); 
								?></td>
								<td><?php 
									if($matricula->terminado == 1) echo 'Terminada';
									elseif($matricula->cancelado == 1) echo 'Cancelada';
									else echo 'Activa';
								?></td>
								<td>{{$matricula->Asesor->apellidos}} {{$matricula->Asesor->nombres}}</td>
								<td class="text-center">
								<a href="{{route('filial.matriculas_vista',$matricula->id)}}" title="@lang('lista.vistadetallada')"><i class="btn-xs btn-info glyphicon glyphicon-search"></i></a>
								<a href="{{route('filial.matriculas_editar',$matricula->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>
								<!-- <a href="{{route('filial.matriculas_actualizar',$matricula->id)}}" title="@lang('lista.actualizar')"><i class="btn-xs btn-success glyphicon glyphicon-repeat"></i></a> -->
								<!-- <a href="{{route('filial.matriculas_pase',$matricula->id)}}" title="@lang('lista.pases')"><i class="btn-xs btn-warning glyphicon glyphicon-share-alt"></i></a> -->
								<a href="{{route('filial.matriculas_borrar',$matricula->id)}}" title="@lang('lista.eliminar')"><i class="btn-xs btn-danger glyphicon glyphicon-trash"></i></a>

								</td>
							</tr>
						@endforeach
						</tbody>
					</table>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
	
@endsection