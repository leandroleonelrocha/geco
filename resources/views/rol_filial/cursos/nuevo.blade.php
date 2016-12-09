@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('curso.nuevocurso')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route'=> 'filial.cursos_nuevo_post', 'method'=>'post']) !!}
                            <div class="col-md-6 form-group">
                                <label>@lang('curso.nombre')</label>
                                {!! Form::text('nombre',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('curso.duracion')</label>
                                {!! Form::text('duracion',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('curso.descripcion')</label>
                                {!! Form::textarea('descripcion',null,array('class'=>'form-control','size'=>'30x3')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>@lang('curso.taller') {!! Form::checkbox('taller','1')!!}</label>
                            </div>

                            <div class="box-footer col-xs-12">
                                <button type="submit" class="btn btn-success">@lang('curso.crear') </button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection