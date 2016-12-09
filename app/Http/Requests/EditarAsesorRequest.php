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
            // 'telefono' => 'required',
            // 'mail' => 'required',
        ];
    }

    public function messages()
    {
        return [
            'tipo_documento_id.required' => 'Seleccione un tipo de documento',
            'nro_documento.required' => 'El número de documento es requerido',
            'nro_documento.numeric'=> 'El número de documento es numérico', 
            'nombres.required' => 'El nombre es requerido',
            'apellidos.required' => 'El apellido es requerido ', 
            'direccion.required' => 'La dirección es requerida',
            'localidad.required' => 'La localidad es requerida',
            // 'telefono.required' => 'El teléfono es requerido',
            // 'mail.required' => 'El mail es requerido',
        ];
    }
}