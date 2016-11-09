@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Nuevo Director</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route'=> 'dueño.directores_nuevo_post', 'method'=>'post']) !!}
                            <div class="col-md-6 form-group">
                                <label>Tipo de documento</label>
                                {!! Form::select('tipo_documento_id',$tipos->toArray(),null,array('class' => 'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nro de documento</label>
                                {!! Form::text('nro_documento',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Apellido</label>
                                {!! Form::text('apellidos',null,array('class'=>'form-control')) !!}
                            </div>
                            <div class="col-md-6 form-group">
                                <label>Nombres</label>
                                {!! Form::text('nombres',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>Tel&eacute;fono</label>
                                {!! Form::text('telefono',null,array('class'=>'form-control')) !!}
                            </div>

                            <div class="col-md-6 form-group">
                                <label>E-Mail</label>
                                {!! Form::email('mail',null,array('class'=>'form-control')) !!}
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