<?php

Route::group(['prefix' => 'contrasena'], function(){


	Route::get('nueva', [

		'as' => 'contrasena.nueva',
		'uses' => 'LoginController@nueva'
	]);

	Route::post('postNueva', [

		'as' => 'contrasena.postNueva',
		'uses' => 'LoginController@post_Nueva'
	]);

});