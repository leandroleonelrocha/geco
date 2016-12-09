<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GeCo -- Grupo Candelado</title>
</head>
<body>
	<div class="mailContainer">
		<div class="box title"> GE<span class="verde">CO</span> </div>
		<div class="box">
			<p>Se le comunica a {!!$nombre!!} {!!$apellido!!} que el grupo correspondiente a <?php if(isset($curso)){?> el curso " {!!$curso!!} " <?php } ?> <?php if(isset($carrera)){?> la materia " {!!$materia!!} " perteneciente a la carrera " {!!$carrera!!} " <?php } ?> quedará cancelado.</p>
			<p>Por favor comun&iacute;quese con su filial para m&aacute;s informaci&oacute;n </p>
		</div>
		<div class="box">
			<p>Gracias por su atenci&oacute;n.</p>
		</div>
	</div>
</body>
</html>