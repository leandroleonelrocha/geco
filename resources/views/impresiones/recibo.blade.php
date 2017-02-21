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
            font-size: 18px;
		
		}
		#main {
			padding-top: 10px;
            margin-top: -40px !important;
		    float: left;
		    font-size: 18px;
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

    	<div class="right">
	        <p>{{ $recibo->Pago->Matricula->Persona->fullname }}</p>
	        <p>{{ $recibo->Pago->Matricula->Persona->domicilio }}</p>
	        <p>
				<?php 
				if ($recibo->Pago->Matricula->carrera_id != null) echo $recibo->Pago->Matricula->Carrera->nombre;
				else echo $recibo->Pago->Matricula->Curso->nombre;
				?>

	        </p>
        </div>

        <div class="left">
	        <p>@lang('impresiones/recibo.nmatricula') {{ $recibo->Pago->Matricula->id }}</p>
	        <p>@lang('impresiones/recibo.telefono') 
	        	@foreach($recibo->Pago->Matricula->Persona->PersonaTelefono as $telefono)
	        	{{$telefono->telefono }}
	        	@endforeach
	        </p>
	     
        </div>
        
    </div>
    <div id="main">
  		<table class="table no-margin">
            <thead>
            <tr>
            <th></th>
            <th>Recargo</th>
            <th>Descuento</th>
            <th>Total</th>
            </tr>
            </thead>
            <tbody>

            	<tr>
            	<td>
            		 @if($recibo->Pago->nro_pago == 0)
						<a href="#">Matricula</a>
 					@else
                    	<a href="#">Numero de pago: {{$recibo->Pago->nro_pago}}</a>
                    @endif
            	</td>
				<td align="center">$ {{$recibo->Pago->recargo_adicional}}</td>
                <td align="center">$ {{$recibo->Pago->descuento_adicional}}</td>
                <td align="center">$ {{$recibo->monto}}</td>
                </tr>  	
            </tbody>
        </table>    

        <p>@lang('impresiones/recibo.son') {{$recibo->monto_letra}} @lang('impresiones/recibo.pesos') -------------------------- @lang('impresiones/recibo.total') ${{$recibo->monto}}.00</p>
        
    </div>
   

</div>
</body>