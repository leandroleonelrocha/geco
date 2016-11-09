@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('carrera.nuevacarrera')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route'=> 'filial.carreras_nuevo_post', 'method'=>'post']) !!}
                            <div class="col-md-6 form-group">
                                <label>@lang('carrera.numero')</label>
                                {!! Form::text('id',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('carrera.nombre')</label>
                                {!! Form::text('nombre',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>@lang('carrera.duracion')</label>
                                {!! Form::text('duracion',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>@lang('carrera.descripcion')</label>
                                {!! Form::textarea('descripcion',null,array('class'=>'form-control','size'=>'30x3')) !!}
                            </div>

                            <div class="box-footer col-xs-12">
                                {!! Form::submit('Crear',array('class'=>'btn btn-success')) !!}
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection