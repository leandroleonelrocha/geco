<?php
Route::get('estadisticas',[
	'as' 	=> 'dueño.estadisticas',
	'uses' 	=> 'DuenoController@estadisticas'
]);
Route::post('detalles',[
	'as' => 'dueno.estadisticas_detalles',
	'uses' => 'DuenoController@detalles'
]);
