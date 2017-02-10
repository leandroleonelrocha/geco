<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarAulaRequest extends Request
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
            'nombre' => 'required',

            'nombre' => 'required|unique:aula,nombre',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre de aula es requerido.',
            'nombre.unique'=> 'El nombre de aula ya está en uso o esta guardando la misma.', 
        ];
    }
}