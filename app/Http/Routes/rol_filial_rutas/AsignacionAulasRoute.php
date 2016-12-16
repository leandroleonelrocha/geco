<?php

	Route::get('asignacionAulas',[
		'as' => 'filial.asignacionAulas',
		'uses' => 'AulaController@lista'
	 ]);

	Route::get('asignacionAulas_nuevo', [

		'as' => 'filial.asignacionAulas_nuevo',
		'uses' => 'AulaController@nuevo'
	]);

	Route::get('asignacionAulas_nuevo_post/{id}', [

		'as' => 'filial.asignacionAulas_nuevo_post',
		'uses' => 'AulaController@nuevo_post'
	]);