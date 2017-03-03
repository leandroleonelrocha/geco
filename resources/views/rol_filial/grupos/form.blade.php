@extends('template')
@section('content')

        {!! Form::open(['route'=>'grupos.postAdd']) !!}
    <div class="row">
        <div class="col-xs-12">
            <div class="box">
                <div class="box-header">
                    <h3 class="box-title">@lang('grupo.nuevogrupo')</h3>
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
                                <option value="carrera;{{$carrera->id}}">
                                    {{$carrera->nombre}}
                                </option>
                                @endforeach
                                </optgroup>
                                <optgroup label=@lang('grupo.cursos')>
                                @foreach($cursos as $curso)
                                <option value="curso;{{$curso->id}}">
                                    {{$curso->nombre}}
                                </option>
                                @endforeach
                                </optgroup>
                                </select>
                            </div>
                            <div class="form-group teorica_practica">
                                <label>@lang('materia.tipomateria')</label>
                                <div>
                                    <input type='radio' class='flat-red tp practica' name='teorica_practica' value="practica" >@lang('materia.practica')
                                    <input type='radio' class='flat-red tp teorica' name='teorica_practica' value="teorica">@lang('materia.teorica')
                                </div>
                            </div>
                            <div class="form-group">
                                <label>@lang('grupo.nombre_grupo')</label>
                                {!! Form::text('descripcion', null , array('class'=>'form-control')) !!}
                            </div>
                            <div class="form-group">
                                <label for="exampleInputEmail1">@lang('grupo.docente')</label>
                                {!! Form::select('docente_id',( $docentes->toArray()), null, ['id' => 'docente_id', 'class' => 'form-control select2']) !!}
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
                                <input class="form-control" name="color" type="color" value="#563d7c" id="example-color-input">
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
@section('js')
<script type="text/javascript">
   
   $(document).ready(function() {
        $('.teorica_practica').hide();
        // function obtenerMaterias(){
        //     var carreras_cursos=$('select[id=carreras_cursos]').val(); 
        //         var tipo = carreras_cursos.split(';');
        //         if(tipo[0] == "carrera"){   
        //             $(".materia").show();
        //             $(".teorica_practica").show();
        //             var tp = $(".tp").val();
        //             $.ajax(
        //                 {
        //                 url: "post_materias_carreras",
        //                 type: "POST",
        //                 data: 'carrera_id='+tipo[1],
        //                 headers: {
        //                 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        //                 },
        //                 success: function(result){
        //                        if(result.length == 0){
        //                             $(".materia").show();
        //                             $(".materia").empty();
        //                             $(".teorica_practica").hide();
        //                        }
        //                        if(result.length > 0){
        //                            $(".materia").show();
        //                            $(".select_materia").empty();
        //                            $(".teorica_practica").show();
        //                            $.each(result, function(clave, valor) {
        //                                 $('.select_materia').append( '<option value="'+valor.id+'">'+valor.nombre+'</option>' );
        //                            });
        //                        }
                            
        //                 }}
        //             );
        //         }
        //         if(tipo[0] == "curso"){
        //             $(".select_materia").empty(); 
        //             $(".materia").hide();
        //             $(".teorica_practica").hide();
        //         }
        // }

         function showTP(){
            var carreras_cursos=$('#carreras_cursos').val(); 
                var tipo = carreras_cursos.split(';');
                if(tipo[0] == "carrera") $(".teorica_practica").show();
                else $(".teorica_practica").hide();
                if (tipo == 0) $(".materia").hide();
        }

        // Obtención de los datos de las materias sin filtro, sirve para mostrar/ocultar datos
        function obtenerAllMaterias(){
            var carreras_cursos = $('#carreras_cursos').val(),
                tipo            = carreras_cursos.split(';');
                // tipoM           = $(".tp:checked").val();
                if(carreras_cursos != 0){
                    $(".materia").show();

                    if (tipo[0] == "curso") {
                        $(".select_materia").empty();
                        $.ajax(
                            {
                            url: "post_materias_cursos_all",
                            type: "POST",
                            data: {curso_id: tipo[1]},
                            // headers: {
                            // 'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            // },
                            success: function(result){
                                   if(result.length == 0){
                                        $(".materia").show();
                                        $(".select_materia").empty();
                                        $('.select_materia').append( '<tr><td class="text-center"> - </td><td>{!! Form::select('aula_id[]',$aulas->toArray(),null,array("class" => "form-control")) !!}</td><td><div class="form-group"><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="date" name="fecha_inicio[]" class="form-control fecha_inicio"></div></div></td><td><input class="form-control" name="horario_desde[]" type="time" value="08:00:00" ></td><td><input class="form-control" name="horario_hasta[]" type="time" value="09:00:00" ></td><td class="text-center"><input type="text" name="cantidad_clases[]" class="text-center" /></td></tr>' );
                                   }
                                   if(result.length > 0){
                                       var practica = [], 
                                           teorica  = [],
                                           i = 0;

                                       $(".materia").show();
                                       $(".select_materia").empty();
                                       $(".teorica_practica").show();
                                       console.log(result);
                                       $.each(result, function(clave, valor) {
                                            if (valor.practica == 1)
                                                practica[i] = true;

                                            if (valor.teorica == 1)
                                                teorica[i] = true;

                                            i++;
                                       });
                                   }
                            }}
                        ); // Fin - Ajax
                    }// Fin Tipo Curso
                    else if(tipo[0] == "carrera"){
                        $(".teorica_practica").show();
                        $.ajax(
                            {
                            url: "post_materias_carreras_all",
                            type: "POST",
                            data: {carrera_id: tipo[1]},
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(result){
                                   if(result.length == 0){
                                        $(".materia").show();
                                        $(".select_materia").empty();
                                        $('.select_materia').append( '<tr><td class="text-center"> - </td><td>{!! Form::select('aula_id[]',$aulas->toArray(),null,array("class" => "form-control")) !!}</td><td><div class="form-group"><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="date" name="fecha_inicio[]" class="form-control fecha_inicio"></div></div></td><td><input class="form-control" name="horario_desde[]" type="time" value="08:00:00" ></td><td><input class="form-control" name="horario_hasta[]" type="time" value="09:00:00" ></td><td class="text-center"><input type="text" name="cantidad_clases[]" class="text-center" /></td></tr>' );
                                   }
                                   if(result.length > 0){
                                       var practica = [], 
                                           teorica  = [],
                                           i = 0;

                                       $(".materia").show();
                                       $(".select_materia").empty();
                                       $(".teorica_practica").show();
                                       console.log(result);
                                       $.each(result, function(clave, valor) {
                                            if (valor.practica == 1)
                                                practica[i] = true;

                                            if (valor.teorica == 1)
                                                teorica[i] = true;

                                            i++;
                                       });
                                       if (practica.indexOf(true) != -1){
                                            $('.teorica_practica').show();
                                            $('.practica').show();
                                       }
                                       else $('.practica').hide();

                                       if (teorica.indexOf(true) != -1){
                                            $('.teorica_practica').show();
                                            $('.teorica').show();
                                       }
                                       else $('.teorica').hide();
                                   }
                            }}
                        ); // Fin - Ajax
                    } // Fin Tipo Carrera
                }
        }

        // Obtención de las Materias, sirve para llenar la tabla
        function obtenerMaterias(){
            var carreras_cursos = $('#carreras_cursos').val(),
                tipo            = carreras_cursos.split(';'),
                tipoM           = $(".tp:checked").val();
                if(carreras_cursos != 0){
                    $(".materia").show();

                    if (tipo[0] == "curso") {
                        $(".select_materia").empty();
                        $.ajax(
                            {
                            url: "post_materias_cursos",
                            type: "POST",
                            data: {curso_id: tipo[1]},
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(result){
                                   if(result.length > 0){
                                       $(".materia").show();
                                       $(".select_materia").empty();
                                       $(".teorica_practica").show();
                                       console.log(result);
                                       $.each(result, function(clave, valor) {
                                            $('.select_materia').append( '<tr><td><input type="hidden" name="materia_id[]" value="'+valor.id+'">'+valor.nombre+'</td><td>{!! Form::select('aula_id[]',$aulas->toArray(),null,array("class" => "form-control")) !!}</td><td><div class="form-group"><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="date" name="fecha_inicio[]" class="form-control fecha_inicio"></div></div></td><td><input class="form-control" name="horario_desde[]" type="time" value="08:00:00" ></td><td><input class="form-control" name="horario_hasta[]" type="time" value="09:00:00" ></td><td class="text-center"><input type="text" name="cantidad_clases[]" class="text-center" /></td></tr>' );
                                       });
                                   }
                            }}
                        ); // Fin - Ajax
                    }// Fin Tipo Curso
                    else if(tipo[0] == "carrera"){
                        $(".teorica_practica").show();
                        $.ajax(
                            {
                            url: "post_materias_carreras",
                            type: "POST",
                            data: {carrera_id: tipo[1], tp: tipoM},
                            headers: {
                            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                            },
                            success: function(result){
                                   if(result.length > 0){
                                       $(".materia").show();
                                       $(".select_materia").empty();
                                       $(".teorica_practica").show();
                                       console.log(result);
                                       $.each(result, function(clave, valor) {
                                            $('.select_materia').append( '<tr><td><input type="hidden" name="materia_id[]" value="'+valor.id+'">'+valor.nombre+'</td><td>{!! Form::select('aula_id[]',$aulas->toArray(),null,array("class" => "form-control")) !!}</td><td><div class="form-group"><div class="input-group"><div class="input-group-addon"><i class="fa fa-calendar"></i></div><input type="date" name="fecha_inicio[]" class="form-control fecha_inicio"></div></div></td><td><input class="form-control" name="horario_desde[]" type="time" value="08:00:00" ></td><td><input class="form-control" name="horario_hasta[]" type="time" value="09:00:00" ></td><td class="text-center"><input type="text" name="cantidad_clases[]" class="text-center" /></td></tr>' );
                                       });
                                   } // result.length
                            }}// success
                        );
                } // Fin Tipo Carrera
            }
        }
        
        // Suceción de fecha de inicio ~~ Carreras y Cursos

        showTP();
        // obtenerMaterias();
        $("#carreras_cursos").change(function(){
            obtenerAllMaterias();
            // showTP();
        });
        
        $(".practica").next().on('click', function(){ obtenerMaterias(); });
        $(".teorica").next().on('click', function(){ obtenerMaterias(); });
        // $(".ano").on('click', function(){ obtenerMaterias(); });

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