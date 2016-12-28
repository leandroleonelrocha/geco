@extends('template')
@section('css')
<style type="text/css">
.stepwizard-step p {
    margin-top: 10px;
}
.stepwizard-row {
    display: table-row;
}
.stepwizard {
    display: table;
    width: 50%;
    position: relative;
}
.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}
.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;
}
.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}
.btn-circle {
    width: 30px;
    height: 30px;
    text-align: center;
    padding: 6px 0;
    font-size: 12px;
    line-height: 1.428571429;
    border-radius: 15px;
}
</style>
@endsection
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3 class="box-title">@lang('persona.nuevopersona')</h3>
				</div>
				<div class="box-body">
					<div class="stepwizard col-md-offset-3">
					    <div class="stepwizard-row setup-panel">
					      <div class="stepwizard-step">
					        <a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
					        <p>Paso 1</p>
					      </div>
					      <div class="stepwizard-step">
					        <a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
					        <p>Paso 2</p>
					      </div>
					      <div class="stepwizard-step">
					        <a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
					        <p>Paso 3</p>
					      </div>
					    </div>
  					</div>
  				 @if(isset($model))
  				 {!! Form::model($model,['route'=>['filial.personas_editar_post',$model->id]]) !!}
  				 @else
  				 {!! Form::open(['route'=> 'filial.personas_nuevo_post', 'method'=>'post']) !!}
  				 @endif		
				    <div class="row setup-content" id="step-1">
				      <div class="col-xs-12">
				        
				        
				          <div class="form-group">
								<label>@lang('persona.tipodocumento')</label>
								{!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control', 'required' => 'required')) !!}
							</div>
				          <div class="form-group">
				            <label>@lang('persona.tipodocumento')</label>
							{!! Form::text('nro_documento',null,array('class'=>'form-control', 'required' => 'required', 'placeholder' => 'Escriba el númnero de documento' )) !!}
				          </div>
				          <div class="form-group">
				          	    <label>@lang('persona.apellido')</label>
								{!! Form::text('apellidos',null,array('class'=>'form-control', 'required' => 'required', 'placeholder' => 'Escriba el apellido')) !!}
				          </div>
				          <div class="form-group">
				            <label>@lang('persona.nombre')</label>
							{!! Form::text('nombres',null,array('class'=>'form-control', 'required' => 'required', 'placeholder' => 'Escriba el nombre' )) !!}
				          </div>
				          	
				          	<div class="row">
								<div class="col-md-4 form-group">
									<label>@lang('persona.domicilio')</label>
									{!! Form::text('domicilio',null,array('class'=>'form-control')) !!}
								</div>
								<div class="col-md-4 form-group">
									<label>@lang('persona.localidad')</label>
									{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
								</div>

				                 <div class="col-md-4 form-group">
	                                <label>@lang('filial.pais')</label>
	                                {!! Form::select('pais_id', $paises->toArray() , null, array('class'=>'form-control select2')) !!}
                            	</div>
							</div>
						
							<div class="row">
			                    <div class="col-xs-6">
			                     	<div class="col-xs-12"><label>@lang('persona.genero')</label></div>
									<div class="col-xs-3">
										{!! Form::radio('genero', 'M',null, array('class'=>'flat-red') ) !!} @lang('persona.masculino')
									</div>
									<div class="col-xs-3">
										{!! Form::radio('genero', 'F',null, array('class'=>'flat-red') ) !!} @lang('persona.femenino')
									</div>
			                    </div>
			                    <div class="col-xs-6">
			                     	<label>@lang('persona.fnacimiento')</label>
									{!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
			                    </div>
		                   	</div>
		                    <hr>
                   			<button class="btn btn-primary nextBtn  pull-right" type="button" >Siguiente</button>
                 			
				      </div>
				    </div>
				    <div class="row setup-content" id="step-2">
				      <div class="col-xs-12">
				       
				            <div class="form-group">
								<label>@lang('persona.estadocivil')</label>
								{!! Form::text('estado_civil',null,array('class'=>'form-control')) !!}
							</div>
							<div class="form-group">
								<label>@lang('persona.nivelestudios')</label>
								{!! Form::select('nivel_estudios',['Secundario Completo' => 'Secundario Completo','Terciario' => 'Terciario','Universitario' => 'Universitario'],null,array('class' => 'form-control')) !!}
							</div>
							<div class="form-group">
								<label>@lang('persona.computacion')</label>
								<div>{!! Form::checkbox('estudio_computacion', '1', null, array('class'=>'flat-red')) !!} @lang('persona.si')</div>
							</div>
							<div class="form-group">
								<label>@lang('persona.computadora')</label>
								<div>{!! Form::checkbox('posee_computadora', '1', null, array('class'=>'flat-red')) !!} @lang('persona.si')</div>
							</div>
							<div class="form-group">
								<label>@lang('persona.disponibilidad')</label>
								<div class="form-check">
								  <label>
								   {!! Form::checkbox('disponibilidad_manana', '1', null,array('class'=>'flat-red')) !!} 
								   @lang('persona.mañana')
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								    {!! Form::checkbox('disponibilidad_tarde', '1', null,array('class'=>'flat-red')) !!} 
								  @lang('persona.tarde')
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								  {!! Form::checkbox('disponibilidad_noche', '1', null,array('class'=>'flat-red')) !!} 
								  @lang('persona.noche')
								  </label>
								</div>
								<div class="form-check">
								  <label class="form-check-label">
								  {!! Form::checkbox('disponibilidad_sabados', '1', null,array('class'=>'flat-red')) !!}
								  @lang('persona.sabados')
								  </label>
								</div>
							</div>	
						<hr>
				        <button class="btn btn-primary nextBtn pull-right" type="button" >Siguiente</button>
				       
				      </div>
				    </div>
				    <div class="row setup-content" id="step-3">
				     
				        <div class="col-md-12">
				         
				          <div class="form-group">
								<label>@lang('persona.aclaraciones')</label>
								{!! Form::textarea('aclaraciones',null,array('class'=>'form-control','size'=>'30x4')) !!}
							</div>
							<div class="form-group">
								<label>@lang('persona.telefonos')</label>
								<button class="add_input_telefono btn btn-success">+</button>	
								<div class="input_fields_telefono">
									@if(isset($model))
										@foreach ($telefono as $t)
											<input type="text" name="telefono[]" class="form-control" value="{{$t->telefono}}">
										@endforeach
									@else
										<input type="text" name="telefono[]" class="form-control">
									@endif
								
								</div>
							</div>
							<div class="form-group">
								<label>E-Mails</label>
								<button class="add_input_mail btn btn-success">+</button>	
								<div class="input_fields_wrap">
								@if(isset($model))
										@foreach ($mail as $m)
										<input type="text" name="mail[]" class="form-control" value="{{$m->mail}}">
										@endforeach
									@else
										<input type="text" name="mail[]" class="form-control">
									@endif
							   		
								</div>	
							</div>
						<hr>	
				        <button class="btn btn-success pull-right" type="submit">@lang('persona.crear')</button>
				  
				      </div>
				    </div>
				{!! Form::close() !!}
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection
@section('js')
<script src="{{asset('js/form-wizard.js')}}"></script>
@endsection