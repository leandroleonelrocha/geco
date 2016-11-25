<?php
	Route::get('docentes', [
		'as'	=>	'filial.docentes',
		'uses'	=>	'DocenteController@lista'
	]);

	Route::group(['middleware' => 'habilitado'], function(){

		Route::get('docentes_nuevo',[
			'as'	=>	'filial.docentes_nuevo',
			'uses'	=>	'DocenteController@nuevo'
		]);

		Route::post('docentes_nuevo_post',[
			'as'	=>	'filial.docentes_nuevo_post',
			'uses'	=>	'DocenteController@nuevo_post'
		]);

		Route::get('docentes_borrar/{id}',[
			'as'	=> 'filial.docentes_borrar',
			'uses'	=>	'DocenteController@borrar'
		]);

		Route::get('docentes_editar/{id}',[
			'as'	=> 'filial.docentes_editar',
			'uses'	=>	'DocenteController@editar'
		]);

		Route::post('docentes_editar_post',[
			'as'	=> 'filial.docentes_editar_post',
			'uses'	=>	'DocenteController@editar_post'
		]);

		Route::get('docentes_calcularHoras/{id}',[
			'as'	=> 'filial.docentes_calcularHoras',
			'uses'	=>	'DocenteController@calcularHoras'
		]);

			Route::post('docentes_calcularHorasBusqueda',[
			'as'	=> 'filial.docentes_calcularHorasBusqueda',
			'uses'	=>	'DocenteController@calcularHorasBusqueda'
		]);

