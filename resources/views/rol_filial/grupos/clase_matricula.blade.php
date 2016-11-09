@extends('template')


@section('content')
								
	<div class="row">
		<div class="col-xs-12">

        @if(isset($model))
          {!! Form::model($model,['route'=>['grupos.cargar_clase',$model->id]]) !!}
        @else
          {!! Form::open(['route'=>'grupos.cargar_clase']) !!}
        @endif        

        <div class="box">

                <div class="box-header">
                 
                </div><!-- /.box-header -->
                <div class="box-body no-padding">
                  <div class="col-sm-4 invoice-col">
                 
                  <br>
                  <b>Grupo:</b>{{ $clase->Grupo->descripcion }}<br>
                  <b>Docente:{{ $clase->Docente->fullname}}</b><br>
                 
                </div>


                  <table class="table table-striped">
                    <tbody>
                    <tr>
                      <th>#</th>
                      <th>Asistencia</th>
                      <th>Apellido y nombre</th>
                     
                    </tr>
                    
                      @foreach($grupo_matricula as $gm)
                          <tr>

                             <td ><input type="hidden" name="clase_id" value="{{$clase->id}}"></td>
                             @if( !empty($search->buscarClasePorMatricula($gm->matricula_id, $clase->id)))
                              <td>Si
                                <input type='radio' class='flat-red' name='asistio[][{{$gm->matricula_id}}]' value="1"  {{ $search->buscarClasePorMatricula($gm->matricula_id, $clase->id) == 'true' ? 'checked' : ''  }}    >NO
                                <input type='radio' class='flat-red' name='asistio[][{{$gm->matricula_id}}]' value="0"  {{ $search->buscarClasePorMatricula($gm->matricula_id, $clase->id) == 'false' ? 'checked' : ''  }}  >
                              </td>
                             @else
                              <td> 
                                <input  class='flat-red'  type="radio"  name='asistio[][{{$gm->matricula_id}}]' value="1">SI
                                <input  class='flat-red'  type="radio"  name='asistio[][{{$gm->matricula_id}}]' value="0">NO
                              </td>
                             @endif
                               <td>{{$gm->Matricula->Persona->fullname}}</td>    
                          </tr>
                      @endforeach 
                    
                  </tbody>
                  </table>
                 
                </div><!-- /.box-body -->

        </div>
        <button type="submit" class="btn btn-primary pull-right">Guardar</button>
        {!! Form::close() !!}

</div><!-- /.mail-box-messages -->
</div><!-- /.box-body -->
               
  
@endsection

