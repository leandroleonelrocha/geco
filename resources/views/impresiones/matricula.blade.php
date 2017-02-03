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
			text-align: left;
			
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
<div id="container">
    <div id="header">

        <h2 >@lang('impresiones/matricula.certificado')</h2>


    </div>
    <div id="sidebar">

    	<div class="right">
	        <p>Filial: {{$matricula->Filial->nombre}} </p>
	        <p>Nro Documento: {{$matricula->Persona->nro_documento}} </p>
	        	Grupo:
	        	
	        	@foreach($matricula->Grupo as $grupo)
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
        	<p>@lang('impresiones/matricula.nombre') 	{{$matricula->Persona->fullname}} </p>
	        <p>@lang('impresiones/matricula.domicilio') {{$matricula->Persona->domicilio}} </p>
	        
	        </p>
	        <p>@lang('impresiones/matricula.nmatricula') {{ $matricula->id }}</p>
	     
        </div>
        
    </div>
    <div id="main">
	    <table>
		  	<thead>
		    	<tr>
			    	<th>@lang('impresiones/matricula.modulo')</th>
			      	<th>@lang('impresiones/matricula.grupo')</th>
			      	<th>@lang('impresiones/matricula.nota')</th>
			      	<th>@lang('impresiones/matricula.acta')</th>
			      	<th>@lang('impresiones/matricula.fecha')</th>
			      	<th>@lang('impresiones/matricula.docente')</th>
			      	
		    	</tr> 
		  	</thead>
		  	<tbody>
		  		@foreach($matricula->Grupo as $grupo)
		    
		    	<tr>
			    	<td>@if(isset($grupo->Curso->nombre))
	        				{{$grupo->Curso->nombre}}
	        			@endif
	        			@if(isset($grupo->Carrera->nombre))
	        				{{$grupo->Carrera->nombre}}
	        			@endif
	        		</td>
			     	<td>{{$grupo->id}}</td>
			     	<td>
			     		@foreach($matricula->Examen as $examen)
			     			{{$examen->nota}}
			     		@endforeach

			     	</td>
			     	<td>{{5432}}</td>
			     	<td>30/09/2016</td>
			     	<td> {{$examen->Docente->fullname}} </td>
			     	
		    	</tr>
		  		@endforeach
		  	</tbody>
		</table>
    </div>
   
   <div id="sidebar">
   		<p>@lang('impresiones/matricula.notapromedio') 8</p>
   		<div class="right">
   			<p>@lang('impresiones/matricula.cantidadclases')</p>
   			<p>@lang('impresiones/matricula.cantidadclasesasistidas')</p>
   			<p>@lang('impresiones/matricula.promedioclases')</p>
   		
   		</div>


        <div class="left">
        	<p>10</p>
        	<p>7</p>
        	<p>74.000</p>
        </div>
   		
   </div>

</div>
</body>