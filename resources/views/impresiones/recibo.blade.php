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
	        <p>{{ $recibo->Pago->Matricula->Persona->fullname }}</p>
	        <p>{{ $recibo->Pago->Matricula->Persona->domicilio }}</p>
	        <p>
	        	@lang('impresiones/recibo.grupo'):

	        	@foreach($recibo->Pago->Matricula->Grupo as $grupo)
	        		@if(isset($grupo->Curso->nombre))
	        			{{$grupo->Curso->nombre}}
	        		@endif
	        		@if(isset($grupo->Carrera->nombre))
	        			{{$grupo->Carrera->nombre}}
	        		@endif
				
	        	@endforeach
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

        <h3>@lang('impresiones/recibo.planpago')</h3>
        <p>@lang('impresiones/recibo.matriculacompleta')</p>
        <p>@lang('impresiones/recibo.son') {{$recibo->monto_letra}} @lang('impresiones/recibo.pesos') -------------------------- @lang('impresiones/recibo.total') ${{$recibo->monto}}.00</p>
        
    </div>
   
</div>
</body>