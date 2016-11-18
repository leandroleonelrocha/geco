<?php
Route::get('estadisticas',[
	'as' => 'estadisticas.inicio',
	'uses' => 'EstadisticaController@index'
]);

Route::post('procesarAjax',[
	'as' => 'estadisticas.procesarAjax',
	'uses' => 'EstadisticaController@procesarAjax'
]);
