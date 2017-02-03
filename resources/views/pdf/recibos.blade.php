<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
	<title>GeCo -- @lang('impresiones/recibos.recibos')</title>
</head>
<body>
	<div>
		<div> <p><strong>@lang('impresiones/recibos.tipo')</strong> {{ $recibo->ReciboTipo->recibo_tipo }}</p> </div>
		<div> <p><strong>@lang('impresiones/recibos.npago')</strong> {{ $recibo->Pago->nro_pago }}</p> </div>
		<div> <p><strong>@lang('impresiones/recibos.monto')</strong> {{ $recibo->monto }}</p> </div>
		<div> <p><strong>@lang('impresiones/recibos.concepto')</strong> {{ $recibo->ReciboConceptoPago->concepto_pago }}</p> </div>
		<div> <p><strong>@lang('impresiones/recibos.descripcion')</strong> {{ $recibo->ReciboTipo->recibo_tipo }}</p> </div>
	</div>
</body>
</html>