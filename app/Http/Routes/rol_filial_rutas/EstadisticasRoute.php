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

Route::get('estadisticas/caja_diaria',[
	'as' => 'estadisticas.caja_diaria',
	'uses' => 'EstadisticaController@caja_diaria'
]);

Route::get('estadisticas/preinforme',[
	'as' => 'estadisticas.preinforme',
	'uses' => 'EstadisticaController@preinforme'
]);