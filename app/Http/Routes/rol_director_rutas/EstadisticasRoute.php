<?php
Route::get('estadisticas',[
	'as' => 'director.estadisticas',
	'uses' => 'DirectoresController@estadisticas'
]);

Route::post('detalles',[
	'as' => 'director.detalles',
	'uses' => 'DirectoresController@detalles'
]);
