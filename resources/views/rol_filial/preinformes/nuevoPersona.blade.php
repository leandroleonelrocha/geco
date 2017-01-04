@extends('template')
@section('css')
<link rel="stylesheet" href="{{asset('css/steps/form-wizard.css')}}">
@endsection
@section('content')
	<div class="row">
		<div class="col-xs-12">
			<div class="wizard">
				<div class="wizard-inner">
	                <div class="connecting-line"></div>
	                <ul class="nav nav-tabs" role="tablist">

	                    <li role="presentation" class="active">
	                        <a href="#step1" data-toggle="tab" aria-controls="step1" role="tab" title="Step 1">
	                            <span class="round-tab">
	                                <i class="glyphicon glyphicon-folder-open"></i>
	                            </span>
	                        </a>
	                    </li>

	                    <li role="presentation" class="disabled">
	                        <a href="#step2" data-toggle="tab" aria-controls="step2" role="tab" title="Step 2">
	                            <span class="round-tab">
	                                <i class="glyphicon glyphicon-pencil"></i>
	                            </span>
	                        </a>
	                    </li>
	                 
	                    <li role="presentation" class="disabled">
	                        <a href="#step3" data-toggle="tab" aria-controls="complete" role="tab" title="Complete">
	                            <span class="round-tab">
	                                <i class="glyphicon glyphicon-ok"></i>
	                            </span>
	                        </a>
	                    </li>
	                </ul>
	            </div>
			</div>
		</div>
	</div>
	

	<div class="row">
		<div class="col-xs-12">
			<div class="box">
				<div class="box-header">
					<h3>@lang('preinforme.nuevopreinforme')</h3>
				</div>
				<div class="box-body">

							{!! Form::open(['route'=> 'filial.preinformes_nuevaPersona_post', 'method'=>'post']) !!}
								 <div class="tab-content">
				                    <div class="tab-pane active" role="tabpanel" id="step1">
				                    	<!-- ---------- Datos Personales ---------- -->
				                    			<div class="col-xs-12">
				                                <label>@lang('persona.asesor')</label>
				                                    {!! Form::select('asesor',$asesores->toArray(),null,array('class' => 'form-control select2')) !!}

				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.apellido')</label>
				                                    {!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.nombre')</label>
				                                    {!! Form::text('nombres',null,array('class'=>'form-control')) !!}
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.tipodocumento')</label>
				                                    {!! Form::select('tipo_documento',$tipos->toArray(),null,array('class' => 'form-control')) !!}
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.numerodocumento')</label>
				                                    {!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <div class="col-xs-12"><label>@lang('persona.genero')</label></div>
				                                    <div class="col-xs-3">
				                                        {!! Form::radio('genero', 'M', null, array('class'=>'flat-red')) !!} @lang('persona.masculino')
				                                    </div>
				                                    <div class="col-xs-3">
				                                        {!! Form::radio('genero', 'F',  null, array('class'=>'flat-red')) !!} @lang('persona.femenino')
				                                    </div>
				                                </div>
				                                <div class="col-md-6 form-group">
				                                	<label>@lang('persona.estadocivil')</label>
				                                    {!! Form::text('estado_civil',null,array('class'=>'form-control')) !!}
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.domicilio')</label>
				                                    {!! Form::text('domicilio',null,array('class'=>'form-control')) !!}
				                                </div>



				                                <div class="col-md-3 form-group">
				                                    <label>@lang('persona.localidad')</label>
				                                    {!! Form::text('localidad',null,array('class'=>'form-control')) !!}
				                                </div>

				                                <div class="col-md-3 form-group">
				                                    <label>@lang('filial.pais')</label>
				                                    {!! Form::select('pais_id', $paises->toArray() , null, array('class'=>'form-control select2')) !!}
				                                </div>
				                               
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.fnacimiento')</label>
				                                    {!! Form::date('fecha_nacimiento',null,array('class'=>'form-control')) !!}
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.nivelestudios')</label>
				                                    {!! Form::text('nivel_estudios',null,array('class'=>'form-control')) !!}
				                                </div>
				                                
				                                
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.telefonos')</label>
				                                    <button class="add_input_telefono btn btn-success">+</button>   
				                                    <div class="input_fields_telefono">
				                                        <input type="text" name="telefono[]" class="form-control">
				                                    </div>
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>E-Mails</label>
				                                    <button class="add_input_mail btn btn-success">+</button>  
				                                    <div class="input_fields_wrap">
				                                        <input type="text" name="mail[]" class="form-control">
				                                    </div>  
				                                </div>
				                                
				                                <div class="col-xs-12">
				                                <button class="btn btn-primary next-step  pull-right" type="button" >@lang('persona.siguiente')</button>
				                                </div>
				                    </div>
				                    <div class="tab-pane" role="tabpanel" id="step2">

				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.computacion')</label>
				                                    <div>{!! Form::checkbox('estudio_computacion', '1', null, array('class'=>'flat-red')) !!} @lang('persona.si')</div>
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.computadora')</label>
				                                    <div>{!! Form::checkbox('posee_computadora', '1', null, array('class'=>'flat-red')) !!} @lang('persona.si')</div>
				                                </div>
				                                <div class="col-md-6 form-group">

				                                    <label>@lang('persona.disponibilidad')</label>
				                                   
				                                    <div class="form-check">
													     {!! Form::checkbox('disponibilidad_manana', '1', null, array('class'=>'flat-red')) !!} @lang('persona.mañana')
													</div>

													<div class="form-check">
													 {!! Form::checkbox('disponibilidad_tarde', '1', null, array('class'=>'flat-red')) !!} @lang('persona.tarde')
													</div>

													<div class="form-check">
													{!! Form::checkbox('disponibilidad_noche', '1', null, array('class'=>'flat-red')) !!} @lang('persona.noche')
													</div>


				                                   
				                                    <div class="checkbox-check">
				                                    {!! Form::checkbox('disponibilidad_sabados', '1',  null, array('class'=>'flat-red')) !!} @lang('persona.sabados')
				                                    </div>
				                                   
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>@lang('persona.aclaraciones')</label>
				                                    {!! Form::textarea('aclaraciones',null,array('class'=>'form-control','size'=>'30x4')) !!}
				                                </div>

				                                <div class="col-md-6 form-group">
				                                    <label>@lang('preinforme.descripcion')</label>
				                                    {!! Form::textarea('descripcion_preinforme',null,array('class'=>'form-control','size'=>'30x4')) !!}
				                                </div>
				                                <div class="col-md-6 form-group">
				                                    <label>Medio</label>
				                                    {!! Form::textarea('medio',null,array('class'=>'form-control','size'=>'30x4')) !!}
				                                </div>
				                            
				                                 <div class="col-xs-12">
							                        <ul class="list-inline pull-right">
							                            <li><button type="button" class="btn btn-default prev-step">@lang('persona.anterior')</button></li>
							                            <li><button type="button" class="btn btn-primary next-step">@lang('persona.continuar')</button></li>
							                        </ul>
				                        		</div>
				                    </div>
				                    <div class="tab-pane" role="tabpanel" id="step3">
				                                <div class="col-md-12 form-group">
				                                    <label>@lang('preinforme.encontro')</label>
				                                    {!! Form::textarea('como_encontro',null,array('class'=>'form-control','size'=>'30x4')) !!}
				                                </div>
				                             

				                                <div class="col-md-5 form-group">
				                                    <label>@lang('preinforme.carreras')</label>
				                                    {!! Form::select('carrera[]',$carreras->toArray(),null,array('id'=>'carreras', 'class' => 'form-control', 'multiple')) !!}
				                                </div>
				                                <div class="col-md-5 form-group">
				                                    <label>@lang('preinforme.cursos')</label>
				                                    {!! Form::select('curso[]',$cursos->toArray(),null,array('id'=>'cursos', 'class' => 'form-control', 'multiple')) !!}
				                                </div>
				                                <div class="col-md-2 form-group">
				                                    <label>@lang('preinforme.ningunat')</label>
				                                    <div>{!! Form::checkbox('ninguna', '1',null,array('id'=>'ninguna')) !!}</div>
				                                </div>
				                                <div class="col-md-12 form-group">
				                                    <label>@lang('preinforme.otrost')</label>
				                                    {!! Form::textarea('descripcion_interes',null,array('id'=>'otros', 'class' => 'form-control','disabled','size'=>'30x4')) !!}
				                                </div>
				                                
						                        <div class="col-xs-12">
							                        <ul class="list-inline pull-right">
							                            <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
							                            <li><button type="button" class="btn btn-primary next-step">@lang('persona.crear')</button></li>
							                           
							                        </ul>
						                        </div>
				                    </div>
				                  
				                    <div class="clearfix"></div>
				                </div>	
							
							
							{!! Form::close() !!}
						
					</div>
        		</div><!-- Fin box-body -->
			</div> <!-- Fin box -->
		</div> <!-- Fin col -->
	</div> <!-- Fin row -->
@endsection
@section('js')
<script type="text/javascript">
	$(document).ready(function () {
    //Initialize tooltips
    $('.nav-tabs > li a[title]').tooltip();
    
    //Wizard
    $('a[data-toggle="tab"]').on('show.bs.tab', function (e) {

        var $target = $(e.target);
    
        if ($target.parent().hasClass('disabled')) {
            return false;
        }
    });

    $(".next-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        $active.next().removeClass('disabled');
        nextTab($active);

    });
    $(".prev-step").click(function (e) {

        var $active = $('.wizard .nav-tabs li.active');
        prevTab($active);

    });
});

function nextTab(elem) {
    $(elem).next().find('a[data-toggle="tab"]').click();
}
function prevTab(elem) {
    $(elem).prev().find('a[data-toggle="tab"]').click();
}

</script>
@endsection