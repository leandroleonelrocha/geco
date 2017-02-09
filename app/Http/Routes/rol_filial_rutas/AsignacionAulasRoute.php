<?php

	Route::get('asignacionAulas',[
		'as' => 'filial.asignacionAulas',
		'uses' => 'AulaController@lista'
	 ]);

	Route::get('asignacionAulas_nuevo', [

		'as' => 'filial.asignacionAulas_nuevo',
		'uses' => 'AulaController@nuevo'
	]);

	Route::post('asignacionAulas_nuevo_post', [

		'as' => 'filial.asignacionAulas_nuevo_post',
		'uses' => 'AulaController@nuevo_post'
	]);

	Route::get('asignacionAulas_editar/{id}', [

		'as' => 'filial.asignacionAulas_editar',
		'uses' => 'AulaController@editar'
	]);

	Route::post('asignacionAulas_editar_post', [

		'as' => 'filial.asignacionAulas_editar_post',
		'uses' => 'AulaController@editar_post'
	]);