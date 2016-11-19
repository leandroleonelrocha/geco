<?php

	Route::get('directores_editarPerfil/{id}',[
		'as'	=> 'director.perfil_editarPerfil',
		'uses'	=>	'DirectoresController@editarPerfil'
	]);
	
	Route::post('directores_editarPerfil_post',[
		'as'	=> 'director.perfil_editarPerfil_post',
		'uses'	=>	'DirectoresController@editarPerfil_post'
	]);