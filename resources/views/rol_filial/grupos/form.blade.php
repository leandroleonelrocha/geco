@extends('template')
@section('content')
    @if(isset($model))
        {!! Form::model($model,['route'=>['grupos.postEdit',$model->id]]) !!}
    @else
        {!! Form::open(['route'=>'grupos.postAdd']) !!}
    @endif

    <div class="box-body">
        <div class="form-group">
            <label>Carreras y Cursos</label>
            <select name="carreras_cursos" id="carreras_cursos" class="form-control">
            <option>Seleccione una materia o curso</option>
            <optgroup label="Carreras">
            @foreach($carreras as $carrera)
            <option value="carrera;{{$carrera->id}}" <?php if(!empty($model)){
            if(isset($model->Carrera->id)){if($model->Carrera->id == $carrera->id) echo 'selected';}
            }?>>
                {{$carrera->nombre}}
            </option>
            @endforeach
            </optgroup>
            <optgroup label="Cursos">
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

        <div class="form-group materia" style="display: none">
            <label for="exampleInputEmail1">Materia  </label>
            <select name="materia_id" class="form-control select_materia">
            </select>
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

        <div class="form-group">
            <label for="example-color-input">Color</label>
            @if(empty($model))
            <input class="form-control" name="color" type="color" value="#563d7c" id="example-color-input">
            @else
            {!! Form::color('color', null ,  array('class'=>'form-control', 'id'=>'example-color-input')) !!}
            @endif
        </div>



         <button class="add_field_button">Agregar otro dia</button><br>
            
            <div class="row input_fields_wrap">
                <div class="form-group">
                    <div class="col-xs-6">
                    <label> Dia </label>
                    <select name="dia[]" class="form-control">
                        <option value="1"> Lunes</option>
                        <option value="2"> Martes</option>
                        <option value="3"> Miercoles</option>
                        <option value="4"> Jueves</option>
                        <option value="5"> Viernes</option>
                        <option value="6"> Sabados</option>
                     </select>
                    </div>

                  <div class="col-xs-3">
                   <label> Hora comienzo </label>
                    <input class="form-control" name="horario_desde[]" type="time" value="13:45:00" >
                  </div>

                  <div class="col-xs-3">
                   <label> Hora fin </label>
                    <input class="form-control" name="horario_hasta[]" type="time" value="13:45:00" >
                  </div>


                </div>
            </div>
        
    </div><!-- /.box-body -->

    <div class="box-footer">
        <button type="submit" class="btn btn-primary">Guardar</button>
    </div>
    </div><!-- /.box -->
    {!! Form::close() !!}
@endsection

@section('js')
<script type="text/javascript">
   
   $(document).ready(function() {
       $("#carreras_cursos").change(function(){
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
                
        });

        var max_fields      = 10; //maximum input boxes allowed
        var wrapper         = $(".input_fields_wrap"); //Fields wrapper
        var add_button      = $(".add_field_button"); //Add button ID
        
        var x = 1; //initlal text box count
        $(add_button).click(function(e){ //on add input button click
            e.preventDefault();
            if(x < max_fields){ //max input box allowed
                x++; //text box increment
                console.log(x);
                $(wrapper).append(add_input()); //add input box
            }
        });
        
        $(wrapper).on("click",".remove_field", function(e){ //user click on remove text
            
            var row = $(this).data('id');
            e.preventDefault(); $(this).parent('div').remove(); x--;

        })


        function add_input(){
         var data = '<div class="form-group">'+
                    '<div class="col-xs-6">'+
                    '<select name="dia[]" class="form-control">'+
                        '<option value="1"> Lunes</option>'+
                        '<option value="2"> Martes</option>'+
                        '<option value="3"> Miercoles</option>'+
                        '<option value="4"> Jueves</option>'+
                        '<option value="5"> Viernes</option>'+
                        '<option value="6"> Sabados</option> ' +
                     '</select>'+
                    '</div>'+
                        '<div class="col-xs-3">'+
                        '<input class="form-control" name="horario_desde[]" type="time" value="13:45:00" >'+
                      '</div>'+
                      '<div class="col-xs-3">'+
                        '<input class="form-control" name="horario_hasta[]" type="time" value="13:45:00" >'+
                      '</div>'+
                    '</div>';
          return data;      
        }
});

</script>

@endsection