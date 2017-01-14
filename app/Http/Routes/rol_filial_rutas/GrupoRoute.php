<?php

Route::group(['prefix' => 'grupos'], function(){

	Route::get('',[
		'as' => 'grupos.index',
		'uses' => 'GrupoController@index'
	 ]);

	Route::group(['middleware' => 'habilitado'], function(){

		Route::get('nuevo', [

			'as' => 'grupos.nuevo',
			'uses' => 'GrupoController@nuevo'
		]);

		Route::post('postAdd', [

			'as' => 'grupos.postAdd',
			'uses' => 'GrupoController@postAdd'
		]);

		Route::get('borrar/{id}',[
		'as'	=> 'grupos.grupos_borrar',
		'uses'	=>	'GrupoController@borrar'
		]);

		
		Route::post('postEditar/{id}',[
		'as'	=> 'grupos.postEdit',
		'uses'	=>	'GrupoController@postEdit'
		]);

		Route::get('editar/{id}',[
		'as'	=> 'grupos.edit',
		'uses'	=>	'GrupoController@edit'
		]);

		Route::get('clases',[
			'as' => 'grupos.clases',
			'uses' => 'GrupoController@clases'
		]);

		// Route::get('clase_asistencias/{id}',[
		// 	'as' => 'grupos.clase_asistencias',
		// 	'uses' => 'GrupoController@clase_asistencias'
		// ]);

		// Route::get('clase_asistir/{clase}/{matricula}/{asistio}',[
		// 	'as' => 'grupos.clase_asistir',
		// 	'uses' => 'GrupoController@asistir'
		// ]);

		Route::get('clases/matricula/{id}',[
			'as' => 'grupos.clase_matricula',
			'uses' => 'GrupoController@clase_matricula'
		]);

		Route::post('cargar_clase',[
			'as' => 'grupos.cargar_clase',
			'uses' => 'GrupoController@cargar_clase'
		]);

		Route::post('buscar_clase',[
		   'as' =>'grupos.buscar_clase',
	        'uses' =>'GrupoController@buscar_clase'
	    ]);

		Route::post('nueva_clase', [
			'as' => 'grupos.nueva_clase',
			'uses' => 'GrupoController@nueva_clase'
		]);

		Route::post('editar_clase', [
			'as' => 'grupos.editar_clase',
			'uses' => 'GrupoController@editar_clase'
		]);

		Route::get('clases/borrar_clase/{id}', [
			'as' => 'grupos.borrar_clase',
			'uses' => 'GrupoController@borrar_clase'
		]);

		Route::post('editar_clase_arrastrando',[
			'as' => 'grupos.editar_clase_arrastrando',
			'uses' => 'GrupoController@editar_clase_arrastrando'
		]);	

		Route::post('post_materias_carreras',[
			'as' => 'grupos.post_materias_carreras',
			'uses' => 'GrupoController@post_materias_carreras'
		]);

		Route::get('imprimir_asistencias/{id}',[
			'as'  => 'grupos.imprimir_asistencias',
			'uses'=> 'GrupoController@imprimir_asistencias'
		]);

		Route::get('imprimir_asistencias_dia/{id}',[
			'as'  => 'grupos.imprimir_asistencias_dia',
			'uses'=> 'GrupoController@imprimir_asistencias_dia'
		]);

	});
	
});
