<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoCursoRequest extends Request
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
            'nombre' => 'required|unique:curso,nombre'
            'duracion' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'El nombre es requerido',
            'nombre.unique'=> 'El nombre del curso ya está en uso' 
            'duracion.required' => 'La duración es requerida',
        ];
    }
}