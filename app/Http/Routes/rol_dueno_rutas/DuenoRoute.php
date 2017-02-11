<?php

Route::group(['prefix' => 'administrador'], function(){

	//Inicio Rol Dueño
	Route::get('inicio', [
		'as' => 'dueño.inicio',
		'uses' => 'DuenoController@index',
		'middleware' => 'dueno'
	 ]);

	// Rutas Operaciones ---------- Filiales
	require_once('FilialesRoute.php');
	require_once('EstadisticasRoute.php');


	// Rutas Operaciones ---------- Directores
	// require_once('DirectoresRoute.php');

	// Rutas Operaciones ---------- Estadísticas
	// require_once(__DIR__ . '/Routes/rol_filial_rutas/Filiales.php');
});
