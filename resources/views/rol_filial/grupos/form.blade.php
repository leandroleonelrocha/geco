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
                    <h3 class="box-title">@lang('docente.nuevodocente')</h3>
                </div>
                <div class="box-body">
                    <div class="row">
                        <div class="col-xs-12">
                            <div class="form-group">
                                <label>@lang('grupo.carrerasycursos')</label>
                                <select name="carreras_cursos" id="carreras_cursos" class="form-control">
                                <option>@lang('grupo.seleccioncyc')</option>
                                <optgroup label=@lang('grupo.carreras')>
                                @foreach($carreras as $carrera)
                                <option value="carrera;{{$carrera->id}}" <?php if(!empty($model)){
                                if(isset($model->Carrera->id)){if($model->Carrera->id == $carrera->id) echo 'selected';}
                                }?>>
                                    {{$carrera->nombre}}
                                </option>
                                @endforeach
                                </optgroup>
                                <optgroup label=@lang('grupo.cursos')>
                                @foreach($cursos as $curso)
                                <option value="curso;{{$curso->id}}" <?php if(!empty($model)){
                                if(isset($model->Curso->id)){if($model->Curso->id == $curso->id) echo 'selected';}
                                }?>>
                                    {{$curso->nombre}}
                                </option>
                                @endforeach
                                </optgroup>
                                </select>
                            </div>
                            <div class="form-group">
                                <label>@lang('grupo.descripcion')</label>
                                {!! Form::text('descripcion', null ,  array('class'=>'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('grupo.docente')</label>
                                @if(empty($model))
                                {!! Form::select('docente_id',( $docentes->toArray()), null, ['id' => 'docente_id', 'class' => 'form-control select2']) !!}
                                @else
                                {!! Form::select('docente_id',['' => 'Seleccionar docente'] + $docentes->toArray() ,$model->Docente->id, ['id' => 'docente_id', 'class' => 'form-control select2']) !!}
                                @endif
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
                                <label>@lang('grupo.rangofecha')</label>
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
                            <div class="form-group">
                                <label for="example-color-input">@lang('grupo.color')</label>
                                @if(empty($model))
                                <input class="form-control" name="color" type="color" value="#563d7c" id="example-color-input">
                                @else
                                {!! Form::color('color', null ,  array('class'=>'form-control', 'id'=>'example-color-input')) !!}
                                @endif
                            </div>
                            <button class="add_field_button btn btn-primary">@lang('grupo.agregarotrodia')</button><br>
                            @if(empty($model))
                            <div class="row input_fields_wrap">
                                <div class="form-group horario">
                                    <div class="col-xs-12 materia" style="display: none;">
                                       <label> @lang('grupo.materia') </label>
                                       <select name="materia_id" class="form-control select_materia">
                                       </select>
                                    </div>
                                    <div class="col-xs-3">
                                       <label> @lang('grupo.aula') </label>
                                       {!! Form::select('aula',$aulas->toArray(),null,array('class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-xs-3">
                                        <label> @lang('grupo.dia') </label>
                                        <select name="dia[]" class="form-control">
                                            <option value="1"> @lang('grupo.lunes')</option>
                                            <option value="2"> @lang('grupo.martes')</option>
                                            <option value="3"> @lang('grupo.miercoles')</option>
                                            <option value="4"> @lang('grupo.jueves')</option>
                                            <option value="5"> @lang('grupo.viernes')</option>
                                            <option value="6"> @lang('grupo.sabados')</option>
                                        </select>
                                    </div>

                                  <div class="col-xs-3">
                                   <label> @lang('grupo.horacomienzo') </label>
                                    <input class="form-control" name="horario_desde[]" type="time" value="08:00:00" >
                                  </div>
                                  <div class="col-xs-3">
                                   <label> @lang('grupo.horafin') </label>
                                    <input class="form-control" name="horario_hasta[]" type="time" value="09:00:00" >
                                  </div>

                                </div>
                            </div>
                            @else
                            <div class="row input_fields_wrap">
                                @foreach($model->GrupoHorario as $horario)
                              
                                <div class="form-group horario">
                                    @if(!empty($horario->materia_id))
                                    <div class="col-xs-12 materia">
                                       <label> @lang('grupo.materia') </label>
                                       {!! Form::select('materia_id',$materias->toArray(), $horario->materias_id ,array('class' => 'form-control select_materia')) !!}
                                    </div>
                                    @endif
                                    <div class="col-xs-3">
                                       <label> @lang('grupo.aula') </label>
                                       {!! Form::select('aula',$aulas->toArray(), $horario->aula_id ,array('class' => 'form-control')) !!}
                                    </div>
                                    <div class="col-xs-3">
                                    <label> Dia </label>
                                    <select name="dia[]" class="form-control">
                                       
                                        <option <?php if ($horario->dia == 'Lunes' )  echo 'selected' ; ?>  value="1" > @lang('grupo.lunes')</option>
                                        <option <?php if ($horario->dia == 'Martes' ) echo 'selected' ; ?>  value="2"> @lang('grupo.martes')</option>
                                        <option  <?php if ($horario->dia == 'Miercoles' ) echo 'selected' ; ?>  value="3"> @lang('grupo.miercoles')</option>
                                        <option  <?php if ($horario->dia == 'Jueves' ) echo 'selected' ; ?>  value="4"> @lang('grupo.jueves')</option>
                                        <option  <?php if ($horario->dia == 'Viernes' ) echo 'selected' ; ?>  value="5"> @lang('grupo.viernes')</option>
                                        <option  <?php if ($horario->dia == 'Sabado' ) echo 'selected' ; ?>  value="6"> @lang('grupo.sabados')</option>
                                     </select>
                                    </div>

                                  <div class="col-xs-3">
                                   <label> @lang('grupo.horacomienzo') </label>
                                    <input class="form-control" name="horario_desde[]" type="time" value="{{$horario->horario_desde}}" >
                                  </div>

                                  <div class="col-xs-3">
                                   <label> @lang('grupo.horafin') </label>
                                    <input class="form-control" name="horario_hasta[]" type="time" value="{{$horario->horario_hasta}}" >
                                  </div>

                                </div>
                                @endforeach
                            </div>
                            @endif
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
@section('js')
<script type="text/javascript">
   
   $(document).ready(function() {
        function obtenerMaterias(){
            var carreras_cursos=$('select[id=carreras_cursos]').val(); 
                var tipo = carreras_cursos.split(';');
                if(tipo[0] == "carrera"){   
                    $(".materia").show();
                    $.ajax(
                        {
                        url: "post_materias_carreras",
                        type: "POST",
                        data: 'carrera_id='+tipo[1],
                        headers: {
                        'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                        },
                        success: function(result){
                               if(result.length == 0){
                                    $(".materia").show();
                                    $(".materia").empty();
                               }
                               if(result.length > 0){
                                   $(".materia").show();
                                   $(".select_materia").empty();
                                   $.each(result, function(clave, valor) {
                                        $('.select_materia').append( '<option value="'+valor.id+'">'+valor.nombre+'</option>' );
                                   });
                               }
                            
                        }}

                    );
                }

                if(tipo[0] == "curso"){
                    $(".select_materia").empty(); 
                    $(".materia").hide();
                }
        }

        obtenerMaterias();
        $("#carreras_cursos").change(function(){ obtenerMaterias(); });

        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                console.log(x);
                var m = $('.select_materia:last').val();
                $(wrapper).append($('.horario:last').clone()); //add input box
                $('.select_materia:last option').each(function(){
                    if ( $(this).val() == m )
                        $(this).attr("selected","selected");
                });
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            
            var row = $(this).data('id');
            e.preventDefault(); $(this).parent('div').remove(); x--;

        });

        // function add_input(){
        //     return $('.horario').clone();
        // }


        // function add_input(){
        //  var data = '<div class="form-group">'+
        //             '<div class="col-xs-6">'+
        //             '<select name="dia[]" class="form-control">'+
        //                 '<option value="1"> @lang('grupo.lunes')</option>'+
        //                 '<option value="2"> @lang('grupo.martes')</option>'+
        //                 '<option value="3"> @lang('grupo.miercoles')</option>'+
        //                 '<option value="4"> @lang('grupo.jueves')</option>'+
        //                 '<option value="5"> @lang('grupo.viernes')</option>'+
        //                 '<option value="6"> @lang('grupo.sabado')</option> ' +
        //              '</select>'+
        //             '</div>'+
        //                 '<div class="col-xs-3">'+
        //                 '<input class="form-control" name="horario_desde[]" type="time" value="13:45:00" >'+
        //               '</div>'+
        //               '<div class="col-xs-3">'+
        //                 '<input class="form-control" name="horario_hasta[]" type="time" value="13:45:00" >'+
        //               '</div>'+
        //             '</div>';
        //   return data;      
        // }
});


$(".star_intro" ).click(function() {


    var texto ='¡Bienvenido al Tutorial de Grupos!';  
    <?php
        $array = [
            "#carreras_cursos"        =>  "Seleccione un nuevo curso o carrera del nuevo grupo",
            "#example-color-input"    =>  "El color que se seleccione es el que se verá en el calendario del nuevo grupo",
            ".add_field_button"       =>  "Boton para agregar nuevos dias al grupo",
        ];
    
    ?>

    startIntro(texto);

});     

</script>
@include('partials.inicio_tutorial')

@endsection