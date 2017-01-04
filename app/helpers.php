

<?php

function helpersfuncionFecha($fecha){
    return date("Y-m-d", strtotime($fecha)).' 00:00:00.000000';
}

function helperslabelsEstadisticas(){
    return  ['estudio_computacion', 'posee_computadora', 'disponibilidad_manana', 'disponibilidad_tarde', 'disponibilidad_noche', 'disponibilidad_sabados'];
}

function helpersnombresEstadisticas(){
    return ['Posee PC', 'Estudio PC',  'Manana', 'Tarde', 'Noche', 'Sabados'];
}

function helpersgetFecha($value){
    return date("d/m/Y", strtotime($value));        
}

function herlpersObtenerFechas($value){
 	return explode("-", $value);	
}

