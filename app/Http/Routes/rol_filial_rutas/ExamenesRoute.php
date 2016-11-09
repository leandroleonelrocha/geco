<?php
Route::group(['prefix' => 'examenes'], function(){

	Route::get('', [
		'as'	=>	'filial.examenes',
		'uses'	=>	'ExamenController@index'
	]);

	Route::get('nuevo',[
		'as'	=>	'filial.examenes_nuevo',
		'uses'	=>	'ExamenController@nuevo'
	]);

	Route::post('examenes_nuevo_post',[
		'as'	=>	'filial.examenes_nuevo_post',
		'uses'	=>	'ExamenController@nuevo_post'
	]);

	Route::get('examenes_borrar/{id}',[
		'as'	=> 'filial.examenes_borrar',
		'uses'	=>	'ExamenController@borrar'
	]);

	Route::get('editar/{id}',[
		'as'	=> 'filial.examenes_editar',
		'uses'	=>	'ExamenController@editar'
	]);

	Route::post('examenes_editar_post/{id}',[
		'as'	=> 'filial.examenes_editar_post',
		'uses'	=>	'ExamenController@editar_post'
	]);

});
