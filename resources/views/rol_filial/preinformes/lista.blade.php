@extends('template')

@section('content')
									<!-- Lista de Preinformes -->
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('preinforme.listadopreinforme')</h3>
					<div class="box-tools pull-right no-print">
						<a href="{{route('filial.preinformes_seleccion')}}" id="step1" class="btn btn-success text-white"> @lang('preinforme.agregarnuevo')</a>
					</div>
				</div>
				<div class="box-body">
					 <table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>@lang('preinforme.numero')</th>
						<th>@lang('persona.asesor')</th>
						<th>@lang('preinforme.persona')</th>
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
								<td class="text-center"><a href="{{route('filial.preinformes_editar',$preinforme->id)}}" title="Editar"><i class="btn-xs btn-success glyphicon glyphicon-pencil"></i></a></td>
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
	        	{!! $preinformes->render() !!}
	        </div>
        </div>
    </div>
@endsection


@section('js')
<script type="text/javascript">
		

 function startIntro(){
        var intro = introJs();

          intro.setOptions({

            'showProgress': true,
            steps: [
              { 
                intro: "Hello world!"
              },
              {
                element: document.querySelector('#step1'),
                intro: "This is a tooltip."
              },
              {
                element: document.querySelector('#example1_filter'),
                intro: "This is a tooltip."
              },
              {
                element: document.querySelector('#example1_length'),
                intro: "This is a tooltip."
              },
              {
                element: document.querySelector('#step_editar'),
                intro: "This is a tooltip."
              },
              {
                element: document.querySelector('#step_borrar'),
                intro: "This is a tooltip."
              }
            ]
          });

          intro.start();
      }

</script>
@endsection