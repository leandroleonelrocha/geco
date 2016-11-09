<?php

	Route::get('asesores',[
		'as' => 'filial.asesores',
		'uses' => 'AsesorController@lista'
	 ]);

	Route::get('asesores_nuevo', [

		'as' => 'filial.asesores_nuevo',
		'uses' => 'AsesorController@nuevo'
	]);

	Route::post('asesores_nuevo_post', [

		'as' => 'filial.asesores_nuevo_post',
		'uses' => 'AsesorController@nuevo_post'
	]);

	Route::get('asesores_editar/{id}',[
		'as'	=> 'filial.asesores_editar',
		'uses'	=>	'AsesorController@editar'
	]);

	Route::post('asesores_editar_post',[
		'as'	=> 'filial.asesores_editar_post',
		'uses'	=>	'AsesorController@editar_post'
	]);

	Route::get('asesores_borrar/{id}',[
		'as'	=> 'filial.asesores_borrar',
		'uses'	=>	'AsesorController@borrar'
	]);
