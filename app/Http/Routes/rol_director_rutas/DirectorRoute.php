<?php

Route::group(['prefix' => 'director'], function(){

	Route::get('inicio',[
		'as' => 'director.inicio',
		'uses' => 'DirectoresController@index'
	 ]);

});