<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoMedioPreinformeRequest extends Request
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
        // return [
        //     'medio' => 'required',
        //     'medio' => 'required|unique:preinforme_medio,medio',
        // ];
        $nbr = count($this->input('medio')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['medio.' . $index] = 'required';
        }

        $nbr = count($this->input('medio')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['medio.' . $index] = 'required|unique:preinforme_medio,medio';
        }

        return $rules;
    }

    public function messages()
    {
        // return [
        //     'medio.required' => 'El campo medio es requerido.',
        //     'medio.unique'=> 'El campo medio ya está en uso.', 
        // ];
        $nbr = count($this->input('medio')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['medio.' . $index.'.required'] = 'El campo medio es requerido, ingrese al menos una.';
        }

        $nbr = count($this->input('medio')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['medio.' . $index.'.unique'] = 'El campo medio ya está en uso, ingrese otro.';
        }
        return $messages;
    }

}