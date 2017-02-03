<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>@lang('impresiones/libro_iva.libro')</title>
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
          		width: 100%;
             
              border-collapse: collapse;
              text-align: center;
          }
          li {  
            list-style-type: none;
            font-size: small;
          }


		#sidebar {
		    padding-top: 100px;
            margin-top: -40px !important;
            font-size: 18px;
		
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

      </style>
  </head>
  <body>

  <div class="titulo">

      <span>@lang('impresiones/libro_iva.fechadesde') {{$datos['fecha_desde']}} - @lang('impresiones/libro_iva.fechahasta') {{$datos['fecha_hasta']}}</span>
      <span>@lang('impresiones/libro_iva.filial')</span>
  </div>

<div class="content">
	<table>
  	<thead>
    	<tr>
        <th>@lang('impresiones/libro_iva.fecha')</th>
        <th>@lang('impresiones/libro_iva.recibo')</th>
        <th>@lang('impresiones/libro_iva.nombre')</th>
        <th>@lang('impresiones/libro_iva.importe')</th>
      </tr>
  	</thead>
  	<tbody>

  	@foreach($model as $m)
    	<tr>
    	<td>{{$m['fecha']}}</td>
    	<td>{{$m['recibo']}}</td>
    	<td>{{$m['nombre']}}</td>
    	<td>$ {{$m['importe']}}</td>
    	
    	</tr>
  	@endforeach
  	</tbody>
	</table>
</div>

<table>
  	<thead>
    	<tr>
        <th>@lang('impresiones/libro_iva.recibo')</th>
        <th>@lang('impresiones/libro_iva.importe')</th>
      </tr>
  	</thead>
  	<tbody>

   @foreach($suma_recibo as $recibo)
    		<tr>
    		<td>{{$recibo->recibo}}</td>
        	<td>{{$recibo->total}}</td>
        	</tr>
   	@endforeach
  	</tbody>

</table>

<p>@lang('impresiones/libro_iva.totalgeneral') {{$total_general[0]->total}}</p>
<hr>

<table>
    <thead>
      <tr>
        <th></th>
        <th>@lang('impresiones/libro_iva.reciboa')</th>
        <th>@lang('impresiones/libro_iva.recibob')</th>
        <th>@lang('impresiones/libro_iva.reciboc')</th>
        <th>@lang('impresiones/libro_iva.recibox')</th>

       
      </tr>
    </thead>
    <tbody>

   @foreach($suma_grupo as $grupo)
        
        <tr>
          <td>{{$grupo->grupo}}</td>
          
          </tr>
    @endforeach
    </tbody>

</table>



</body>
</html>

