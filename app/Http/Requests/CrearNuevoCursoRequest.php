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

            'id' => 'required',
            'id' => 'required|unique:curso,id',
            'nombre' => 'required',
            'duracion' => 'required',
            'nombre' => 'required|unique:curso,nombre'



        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Escriba un número de curso',
            'id.unique'=> 'El número de curso ya está en uso',
            'nombre.required' => 'Escriba un nombre',
            'duracion.required' => 'Escriba la duración',
            'nombre.unique'=> 'El nombre del curso ya está en uso' 
        ];
    }

}