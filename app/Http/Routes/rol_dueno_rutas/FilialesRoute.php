<?php
	Route::get('filiales',[
		'as' 	=> 'dueño.filiales',
		'uses' 	=> 'FilialesController@lista'
	 ]);

	Route::get('filiales_nuevo', [
		'as' 	=> 'dueño.filiales_nuevo',
		'uses' 	=> 'FilialesController@nuevo'
	]);

	Route::post('filiales_nuevo_post', [
		'as' 	=> 'dueño.filiales_nuevo_post',
		'uses' 	=> 'FilialesController@nuevo_post'
	]);

	Route::get('filiales_borrar/{id}',[
		'as'	=> 'dueño.filiales_borrar',
		'uses'	=>	'FilialesController@borrar'
	]);

	Route::get('filiales_editar/{id}',[
		'as'	=> 'dueño.filiales_editar',
		'uses'	=>	'FilialesController@editar'
	]);
	
	Route::post('filiales_editar_post',[
		'as'	=> 'dueño.filiales_editar_post',
		'uses'	=>	'filialesController@editar_post'
	]);