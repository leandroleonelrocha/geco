<?php

	Route::get('matriculas',[
		'as'   => 'filial.matriculas',
		'uses' => 'MatriculaController@lista'
	 ]);

	Route::group(['middleware' => 'habilitado'], function(){
		
		Route::get('matriculas_seleccion',[
			'as'   => 'filial.matriculas_seleccion',
			'uses' => 'MatriculaController@seleccion'
		 ]);

		Route::get('matriculas_nuevo/{id}',[
			'as'	=>	'filial.matriculas_nuevo',
			'uses'	=>	'MatriculaController@nuevo'
		]);

		Route::get('matriculas_nuevaPersona',[
			'as'	=>	'filial.matriculas_nuevaPersona',
			'uses'	=>	'MatriculaController@nuevaPersona'
		]);

		Route::post('matriculas_nuevo_post',[
			'as'	=>	'filial.matriculas_nuevo_post',
			'uses'	=>	'MatriculaController@nuevo_post'
		]);

		Route::post('matriculas_nuevaPersona_post',[
			'as'	=>	'filial.matriculas_nuevaPersona_post',
			'uses'	=>	'MatriculaController@nuevaPersona_post'
		]);

		Route::get('matriculas_editar/{id}',[
			'as'	=> 'filial.matriculas_editar',
			'uses'	=>	'MatriculaController@editar'
		]);

		Route::post('matriculas_editar_post',[
			'as'	=> 'filial.matriculas_editar_post',
			'uses'	=>	'MatriculaController@editar_post'
		]);

		Route::get('matriculas_borrar/{id}',[
			'as'	=> 'filial.matriculas_borrar',
			'uses'	=>	'MatriculaController@borrar'
		]);

		Route::get('matriculas_actualizar/{id}',[
			'as'	=> 'filial.matriculas_actualizar',
			'uses'	=>	'MatriculaController@actualizar'
		]);

		Route::post('matriculas_actualizar_post',[
			'as'	=> 'filial.matriculas_actualizar_post',
			'uses'	=>	'MatriculaController@actualizar_post'
		]);

		Route::get('matriculas_vista/{id}',[
			'as'	=> 'filial.matriculas_vista',
			'uses'	=>	'MatriculaController@vista'
		]);

		Route::get('matriculas_pase/{id}',[
			'as'	=> 'filial.matriculas_pase',
			'uses'	=>	'MatriculaController@pase'
		]);

		Route::get('matriculas_pase_nuevo/{filial}/{matricula}',[
			'as'	=> 'filial.matriculas_pase_nuevo',
			'uses'	=>	'MatriculaController@pase_nuevo'
		]);
		
		Route::get('matriculas_imprimir/{id}',[
			'as'	=>  'filial.matriculas_imprimir',
			'uses'	=>	'MatriculaController@matriculas_imprimir'
		]);



	});

		Route::get('matriculas_pases',[
			'as'	=> 'filial.matriculas_pases',
			'uses'	=>	'MatriculaController@pases'
		]);

		Route::get('matriculas_pases_confirmar/{id}',[
			'as'	=> 'filial.matriculas_pases_confirmar',
			'uses'	=>	'MatriculaController@confirmar'
		]);

		Route::get('matriculas_pases_rechazar/{id}',[
			'as'	=> 'filial.matriculas_pases_rechazar',
			'uses'	=>	'MatriculaController@rechazar'
		]);

		Route::post('matriculas_grupos/',[
			'as'	=> 'filial.matriculas_grupos',
			'uses'	=>	'MatriculaController@matriculas_grupos'
		]);

		Route::get('matriculas_imprimir_plan_de_pago/{id}',[
			'as'	=> 'filial.matriculas_imprimir_plan_de_pago',
			'uses'	=>	'MatriculaController@imprimir_plan_de_pago'
		]);

		Route::get('matricula_prueba',[
			
			'as'	=> 'filial.matricula_prueba',
			'uses'	=>	'MatriculaController@matricula_prueba'
		]);