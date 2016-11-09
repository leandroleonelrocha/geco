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
        return [

            'tipo_documento_id' => 'required',
            'nro_documento' => 'required', 
            'nro_documento' => 'required|unique:asesor,nro_documento',
            'apellidos' => 'required',
            'nombres' => 'required',
            'direccion' => 'required',
            'localidad' => 'required',
            'telefono' => 'required',
            'mail' => 'required',
            'mail' => 'required|unique:asesor_mail,mail',

        ];
    }

    public function messages()
    {
        return [
            'tipo_documento_id.required' => 'Seleccione un tipo de documento',
            'nro_documento.required' => 'Escriba un número de documento',
            'nro_documento.unique'=> 'El número de documento ya está en uso', 
            'nombres.required' => 'Escriba el nombre',
            'apellidos.required' => 'Escriba el apellido', 
            'direccion.required' => 'Escriba la dirección',
            'localidad.required' => 'Escriba la localidad',
            'telefono.required' => 'Escriba el teléfono',
            'mail.required' => 'Escriba el E-mail',
            'mail.unique'=> 'El mail ya está en uso', 
        ];
    }

}