<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<title>GeCo -- Nuevos Grupos</title>
</head>
<body>
	<div class="mailContainer">
		<div class="box title"> GE<span class="verde">CO</span> </div>
		<div class="box">
			<div>Le comunicamos que hay nuevos grupos disponibles, acontinuación se muestra una lista detallada</div>
			<div>
				<table>
					<thead>
						<th>Curso</th>
						<th>Carrera</th>
						<th>Materia</th>
						<th>Docente</th>
						<th>Disponibilidad</th>
						<th>Fecha de Inicio</th>
						<th>Fecha de Finalizaci&oacute;n</th>
					</thead>
					<tbody>
					<?php $grupos = unserialize($dataGrupos); ?>
						@foreach($grupos as $grupo)
							<tr>
								<td>
									<?php 
										if (isset($grupo->curso_id)) echo $grupo->Curso->nombre;
										else echo'-'; 
									?>
								</td>
								<td>
									<?php 
										if (isset($grupo->carrera_id)) echo $grupo->Carrera->nombre;
										else echo'-'; 
									?>
								</td>
								<td>
									<?php 
										if (isset($grupo->materia_id)) echo $grupo->Materia->nombre;
										else echo'-'; 
									?>
								</td>
								<td>
									<?php 
										if (isset($grupo->docente_id)) echo $grupo->Docente->apellidos.' '.$grupo->Docente->nombres;
										else echo'-'; 
									?>
								</td>
								<td>
									<?php 
										if ($grupo->turno_manana == 1) 	echo 'Mañana ';
										if ($grupo->turno_tarde == 1) 	echo 'Tarde ';
										if ($grupo->turno_noche == 1) 	echo 'Noche ';
										if ($grupo->turno_sabados == 1) echo 'Sábados';
									?>
								</td>
								<td>{{$grupo->fecha_inicio}}</td>
								<td>{{$grupo->fecha_fin}}</td>
							</tr>
						@endforeach
					</tbody>
				</table>
			</div>
		</div>
</body>
</html>