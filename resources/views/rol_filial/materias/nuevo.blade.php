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
                                <label>@lang('materia.numero')</label>
                                {!! Form::text('id',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('materia.carrera')</label>
                                {!! Form::select('carrera_id', $carreras->toArray() , null, array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('materia.nombre')</label>
                                {!! Form::text('nombre',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>@lang('materia.descripcion')</label>
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