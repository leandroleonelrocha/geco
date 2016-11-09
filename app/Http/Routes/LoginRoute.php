<?php 

Route::get('login', [

	'as' => 'auth.login',
	'uses' => 'LoginController@getLogin'

]);


Route::post('postLogin', [

	'as' => 'auth.postLogin',
	'uses' => 'LoginController@postLogin'

]);

Route::get('getLogout',[
	'as' => 'auth.getLogout',
	'uses' => 'LoginController@getLogout'
 ]);