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
     
	</style>
</head>

<body>

<div id="container">
    <div id="header">
        <h2 >@lang('impresiones/recibo.fecha')  <?php echo date('d/m/Y'); ?></h2>

    </div>
    <div id="sidebar">

    	<div class="right">
    		<?php
    			$matricula = Session::get('matricula');
    		?>
	        <p>{{ $matricula->Persona->fullname }}</p>
	        <p>{{ $matricula->Persona->domicilio }}</p>
	        <p>
    		@lang('impresiones/recibo.grupo'):

	        	<?php 
				if ($matricula->carrera_id != null) echo $matricula->Carrera->nombre;
				else echo $matricula->Curso->nombre;
				?>
	        </p>
        </div>

        <div class="left">
	        <p>@lang('impresiones/recibo.nmatricula') {{ $matricula->id }}</p>
	        <p>@lang('impresiones/recibo.telefono') 
	        	@foreach($matricula->Persona->PersonaTelefono as $telefono)
	        	{{$telefono->telefono }}
	        	@endforeach
	        </p>
	     
        </div>
        
    </div>
    <div id="main">
    	<p>Cantidad de pagos: {{count($model)}}</p>
    	@foreach($model as $pago)
    		<p>$ {{$pago['monto_a_pagar'] + $pago['recargo_adicional'] - $pago['descuento_adicional'] }}</p>
    	@endforeach
    	<p>
    		SON ${{$letra}} pesos
    		------------------------------------------
    		TOTAL : $
    		{{$total}}.00
    	</p>
	   	
        
    </div>
   
</div>
</body>