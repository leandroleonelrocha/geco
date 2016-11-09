<?php

// Route::group(['prefix' => 'dueño'], function(){

	//Inicio Rol Dueño
	Route::get('inicio',[
		'as' => 'dueño.inicio',
		'uses' => 'DuenoController@index'
	 ]);

	// Rutas Operaciones ---------- Filiales
	require_once('FilialesRoute.php');

	// Rutas Operaciones ---------- Directores
	//require_once('DirectoresRoute.php');

	// Rutas Operaciones ---------- Estadísticas
	// require_once(__DIR__ . '/Routes/rol_filial_rutas/Filiales.php');
// });
