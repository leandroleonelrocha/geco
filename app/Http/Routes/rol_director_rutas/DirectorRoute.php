<?php

Route::group(['prefix' => 'director', 'middleware'=>'director'], function(){

	Route::get('inicio',[
		'as' => 'director.inicio',
		'uses' => 'DirectoresController@index'
	 ]);
		require_once('EstadisticasRoute.php');
	

});