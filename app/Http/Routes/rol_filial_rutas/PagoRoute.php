<?php
	
	Route::get('pagos_matriculas',[
		'as'	=> 'filial.pagos_matriculas',
		'uses'	=>	'PagoController@vista'
	]);

	Route::get('pagos/{id}',[
		'as'	=> 'filial.pagos',
		'uses'	=>	'PagoController@lista'
	]);

	Route::get('pagos_nuevo/{id}',[
		'as'	=> 'filial.pagos_nuevo',
		'uses'	=>	'PagoController@nuevo'
	]);

	Route::post('pagos_nuevo_post',[
		'as'	=> 'filial.pagos_nuevo_post',
		'uses'	=>	'PagoController@nuevo_post'
	]);

	Route::get('pagos_editar/{id}',[
		'as'	=> 'filial.pagos_editar',
		'uses'	=>	'PagoController@editar'
	]);

	Route::post('pagos_editar_post',[
		'as'	=> 'filial.pagos_editar_post',
		'uses'	=>	'PagoController@editar_post'
	]);

	Route::get('pagos_actualizar/{id}',[
		'as'	=> 'filial.pagos_actualizar',
		'uses'	=>	'PagoController@actualizar'
	]);

	Route::post('pagos_actualizar_post',[
		'as'	=> 'filial.pagos_actualizar_post',
		'uses'	=>	'PagoController@actualizar_post'
	]);