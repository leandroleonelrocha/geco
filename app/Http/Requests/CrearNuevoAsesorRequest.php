<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevoAsesorRequest extends Request
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
        $rules = [
                    'tipo_documento_id' => 'required',
                    'nro_documento' => 'required', 
                    'nro_documento' => 'required|unique:asesor,nro_documento',
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
            'nro_documento.required' => 'Escriba un número de documento.',
            'nro_documento.unique'=> 'El número de documento ya está en uso.', 
            'nombres.required' => 'Escriba el nombre.',
            'apellidos.required' => 'Escriba el apellido.', 
            'direccion.required' => 'Escriba la dirección.',
            'localidad.required' => 'Escriba la localidad.',
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