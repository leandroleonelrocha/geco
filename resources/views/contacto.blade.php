@extends('template')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h2>@lang('contacto.contacto')</h2>
<!-- 					<h1 class="box-title">@lang('contacto.equipo')</h1> -->
				</div>

				<div class="box-body">
					<div class="row">
			  			<div class= "col-md-12">
				    		<div class="thumbnail">
								<h2>Soporte T&eacute;cnico</h3>
								<h3>The Whiteout Team</h3>
				      			<img src="{{asset('img/whiteoutteam.png')}}" height="150" width="150" class="img-circle" >
			      				<div class="caption">
			
	      						</div>

	      		<div class="box-body">
					<table id="example1" class="table table-bordered table-striped">
						<thead> <tr>
						<th>Filial</th>
						<th>@lang('filial.telefonos')</th>
						<th>E-Mail</th>
						<th>Director</th>
					<!-- 	<th>Telefono director</th> -->
						<th class="no-print"></th>
						</tr> </thead>
	    				<tbody>
					    	@foreach($filiales as $f)
						
							    <tr role="row" class="odd">
							        <td class="sorting_1">{{ $f->nombre }}</td>
					                <td>
			                     	@foreach($f->FilialTelefono as $telefono)
						            		{{$telefono->telefono}}<br>
					            	@endforeach</td>
					            	<td>{{ $f->mail}}</td>
						            <td>{{ $f->Director->fullname}}</td>
						  
							    </tr>
						    @endforeach

	    				</tbody>
				    </table>
        		</div><!-- Fin box-body -->
    						</div>
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection