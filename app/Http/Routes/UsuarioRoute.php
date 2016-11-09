<?php

Route::group(['prefix' => 'usuario'], function(){

	Route::get('/',[
		'as' => 'usuario.index',
		'uses' => 'UsuarioController@index'
	 ]);

	Route::get('nuevo', [

		'as' => 'usuario.nuevo',
		'uses' => 'UsuarioController@nuevo'
	]);

	Route::post('postNuevo', [

		'as' => 'usuario.postNuevo',
		'uses' => 'UsuarioController@postNuevo'
	]);

});



