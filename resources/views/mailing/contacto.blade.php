<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GeCo -- Mensaje de la plataforma</title>
</head>
<body>
	<div class="mailContainer">
		<div class="box title">
			<p>Usted ha recibido una consulta de <strong>{!!$nombre!!}</strong></p>
		</div>

		<div class="box">
			<p><strong>Tipo de consulta: </strong>{!!$tipoConsulta!!}</p>
			<p><strong>E-Mail: </strong>{!!$mail!!}</p>
			<p><strong>Telefono: </strong>{!!$telefono!!}</p>
			<p><strong>Mensaje: </strong>{!!$mensaje!!}</p>
		</div>
	</div>
</body>
</html>