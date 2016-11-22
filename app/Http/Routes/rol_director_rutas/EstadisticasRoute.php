<?php
Route::get('estadisticas',[
	'as' => 'director.estadisticas',
	'uses' => 'EstadisticaController@index'
]);

Route::post('procesarAjax',[
	'as' => 'estadisticas.procesarAjax',
	'uses' => 'EstadisticaController@procesarAjax'
]);
