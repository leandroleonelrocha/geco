<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GeCo -- Clase Candelada</title>
</head>
<body>
	<div class="mailContainer">
		<div class="box title"> GE<span class="verde">CO</span> </div>
		<div class="box">
			<p>Se le comunica a {!!$nombre!!} {!!$apellido!!} que el d&iacute;a {!!$fecha!!} la clase correspondiente a <?php if(isset($curso)){?> el curso " {!!$curso!!} " <?php } ?> <?php if(isset($carrera)){?> la materia " {!!$materia!!} " perteneciente a la carrera " {!!$carrera!!} " <?php } ?> quedará cancelada, debido a: {!!$descripcion!!}.</p>
		</div>
		<div class="box">
			<p>Gracias por su atenci&oacute;n.</p>
		</div>
	</div>
</body>
</html>