<?php

	Route::get('mails',[
		'as' => 'filial.mails',
		'uses' => 'MailingController@lista'
	 ]);

	Route::get('mails_enviar',[
		'as' => 'filial.mails_enviar',
		'uses' => 'MailingController@enviar_post'
	 ]);