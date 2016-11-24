<?php
Route::get('estadisticas',[
	'as' => 'director.estadisticas',
	'uses' => 'DirectoresController@estadisticas'
]);

Route::get('estadisticas_detalles',[
	'as' => 'director.estadisticas_detalles',
	'uses' => 'DirectoresController@estadisticas_detalles'
]);
