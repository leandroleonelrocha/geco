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
		                  	$s = session('usuario')['rol_id'];
		                  	$u = session('usuario')['entidad_id'];
		                  ?>
   							<div class="box-header">
								<h3 class="box-title">@lang('contacto.listafilial')</h3>
							</div>
							<table id="example1" class="table table-bordered table-striped">
								<thead> <tr>
								<th></th>
								<th>@lang('filial.cadena')</th>
								<th>@lang('contacto.telefonos')</th>
								<th>@lang('contacto.mails')</th>
								<th>@lang('contacto.director')</th>
								</tr> </thead>
			    				<tbody>
							    	@foreach($filiales as $f)
									    <tr role="row" class="<?php if($s == 3){
									    	if($f->director_id == $u) echo 'bg-primary';
									    	} ?> odd">
									        <td class="sorting_1"><strong>{{ $f->nombre }}</strong></td>
									        <td>{{ $f->Cadena->nombre}}</td>
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
						    <div class="box-header">
								<h3 class="box-title">@lang('contacto.listadirector')</h3>
							</div>
						    <table id="example2" class="table table-bordered table-striped">
								<thead> <tr>
								<th></th>
								<th>@lang('contacto.telefonos')</th>
								<th>@lang('contacto.mails')</th>
								<th>@lang('contacto.filiales')</th>
								</tr> </thead>
			    				<tbody>
							    	@foreach($directores as $d)
							    		<tr role="row" class="odd">
									        <td class="sorting_1"><strong>{{ $d->apellidos }} {{ $d->nombres }}</strong></td>
							                <td>
					                     	@foreach($d->DirectorTelefono as $telefono)
								            		{{$telefono->telefono}}<br>
							            	@endforeach</td>
							            	<td>{{ $d->mail}}</td>
							            	<td>
					                     	@foreach($d->Filial as $filial)
								            		{{$filial->nombre}}<br>
							            	@endforeach</td>
									    </tr>
								    @endforeach
			    				</tbody>
						    </table>
                		</div>
                	</div>
                </div><!-- /.box-body -->
           
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection