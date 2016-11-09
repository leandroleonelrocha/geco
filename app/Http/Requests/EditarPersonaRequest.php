<?php

namespace App\Http\Requests;
use App\Http\Requests\Request;

class EditarPersonaRequest extends Request
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
            'genero'=> 'required',
            'fecha_nacimiento'=> 'required',
            'domicilio' => 'required',
            'localidad' => 'required',
            'telefono' => 'required',
            'mail' => 'required',
            'estado_civil' => 'required',
            'nivel_estudios' => 'required',
            'aclaraciones' => 'required',

        ];
    }

    public function messages()
    {
        return [
            'tipo_documento_id.required' => 'Seleccione un tipo de documento',
            'nro_documento.required' => 'Escriba un número documento', 
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
            'aclaraciones.required' => 'Escriba una aclaración', 
        ];
    }

}