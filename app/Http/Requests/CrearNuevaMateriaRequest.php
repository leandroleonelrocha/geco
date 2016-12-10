<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevaMateriaRequest extends Request
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
            'carrera_id'=>'required',
            'nombre' => 'required',
            'nombre' => 'required|unique:materia,nombre',
        ];
    }

    public function messages()
    {
        return [
            'carrera_id' => 'Seleccione una carrera.',
            'nombre.required' => 'El nombre es requerido.',
            'nombre.unique'=> 'El nombre de la materia ya está en uso.', 
        ];
    }

}