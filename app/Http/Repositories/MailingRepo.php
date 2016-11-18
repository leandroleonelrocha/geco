<?php

namespace App\Http\Repositories;
use App\Entities\Mailing;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;
use Mail;

class MailingRepo extends BaseRepo {

    public function getModel()
    {
        return new Mailing();
    }

    public function sendMail($ruta, $datosMail, $user){
    	return Mail::send($ruta,$datosMail,function($msj) use($user){
			        	$msj->subject('GeCo');
			        	$msj->to($user);
			        });
    }
    
}