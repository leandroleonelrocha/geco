<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Listado Morosidad</title>
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

          table, th, td {
              border: 1px solid ;
              border-collapse: collapse;
              text-align: center;
          }
          li {  
            list-style-type: none;
            font-size: small;
          }


      </style>
  </head>
  <body>

  <div class="titulo">
      <span>Fecha desde: {{$datos['fecha_desde']}} - Fecha hasta: {{$datos['fecha_hasta']}}</span>
      <span>Filial</span>
  </div>

<div class="content">
	<table>
  	<thead>
    	<tr>
    	<th >Matrícula</th>
    	<th >Grupo</th>
    	<th >Nombre</th>
    	<th >Cuota</th>
    	<th >Vencimiento</th>
    	<th >Saldo</th>
      <th >Email</th>
      <th >Teléfonos</th>
    	</tr> 
  	</thead>
  	<tbody>
  	@foreach($model as $m)
    	<tr>
    	<td>{{$m['matricula']}}</td>
    	<td>{{$m['grupo']}}</td>
    	<td>{{$m['persona']}}</td>
    	<td>{{$m['nro_pago']}}</td>
    	<td>{{$m['vencimiento']}}</td>
    	<td>{{$m['saldo']}}</td>
    	<td>
         <ul>
         @foreach($m['persona_email'] as $email)
          <li>{{$email->mail}}</li>
        @endforeach
        </ul>
      </td>
      <td>
         <ul>
         @foreach($m['persona_telefono'] as $telefono)
          <li>{{$telefono->telefono}}</li>
        @endforeach
        </ul>
      </td>
      			        
    	</tr>
  	@endforeach
  	</tbody>
	</table>
</div>

</body>
</html>