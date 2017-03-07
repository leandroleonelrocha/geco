@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('materia.nuevamateria')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route'=> 'filial.materias_nuevo_post', 'method'=>'post']) !!}

                            <div class="col-md-6 form-group">
                                <label>@lang('materia.nombre')</label>
                                {!! Form::text('nombre',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-3 form-group">
                                
                                <label>@lang('preinforme.carreras')</label>

                                {!! Form::select('carrera[]',$carreras->toArray(),null, array('id'=>'carreras', 'class' => 'form-control', 'multiple')) !!}
                            </div>
                            <div class="col-md-3 form-group">

                                <label>@lang('preinforme.cursos')</label>
                                {!! Form::select('curso[]',$cursos->toArray(),null,array('id'=>'cursos', 'class' => 'form-control', 'multiple')) !!}
                            </div>
                                                      
                            <div class="col-md-6 form-group teorica_practica">
                                <label>@lang('materia.tipomateria')</label>
                                <div>
                                    <input type='radio' class='flat-red' name='teorica_practica' value="1" >@lang('materia.practica')
                                    <input type='radio' class='flat-red' name='teorica_practica' value="0">@lang('materia.teorica')
                                </div>
                            </div>
                            
                            <div class="col-md-6 form-group">
                                <label>@lang('materia.descripcion')</label>
                                {!! Form::textarea('descripcion',null,array('class'=>'form-control','size'=>'30x3')) !!}
                            </div>

                            <div class="box-footer col-xs-12">
                            <button type="submit" class="btn btn-success">@lang('materia.crear') </button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection
@section('js')
<script type="text/javascript">
   $(document).ready(function(){
        $("#carreras_cursos").change(function(){
            var carreras_cursos = $('#carreras_cursos').val(),
                tipo            = carreras_cursos.split(';');
            if(tipo[0] == "curso") $('.teorica_practica').hide();
            else $('.teorica_practica').show();
        });
   });
</script>
@endsection