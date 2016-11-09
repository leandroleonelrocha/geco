<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarMateriaRequest extends Request
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

            'id' => 'required',
            'carrera_id'=>'required',
            'nombre' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Escriba un número de materia',
            'carrera_id' => 'Seleccione una materia',
            'nombre.required' => 'Escriba un nombre',
        ];
    }

}