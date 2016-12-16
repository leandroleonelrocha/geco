<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoExamenRequest extends Request
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

        
        $nbr = count($this->input('nota')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['nota.' . $index] = 'required';
        }


        return $rules;
    }

    public function messages(){

        $nbr = count($this->input('nota')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['nota.' . $index.'.required'] = 'Escriba almenos una nota.';
        }

        return $messages;
    }
}