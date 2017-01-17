<?php
Route::group(['prefix' => 'examenes'], function(){

	Route::get('', [
		'as'	=>	'filial.examenes',
		'uses'	=>	'ExamenController@index'
	]);

	Route::group(['middleware' => 'habilitado'], function(){

		Route::get('nuevo',[
			'as'	=>	'filial.examenes_nuevo',
			'uses'	=>	'ExamenController@nuevo'
		]);

		Route::post('examenes_nuevo_post',[
			'as'	=>	'filial.examenes_nuevo_post',
			'uses'	=>	'ExamenController@nuevo_post'
		]);

		Route::get('examenes_borrar/{id}',[
			'as'	=> 'filial.examenes_borrar',
			'uses'	=>	'ExamenController@borrar'
		]);

		Route::get('editar/{id}',[
			'as'	=> 'filial.examenes_editar',
			'uses'	=>	'ExamenController@editar'
		]);

		Route::post('examenes_editar_post/{id}',[
			'as'	=> 'filial.examenes_editar_post',
			'uses'	=>	'ExamenController@editar_post'
		]);

	    Route::post('grupos_examenes',[
			'as' 	=> 'filial.examenes_grupos_examenes',
			'uses' 	=> 'ExamenController@grupos_examenes'
	    ]);

	    Route::get('detalles/{nro_acta}',[
	    	'as' 	=> 'filial.examenes_detalles',
	        'uses' 	=> 'ExamenController@detalles'
	    ]);

	    Route::get('examenes_recuperatorio/{id}',[
			'as'	=> 'filial.examenes_recuperatorio',
			'uses'	=> 'ExamenController@recuperartorio'
		]);

		Route::post('examenes_recuperatorio_post',[
			'as'	=> 'filial.examenes_recuperatorio_post',
			'uses'	=> 'ExamenController@recuperartorio_post'
		]);

		Route::get('imprimir_acta', function () {
		   
		    $pdf   		= PDF::loadView('impresiones.impresion_acta_examen');
			return $pdf->stream();
		});



	    
	});

});
