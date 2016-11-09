<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>GeCo -- Recibos</title>
</head>
<body>
	<div>
		<div> <p><strong>Tipo:</strong> {{ $recibo->ReciboTipo->recibo_tipo }}</p> </div>
		<div> <p><strong>Nro de Pago:</strong> {{ $recibo->Pago->nro_pago }}</p> </div>
		<div> <p><strong>Monto:</strong> {{ $recibo->monto }}</p> </div>
		<div> <p><strong>Concepto:</strong> {{ $recibo->ReciboConceptoPago->concepto_pago }}</p> </div>
		<div> <p><strong>Descripci&oacute;n:</strong> {{ $recibo->ReciboTipo->recibo_tipo }}</p> </div>
	</div>
</body>
</html>