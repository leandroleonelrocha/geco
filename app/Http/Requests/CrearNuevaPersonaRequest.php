<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class CrearNuevaPersonaRequest extends Request
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
           // 'asesor_id' => 'required',
            'tipo_documento_id' => 'required',
            'nro_documento' => 'required',
            // 'nro_documento' => 'required|unique:persona,nro_documento',
            'nro_documento' => 'required|numeric',
            'apellidos' => 'required',
            'nombres' => 'required',
            // 'genero'=> 'required',
            'fecha_nacimiento'=> 'required',
            'domicilio' => 'required',
            'localidad' => 'required',
            'estado_civil' => 'required',
            'nivel_estudios' => 'required',
            // 'telefono' => 'required',
            // 'mail' => 'required',
            // 'mail' => 'required|unique:persona_mail,mail',
        ];
    }

    public function messages()
    {
        return [
            //  'asesor_id.required' => 'Seleccione un asesor',
            'tipo_documento_id.required' => 'Seleccione un tipo de documento',
            'nro_documento.required' => 'El número de documento es requerido',
            // 'nro_documento.unique'=> 'El número de documento ya está en uso', 
            'nro_documento.numeric'=> 'El número de documento es numérico', 
            'apellidos.required' => 'El apellido es requerido',
            'nombres.required' => 'El nombre es requerido',
            // 'genero.required' => 'Seleccione un género',
            'fecha_nacimiento.required' => 'La fecha de nacimiento es requerida',
            'domicilio.required' => 'El domicilio es requerido',
            'localidad.required' => 'La localidad es requerida',
            'estado_civil.required' => 'El estado civil es requerido',
            'nivel_estudios.required' => 'El nivel estudios es requerido',
            // 'telefono.required' => 'El teléfono es requerido',
            // 'mail.required' => 'El mail es requerido', 
            // 'mail.unique'=> 'El mail ya está en uso',
        ];
    }

}