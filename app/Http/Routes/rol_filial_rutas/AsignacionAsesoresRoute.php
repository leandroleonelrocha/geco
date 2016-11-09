<?php

	Route::get('asignacionAsesores',[
		'as' => 'filial.asignacionAsesores',
		'uses' => 'AsignacionAsesorAFilialController@lista'
	 ]);

	Route::get('asignacionAsesores_nuevo', [

		'as' => 'filial.asignacionAsesores_nuevo',
		'uses' => 'AsignacionAsesorAFilialController@nuevo'
	]);

	Route::get('asignacionAsesores_nuevo_post/{id}', [

		'as' => 'filial.asignacionAsesores_nuevo_post',
		'uses' => 'AsignacionAsesorAFilialController@nuevo_post'
	]);

	Route::get('asignacionAsesores_borrar/{id}',[
		'as'	=> 'filial.asignacionAsesores_borrar',
		'uses'	=>	'AsignacionAsesorAFilialController@borrar'
	]);