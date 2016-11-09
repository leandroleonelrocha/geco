<?php

	Route::get('matriculas',[
		'as'   => 'filial.matriculas',
		'uses' => 'MatriculaController@lista'
	 ]);

	Route::get('matriculas_seleccion',[
		'as'   => 'filial.matriculas_seleccion',
		'uses' => 'MatriculaController@seleccion'
	 ]);

	Route::get('matriculas_nuevo/{id}',[
		'as'	=>	'filial.matriculas_nuevo',
		'uses'	=>	'MatriculaController@nuevo'
	]);

	Route::get('matriculas_nuevaPersona',[
		'as'	=>	'filial.matriculas_nuevaPersona',
		'uses'	=>	'MatriculaController@nuevaPersona'
	]);

	Route::post('matriculas_nuevo_post',[
		'as'	=>	'filial.matriculas_nuevo_post',
		'uses'	=>	'MatriculaController@nuevo_post'
	]);

	Route::post('matriculas_nuevaPersona_post',[
		'as'	=>	'filial.matriculas_nuevaPersona_post',
		'uses'	=>	'MatriculaController@nuevaPersona_post'
	]);

	Route::get('matriculas_editar/{id}',[
		'as'	=> 'filial.matriculas_editar',
		'uses'	=>	'MatriculaController@editar'
	]);

	Route::post('matriculas_editar_post',[
		'as'	=> 'filial.matriculas_editar_post',
		'uses'	=>	'MatriculaController@editar_post'
	]);

	Route::get('matriculas_borrar/{id}',[
		'as'	=> 'filial.matriculas_borrar',
		'uses'	=>	'MatriculaController@borrar'
	]);

	Route::get('matriculas_actualizar/{id}',[
		'as'	=> 'filial.matriculas_actualizar',
		'uses'	=>	'MatriculaController@actualizar'
	]);

	Route::post('matriculas_actualizar_post',[
		'as'	=> 'filial.matriculas_actualizar_post',
		'uses'	=>	'MatriculaController@actualizar_post'
	]);

	Route::get('matriculas_vista/{id}',[
		'as'	=> 'filial.matriculas_vista',
		'uses'	=>	'MatriculaController@vista'
	]);