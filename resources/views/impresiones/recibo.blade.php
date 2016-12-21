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
   			left: -150px;
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

        <h2 >Fecha:  <?php echo date('d/m/Y'); ?></h2>

    </div>
    <div id="sidebar">

    	<div class="right">
	        <p>{{ $recibo->Pago->Matricula->Persona->fullname }}</p>
	        <p>{{ $recibo->Pago->Matricula->Persona->domicilio }}</p>
	        <p>
	        	Grupo:

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
	        <p>Nro Matricula: {{ $recibo->Pago->Matricula->id }}</p>
	        <p>Teléfono: 
	        	@foreach($recibo->Pago->Matricula->Persona->PersonaTelefono as $telefono)
	        	{{$telefono->telefono }}
	        	@endforeach
	        </p>
	     
        </div>
        
    </div>
    <div id="main">

        <h3>Plan de Pago</h3>
        <p>Matricula completa</p>
        <p>Son {{$recibo->monto_letra}} pesos -------------------------- total ${{$recibo->monto}}.00</p>
        
    </div>
   
</div>
</body>