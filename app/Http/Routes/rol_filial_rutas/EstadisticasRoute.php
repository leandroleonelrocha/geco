<?php
Route::get('estadisticas',[
	'as' => 'filial.estadisticas',
	'uses' => 'EstadisticaController@index'
]);


Route::post('detalles',[

	'as' => 'estadisticas.detalles',
	'uses' => 'EstadisticaController@detalles'

]);
