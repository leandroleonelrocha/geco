<?php
	Route::get('directores',[
		'as' 	=> 'dueño.directores',
		'uses' 	=> 'DirectoresController@lista'
	 ]);

	Route::get('directores_nuevo', [
		'as' 	=> 'dueño.directores_nuevo',
		'uses' 	=> 'DirectoresController@nuevo'
	]);

	Route::post('directores_nuevo_post', [
		'as' 	=> 'dueño.directores_nuevo_post',
		'uses' 	=> 'DirectoresController@nuevo_post'
	]);

	Route::get('directores_borrar/{id}',[
		'as'	=> 'dueño.directores_borrar',
		'uses'	=>	'DirectoresController@borrar'
	]);

	Route::get('directores_editar/{id}',[
		'as'	=> 'dueño.directores_editar',
		'uses'	=>	'DirectoresController@editar'
	]);

	Route::post('directores_editar_post',[
		'as'	=> 'dueño.directores_editar_post',
		'uses'	=>	'DirectoresController@editar_post'
	]);