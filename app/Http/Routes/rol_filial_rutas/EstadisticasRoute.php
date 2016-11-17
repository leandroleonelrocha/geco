<?php
Route::get('estadisticas',[
	'as' => 'filial.estadisticas',
	'uses' => 'EstadisticaController@index'
]);

Route::get('test',[
	'as' => 'filial.test',
	'uses' => 'EstadisticaController@test'
]);

Route::post('estadistica_preinformes_ajax',[
	'as' => 'estadisticas.estadistica_preinformes_ajax',
	'uses' => 'EstadisticaController@estadistica_preinformes_ajax'
]);


Route::post('estadistica_inscripcion_ajax',[
	'as' => 'estadisticas.estadistica_inscripcion_ajax',
	'uses' => 'EstadisticaController@estadistica_inscripcion_ajax'
]);

Route::get('detalles',[

	'as' => 'estadisticas.detalles',
	'uses' => 'EstadisticaController@detalles'

]);
