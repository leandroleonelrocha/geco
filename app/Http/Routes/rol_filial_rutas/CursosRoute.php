<?php

	Route::get('cursos',[
		'as' 	=> 'filial.cursos',
		'uses' 	=> 'CursoController@lista'
	 ]);

	Route::get('cursos_nuevo', [
		'as' 	=> 'filial.cursos_nuevo',
		'uses' 	=> 'CursoController@nuevo'
	]);

	Route::post('cursos_nuevo_post', [
		'as' => 'filial.cursos_nuevo_post',
		'uses' => 'CursoController@nuevo_post'
	]);

	Route::get('cursos_editar/{id}',[
		'as'	=> 'filial.cursos_editar',
		'uses'	=>	'CursoController@editar'
	]);

	Route::post('cursos_editar_post',[
		'as'	=> 'filial.cursos_editar_post',
		'uses'	=>	'CursoController@editar_post'
	]);
	
	Route::get('cursos_borrar/{id}',[
		'as'	=> 'filial.cursos_borrar',
		'uses'	=>	'CursoController@borrar'
	]);