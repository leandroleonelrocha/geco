<?php
	Route::get('directores',[
		'as' 	=> 'dueño.directores',
		'uses' 	=> 'DuenoController@lista'
	 ]);

	Route::get('directores_nuevo', [
		'as' 	=> 'dueño.directores_nuevo',
		'uses' 	=> 'DuenoController@nuevo'
	]);

	Route::post('directores_nuevo_post', [
		'as' 	=> 'dueño.directores_nuevo_post',
		'uses' 	=> 'DuenoController@nuevo_post'
	]);

	Route::get('directores_borrar/{id}',[
		'as'	=>  'dueño.directores_borrar',
		'uses'	=>	'DuenoController@borrar'
	]);

	Route::get('directores_editar/{id}',[
		'as'	=>	'dueño.directores_editar',
		'uses'	=>	'DuenoController@editar'
	]);

	Route::post('directores_editar_post',[
		'as'	=> 'dueño.directores_editar_post',
		'uses'	=>	'DuenoController@editar_post'
	]);