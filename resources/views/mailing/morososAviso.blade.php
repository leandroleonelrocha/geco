<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GeCo -- Pre-Moroso</title>
</head>
<body>
	<div class="mailContainer">
		<div class="box title"> GE<span class="verde">CO</span> </div>
		<div class="box">
			<p>Se le comunica a {!!$nombre!!} {!!$apellido!!} que el pago nro {!!$nro_pago!!} <?php if ($nro_pago == 0) echo '(Matrícula)' ?>, perteneciente a la matr&iacute;cula {!!$matricula!!} vencerá el {!!$vencimiento!!}, si no abona antes de esta fecha pasar&aacute; a la lista de morosos.</p>
			<p>Le recomendamos que pase a abonar lo antes posible para evitar inconvenientes.</p>
		</div>
		<div class="box">
			<p>Gracias por su atenci&oacute;n.</p>
		</div>
	</div>
</body>
</html>