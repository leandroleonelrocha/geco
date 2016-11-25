<?php

Route::group(['prefix' => 'filial'], function(){

	// Inicio Rol Filial
	Route::get('inicio',[
		'as' => 'filial.inicio',
		'uses' => 'FilialesController@index'

	 ]);

	// Rutas Operaciones -------- Personas
	require_once('PersonasRoute.php');
	
	// Rutas Operaciones ---------- Preinformes
	require_once('PreinformesRoute.php');

	// Rutas Operaciones ---------- Matrículas
	require_once('MatriculasRoute.php');

	// Rutas Operaciones ---------- Pago
	require_once('PagoRoute.php');

	// Rutas Operaciones ---------- Recibos
	require_once('ReciboRoute.php');

	// Rutas Operaciones ---------- Cursos
	require_once('CursosRoute.php');

	// Rutas Operaciones ---------- Carreras
	require_once('CarrerasRoute.php');

	// Rutas Operaciones ---------- Materias
	require_once('MateriasRoute.php');

	// Rutas Operaciones ---------- Grupos
	require_once('GrupoRoute.php');

	// Rutas Operaciones ---------- Exámenes
	require_once('ExamenesRoute.php');

	// Rutas Operaciones ---------- Asesores

	require_once('AsesoresRoute.php');

	// Rutas Operaciones ---------- Asignación de Asesores
	require_once('AsignacionAsesoresRoute.php');

	// Rutas Operaciones ---------- Estadísticas

	require_once('EstadisticasRoute.php');

	// Rutas Operaciones ---------- Docentes
	require_once('DocentesRoute.php');

	// Rutas Operaciones ---------- Perfiles
	require_once('PerfilRoute.php');

	// Rutas Operaciones ---------- Contacto
	require_once('ContactoRoute.php');

	// require_once('Route.php');

	
	// Rutas Operaciones ---------- Mails
	require_once('MailsRoute.php');

});
