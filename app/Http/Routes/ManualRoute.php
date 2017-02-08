<?php

Route::group(['prefix' => 'manual'], function(){


	Route::get('index', [

		'as' => 'manual.index',
		'uses' => 'ManualController@index'
	]);

});