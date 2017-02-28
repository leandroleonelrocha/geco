<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@lang('impresiones/asistencias.listado')</title>
      <style>

          *{
              font-size: 90%;
              margin:5px;
              padding:2px;
          }

      
          .titulo{
              width: 100%;
              margin-top: 5px;
              margin-bottom: -25px !important;
          }

          .titulo *{
              vertical-align: middle !important;
              display: inline-block;
          }

          .titulo span{
              width: 50%;
              /*border: 1px solid red;*/
          }

          .right{
              display: inline-block;
              vertical-align: bottom !important;
              width: 50%;
          }

          .left{
              width: 50%;
              display: inline-block;
              vertical-align: top !important;
          }

          .content{
              border-top: 1px solid #c1c1c1;
              padding-top: 10px;
              margin-top: -40px !important;
          }

          .content span,.content p{
              display: inline-block;
              vertical-align: top !important;
          }

          .content span{
              width:100%;
          }

          .border{
              /*border-bottom: 1px solid black;*/
              margin-top: -10px !important;
              padding-top: 0 !important;
              margin-bottom: -20px !important;
              padding-bottom: 0 !important;
          }

          .datos_medicos p{
              margin:0 !important;
              padding:0 !important;
          }
            th,td{
              width: auto;
               border: 1px solid ;
              border-collapse: collapse;
              text-align: center;
            }

          table{
              border: 1px solid ;
              border-collapse: collapse;
              text-align: center;
              width: 100%;
          }
         
         

      </style>
  </head>
  <body>

  <div class="titulo">
      <span>@lang('impresiones/asistencias.planillaasistencia')</span>

      <span>@lang('impresiones/asistencias.sucursal') {{$grupo->Filial->fullname}} </span>
  </div>

  <br><br>
  <table >
    <thead>
      <tr>
        <th>@lang('impresiones/asistencias.nya')</th>
        @foreach($grupo->Clases as $clase)
        <th>{{ helpersgetDiaMes($clase->fecha) }}</th>
        @endforeach
         
      </tr>
    </thead>
    <tbody>

    @foreach($matriculas as $m)
      <tr>
      <td>{{$m->Persona->fullname}}</td>
      @foreach($grupo->Clases as $clase)
        <td></td>
      @endforeach
               
      </tr>
    @endforeach
      <tr>
        <td>@lang('impresiones/asistencias.profesorturno') </td>
        @foreach($grupo->Clases as $clase)
        <td></td>
        @endforeach
       
      </tr>
    </tbody>
  </table>

  <br><br>
  <table border=1  >
  
    <tbody>

      <tr>
      <td colspan="1">@lang('impresiones/asistencias.grupo') {{$grupo->fullname}}</td>
      <td colspan="4">@lang('impresiones/asistencias.profesor') {{$grupo->Docente->fullname}}</td>
     
      </tr>

      @foreach($grupo->GrupoHorario as $horario)

      <tr>
      <td>@lang('impresiones/asistencias.dia')<br> {{$horario->dia}}</td>
      <td>@lang('impresiones/asistencias.horariodesde') {{ $horario->horario_desde }}</td>
      <td>@lang('impresiones/asistencias.horariohasta') {{ $horario->horario_hasta }}</td>
      <td>@lang('impresiones/asistencias.materia') {{ $horario->Materia->nombre }}</td>
      <td>@lang('impresiones/asistencias.horarioaula') {{ $horario->Aula->nombre }}</td>

      </tr>
      @endforeach

    </tbody>
  </table>


</body>
</html>