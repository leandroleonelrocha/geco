<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevaAulaRequest extends Request
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

        $nbr = count($this->input('nombre')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['nombre.' . $index] = 'required';
        }

        $nbr = count($this->input('nombre')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['nombre.' . $index] = 'required|unique:aula,nombre';
        }

        return $rules;
    }

    public function messages(){

        $nbr = count($this->input('nombre')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['nombre.' . $index.'.required'] = 'El nombre de aula es requerida, escriba al menos una.';
        }

        $nbr = count($this->input('nombre')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['nombre.' . $index.'.unique'] = 'El nombre de aula ya esta en uso, ingrese otro.';
        }
        return $messages;
    }
}