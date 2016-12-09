@extends('template')

@section('content')

	<div class="row">
		<div class="col-xs-12">
			<h2>@lang('contacto.contacto')</h2>

			<div class="box">
			
                <div class="box-body box-profile">

                  <img class="profile-user-img img-responsive img-circle" height="400" width="400"  src="{{asset('img/whiteoutteam.png')}}" alt="User profile picture">
                  <h3 class="profile-username text-center">The Whiteout Team</h3>
                  <p class="text-muted text-center">@lang('contacto.soporte')</p>

                  <p class="text-muted text-center">
                  <strong><i class="fa fa-book margin-r-5"></i>  Teléfono</strong>
                  
                  	112345679
                  </p>

<<<<<<< HEAD
				<div class="box-body">
					<div class="row">
			  			<div class= "col-md-12">
				    		<div class="thumbnail">
				    						
								<h2>@lang('contacto.soporte')</h2>
								<h3>The Whiteout Team</h3>
								<p>Tel:1132145678</p>
					
				      			<img src="{{asset('img/whiteoutteam.png')}}" height="200" width="200" class="img-circle">
								<?php
=======
                  <hr>
                  <?php
>>>>>>> 2abc0a207e526c52b9fddfdcf96b226ebd4603c9
	    				    	$s= (session('usuario')['rol_id']);

   								if ($s==4 || $s==2) {
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