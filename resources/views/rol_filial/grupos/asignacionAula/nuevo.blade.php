@extends('template')

@section('content')
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">Asignacion Aula</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            {!! Form::open(['route'=> 'filial.asignacionAulas_nuevo_post', 'method'=>'post']) !!}
                            <div class="col-md-6 form-group">
                                <label>Aula</label>
                                <button class="add_input_telefono btn btn-success">+</button>   
                                <div class="input_fields_telefono">
                                    <input type="text" name="nombre[]" class="form-control">
                                </div>
                            </div>

                            <div class="box-footer col-xs-12">
                                <button type="submit" class="btn btn-success">Crear </button>
                            </div>

                            {!! Form::close() !!}
                        </div>
                    </div>
                </div><!-- Fin box-body -->
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection