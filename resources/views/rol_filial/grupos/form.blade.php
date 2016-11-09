@extends('template')


@section('content')
    @if(isset($model))
        {!! Form::model($model,['route'=>['grupos.postEdit',$model->id]]) !!}
    @else
        {!! Form::open(['route'=>'grupos.postAdd']) !!}
    @endif

    <div class="box-body">

        <div class="form-group">
            <label for="exampleInputEmail1">Curso  </label>
            @if(empty($model))
            {!! Form::select('curso_id',(['' => 'Seleccionar curso'] + $cursos->toArray()), null, ['id' => 'curso_id', 'class' => 'form-control']) !!}
            @else
            {!! Form::select('curso_id',['' => 'Seleccionar curso'] + $cursos->toArray() ,$model->Curso->id, ['id' => 'curso_id', 'class' => 'form-control']) !!}
            @endif
        </div>

        <div class="form-group">
            <label for="exampleInputEmail1">Carreras  </label>
            @if(empty($model))
            {!! Form::select('carrera_id',(['' => 'Seleccionar carrera'] + $carreras->toArray()), null, ['id' => 'carrera_id', 'class' => 'form-control']) !!}
            @else
            {!! Form::select('carrera_id',['' => 'Seleccionar carrera'] + $carreras->toArray() ,$model->Carrera->id, ['id' => 'carrera_id', 'class' => 'form-control']) !!}
            @endif
        </div>

         <div class="form-group">
            <label for="exampleInputEmail1">Materias  </label>
            @if(empty($model))
            {!! Form::select('materia_id',(['' => 'Seleccionar materia'] + $materias->toArray()), null, ['id' => 'materia_id', 'class' => 'form-control']) !!}
            @else
            {!! Form::select('materia_id',['' => 'Seleccionar materia'] + $materias->toArray() ,$model->Materia->id, ['id' => 'materia_id', 'class' => 'form-control']) !!}
            @endif
        </div>

        <div class="form-group">
            {!! Form::label('descripcion', 'Descripcion') !!}
            {!! Form::text('descripcion', null ,  array('class'=>'form-control')) !!}
        </div>

           <div class="form-group">
            <label for="exampleInputEmail1">Docente  </label>
            @if(empty($model))
            {!! Form::select('docente_id',(['' => 'Seleccionar docente'] + $docentes->toArray()), null, ['id' => 'docente_id', 'class' => 'form-control']) !!}
            @else
            {!! Form::select('docente_id',['' => 'Seleccionar docente'] + $docentes->toArray() ,$model->Docente->id, ['id' => 'docente_id', 'class' => 'form-control']) !!}
            @endif
        </div>

        <div class="form-group">
                                <label>Disponibilidad</label>
                                <div class="col-xs-12">
                                    {!! Form::checkbox('turno_manana', '1') !!} Ma&ntilde;ana
                                </div>
                                <div class="col-xs-12">
                                    {!! Form::checkbox('turno_tarde', '1') !!} Tarde
                                </div>
                                <div class="col-xs-12">
                                    {!! Form::checkbox('turno_noche', '1') !!} Noche
                                </div>
                                <div class="col-xs-12">
                                    {!! Form::checkbox('sabados', '1') !!} S&aacute;bados
                                </div>
                            </div>


        <div class="form-group">
                    <label>Date range:</label>
                    <div class="input-group">
                      <div class="input-group-addon">
                        <i class="fa fa-calendar"></i>
                      </div>
                       @if(empty($model))
                          {!! Form::text('fecha', null ,  array('class'=>'form-control', 'id'=>'reservation')) !!}
                        @else
                          {!! Form::text('fecha', $model->fulldate ,  array('class'=>'form-control', 'id'=>'reservation')) !!}
                     
                        @endif
                    
                    
                    </div><!-- /.input group -->
        </div>                    

        
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
    </div><!-- /.box -->
    {!! Form::close() !!}
@endsection
