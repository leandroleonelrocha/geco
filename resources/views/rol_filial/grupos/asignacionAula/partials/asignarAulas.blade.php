{!! Form::open(['route'=> 'filial.asignacionAulas_nuevo_post', 'method'=>'post']) !!}
    <div class="col-md-6 form-group">
        <label>@lang('grupo.nombreaula')</label>
        <button class="add_input_nombre btn-xs btn-success">+</button>   
        <div class="input_fields_nombre">
            <input type="text" name="nombre[]" class="form-control" placeholder="20, AA30">
        </div>
    </div>

    <div class="box-footer col-xs-12">
        <button type="submit" class="btn btn-success">@lang('grupo.crear')</button>
    </div>
{!! Form::close() !!}

<table id="example1" class="table table-bordered table-striped">
    <thead> 
        <tr>
        <th>Aula</th>
        <th>Grupo (Dias y Horarios)</th>
        <th class="no-print"></th>
        </tr> 
    </thead>
    <tbody>
        @foreach($aulas as $a)
            <tr role="row" class="odd">
                
                <td class="sorting_1">{{$a->nombre}}</td>
                <td>
                    @foreach($a->GrupoHorario as $grupo)
                    <dl class="dl-horizontal">
                    <dt>{{$grupo->Grupo->fullname}}</dt>
                    <dd>{{$grupo->dia}} - {{$grupo->horario_desde}} A {{$grupo->horario_hasta}}</dd>
                    </dl>
                    @endforeach

                </td>
                <td class="text-center">
                <a href="{{route('filial.asignacionAulas_editar',$a->id)}}" title="@lang('lista.editar')"><i class="btn-xs btn-primary glyphicon glyphicon-pencil"></i></a>  </td>                     
            </tr>
        @endforeach
    </tbody>
</table>