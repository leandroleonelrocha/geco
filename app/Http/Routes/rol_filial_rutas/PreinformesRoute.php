<?php

	Route::get('preinformes',[
		'as' => 'filial.preinformes',
		'uses' => 'PreinformeController@lista'
	 ]);

	Route::group(['middleware' => 'habilitado'], function(){

		Route::get('preinformes_seleccion',[
			'as' => 'filial.preinformes_seleccion',
			'uses' => 'PreinformeController@seleccion'
		 ]);

		Route::get('preinformes_nuevo/{id}',[
			'as'	=>	'filial.preinformes_nuevo',
			'uses'	=>	'PreinformeController@nuevo'
		]);

		Route::get('preinformes_nuevaPersona',[
			'as'	=>	'filial.preinformes_nuevaPersona',
			'uses'	=>	'PreinformeController@nuevaPersona'
		]);

		Route::post('preinformes_nuevo_post',[
			'as'	=>	'filial.preinformes_nuevo_post',
			'uses'	=>	'PreinformeController@nuevo_post'
		]);

		Route::post('preinformes_nuevaPersona_post',[
			'as'	=>	'filial.preinformes_nuevaPersona_post',
			'uses'	=>	'PreinformeController@nuevaPersona_post'
		]);

		Route::get('preinformes_editar/{id}',[
			'as'	=> 'filial.preinformes_editar',
			'uses'	=>	'PreinformeController@editar'
		]);

		Route::post('preinformes_editar_post',[
			'as'	=> 'filial.preinformes_editar_post',
			'uses'	=>	'PreinformeController@editar_post'
		]);

		Route::get('preinformes_nuevoDatos',[
			'as'	=>	'filial.preinformes_nuevoDatos',
			'uses'	=>	'PreinformeController@nuevoDatos'
		]);

		Route::post('preinformes_nuevoDatosMedio_post',[
			'as'	=>	'filial.preinformes_nuevoDatosMedio_post',
			'uses'	=>	'PreinformeController@nuevoDatosMedio_post'
		]);

		Route::post('preinformes_nuevoDatosEncontro_post',[
			'as'	=>	'filial.preinformes_nuevoDatosEncontro_post',
			'uses'	=>	'PreinformeController@nuevoDatosEncontro_post'
		]);

	});