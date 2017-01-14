<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Listado de asistencias</title>
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

          table, th, td {
              border: 1px solid ;
              border-collapse: collapse;
              text-align: center;
              width: 100%;
               height: 50px;
          }
          li {  
            list-style-type: none;
            font-size: small;
          }


      </style>
  </head>
  <body>

  <div class="titulo">
      <span>Fecha: </span>
      <span>Grupo: {{$grupo->fullname}} </span>
  </div>

<div class="content">
	<table>
  	<thead>
    	<tr>
    	<th>Matrícula</th>
      <th>Apellido y Nombre</th>
      <th>Asistencia</th>
    	</tr> 
  	</thead>
  	<tbody>
  	@foreach($matriculas as $matricula)
    	<tr>
    	<td>{{ $matricula->id }}</td>
      <td>{{ $matricula->Persona->fullname }}</td>
      <td></td>

   
      			        
    	</tr>
  	@endforeach
  	</tbody>
	</table>
</div>

</body>
</html>