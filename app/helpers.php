

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

function helpersgetDiaMes($value){
    return date("d/m", strtotime($value));        
}


function herlpersObtenerFechas($value){
 	return explode("-", $value);	
}

function first_day_month() {
      $month = date('m');
      $year = date('Y');
      return date('Y-m-d', mktime(0,0,0, $month, 1, $year));
}

  /** Actual month last day **/
function last_day_month() { 
      $month = date('m');
      $year = date('Y');
      $day = date("d", mktime(0,0,0, $month+1, 0, $year));
 
      return date('Y-m-d', mktime(0,0,0, $month, $day, $year));
  };
