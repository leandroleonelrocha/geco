@extends('template')
@section('content')
 @if(isset($model))
        {!! Form::model($model,['route'=>['grupos.postEdit',$model->id]]) !!}
    @else
        {!! Form::open(['route'=>'grupos.postAdd']) !!}
    @endif
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <!-- <h3 class="box-title">@lang('grupo.nuevogrupo')</h3> -->
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>@lang('grupo.carrerasycursos')</label>
                                <select name="carreras_cursos" id="carreras_cursos" class="form-control">
                                <option value="0">@lang('grupo.seleccioncyc')</option>
                                <optgroup label=@lang('grupo.carreras')>
                                @foreach($carreras as $carrera)
                                <option value="carrera;{{$carrera->id}}" <?php if(isset($model->Carrera->id)){if($model->Carrera->id == $carrera->id) echo 'selected';}?>>
                                    {{$carrera->nombre}}
                                </option>
                                @endforeach
                                </optgroup>
                                <optgroup label=@lang('grupo.cursos')>
                                @foreach($cursos as $curso)
                                <option value="curso;{{$curso->id}}" <?php if(isset($model->Curso->id)){if($model->Curso->id == $curso->id) echo 'selected';}?>>
                                    {{$curso->nombre}}
                                </option>
                                @endforeach
                                </optgroup>
                                </select>
                            </div>
                            <div class="form-group teorica_practica">
                                <label>@lang('materia.tipomateria')</label>
                                <div>
                                    <input type='radio' class='flat-red tp' name='teorica_practica' value="practica" <?php if($model->practica == 1) echo 'checked';?>>@lang('materia.practica')
                                    <input type='radio' class='flat-red tp' name='teorica_practica' value="teorica" <?php if($model->teorica == 1) echo 'checked';?>>@lang('materia.teorica')
                                </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('grupo.descripcion')</label>
                                {!! Form::text('descripcion', $model->descripcion ,  array('class'=>'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('grupo.docente')</label>
                                {!! Form::select('docente_id',['' => 'Seleccionar docente'] + $docentes->toArray() ,$model->Docente->id, ['id' => 'docente_id', 'class' => 'form-control select2']) !!}
                            </div>
                            <div class="form-group">
                                <label>@lang('grupo.disponibilidad')</label>
                                    <div>
                                        {!! Form::checkbox('turno_manana', '1', null, array('class'=>'flat-red')) !!} @lang('grupo.mañana')
                                    </div>
                                    <div>
                                        {!! Form::checkbox('turno_tarde', '1', null, array('class'=>'flat-red')) !!} @lang('grupo.tarde')
                                    </div>
                                    <div>
                                        {!! Form::checkbox('turno_noche', '1', null, array('class'=>'flat-red')) !!} @lang('grupo.noche')
                                    </div>
                                    <div>
                                        {!! Form::checkbox('sabados', '1', null, array('class'=>'flat-red')) !!} @lang('grupo.sabados')
                                    </div>
                            </div>
                            <div class="form-group">
                                <label for="example-color-input">@lang('grupo.color')</label>
                                {!! Form::color('color', null ,  array('class'=>'form-control', 'id'=>'example-color-input')) !!}
                            </div>

                            <div class="form-group materia">
                                <table class="table table-bordered table-stripe">
                                    <thead> 
                                    <tr>
                                        <th class="text-center">Materias</th>
                                        <th class="text-center">@lang('grupo.aula')</th>
                                        <th class="text-center">@lang('grupo.fechainicio')</th>
                                        <th class="text-center">@lang('grupo.horacomienzo')</th>
                                        <th class="text-center">@lang('grupo.horafin')</th>
                                        <th class="text-center">@lang('grupo.cantclases')</th>
                                    </tr> 
                                    </thead>
                                    <tbody class="select_materia">
                                    </tbody>
                                </table>
                            </div>
                            
                        </div>
                    </div>
                </div><!-- Fin box-body -->
                <div class="box-footer">
                    <button type="submit" class="btn btn-success">@lang('grupo.guardar') </button>
                </div>
                {!! Form::close() !!}
            </div> <!-- Fin box -->
        </div> <!-- Fin col -->
    </div> <!-- Fin row -->
@endsection