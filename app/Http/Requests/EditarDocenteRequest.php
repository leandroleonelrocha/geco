<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarDocenteRequest extends Request
{
    /**
     * Determine if the user is authorized to make this request.
     *
     * @return bool
     */
    public function authorize()
    {
        return true;
    }

    /**
     * Get the validation rules that apply to the request.
     *
     * @return array
     */
    public function rules()
    {
        return [

            'tipo_documento_id' => 'required',
            'nro_documento' => 'required',
            'apellidos' => 'required',
            'nombres' => 'required',
            'descripcion' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'tipo_documento_id.required' => 'Escriba un tipo de documento',
            'nro_documento.required' => 'Escriba el número de documento',  
            'apellidos.required' => 'Escriba el nombre',
            'nombres.required' => 'Escriba el apellido',
            'descripcion.required' => 'Escriba la descripción',     
        ];
    }

}