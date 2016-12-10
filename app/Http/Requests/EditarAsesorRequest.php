<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarAsesorRequest extends Request
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

            'tipo_documento_id' => 'required',
            'nro_documento' => 'required', 
            'nro_documento' => 'required|numeric',
            'apellidos' => 'required',
            'nombres' => 'required',
            'direccion' => 'required',
            'localidad' => 'required',
        ];
        
        $nbr = count($this->input('telefono')) - 1;
        foreach(range(0, $nbr) as $index) {
            $rules['telefono.' . $index] = 'required';
        }

        $nbr = count($this->input('mail')) - 1;
        foreach(range(0, $nbr) as $index) {

            $rules['mail.' . $index] = 'required';
        }
        return $rules;
    }

    public function messages(){
        
        $messages = [
            'tipo_documento_id.required' => 'Seleccione un tipo de documento.',
            'nro_documento.required' => 'El número de documento es requerido.',
            'nro_documento.numeric'=> 'El número de documento es numérico.', 
            'nombres.required' => 'El nombre es requerido.',
            'apellidos.required' => 'El apellido es requerido.', 
            'direccion.required' => 'La dirección es requerida.',
            'localidad.required' => 'La localidad es requerida',
        ];

        $nbr = count($this->input('telefono')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['telefono.' . $index.'.required'] = 'Escriba almenos un teléfono.';
        }

        $nbr = count($this->input('mail')) - 1;
        foreach(range(0, $nbr) as $index) {
            $messages['mail.' . $index.'.required'] = 'Escriba almenos un e-mail.';
        }

        return $messages;
    }
}