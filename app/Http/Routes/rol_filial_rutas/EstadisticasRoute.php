<?php
Route::get('estadisticas',[
	'as' => 'filial.estadisticas',
	'uses' => 'EstadisticaController@index'
]);

Route::get('test',[
	'as' => 'filial.test',
	'uses' => 'EstadisticaController@test'
]);


Route::get('detalles',[

	'as' => 'estadisticas.detalles',
	'uses' => 'EstadisticaController@detalles'

]);
