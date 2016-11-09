<?php

Route::group(['prefix' => 'restaurarCuenta'], function(){


	Route::get('nueva', [

		'as' => 'restaurarCuenta.nueva',
		'uses' => 'RestauracionCuentaController@nueva'
	]);

	Route::post('postNueva', [

		'as' => 'restaurarCuenta.postNueva',
		'uses' => 'RestauracionCuentaController@post_Nueva'
	]);

});