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
            'apellidos' => 'required',
            'nombres' => 'required',
            'direccion' => 'required',
            'localidad' => 'required',
            'telefono' => 'required',
            'mail' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'tipo_documento_id.required' => 'Seleccione un tipo de documento',
            'nro_documento.required' => 'Escriba un número de documento',
            'nombres.required' => 'Escriba el nombre',
            'apellidos.required' => 'Escriba el apellido', 
            'direccion.required' => 'Escriba la dirección',
            'localidad.required' => 'Escriba la localidad',
            'telefono.required' => 'Escriba el teléfono',
            'mail.required' => 'Escriba el E-mail',
        ];
    }

}