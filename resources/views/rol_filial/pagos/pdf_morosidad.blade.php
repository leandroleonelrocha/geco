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

          table{
              border-collapse: collapse;
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


      </style>
  </head>
  <body>

  <div class="titulo">
      <span>Fecha</span>
      <span>Filial</span>
  </div>

<div class="content">
	<table id="tabla_morosidad" class="table table-bordered table-striped">
	<thead>
	<tr>
	<th class="text-center">Matrícula</th>
	<th class="text-center">Grupo</th>
	<th class="text-center">Nombre</th>
	<th class="text-center">Cuota</th>
	<th class="text-center">Fecha pago</th>
	<th class="text-center">Vencimiento</th>
	<th class="text-center">Saldo</th>
	<th class="text-center">Teléfonos</th>
	<th class="text-center">Correos</th>
	</tr> 
	</thead>
	<tbody>
	@foreach($model as $m)
	<tr>
	<td>{{$m['matricula']}}</td>
	<td>{{$m['grupo']}}</td>
	<td>{{$m['persona']}}</td>
	<td>{{$m['nro_pago']}}</td>
	<td>fecha pago</td>
	<td>{{$m['saldo']}}</td>
	<td>{{$m['vencimiento']}}</td>
	<td>{{$m['vencimiento']}}</td>							        
	</tr>
	@endforeach
	</tbody>
	</table>
</div>

</body>
</html>