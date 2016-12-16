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