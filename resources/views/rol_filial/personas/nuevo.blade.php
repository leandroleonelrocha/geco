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
  
				  {!! Form::open(['route'=> 'filial.personas_nuevo_post', 'method'=>'post']) !!}
				    <div class="row setup-content" id="step-1">
				      <div class="col-xs-12">
				        <div class="col-md-12">
				        
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
				          	

							<div class="col-md-6 form-group">
								<label>@lang('persona.domicilio')</label>
								{!! Form::text('domicilio',null,array('class'=>'form-control')) !!}
							</div>
							<div class="col-md-6 form-group">
								<label>@lang('persona.localidad')</label>
								{!! Form::text('localidad',null,array('class'=>'form-control')) !!}
							</div>

							<div class="col-md-6 form-group">
								<div class="col-xs-12"><label>@lang('persona.genero')</label></div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'M',null, array('class'=>'flat-red') ) !!} @lang('persona.masculino')
								</div>
								<div class="col-xs-3">
									{!! Form::radio('genero', 'F',null, array('class'=>'flat-red') ) !!} @lang('persona.femenino')
								</div>
							</div>

							<div class="col-md-6 form-group">
								<label>@lang('persona.fnacimiento')</label>
								{!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
							</div>

				          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
				        </div>
				      </div>
				    </div>
				    <div class="row setup-content" id="step-2">
				      <div class="col-xs-12">
				        <div class="col-md-12">
				          
				          
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
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_manana', '1', null,array('class'=>'flat-red')) !!} @lang('persona.mañana')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_tarde', '1', null,array('class'=>'flat-red')) !!} @lang('persona.tarde')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_noche', '1', null,array('class'=>'flat-red')) !!} @lang('persona.noche')
								</div>
								<div class="col-xs-12">
									{!! Form::checkbox('disponibilidad_sabados', '1', null,array('class'=>'flat-red')) !!} @lang('persona.sabados')
								</div>
							</div>	

				          <button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>

				        </div>
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
									<input type="text" name="telefono[]" class="form-control">
								</div>
							</div>

							<div class="form-group">
								<label>E-Mails</label>
								<button class="add_input_mail btn btn-success">+</button>	
								<div class="input_fields_wrap">
							   		<input type="text" name="mail[]" class="form-control">
								</div>	
							</div>

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
<script type="text/javascript">
	$(document).ready(function () {
  var navListItems = $('div.setup-panel div a'),
          allWells = $('.setup-content'),
          allNextBtn = $('.nextBtn');

  allWells.hide();

  navListItems.click(function (e) {
      e.preventDefault();
      var $target = $($(this).attr('href')),
              $item = $(this);

      if (!$item.hasClass('disabled')) {
          navListItems.removeClass('btn-primary').addClass('btn-default');
          $item.addClass('btn-primary');
          allWells.hide();
          $target.show();
          $target.find('input:eq(0)').focus();
      }
  });

  allNextBtn.click(function(){
      var curStep = $(this).closest(".setup-content"),
          curStepBtn = curStep.attr("id"),
          nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
          curInputs = curStep.find("input[type='text'],input[type='url']"),
          isValid = true;

      $(".form-group").removeClass("has-error");
      for(var i=0; i<curInputs.length; i++){
          if (!curInputs[i].validity.valid){
              isValid = false;
              $(curInputs[i]).closest(".form-group").addClass("has-error");
          }
      }

      if (isValid)
          nextStepWizard.removeAttr('disabled').trigger('click');
  });

  $('div.setup-panel div a.btn-primary').trigger('click');
});
</script>
@endsection