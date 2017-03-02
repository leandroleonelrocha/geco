<?php
	
	Route::get('pagos_matriculas',[
		'as'	=> 'filial.pagos_matriculas',
		'uses'	=>	'PagoController@vista'
	]);
	
	Route::get('pagos/{id}',[
		'as'	=>  'filial.pagos',
		'uses'	=>	'PagoController@lista'
	]);

	Route::group(['middleware' => 'habilitado'], function(){
		Route::get('pagos_nuevo/{id}',[
			'as'	=>  'filial.pagos_nuevo',
			'uses'	=>	'PagoController@nuevo'
		]);

		Route::post('pagos_nuevo_post',[
			'as'	=>  'filial.pagos_nuevo_post',
			'uses'	=>	'PagoController@nuevo_post'
		]);

		Route::get('pagos_plan_nuevo/{id}',[
			'as'	=> 'filial.pagos_plan_nuevo',
			'uses'	=>	'PagoController@nuevo_plan'
		]);

		Route::post('pagos_plan_nuevo_post',[
			'as'	=>  'filial.pagos_plan_nuevo_post',
			'uses'	=>	'PagoController@nuevo_plan_post'
		]);

		Route::get('pagos_borrar/{id}',[
			'as'	=>  'filial.pagos_borrar',
			'uses'	=>	'PagoController@borrar'
		]);

		Route::get('pagos_editar/{id}',[
			'as'	=>  'filial.pagos_editar',
			'uses'	=>	'PagoController@editar'
		]);

		Route::post('pagos_editar_post',[
			'as'	=>  'filial.pagos_editar_post',
			'uses'	=>	'PagoController@editar_post'
		]);

		Route::get('pagos_actualizar/{id}',[
			'as'	=>  'filial.pagos_actualizar',
			'uses'	=>	'PagoController@actualizar'
		]);

		Route::post('pagos_actualizar_post',[
			'as'	=>  'filial.pagos_actualizar_post',
			'uses'	=>	'PagoController@actualizar_post'
		]);

		Route::post('tabla_morisidad',[
			'as'	=>	'filial.tabla_morisidad',
			'uses'	=>	'PagoController@tabla_morisidad'
		]);

		Route::post('tabla_iva',[
			'as'	=>	'filial.tabla_iva',
			'uses'	=>	'PagoController@tabla_iva'
		]);

		Route::get('imprimir_iva',[
			'as'	=>	'filial.imprimir_iva',
			'uses'	=>	'PagoController@imprimir_iva'
		]);

		Route::get('imprimir_morosidad',[
			'as'	=>	'filial.imprimir_morosidad',
			'uses'	=>	'PagoController@imprimir_morosidad'
		]);

		Route::get('libro_iva',[
			'as'	=>	'filial.vista_libro_iva',
			'uses'	=>	'PagoController@vista_libro_iva'
		]);
		Route::get('morosidad',[
			'as'	=>	'filial.vista_morosidad',
			'uses'	=>	'PagoController@vista_morosidad'
		]);


		
	});
