<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoEncontroPreinformeRequest extends Request
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
            'como_encontro' => 'required',
            'como_encontro' => 'required|unique:preinforme_como_encontro,como_encontro',
        ];
    }

    public function messages()
    {
        return [
            'como_encontro.required' => 'El campo ¿Cómo nos encontró? es requerido.',
            'como_encontro.unique'=> 'El campo ¿Cómo nos encontró? ya está en uso.', 
        ];
    }

}