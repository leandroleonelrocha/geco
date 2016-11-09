<?php

namespace App\Http\Repositories;
use App\Entities\TipoDocumento;
use App\Http\Repositories\BaseRepo;
use Illuminate\Support\Facades\Auth;

class TipoDocumentoRepo extends BaseRepo {

    public function getModel()
    {
        return new TipoDocumento();
    }
}