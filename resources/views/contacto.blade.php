@extends('template')
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<h2>@lang('contacto.contacto')</h2>
			<div class="box">
			
                <div class="box-body box-profile">
                  <img class="profile-user-img img-responsive img-circle" height="600" width="600"  src="{{asset('img/whiteoutteam.png')}}" alt="User profile picture">
                  <h3 class="profile-username text-center">The Whiteout Team</h3>
                  <p class="text-muted text-center">@lang('contacto.soporte')</p>
                  <p class="text-muted text-center">
                  <strong><i class="fa fa-book margin-r-5"></i>  @lang('contacto.telefono')</strong>
                  
                  	112345679
                  </p>
                  <hr>
                  <?php
	    				    	$s= (session('usuario')['rol_id']);
   								if ($s===4 || $s==2) {
       							?>
								<table id="example1" class="table table-bordered table-striped">
								<h4><strong>@lang('contacto.titulof')</strong></h4>
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
						        <?php
				               	
				              	}
					            ?>
                </div><!-- /.box-body -->
           
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection