<?php
	
	Route::get('recibos/{id}',[
		'as'	=> 'filial.recibos',
		'uses'	=>	'ReciboController@lista'
	]);
	Route::group(['middleware' => 'habilitado'], function(){
		Route::get('recibo_nuevo/{id}',[
			'as'	=> 'filial.recibo_nuevo',
			'uses'	=>	'ReciboController@nuevo'
		]);

		Route::post('recibo_nuevo_post',[
			'as'	=> 'filial.recibo_nuevo_post',
			'uses'	=>	'ReciboController@nuevo_post'
		]);

		Route::get('recibo_imprimir/{id?}',[
			'as'	=> 'filial.recibo_imprimir',
			'uses'	=>	'ReciboController@imprimir'
		]);

		Route::get('carrito_imprimir',[
			'as'	=> 'filial.carrito_imprimir',
			'uses'	=>	'ReciboController@carrito_imprimir'
		]);

	});

		
	// Route::get('recibo_imprimir/{id}',function(){
	// 	$pdf = PDF::loadView('pdf.recibos');
	// 	return $pdf->download('recibos.pdf');
	// });
	
