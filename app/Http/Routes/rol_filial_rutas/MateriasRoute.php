<?php
	Route::get('materias',[
		'as' 	=> 'filial.materias',
		'uses' 	=> 'MateriaController@lista'
	 ]);

	Route::get('materias_nuevo', [
		'as' 	=> 'filial.materias_nuevo',
		'uses' 	=> 'MateriaController@nuevo'
	]);

	Route::post('materias_nuevo_post', [
		'as' 	=> 'filial.materias_nuevo_post',
		'uses' 	=> 'MateriaController@nuevo_post'
	]);

	Route::get('materias_editar/{id}',[
		'as'	=> 'filial.materias_editar',
		'uses'	=>	'MateriaController@editar'
	]);

	Route::post('materias_editar_post',[
		'as'	=> 'filial.materias_editar_post',
		'uses'	=>	'MateriaController@editar_post'
	]);

	Route::get('materias_borrar/{id}',[
		'as'	=> 'filial.materias_borrar',
		'uses'	=>	'MateriaController@borrar'
	]);