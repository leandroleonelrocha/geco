<?php
Route::get('estadisticas',[
	'as' => 'filial.estadisticas',
	'uses' => 'EstadisticaController@index'
]);


Route::post('detalles',[
	'as' => 'estadisticas.detalles',
	'uses' => 'EstadisticaController@detalles'
]);

Route::get('estadisticas/lista',[
	'as' => 'estadisticas.lista',
	'uses' => 'EstadisticaController@lista'
]);