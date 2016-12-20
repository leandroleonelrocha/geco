<!DOCTYPE html>
<html>
<head>
	<title></title>
	<style type="text/css">
		body {

    	text-align: center;
		}
		#container {
		    width: 700px;
		    margin: 0px auto;
		    text-align: center;
		}
		#header{
			text-align: right;
		}

		#sidebar {
		    width: 200px;
		    padding: 10px;
		    float: left;
		}
		#main {
			width: 200px;
		    padding: 10px;
		    float: left;
		}
		#footer {
		    clear: both;
		}
	</style>
</head>

<body>
<div id="container">
    <div id="header">

        <h2>Fecha:  <?php echo date('d/m/Y'); ?></h2>

    </div>
    <div id="sidebar">

        <p>{{ $recibo->Pago->Matricula->Persona->fullname }}</p>
        <p>{{ $recibo->Pago->Matricula->Persona->domicilio }}</p>
        <p>1242 SOLANO</p>
        <p>Mozo y camarero</p>
        
    </div>
    <div id="main">

        <h3>Plan de Pago</h3>
        <p>Matricula completa</p>
        <p>Son quinientos pesos ----------------------------------- total 500.00</p>
        
    </div>
    <div id="footer">
        <p>Pie de página</p>
    </div>
</div>
</body>