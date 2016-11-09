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

            'id' => 'required',
            'id' => 'required|unique:carrera,id',
            'nombre' => 'required',
            'duracion' => 'required',
            'descripcion' => 'required',
            'nombre' => 'required|unique:carrera,nombre'


        ];
    }

    public function messages()
    {
        return [
            'id.required' => 'Escriba un número de carrera',
            'id.unique'=> 'El número de curso ya está en uso',
            'nombre.required' => 'Escriba un nombre',
            'duracion.required' => 'Escriba la duración',
            'descripcion.required' => 'Escriba la descripción', 
            'nombre.unique'=> 'El nombre de carrera ya está en uso' 
        ];
    }

}