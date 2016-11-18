<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevaCarreraRequest extends Request
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
            'duracion' => 'required',
            'nombre' => 'required|unique:carrera,nombre'


        ];
    }

    public function messages()
    {
        return [
            'nombre.required' => 'Escriba un nombre',
            'duracion.required' => 'Escriba la duración',
            'nombre.unique'=> 'El nombre de carrera ya está en uso' 
        ];
    }

}