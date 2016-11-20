@extends('template')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h2>@lang('contacto.contacto')</h2>
				</div>

				<div class="box-body">
					<div class="row">
			  			<div class= "col-md-12">
				    		<div class="thumbnail">
				    						
								<h2>@lang('contacto.soporte')</h2>
								<h3>The Whiteout Team</h3>
								<p>Tel:1212121212</p>
					
				      			<img src="{{asset('img/whiteoutteam.png')}}" height="200" width="200" class="img-circle" >
								
								<table id="example1" class="table table-bordered table-striped">
									<thead> <tr>
									<th>@lang('contacto.nombre')</th>
									<th>@lang('contacto.telefonosf')</th>
									<th>@lang('contacto.mailsf')</th>
									<th>Director</th>
								 	<th>@lang('contacto.telefonosd')</th>
							 		<th>@lang('contacto.mailsd')</th>
						
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
									            <td>
						                     	@foreach($f->Director->DirectorTelefono as $directorTelefono)
									            		{{$directorTelefono["telefono"]}}<br>
								            	@endforeach</td>

						            	        <td>
						                     	@foreach($f->Director->DirectorMail as $directorMail)
									            		{{$directorMail["mail"]}}<br>
								            	@endforeach</td>
									       

										    </tr>
									    @endforeach

				    				</tbody>
							    </table>
        
    						</div>
						</div>
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection