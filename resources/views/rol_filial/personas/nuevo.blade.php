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
                    <h3 class="box-title">@lang('persona.nueva')</h3>
                </div>	

				<div class="box-body">

		
  				 @if(isset($persona))
  				 {!! Form::model($persona,['route'=>['filial.personas_editar_post',$persona->id]]) !!}
  				 @else
  				 {!! Form::open(['route'=> 'filial.personas_nuevo_post', 'method'=>'post']) !!}
  				 @endif		

  				
                <div class="tab-content">
                    <div class="tab-pane active" role="tabpanel" id="step1">
                    	@include('rol_filial.personas.partials.form1')
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-primary next-step">Siguiente</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step2">
                    	@include('rol_filial.personas.partials.form2')
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                            <li><button type="button" class="btn btn-primary next-step">Continuar</button></li>
                        </ul>
                    </div>
                    <div class="tab-pane" role="tabpanel" id="step3">
                       @include('rol_filial.personas.partials.form3')
                        <ul class="list-inline pull-right">
                            <li><button type="button" class="btn btn-default prev-step">Anterior</button></li>
                          
                        </ul>
                    </div>
                  
                    <div class="clearfix"></div>
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