@extends('template')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<h2>@lang('contacto.contacto')</h2>
			<div class="box">
			
                <div class="box-body box-profile">
                	<div class="col-xs-6 contact-info text-center">
	                  <h3 class="profile-username">The Whiteout Team</h3>
	                  <p class="text-muted">@lang('contacto.soporte')</p>
	                  <p class="text-muted">
	                  <strong><i class="fa fa-phone fa-lg margin-r-5"></i></strong>(011) 4095 - 1919</p>
	                  <p class="text-muted">
	                  <strong><i class="fa fa-envelope fa-lg margin-r-5"></i></strong>geco.whiteout@gmail.com</p>
	                  <p class="text-muted">
	                  <strong><i class="fa fa-envelope fa-lg margin-r-5"></i></strong>ian.whiteout@outlook.com</p>
                	</div>
                	<div class="col-xs-6 contact-info text-center">
	                  <h3 class="profile-username">@lang('contacto.casacentral')</h3>
	                  <p class="text-muted">@lang('contacto.soportelogico')</p>
	                  <p class="text-muted">
	                  <strong><i class="fa fa-phone fa-lg margin-r-5"></i></strong>(011) 5032 - 9965</p>
	                  <p class="text-muted">
	                  <strong><i class="fa fa-envelope fa-lg margin-r-5"></i></strong>administracion@igionline.com.ar</p>
	                  <p class="text-muted">
	                  <strong><i class="fa fa-envelope fa-lg margin-r-5"></i></strong>administracion@iaconline.com.ar</p>
                	</div>
                	<div class="row">
                		<div class="col-xs-12">
                		<hr>
		                  <?php
	    				    	$s= (session('usuario')['rol_id']);
   								if ($s==4 || $s==2) {
       							?>
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
					                     		<td>{{ $f->Director->mail}}</td>       
										    </tr>
									    @endforeach
				    				</tbody>
							    </table>
						        <?php
						         }
						         else{
				              	?>
								<table id="example1" class="table table-bordered table-striped">
								<h4><strong>@lang('contacto.titulod')</strong></h4>
									<thead> <tr>
									<th>@lang('contacto.nombre')</th>
									<th>@lang('contacto.telefonosf')</th>
									<th>@lang('contacto.mailsf')</th>
						
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
										    </tr>
									    @endforeach
				    				</tbody>
							    </table>
					        <?php } ?>
                		</div>
                	</div>
                </div><!-- /.box-body -->
           
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection