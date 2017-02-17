<table id="example1" class="table table-bordered table-striped">
    <thead> <tr>
        <th>@lang('grupo.grupo')</th>
        <th>@lang('grupo.dia')</th>
        <th>@lang('grupo.horacomienzo')</th>
        <th>@lang('grupo.horafin')</th>
        <th>@lang('grupo.listaaulasasignadas')</th>
    <th class="no-print"></th>
    </tr> </thead>
    <tbody>
        @foreach($grupos as $g)
            @foreach($g->GrupoHorario as $gh)
                <tr role="row" class="odd">
               
                    <td class="sorting_1">{{$gh->Grupo->descripcion}}</td>
                    <td>{{$gh->dia}}</td>
                    <td>{{$gh->horario_desde}}</td>
                    <td>{{$gh->horario_hasta}}</td>
                    <td class="text-center">
                    <span class="text-success"><strong>{{$gh->Aula->nombre}}</strong></span></td>                   
                </tr>
            @endforeach
        @endforeach
    </tbody>
</table>