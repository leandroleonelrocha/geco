<!DOCTYPE html>
<html>
<head>
  <title></title>
  <style type="text/css">
  
    #container {
        width: 700px;
        margin: 0px auto;
        font-family: monospace;
    }

    #header{
      top:20px;
      text-align: right;
      position: relative;
        left: -100px;
    }


    #sidebar {
        padding-top: 100px;
            margin-top: -40px !important;
            font-size: 14px;
    
    }
    #main {
      padding-top: 10px;
            margin-top: -40px !important;
        float: left;
        font-size: 14px;
    }
    #footer {
        clear: both;
    }
    .right{
      line-height:10px; 
          display: inline-block;
          vertical-align: bottom !important;
          width: 50%;
        }

        .left{
          width: 50%;
          display: inline-block;
          vertical-align: top !important;
        }
        table{
          width: 100%;
        }
     
  </style>
</head>

<body>
<div id="container">
    <div id="header">
        <h2 >@lang('impresiones/recibo.fecha')  <?php echo date('d/m/Y'); ?></h2>
    </div>
    <div id="sidebar">
      DATOS PERSONALES:
      <hr>
      <table>
        <tr>
          <td>DOMI: {{$matricula->Persona->domicilio}}</td>
          <td>LOC: {{$matricula->Persona->localidad}}</td>
          <td>{{$matricula->Persona->TipoDocumento->tipo_documeto}}: {{$matricula->Persona->nro_documento}}</td>
          
        </tr>
         
        <tr>
          <td>FECHA NAC: {{$matricula->Persona->fecha_nacimiento}}</td>
          <td>TELEFONOS: @foreach($matricula->Persona->PersonaTelefono as $telefono) {{$telefono->telefono}} @endforeach() </td>
        </tr>
        </table>
    </div>

    <div id="sidebar">
      DATOS DE LA CARRERA:
      <hr>
      <table>
        <tr>
          <td>@if($matricula->carrera_id != null) {{ $matricula->Carrera->nombre}} @else {{$matricula->Curso->nombre}} @endif</td>
         
          <td>@foreach($matricula->Grupo as $grupo) 
                @foreach($grupo->GrupoHorario as $horario)                  
                  {{$horario->dia}} 
                @endforeach
           @endforeach </td>
          
        </tr>
         
       
        </table>
    </div>

      <div id="sidebar">
      PLAN DE PAGO CONVENIDO:
      <hr>
      <table>
        @foreach($matricula->Pago as $pago)
          @if($pago->nro_pago == 0)
          <tr>
            <td> MATRICULA</td>
            <td> {{$pago->monto_original}}.00</td>
            <td>ASESOR: {{$matricula->Asesor->fullname}}</td>
          </tr>
          @else
          <tr>
            <td> CUOTA {{$pago->nro_pago}}</td>
            <td> {{$pago->monto_original }}.00</td>
          </tr>
          @endif

        @endforeach
        </table>
    </div>

     <div id="sidebar">

        <div class="right">
          <p>.................</p>
          <p>Firma del alumno</p>
        </div>

        <div class="left">
          <p>..............................</p>
          <p>Si es menor, firma del padre o tutor</p>
        </div>
        
    </div>

     <p>
      OBSERVACIONES: Descuento de $50 abonando del 1 al 10 de cada mes.
    </p>
    <p>Inicio de clases sujeto a modificaciones. DIRECCION <br>
      Preinforme Nro: 
    </p>
    
</div>
</body>
</html>