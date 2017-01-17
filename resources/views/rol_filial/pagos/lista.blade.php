@extends('template')

@section('content')
	 					
		<div class="row">
		<div class="col-xs-12">
			<div class="box-tools pull-right no-print">
						<a href="{{route('filial.pagos_nuevo',$matricula->id)}}" class="btn btn-success text-white"> @lang('matricula.agregarnuevopago')</a>
					</div>
				</div>
				<div class="box-body">
			
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->

	<div class="row">
		<div class="col-xs-12">
		   <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Listado de pagos</h3>
                </div>
                <div class="box-body">
               		@include('rol_filial.pagos.partials.tabla_pagos')
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
		</div>
    </div>         

@endsection

