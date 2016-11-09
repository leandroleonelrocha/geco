<?php
	Route::get('docentes', [
		'as'	=>	'filial.docentes',
		'uses'	=>	'DocenteController@lista'
	]);

	Route::get('docentes_nuevo',[
		'as'	=>	'filial.docentes_nuevo',
		'uses'	=>	'DocenteController@nuevo'
	]);

	Route::post('docentes_nuevo_post',[
		'as'	=>	'filial.docentes_nuevo_post',
		'uses'	=>	'DocenteController@nuevo_post'
	]);

	Route::get('docentes_borrar/{id}',[
		'as'	=> 'filial.docentes_borrar',
		'uses'	=>	'DocenteController@borrar'
	]);

	Route::get('docentes_editar/{id}',[
		'as'	=> 'filial.docentes_editar',
		'uses'	=>	'DocenteController@editar'
	]);

	Route::post('docentes_editar_post',[
		'as'	=> 'filial.docentes_editar_post',
		'uses'	=>	'DocenteController@editar_post'
	]);