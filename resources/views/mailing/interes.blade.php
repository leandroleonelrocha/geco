<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GeCo -- Moroso</title>
</head>
<body>
	<div class="mailContainer">
		<div class="box title"> GE<span class="verde">CO</span> </div>
		<div class="box">
			<p><?php if ($tipoInteres == 'Carrera') echo 'Nueva Carrera'; else echo 'Nuevo Curso'; ?> disponible.</p>
			<p>{!!$tipoInteres!!}: {!!$interes!!}.</p>
			<p>Duraci&oacute;n: {!!$duracion!!}.</p>
		</div>
	</div>
</body>
</html>