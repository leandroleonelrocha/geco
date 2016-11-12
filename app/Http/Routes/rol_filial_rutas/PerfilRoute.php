<?php

	Route::get('filiales_editarPerfil/{id}',[
		'as'	=> 'filial.perfil_editarPerfil',
		'uses'	=>	'FilialesController@editarPerfil'
	]);
	
	Route::post('filiales_editarPerfil_post',[
		'as'	=> 'filial.perfil_editarPerfil_post',
		'uses'	=>	'filialesController@editarPerfil_post'
	]);