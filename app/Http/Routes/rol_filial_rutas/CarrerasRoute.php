<?php

	Route::get('carreras',[
		'as' 	=> 'filial.carreras',
		'uses' 	=> 'CarreraController@lista'
	]);

	Route::get('carreras_nuevo', [
		'as' 	=> 'filial.carreras_nuevo',
		'uses' 	=> 'CarreraController@nuevo'
	]);

	Route::post('carreras_nuevo_post', [
		'as' 	=> 'filial.carreras_nuevo_post',
		'uses' 	=> 'CarreraController@nuevo_post'
	]);

	Route::get('carreras_editar/{id}',[
		'as'	=> 'filial.carreras_editar',
		'uses'	=>	'CarreraController@editar'
	]);

	Route::post('carreras_editar_post',[
		'as'	=> 'filial.carreras_editar_post',
		'uses'	=>	'CarreraController@editar_post'
	]);

	Route::get('carreras_borrar/{id}',[
		'as'	=> 'filial.carreras_borrar',
		'uses'	=>	'CarreraController@borrar'
	]);