<?php
Route::get('estadisticas',[
		'as' => 'estadisticas.inicio',
		'uses' => 'EstadisticaController@index'
	 ]);

