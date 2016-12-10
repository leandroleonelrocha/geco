<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoDirectorRequest extends Request
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
        $rules= [
            'tipo_documento_id' => 'required',
            'nro_documento' => 'required',
            'nro_documento' => 'required|unique:director,nro_documento',
            'nro_documento' => 'required|numeric',
            'apellidos' => 'required',
            'nombres' => 'required',
            'mail' => 'required',
        ];

        $nbr = count($this->input('telefono')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['telefono.' . $index] = 'required';
        }
        return $rules;
    }

    public function messages()
    {
        $messages= [
            'tipo_documento_id.required' => 'Seleccione un tipo de documento.',
            'nro_documento.required' => 'El número de documento es requerido.',
            'nro_documento.unique'=> 'El número de documento ya está en uso.', 
            'nro_documento.numeric'=> 'El número de documento es numérico.',
            'nombres.required' => 'El nombre es requerido.',
            'apellidos.required' => 'El apellido es requerido.', 
            'mail.required' => 'El mail es requerido.', 
        ];

        $nbr = count($this->input('telefono')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['telefono.' . $index.'.required'] = 'Escriba almenos un teléfono.';
        }
        return $messages;
    }
}