<?php

	Route::get('contacto',[
		'as' 	=> 'filial.contacto',
		'uses' 	=> 'ContactoController@index'
	]);


	Route::post('contacto_nuevo_post',[
		'as' 	=> 'filial.contacto_nuevo_post',
		'uses' 	=> 'ContactoController@nuevo_post'
	]);
	