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
            'nro_documento' => 'required|unique:persona,nro_documento',
            'apellidos' => 'required',
            'nombres' => 'required',
            'genero'=> 'required',
            'fecha_nacimiento'=> 'required',
            'domicilio' => 'required',
            'localidad' => 'required',
            'telefono' => 'required',
            'mail' => 'required',
            'estado_civil' => 'required',
            'nivel_estudios' => 'required',
            'mail' => 'required|unique:persona_mail,mail',

        ];
    }

    public function messages()
    {
        return [

          //  'asesor_id.required' => 'Seleccione un asesor',
            'tipo_documento_id.required' => 'Seleccione un tipo de documento',
            'nro_documento.required' => 'Escriba un número documento',
            'nro_documento.unique'=> 'El número de documento ya está en uso', 
            'apellidos.required' => 'Escriba el apellido',
            'nombres.required' => 'Escriba el nombre',
            'genero.required' => 'Seleccione un género',
            'fecha_nacimiento.required' => 'Escriba la fecha de nacimiento',
            'domicilio.required' => 'Escriba el domicilio',
            'localidad.required' => 'Escriba la localidad',
            'telefono.required' => 'Escriba el teléfono',
            'mail.required' => 'Escriba el mail',
            'localidad.required' => 'Escriba la localidad',
            'estado_civil.required' => 'Escriba el estado civil',
            'nivel_estudios.required' => 'Escriba el nivel de estudios',
            'mail.unique'=> 'El mail ya está en uso', 
        ];
    }

}