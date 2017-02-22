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
      <span>PLANILLA ASISTENCIA MENSUAL</span>

      <span>SUCURSAL: {{$grupo->Filial->fullname}} </span>
  </div>

  <br><br>
  <table >
    <thead>
      <tr>
        <th>Matricula</th>
        <th>Nombre y Apellido</th>
        @foreach($grupo->Clases as $clase)
        <th>{{ helpersgetDiaMes($clase->fecha) }}</th>
        @endforeach
        <th>Asistio</th>
        
      </tr>
    </thead>
    <tbody>

    @foreach($matriculas as $m)
      <tr>
      <td>{{$m->id}}</td>
      <td>{{$m->Persona->fullname}}</td>
      @foreach($grupo->Clases as $clase)
        <td></td>
      @endforeach
      <td></td>
              
      </tr>
    @endforeach
      <tr>
        <td colspan="2" >PROFESOR DE TURNO: </td>
        @foreach($grupo->Clases as $clase)
        <td></td>
        @endforeach
        <td></td>
      </tr>
    </tbody>
  </table>

  <br><br>
  <table border=1  >
  
    <tbody>

      <tr>
      <td colspan="1">GRUPO: {{$grupo->fullname}}</td>
      <td colspan="4">PROFESOR : {{$grupo->Docente->fullname}}</td>
     
      </tr>

      @foreach($grupo->GrupoHorario as $horario)

      <tr>
      <td>DIA:<br> {{$horario->dia}}</td>
      <td>HORARIO DESDE : {{ $horario->horario_desde }}</td>
      <td>HORARIO HASTA : {{ $horario->horario_hasta }}</td>
      <td> MATERIA : {{ $horario->Materia->nombre }}</td>
      <td>HORARIO AULA : {{ $horario->Aula->nombre }}</td>

      </tr>
      @endforeach

    </tbody>
  </table>


</body>
</html>