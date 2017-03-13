<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
	
		#container {
		    width: 600px;
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
    #sidebar p{
      line-height: 0.5;
       font-size: 1em;
    }
		#main {
			  padding-top: -70px;
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
     	
     	table{

     		width: 100%;
     	}
	</style>
</head>

<body>

<div id="container">
    <div id="header">
       
        <h4 >@lang('impresiones/recibo.fecha')  <?php echo date('d/m/Y'); ?></h2>

    </div>

    <div id="sidebar">

    	<div class="right">
    		<?php
    			$matricula = Session::get('matricula');
    		?>
	        <p>{{ $matricula->Persona->fullname }}</p>
	        <p>{{ $matricula->Persona->domicilio }}</p>
	        <p>
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
    	<p>@lang('impresiones/recibo.cantidaddepagos') {{count($model)}}</p>
    	<table class="table no-margin">

                              <thead>
                                <tr>
                                  <th></th>
                                  <th>Pagó</th>
                                  <th>@lang('impresiones/recibo.recargo')</th>
                                  <th>@lang('impresiones/recibo.descuento')</th>
                                  <th>@lang('impresiones/recibos.monto')</th>
                                </tr>
                              </thead>
                              <tbody>

                                 <?php
                                  $model           = Session::get('pagos');
                                 
                                 ?>
                               
                                @if(count($model) > 0)
                                  @foreach($model as $pago)
                                 
                                  <tr>
                                    <td>
                                    @if($pago['nro_pago'] == 0)
                                    <a href="#">@lang('impresiones/recibo.matricula')</a>
                                    
                                    @else
                                    <a href="#">@lang('impresiones/recibo.numerodepago') {{$pago['nro_pago']}}</a>
                                    @endif

                                    </td>
                                    <td align="center">$ {{$pago['cuanto_pago'] }}</td>
                                    <td align="center">$ {{$pago['recargo_adicional']}}</td>
                                    <td align="center">$ {{$pago['descuento_adicional'] }}</td>
                                    <td align="center">$ {{$pago['cuanto_pago'] + $pago['recargo_adicional'] - $pago['descuento_adicional'] }}
                                  </td>
                                    
                                  </tr>
                                
                                  @endforeach
                                  
                                  <tr><td>@lang('impresiones/recibo.total')</td><td></td><td></td>
                                  <td></td>
                                  <td align="center">
                                  <?php
                                      $total=0;
                                      foreach ($model as $pago) {
                                         
                                          $total += $pago['cuanto_pago'] + $pago['recargo_adicional'];
                                          $total -= $pago['descuento_adicional'];
                                      }
                                      echo '$ ' .$total;
                                  ?>
                                  </td>
                                  </tr>


                                @endif
                                                                
                              </tbody>
                            </table><br>
        <p>
    		@lang('impresiones/recibo.son') ${{$letra}} @lang('impresiones/recibo.pesos')
    		------------------------------------------
    		@lang('impresiones/recibo.total') : $
    		{{$total}}.00
    	</p>
    	                    
    </div>
   
</div>
</body>