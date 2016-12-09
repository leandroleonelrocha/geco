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
                  <div class="box-header with-border">
                  <i class="fa fa-share-alt"></i>
                  <h3 class="box-title">{{ $clase->Grupo->descripcion }}</h3>
                  
                </div>

                </div><!-- /.box-header -->
                <div class="box-body">

               

                <p class="lead"><i class="glyphicon glyphicon-user"></i> @lang('grupo.docente'): {{ $clase->Docente->fullname}}</p>


                  <table class="table table-striped">
                    <tbody>
                    <tr>
                      <th>#</th>
                      <th>@lang('grupo.asistencia')</th>
                      <th>@lang('grupo.apellidoynombre')</th>
                     
                    </tr>
                    
                      @foreach($grupo_matricula as $gm)
                          <tr>

                             <td ><input type="hidden" name="clase_id" value="{{$clase->id}}"></td>
                             @if( !empty($search->buscarClasePorMatricula($gm->matricula_id, $clase->id)))
                              <td>@lang('grupo.si')
                                <input type='radio' class='flat-red' name='asistio[][{{$gm->matricula_id}}]' value="1"  {{ $search->buscarClasePorMatricula($gm->matricula_id, $clase->id) == 'true' ? 'checked' : ''  }}    >@lang('grupo.no')
                                <input type='radio' class='flat-red' name='asistio[][{{$gm->matricula_id}}]' value="0"  {{ $search->buscarClasePorMatricula($gm->matricula_id, $clase->id) == 'false' ? 'checked' : ''  }}  >
                              </td>
                             @else
                              <td> 
                                <input  class='flat-red'  type="radio"  name='asistio[][{{$gm->matricula_id}}]' value="1">@lang('grupo.si')
                                <input  class='flat-red'  type="radio"  name='asistio[][{{$gm->matricula_id}}]' value="0">@lang('grupo.no')
                              </td>
                             @endif
                               <td>{{$gm->Matricula->Persona->fullname}}</td>    
                          </tr>
                      @endforeach 
                    
                  </tbody>
                  </table>
                 
                </div><!-- /.box-body -->

        </div>
        <button type="submit" class="btn btn-success pull-right">@lang('grupo.guardar')</button>
        {!! Form::close() !!}

</div><!-- /.mail-box-messages -->
</div><!-- /.box-body -->
               
  
@endsection

