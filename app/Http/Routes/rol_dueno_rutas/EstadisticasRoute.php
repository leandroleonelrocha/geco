<?php
	Route::get('estadisticas',[
		'as' 	=> 'dueño.estadisticas',
		'uses' 	=> 'DuenoController@estadisticas'
	 ]);
