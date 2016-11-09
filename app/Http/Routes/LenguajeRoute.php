<?php

Route::group(['prefix' => 'lenguaje'], function(){

	Route::post('cambiar', [

		'as' => 'lenguaje.cambiar',
		'uses' => 'LenguajeController@cambiar'
	]);

});


Route::group(['middleware' => ['web']], function () {
 
    Route::get('/', function () {
        return view('alumnos.index');
    });
 
    Route::get('lang/{lang}', function ($lang) {
        session(['lang' => $lang]);
        return \Redirect::back();
    })->where([
        'lang' => 'en|es'
    ]);
 
});