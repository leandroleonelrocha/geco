<?php
Route::get('estadisticas',[
	'as' => 'director.estadisticas',
	'uses' => 'DirectoresController@estadisticas'
]);

Route::post('estadisticas_detalles',[
	'as' => 'director.estadisticas_detalles',
	'uses' => 'DirectoresController@estadisticas_detalles'
]);
