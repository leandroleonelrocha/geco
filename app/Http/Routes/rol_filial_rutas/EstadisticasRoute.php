<?php
Route::get('estadisticas',[
	'as' => 'filial.estadisticas',
	'uses' => 'EstadisticaController@index'
]);

Route::post('procesarAjax',[
	'as' => 'estadisticas.procesarAjax',
	'uses' => 'EstadisticaController@procesarAjax'
]);
