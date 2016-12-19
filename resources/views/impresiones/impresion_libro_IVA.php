<table align="center">
	<table>
		<tr>
			<td><?php /*Cadena*/ ?></td>
		</tr>
		<tr>
			<td>FILIAL <?php /*Nombre Filial*/ ?></td>
		</tr>
		<tr>
			<td>DESDE <?php /*Fecha de Inicio*/ ?> HASTA <?php /*Fecha de Fin*/ ?></td>
		</tr>
	</table>
	<tr>
		<th>FECHA</th>
		<th>RECIBO</th>
		<th>NOMBRE</th>
		<th>IMPORTE</th>
	</tr>
	<?php
	if(/*Hay registros*/)
	{
		foreach(/*Registro*/)
		{
	?>
	<tr>
		<td><?php echo /*Fecha*/; ?></td>
		<td><?php echo /*Tipo de Recibo - Número de Recibo*/; ?></td>
		<td><?php echo /*Apellidos, Nombres*/; ?></td>
		<td><?php echo /*Importe*/; ?></td>
	</tr>
	<?php
		}
	}
	foreach (/*Tipo de Recibo*/) 
	{
	?>
	<tr>
		<td>TOTAL RECIBOS <?php /*Tipo de Recibo*/ ?></td>
		<td><?php /*SUM Importe WHERE Tipo de Recibo = Tipo de Recibo */ ?>>
	</tr>
	<?php
	}
	?>
	<tr>
		<td>TOTAL GENERAL</td>
		<td><?php /*SUM Importe*/ ?>>
	</tr>
	<?php
	if(/*No hay registros*/)
	{
	?>
	<tr>
		<td>Sin Registros</td>
	</tr>
	<?php
	}
	?>
</table>