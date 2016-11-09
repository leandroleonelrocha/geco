<?php

	Route::get('personas',[
		'as' 	=> 'filial.personas',
		'uses' 	=> 'PersonaController@lista'
	]);

	Route::get('personas_nuevo', [
		'as' 	=> 'filial.personas_nuevo',
		'uses' 	=> 'PersonaController@nuevo'
	]);

	Route::post('personas_nuevo_post', [
		'as' 	=> 'filial.personas_nuevo_post',
		'uses' 	=> 'PersonaController@nuevo_post'
	]);

	Route::get('personas_editar/{id}',[
		'as'	=> 'filial.personas_editar',
		'uses'	=>	'PersonaController@editar'
	]);

	Route::post('personas_editar_post',[
		'as'	=> 'filial.personas_editar_post',
		'uses'	=>	'PersonaController@editar_post'
	]);

	Route::get('personas_borrar/{id}',[
		'as'	=> 'filial.personas_borrar',
		'uses'	=>	'PersonaController@borrar'
	]);